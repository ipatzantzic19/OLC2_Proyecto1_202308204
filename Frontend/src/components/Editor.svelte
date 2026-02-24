<script lang="ts">
  import "monaco-editor/min/vs/editor/editor.main.css";
  import { onMount } from "svelte";
  import { get } from "svelte/store";
  import * as monaco from "monaco-editor";
  import {
    editorCode,
    consoleOutput,
    symbolTable,
    errors,
    isExecuting,
  } from "../lib/store.js";
  import Console from "./Console.svelte";
  import {
    executeCode,
    clearAll,
    fetchLastErrors,
    fetchLastSymbols,
  } from "../lib/api.js";
  import Modal from "./Modal.svelte";
  import ErrorsTable from "./ErrorsTable.svelte";
  import SymbolsTable from "./SymbolsTable.svelte";

  let activeTab = "console";
  let fileName = "main.golampi";
  let executionTime = "0ms";
  let isModalOpen = false;
  let modalContent: "errors" | "symbols" | null = null;
  let monacoContainer: HTMLDivElement;
  let monacoEditor: monaco.editor.IStandaloneCodeEditor | null = null;
  let unsubscribeEditorCode: (() => void) | null = null;
  let completionProviderDisposable: monaco.IDisposable | null = null;

  function registerGolampiCompletionProvider(): monaco.IDisposable {
    return monaco.languages.registerCompletionItemProvider("go", {
      triggerCharacters: [".", "(", " "],
      provideCompletionItems: (model, position) => {
        const word = model.getWordUntilPosition(position);
        const range = {
          startLineNumber: position.lineNumber,
          endLineNumber: position.lineNumber,
          startColumn: word.startColumn,
          endColumn: word.endColumn,
        };

        const keywordSuggestions: monaco.languages.CompletionItem[] = [
          "package",
          "func",
          "var",
          "const",
          "if",
          "else",
          "for",
          "switch",
          "case",
          "default",
          "break",
          "continue",
          "return",
          "true",
          "false",
          "nil",
          "int32",
          "float32",
          "bool",
          "string",
          "rune",
        ].map((label) => ({
          label,
          kind: monaco.languages.CompletionItemKind.Keyword,
          insertText: label,
          range,
        }));

        const builtinSuggestions: monaco.languages.CompletionItem[] = [
          {
            label: "fmt.Println",
            kind: monaco.languages.CompletionItemKind.Function,
            insertText: "fmt.Println(${1:valor})",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "len",
            kind: monaco.languages.CompletionItemKind.Function,
            insertText: "len(${1:valor})",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "typeOf",
            kind: monaco.languages.CompletionItemKind.Function,
            insertText: "typeOf(${1:valor})",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "substr",
            kind: monaco.languages.CompletionItemKind.Function,
            insertText: "substr(${1:texto}, ${2:inicio}, ${3:largo})",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "now",
            kind: monaco.languages.CompletionItemKind.Function,
            insertText: "now()",
            range,
          },
        ];

        const snippetSuggestions: monaco.languages.CompletionItem[] = [
          {
            label: "main template",
            kind: monaco.languages.CompletionItemKind.Snippet,
            insertText: "package main\n\nfunc main() {\n\t$0\n}",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "if block",
            kind: monaco.languages.CompletionItemKind.Snippet,
            insertText: "if ${1:condicion} {\n\t$0\n}",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "for block",
            kind: monaco.languages.CompletionItemKind.Snippet,
            insertText: "for ${1:i := 0}; ${2:i < n}; ${3:i++} {\n\t$0\n}",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
          {
            label: "switch block",
            kind: monaco.languages.CompletionItemKind.Snippet,
            insertText:
              "switch ${1:valor} {\ncase ${2:caso}:\n\t$0\ndefault:\n\t\n}",
            insertTextRules:
              monaco.languages.CompletionItemInsertTextRule.InsertAsSnippet,
            range,
          },
        ];

        return {
          suggestions: [
            ...keywordSuggestions,
            ...builtinSuggestions,
            ...snippetSuggestions,
          ],
        };
      },
    });
  }

  onMount(() => {
    completionProviderDisposable = registerGolampiCompletionProvider();

    monacoEditor = monaco.editor.create(monacoContainer, {
      value: get(editorCode),
      language: "go",
      theme: "vs-dark",
      automaticLayout: true,
      minimap: { enabled: false },
      fontSize: 13,
      lineHeight: 21,
      tabSize: 4,
      insertSpaces: true,
      scrollBeyondLastLine: false,
      wordWrap: "off",
      readOnly: get(isExecuting),
    });

    monacoEditor.onDidChangeModelContent(() => {
      if (!monacoEditor) return;
      const value = monacoEditor.getValue();
      if (value !== get(editorCode)) {
        editorCode.set(value);
      }
    });

    unsubscribeEditorCode = editorCode.subscribe((value) => {
      if (!monacoEditor) return;
      const current = monacoEditor.getValue();
      if (value !== current) {
        monacoEditor.setValue(value);
      }
    });

    return () => {
      if (completionProviderDisposable) {
        completionProviderDisposable.dispose();
      }
      if (unsubscribeEditorCode) {
        unsubscribeEditorCode();
      }
      if (monacoEditor) {
        monacoEditor.dispose();
      }
    };
  });

  $: if (monacoEditor) {
    monacoEditor.updateOptions({ readOnly: $isExecuting });
  }

  async function runCode() {
    if ($isExecuting) return;

    isExecuting.set(true);
    consoleOutput.set([
      { type: "system", message: "Connecting to backend server..." },
      { type: "success", message: "Initiated interpreter" },
    ]);

    try {
      const result = await executeCode($editorCode);

      if (result.success) {
        // Agregar output a consola
        result.output.forEach((line) => {
          consoleOutput.update((items) => [
            ...items,
            { type: "output", message: line },
          ]);
        });

        consoleOutput.update((items) => [
          ...items,
          {
            type: "success",
            message: `Execution completed successfully (${result.executionTime}).`,
          },
        ]);

        executionTime = result.executionTime;
      } else {
        // Mostrar errores detallados si vienen del backend
        if (result.errors && result.errors.length > 0) {
          result.errors.forEach((err) => {
            const pos =
              err.line || err.column
                ? ` (line ${err.line || 0}, col ${err.column || 0})`
                : "";
            const msg = `${err.type}: ${err.description}${pos}`;
            consoleOutput.update((items) => [
              ...items,
              { type: "error", message: msg },
            ]);
          });
        } else {
          consoleOutput.update((items) => [
            ...items,
            { type: "error", message: result.error || "Execution failed" },
          ]);
        }
      }

      // Actualizar símbolos y errores
      symbolTable.set(result.symbolTable || []);
      errors.set(result.errors || []);
    } catch (error) {
      consoleOutput.update((items) => [
        ...items,
        {
          type: "error",
          message:
            error instanceof Error
              ? `Execution failed: ${error.message}`
              : "Execution failed due to an unexpected error",
        },
      ]);
    } finally {
      isExecuting.set(false);
    }
  }

  async function showLastErrors() {
    const res = await fetchLastErrors();
    if (res && res.success) {
      errors.set(res.errors || []);
    } else {
      errors.set([]);
    }
    modalContent = "errors";
    isModalOpen = true;
  }

  async function showLastSymbols() {
    const res = await fetchLastSymbols();
    if (res && res.success) {
      symbolTable.set(res.symbolTable || []);
    } else {
      symbolTable.set([]);
    }
    modalContent = "symbols";
    isModalOpen = true;
  }

  function clear() {
    clearAll();
    executionTime = "0ms";
  }

  function newFile() {
    if (confirm("Discard unsaved changes?")) {
      editorCode.set("package main\n\nfunc main() {\n    \n}");
      clear();
    }
  }

  function loadFile() {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = ".golampi";

    input.onchange = (e) => {
      const target = e.target as HTMLInputElement;
      if (!target.files || target.files.length === 0) return;

      const file = target.files[0];
      const reader = new FileReader();

      reader.onload = (event) => {
        const readerTarget = event.target as FileReader;
        const result = readerTarget.result;

        if (typeof result === "string") {
          editorCode.set(result);
          fileName = file.name;
        }
      };

      reader.readAsText(file);
    };

    input.click();
  }

  function saveFile() {
    const blob = new Blob([$editorCode], { type: "text/plain" });
    const url = URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = fileName;
    a.click();
    URL.revokeObjectURL(url);
  }
</script>

<div class="ide-container">
  <!-- Top Bar -->
  <div class="top-bar">
    <div class="top-bar-left">
      <div class="logo">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
          <rect
            x="3"
            y="3"
            width="18"
            height="18"
            rx="2"
            stroke="#4A9EFF"
            stroke-width="2"
          />
          <path
            d="M8 12L11 15L16 9"
            stroke="#4A9EFF"
            stroke-width="2"
            stroke-linecap="round"
          />
        </svg>
        <span class="logo-text">Golampi<span class="logo-ide">IDE</span></span>
      </div>

      <button class="toolbar-btn" on:click={newFile}>
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path
            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
          />
          <path d="M14 2v6h6" />
          <line x1="12" y1="11" x2="12" y2="17" />
          <line x1="9" y1="14" x2="15" y2="14" />
        </svg>
        New
      </button>

      <button class="toolbar-btn" on:click={loadFile}>
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path d="M3 7h5l2 3h11v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
          <path d="M3 7V5a2 2 0 0 1 2-2h4l2 3" />
        </svg>
        Load
      </button>

      <button class="toolbar-btn" on:click={saveFile}>
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path
            d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"
          />
          <polyline points="17 21 17 13 7 13 7 21" />
          <polyline points="7 3 7 8 15 8" />
        </svg>
        Save
      </button>

      <button
        class="toolbar-btn primary"
        on:click={runCode}
        disabled={$isExecuting}
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
          <polygon points="5 3 19 12 5 21 5 3" />
        </svg>
        Run Interpreter
      </button>

      <button class="toolbar-btn danger" on:click={clear}>
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <polyline points="3 6 5 6 21 6" />
          <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
          <path d="M10 11v6M14 11v6" />
          <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
        </svg>
        Clear
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Left: Editor -->
    <div class="editor-section">
      <div class="editor-tabs">
        <div class="tab active">
          <span>{fileName}</span>
          <button class="tab-close">×</button>
        </div>
      </div>

      <div class="editor-header">
        <span>EDITOR</span>
      </div>

      <div class="editor-wrapper">
        <div class="monaco-editor-container" bind:this={monacoContainer}></div>
      </div>
    </div>

    <!-- Right: Output -->
    <div class="output-section">
      <div class="output-tabs">
        <button
          class="output-tab"
          class:active={activeTab === "console"}
          on:click={() => (activeTab = "console")}
        >
          <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
            <path d="M2 2h12v12H2V2zm1 1v10h10V3H3z" />
          </svg>
          OUTPUT CONSOLE
        </button>
      </div>

      <div class="output-content">
        {#if activeTab === "console"}
          <Console />
        {/if}
      </div>
    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="bottom-bar">
    <div class="bottom-left">
      <button class="bottom-btn">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M2 3h12v2H2V3zm0 4h12v2H2V7zm0 4h12v2H2v-2z" />
        </svg>
        REPORTS & ANALYSIS
      </button>

      <button
        class="bottom-btn active"
        on:click={() => (activeTab = "results")}
      >
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <circle cx="12" cy="4" r="2" />
          <circle cx="5" cy="12" r="2" />
          <circle cx="19" cy="12" r="2" />
          <circle cx="12" cy="20" r="2" />
          <line x1="12" y1="6" x2="12" y2="10" />
          <line x1="12" y1="10" x2="5" y2="12" />
          <line x1="12" y1="10" x2="19" y2="12" />
          <line x1="12" y1="14" x2="12" y2="18" />
        </svg>
        AST
      </button>

      <button class="bottom-btn error" on:click={showLastErrors}>
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <circle cx="12" cy="12" r="9" />
          <line x1="12" y1="7" x2="12" y2="13" />
          <circle cx="12" cy="17" r="1.2" fill="currentColor" />
        </svg>
        Errors Table
      </button>

      <button class="bottom-btn success" on:click={showLastSymbols}>
        <svg
          width="16"
          height="16"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <rect x="3" y="4" width="18" height="16" rx="2" />
          <line x1="3" y1="9" x2="21" y2="9" />
          <line x1="8" y1="4" x2="8" y2="20" />
          <line x1="14" y1="4" x2="14" y2="20" />
        </svg>
        Symbol Table
      </button>
    </div>

    <div class="bottom-right">
      <span class="lang-info">PHP-SVR</span>
      <span class="lang-info">ANTLR4</span>
    </div>
  </div>

  {#if isModalOpen}
    <Modal on:close={() => (isModalOpen = false)}>
      {#if modalContent === "errors"}
        <ErrorsTable />
      {:else if modalContent === "symbols"}
        <SymbolsTable />
      {/if}
    </Modal>
  {/if}
</div>

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .ide-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
    background: #1e1e1e;
    color: #d4d4d4;
    font-family: "Segoe UI", system-ui, sans-serif;
  }

  /* Top Bar */
  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 48px;
    background: #2d2d2d;
    border-bottom: 1px solid #3e3e3e;
    padding: 0 16px;
    gap: 12px;
  }

  .top-bar-left {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .logo {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-right: 12px;
    padding-right: 12px;
    border-right: 1px solid #3e3e3e;
  }

  .logo-text {
    font-size: 16px;
    font-weight: 600;
    color: #e0e0e0;
  }

  .logo-ide {
    color: #4a9eff;
  }

  .toolbar-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: transparent;
    border: 1px solid #3e3e3e;
    border-radius: 4px;
    color: #d4d4d4;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .toolbar-btn:hover {
    background: #3e3e3e;
    border-color: #4a9eff;
  }

  .toolbar-btn.primary {
    background: #4a9eff;
    border-color: #4a9eff;
    color: white;
  }

  .toolbar-btn.primary:hover {
    background: #3a8edf;
  }

  .toolbar-btn.danger {
    border-color: #f48771;
    color: #f48771;
  }

  .toolbar-btn.danger:hover {
    background: rgba(244, 135, 113, 0.1);
  }

  .toolbar-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  /* Main Content */
  .main-content {
    display: flex;
    flex: 1;
    overflow: hidden;
  }

  .editor-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #3e3e3e;
  }

  .editor-tabs {
    display: flex;
    background: #252526;
    border-bottom: 1px solid #3e3e3e;
  }

  .tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #1e1e1e;
    border-right: 1px solid #3e3e3e;
    color: #4a9eff;
    font-size: 13px;
  }

  .tab.active {
    background: #1e1e1e;
  }

  .tab-close {
    background: none;
    border: none;
    color: #858585;
    cursor: pointer;
    font-size: 18px;
    padding: 0 4px;
  }

  .tab-close:hover {
    color: #d4d4d4;
  }

  .editor-header {
    padding: 8px 16px;
    background: #252526;
    border-bottom: 1px solid #3e3e3e;
    font-size: 11px;
    color: #858585;
    font-weight: 600;
  }

  .editor-wrapper {
    display: flex;
    flex: 1;
    min-height: 0;
    overflow: hidden;
  }

  .monaco-editor-container {
    flex: 1;
    width: 100%;
    height: 100%;
    min-height: 0;
    background: #1e1e1e;
  }

  .output-section {
    width: 50%;
    display: flex;
    flex-direction: column;
  }

  .output-tabs {
    display: flex;
    background: #252526;
    border-bottom: 1px solid #3e3e3e;
  }

  .output-tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: transparent;
    border: none;
    border-bottom: 2px solid transparent;
    color: #858585;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .output-tab:hover {
    color: #d4d4d4;
  }

  .output-tab.active {
    color: #4a9eff;
    border-bottom-color: #4a9eff;
  }

  .output-content {
    flex: 1;
    overflow: hidden;
  }

  /* Bottom Bar */
  .bottom-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 16px;
    background: #252526;
    border-top: 1px solid #3e3e3e;
    border-bottom: 1px solid #3e3e3e;
  }

  .bottom-left {
    display: flex;
    gap: 8px;
  }

  .bottom-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: #2d2d2d;
    border: 1px solid #3e3e3e;
    border-radius: 4px;
    color: #d4d4d4;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .bottom-btn:hover {
    background: #3e3e3e;
  }

  .bottom-btn.active {
    background: #4a9eff;
    border-color: #4a9eff;
    color: white;
  }

  .bottom-btn.error {
    background: rgba(244, 135, 113, 0.1);
    border-color: #f48771;
    color: #f48771;
  }

  .bottom-btn.success {
    background: rgba(106, 153, 85, 0.1);
    border-color: #6a9955;
    color: #6a9955;
  }

  .bottom-right {
    display: flex;
    gap: 12px;
    font-size: 12px;
    color: #858585;
  }

  .lang-info {
    padding: 4px 8px;
    background: #3e3e3e;
    border-radius: 3px;
  }

  /* Status Bar */
</style>
