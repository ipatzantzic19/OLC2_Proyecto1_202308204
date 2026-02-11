<script>
  import GolampiAPI from '../lib/api.js';

  let examples = [];
  let loading = true;

  // Cargar ejemplos al montar el componente
  const loadExamples = async () => {
    try {
      const result = await GolampiAPI.getExamples();
      if (result.success) {
        examples = result.examples;
      }
    } finally {
      loading = false;
    }
  };

  loadExamples();

  function copyToClipboard(code) {
    navigator.clipboard.writeText(code);
    alert('Código copiado al portapapeles');
  }
</script>

<div class="examples-container">
  {#if loading}
    <div class="loading">
      <p>Cargando ejemplos...</p>
    </div>
  {:else if examples && examples.length > 0}
    <div class="examples-grid">
      {#each examples as example, index (index)}
        <div class="example-card">
          <h3>{example.name}</h3>
          <p class="description">{example.description}</p>
          <pre class="code-preview">{example.code.substring(0, 100)}...</pre>
          <button class="btn-copy" on:click={() => copyToClipboard(example.code)}>
            📋 Copiar
          </button>
        </div>
      {/each}
    </div>
  {:else}
    <p class="empty">No hay ejemplos disponibles.</p>
  {/if}
</div>

<style>
  .examples-container {
    flex: 1;
    overflow-y: auto;
    padding: 12px;
    background: #1e1e1e;
  }

  .examples-container::-webkit-scrollbar {
    width: 8px;
  }

  .examples-container::-webkit-scrollbar-track {
    background: #252526;
  }

  .examples-container::-webkit-scrollbar-thumb {
    background: #464647;
    border-radius: 4px;
  }

  .loading {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #666;
  }

  .examples-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 12px;
  }

  .example-card {
    padding: 12px;
    background: #252526;
    border: 1px solid #3e3e3e;
    border-radius: 4px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    transition: all 0.3s;
  }

  .example-card:hover {
    border-color: #4a9eff;
    background: #2a2a2b;
  }

  .example-card h3 {
    margin: 0;
    color: #4a9eff;
    font-size: 14px;
  }

  .description {
    margin: 0;
    color: #888;
    font-size: 12px;
  }

  .code-preview {
    margin: 0;
    padding: 6px;
    background: #1e1e1e;
    color: #d4d4d4;
    font-family: 'Courier New', monospace;
    font-size: 10px;
    line-height: 1.4;
    border-radius: 2px;
    white-space: pre-wrap;
    word-break: break-word;
    max-height: 60px;
    overflow: hidden;
  }

  .btn-copy {
    padding: 6px;
    background: #3e3e3e;
    color: #e0e0e0;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.3s;
  }

  .btn-copy:hover {
    background: #4a9eff;
    color: #fff;
  }

  .empty {
    text-align: center;
    color: #666;
    padding: 20px;
    margin: 0;
  }
</style>
