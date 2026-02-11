<script>
  import { editorCode, isExecuting } from '../lib/store.js';
  import GolampiAPI from '../lib/api.js';
  import Console from './Console.svelte';
  import SymbolTable from './SymbolTable.svelte';
  import Sidebar from './Sidebar.svelte';
  import { clearConsole, addError, addConsoleOutput, addToHistory } from '../lib/store.js';

  let showSymbolTable = false;
  let isLoading = false;
  let executionTime = 0;

  async function executeCode() {
    if ($isExecuting) return;

    clearConsole();
    isLoading = true;
    isExecuting.set(true);

    const startTime = performance.now();

    try {
      const result = await GolampiAPI.executeCode($editorCode);

      executionTime = Math.round(performance.now() - startTime);

      if (result.success) {
        // Agregar salida
        if (result.output && result.output.length > 0) {
          result.output.forEach(line => {
            addConsoleOutput({
              type: 'output',
              message: line,
              timestamp: new Date().toLocaleTimeString(),
            });
          });
        }

        // Agregar símbolos
        if (result.symbolTable) {
          const symbols = Array.isArray(result.symbolTable) 
            ? result.symbolTable 
            : Object.entries(result.symbolTable).map(([key, value]) => ({
                name: key,
                ...value
              }));
          
          console.log('Symbol Table:', symbols);
        }

        addConsoleOutput({
          type: 'success',
          message: `Execution completed successfully (${executionTime}ms).`,
          timestamp: new Date().toLocaleTimeString(),
        });
      } else {
        addConsoleOutput({
          type: 'error',
          message: result.error || 'Unknown error',
          timestamp: new Date().toLocaleTimeString(),
        });
      }

      // Agregar al historial
      addToHistory({
        code: $editorCode,
        timestamp: new Date(),
        success: result.success,
        executionTime,
      });

      // Procesar errores
      if (result.errors && result.errors.length > 0) {
        result.errors.forEach(error => {
          addError(error);
          addConsoleOutput({
            type: 'error',
            message: `[${error.type}] ${error.message} (Line ${error.line}, Col ${error.column})`,
            timestamp: new Date().toLocaleTimeString(),
          });
        });
      }
    } catch (error) {
      addConsoleOutput({
        type: 'error',
        message: `Error: ${error.message}`,
        timestamp: new Date().toLocaleTimeString(),
      });
    } finally {
      isLoading = false;
      isExecuting.set(false);
    }
  }

  function newFile() {
    if (confirm('¿Descartar cambios sin guardar?')) {
      editorCode.set('package main\n\nFunc main() {\n  \n}');
      clearConsole();
    }
  }

  function saveFile() {
    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent($editorCode));
    element.setAttribute('download', 'program.golampi');
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
  }
</script>

<div class="editor-container">
  <div class="toolbar">
    <div class="title">
      <h1>GolampiDE</h1>
      <p>Intérprete interactivo del lenguaje Golampi</p>
    </div>
    
    <div class="controls">
      <button class="btn btn-primary" on:click={executeCode} disabled={$isExecuting}>
        {#if $isExecuting}
          <span class="spinner"></span> Ejecutando...
        {:else}
          ▶ Ejecutar
        {/if}
      </button>
      
      <button class="btn" on:click={() => clearConsole()} disabled={$isExecuting}>
        🗑️ Limpiar
      </button>
      
      <button class="btn" on:click={newFile} disabled={$isExecuting}>
        📄 Nuevo
      </button>
      
      <button class="btn" on:click={saveFile} disabled={$isExecuting}>
        💾 Guardar
      </button>
    </div>
  </div>

  <div class="main-content">
    <Sidebar />

    <div class="editor-section">
      <div class="code-editor">
        <textarea
          bind:value={$editorCode}
          placeholder="Escribe tu código Golampi aquí..."
          disabled={$isExecuting}
        ></textarea>
      </div>
    </div>

    <div class="output-section">
      <div class="panel-tabs">
        <button 
          class="tab" 
          class:active={!showSymbolTable}
          on:click={() => showSymbolTable = false}
        >
          📊 Consola
        </button>
        <button 
          class="tab" 
          class:active={showSymbolTable}
          on:click={() => showSymbolTable = true}
        >
          📋 Tabla de Símbolos
        </button>
      </div>

      {#if showSymbolTable}
        <SymbolTable />
      {:else}
        <Console />
      {/if}
    </div>
  </div>
</div>

<style>
  .editor-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
    background: #1e1e1e;
    color: #e0e0e0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 20px;
    background: #2d2d2d;
    border-bottom: 1px solid #3e3e3e;
    gap: 20px;
  }

  .title {
    flex: 1;
  }

  .title h1 {
    margin: 0;
    font-size: 24px;
    color: #4a9eff;
  }

  .title p {
    margin: 0;
    font-size: 12px;
    color: #888;
  }

  .controls {
    display: flex;
    gap: 10px;
  }

  .btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    background: #3e3e3e;
    color: #e0e0e0;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .btn:hover:not(:disabled) {
    background: #4a4a4a;
  }

  .btn-primary {
    background: #4a9eff;
    color: #fff;
  }

  .btn-primary:hover:not(:disabled) {
    background: #2e8fd4;
  }

  .btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }

  .spinner {
    display: inline-block;
    width: 14px;
    height: 14px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #4a9eff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .main-content {
    display: flex;
    flex: 1;
    gap: 1px;
    overflow: hidden;
  }

  .editor-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #1e1e1e;
  }

  .code-editor {
    flex: 1;
    overflow: hidden;
  }

  .code-editor textarea {
    width: 100%;
    height: 100%;
    border: none;
    padding: 16px;
    background: #1e1e1e;
    color: #d4d4d4;
    font-family: 'Courier New', monospace;
    font-size: 14px;
    line-height: 1.5;
    resize: none;
    outline: none;
  }

  .code-editor textarea::placeholder {
    color: #666;
  }

  .output-section {
    flex: 0.5;
    display: flex;
    flex-direction: column;
    background: #252526;
    border-left: 1px solid #3e3e3e;
  }

  .panel-tabs {
    display: flex;
    border-bottom: 1px solid #3e3e3e;
  }

  .tab {
    flex: 1;
    padding: 10px;
    border: none;
    background: transparent;
    color: #888;
    cursor: pointer;
    font-size: 13px;
    border-bottom: 2px solid transparent;
    transition: all 0.3s;
  }

  .tab.active {
    color: #4a9eff;
    border-bottom-color: #4a9eff;
  }

  .tab:hover {
    color: #aaa;
  }
</style>
