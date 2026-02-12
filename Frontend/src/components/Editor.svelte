<script lang="ts">
  import { onMount } from 'svelte';
  import { editorCode, consoleOutput, symbolTable, errors, isExecuting } from '../lib/store.js';
  import Console from './Console.svelte';
  import { executeCode, clearAll, fetchLastErrors, fetchLastSymbols } from '../lib/api.js';
  import Modal from './Modal.svelte';
  import ErrorsTable from './ErrorsTable.svelte';
  import SymbolsTable from './SymbolsTable.svelte';

  let activeTab = 'console';
  let fileName = 'main.golampi';
  let lineNumbers = [];
  let executionTime = '0ms';
  let isModalOpen = false;
  let modalContent: 'errors' | 'symbols' | null = null;
  
  $: updateLineNumbers($editorCode);
  
  function updateLineNumbers(code) {
    const lines = code.split('\n').length;
    lineNumbers = Array.from({ length: lines }, (_, i) => i + 1);
  }
  
  async function runCode() {
    if ($isExecuting) return;
    
    isExecuting.set(true);
    consoleOutput.set([
      { type: 'system', message: 'Connecting to backend server...' },
      { type: 'success', message: 'Initiated interpreter' },
    ]);
    
    const result = await executeCode($editorCode);
    
    if (result.success) {
      // Agregar output a consola
      result.output.forEach(line => {
        consoleOutput.update(items => [...items, { type: 'output', message: line }]);
      });
      
      consoleOutput.update(items => [
        ...items,
        { type: 'success', message: `Execution completed successfully (${result.executionTime}).` }
      ]);
      
      executionTime = result.executionTime;
    } else {
      // Mostrar errores detallados si vienen del backend
      if (result.errors && result.errors.length > 0) {
        result.errors.forEach(err => {
          const pos = (err.line || err.column) ? ` (line ${err.line || 0}, col ${err.column || 0})` : '';
          const msg = `${err.type}: ${err.description}${pos}`;
          consoleOutput.update(items => [...items, { type: 'error', message: msg }]);
        });
      } else {
        consoleOutput.update(items => [
          ...items,
          { type: 'error', message: result.error || 'Execution failed' }
        ]);
      }
    }
    
    // Actualizar símbolos y errores
    symbolTable.set(result.symbolTable || []);
    errors.set(result.errors || []);
    
    isExecuting.set(false);
  }

  async function showLastErrors() {
    const res = await fetchLastErrors();
    if (res && res.success) {
      errors.set(res.errors || []);
    } else {
      errors.set([]);
    }
    modalContent = 'errors';
    isModalOpen = true;
  }

  async function showLastSymbols() {
    const res = await fetchLastSymbols();
    if (res && res.success) {
      symbolTable.set(res.symbolTable || []);
    } else {
      symbolTable.set([]);
    }
    modalContent = 'symbols';
    isModalOpen = true;
  }
  
  function clear() {
    clearAll();
    executionTime = '0ms';
  }
  
  function newFile() {
    if (confirm('Discard unsaved changes?')) {
      editorCode.set('package main\n\nfunc main() {\n    \n}');
      clear();
    }
  }
  
 function loadFile() {
  const input = document.createElement('input');
  input.type = 'file';
  input.accept = '.golampi';

  input.onchange = (e) => {
    const target = e.target as HTMLInputElement;
    if (!target.files || target.files.length === 0) return;

    const file = target.files[0];
    const reader = new FileReader();

    reader.onload = (event) => {
      const readerTarget = event.target as FileReader;
      const result = readerTarget.result;

      if (typeof result === 'string') {
        editorCode.set(result);
        fileName = file.name;
      }
    };

    reader.readAsText(file);
  };

  input.click();
}

  
  function saveFile() {
    const blob = new Blob([$editorCode], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
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
          <rect x="3" y="3" width="18" height="18" rx="2" stroke="#4A9EFF" stroke-width="2"/>
          <path d="M8 12L11 15L16 9" stroke="#4A9EFF" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span class="logo-text">Golampi<span class="logo-ide">IDE</span></span>
      </div>
      
      <button class="toolbar-btn" on:click={newFile}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M14.5 2.5h-13A.5.5 0 001 3v10a.5.5 0 00.5.5h13a.5.5 0 00.5-.5V3a.5.5 0 00-.5-.5zM2 12V4h12v8H2z"/>
        </svg>
        New
      </button>
      
      <button class="toolbar-btn" on:click={loadFile}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M2 2h8l4 4v7a1 1 0 01-1 1H3a1 1 0 01-1-1V3a1 1 0 011-1z"/>
        </svg>
        Load
      </button>
      
      <button class="toolbar-btn" on:click={saveFile}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M13 2H3a1 1 0 00-1 1v10a1 1 0 001 1h10a1 1 0 001-1V3a1 1 0 00-1-1zM4 3h8v2H4V3zm8 10H4V7h8v6z"/>
        </svg>
        Save
      </button>
      
      <button class="toolbar-btn primary" on:click={runCode} disabled={$isExecuting}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M4 2l10 6-10 6V2z"/>
        </svg>
        Run Interpreter
      </button>
      
      <button class="toolbar-btn danger" on:click={clear}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M5 3h6v1h2V3a1 1 0 00-1-1H4a1 1 0 00-1 1v1h2V3zm8 2H3v9a1 1 0 001 1h8a1 1 0 001-1V5z"/>
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
        <div class="line-numbers">
          {#each lineNumbers as num}
            <div class="line-number">{num}</div>
          {/each}
        </div>
        
        <textarea
          bind:value={$editorCode}
          class="code-editor"
          spellcheck="false"
          disabled={$isExecuting}
        ></textarea>
      </div>
    </div>
    
    <!-- Right: Output -->
    <div class="output-section">
      <div class="output-tabs">
        <button 
          class="output-tab" 
          class:active={activeTab === 'console'}
          on:click={() => activeTab = 'console'}
        >
          <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
            <path d="M2 2h12v12H2V2zm1 1v10h10V3H3z"/>
          </svg>
          OUTPUT CONSOLE
        </button>
      </div>
      
      <div class="output-content">
        {#if activeTab === 'console'}
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
          <path d="M2 3h12v2H2V3zm0 4h12v2H2V7zm0 4h12v2H2v-2z"/>
        </svg>
        REPORTS & ANALYSIS
      </button>
      
      <button class="bottom-btn active" on:click={() => activeTab = 'results'}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M3 2h10a1 1 0 011 1v10a1 1 0 01-1 1H3a1 1 0 01-1-1V3a1 1 0 011-1z"/>
        </svg>
        AST
      </button>
      
      <button class="bottom-btn error" on:click={showLastErrors}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <circle cx="8" cy="8" r="6" stroke="currentColor" fill="none"/>
          <path d="M8 4v5M8 11v1"/>
        </svg>
        Errors Table
      </button>
      
      <button class="bottom-btn success" on:click={showLastSymbols}>
        <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
          <path d="M2 3h12v10H2V3zm1 1v8h10V4H3z"/>
          <path d="M5 6h6M5 8h6M5 10h4"/>
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
    <Modal on:close={() => isModalOpen = false}>
      {#if modalContent === 'errors'}
        <ErrorsTable />
      {:else if modalContent === 'symbols'}
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
    background: #1E1E1E;
    color: #D4D4D4;
    font-family: 'Segoe UI', system-ui, sans-serif;
  }
  
  /* Top Bar */
  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 48px;
    background: #2D2D2D;
    border-bottom: 1px solid #3E3E3E;
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
    border-right: 1px solid #3E3E3E;
  }
  
  .logo-text {
    font-size: 16px;
    font-weight: 600;
    color: #E0E0E0;
  }
  
  .logo-ide {
    color: #4A9EFF;
  }
  
  .toolbar-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: transparent;
    border: 1px solid #3E3E3E;
    border-radius: 4px;
    color: #D4D4D4;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s;
  }
  
  .toolbar-btn:hover {
    background: #3E3E3E;
    border-color: #4A9EFF;
  }
  
  .toolbar-btn.primary {
    background: #4A9EFF;
    border-color: #4A9EFF;
    color: white;
  }
  
  .toolbar-btn.primary:hover {
    background: #3A8EDF;
  }
  
  .toolbar-btn.danger {
    border-color: #F48771;
    color: #F48771;
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
    border-right: 1px solid #3E3E3E;
  }
  
  .editor-tabs {
    display: flex;
    background: #252526;
    border-bottom: 1px solid #3E3E3E;
  }
  
  .tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #1E1E1E;
    border-right: 1px solid #3E3E3E;
    color: #4A9EFF;
    font-size: 13px;
  }
  
  .tab.active {
    background: #1E1E1E;
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
    color: #D4D4D4;
  }
  
  .editor-header {
    padding: 8px 16px;
    background: #252526;
    border-bottom: 1px solid #3E3E3E;
    font-size: 11px;
    color: #858585;
    font-weight: 600;
  }
  
  .editor-wrapper {
    display: flex;
    flex: 1;
    overflow: hidden;
  }
  
  .line-numbers {
    padding: 12px 8px;
    background: #1E1E1E;
    border-right: 1px solid #3E3E3E;
    color: #858585;
    font-family: 'Consolas', 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.6;
    text-align: right;
    user-select: none;
    min-width: 50px;
  }
  
  .line-number {
    height: 20.8px;
  }
  
  .code-editor {
    flex: 1;
    padding: 12px 16px;
    background: #1E1E1E;
    color: #D4D4D4;
    font-family: 'Consolas', 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.6;
    border: none;
    outline: none;
    resize: none;
    tab-size: 4;
  }
  
  
  .output-section {
    width: 50%;
    display: flex;
    flex-direction: column;
  }
  
.output-tabs {
    display: flex;
    background: #252526;
    border-bottom: 1px solid #3E3E3E;
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
    color: #D4D4D4;
  }
  
  .output-tab.active {
    color: #4A9EFF;
    border-bottom-color: #4A9EFF;
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
    border-top: 1px solid #3E3E3E;
    border-bottom: 1px solid #3E3E3E;
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
    background: #2D2D2D;
    border: 1px solid #3E3E3E;
    border-radius: 4px;
    color: #D4D4D4;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s;
  }
  
  .bottom-btn:hover {
    background: #3E3E3E;
  }
  
  .bottom-btn.active {
    background: #4A9EFF;
    border-color: #4A9EFF;
    color: white;
  }
  
  .bottom-btn.error {
    background: rgba(244, 135, 113, 0.1);
    border-color: #F48771;
    color: #F48771;
  }
  
  .bottom-btn.success {
    background: rgba(106, 153, 85, 0.1);
    border-color: #6A9955;
    color: #6A9955;
  }
  
  .bottom-right {
    display: flex;
    gap: 12px;
    font-size: 12px;
    color: #858585;
  }
  
  .lang-info {
    padding: 4px 8px;
    background: #3E3E3E;
    border-radius: 3px;
  }
  
  /* Status Bar */

</style>