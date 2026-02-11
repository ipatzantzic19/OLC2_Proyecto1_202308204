<script>
  import { symbolTable, errors } from '../lib/store.js';
</script>

<div class="symbol-table-container">
  {#if $errors && $errors.length > 0}
    <div class="section">
      <h3>⚠️ Errores ({$errors.length})</h3>
      <table class="error-table">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Mensaje</th>
            <th>Línea</th>
            <th>Columna</th>
          </tr>
        </thead>
        <tbody>
          {#each $errors as error, index (index)}
            <tr class="error-row">
              <td class="type">{error.type || 'ERROR'}</td>
              <td class="message">{error.message}</td>
              <td class="line">{error.line || 0}</td>
              <td class="column">{error.column || 0}</td>
            </tr>
          {/each}
        </tbody>
      </table>
    </div>
  {/if}

  <div class="section">
    <h3>📋 Tabla de Símbolos</h3>
    {#if $symbolTable && $symbolTable.length > 0}
      <table class="symbols-table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Scope</th>
          </tr>
        </thead>
        <tbody>
          {#each $symbolTable as symbol, index (index)}
            <tr>
              <td class="name">{symbol.name}</td>
              <td class="type">{symbol.type}</td>
              <td class="value">{symbol.value}</td>
              <td class="scope">{symbol.scope || 'global'}</td>
            </tr>
          {/each}
        </tbody>
      </table>
    {:else}
      <p class="empty">No hay símbolos para mostrar.</p>
    {/if}
  </div>
</div>

<style>
  .symbol-table-container {
    flex: 1;
    overflow-y: auto;
    padding: 12px;
    background: #1e1e1e;
  }

  .symbol-table-container::-webkit-scrollbar {
    width: 8px;
  }

  .symbol-table-container::-webkit-scrollbar-track {
    background: #252526;
  }

  .symbol-table-container::-webkit-scrollbar-thumb {
    background: #464647;
    border-radius: 4px;
  }

  .section {
    margin-bottom: 16px;
  }

  .section h3 {
    margin: 0 0 8px 0;
    font-size: 13px;
    color: #4a9eff;
    font-weight: 600;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
    background: #252526;
    border-radius: 4px;
    overflow: hidden;
  }

  thead {
    background: #2d2d2d;
  }

  th {
    padding: 8px;
    text-align: left;
    color: #a0a0a0;
    border-bottom: 1px solid #3e3e3e;
    font-weight: 600;
  }

  td {
    padding: 6px 8px;
    color: #d4d4d4;
    border-bottom: 1px solid #3e3e3e;
  }

  tr:last-child td {
    border-bottom: none;
  }

  .error-table tbody tr:hover,
  .symbols-table tbody tr:hover {
    background: #333;
  }

  .error-row .type {
    color: #f48771;
    font-weight: 600;
  }

  .error-row .message {
    color: #d4d4d4;
  }

  .type {
    color: #6a9955;
  }

  .value {
    color: #ce9178;
    font-family: 'Courier New', monospace;
  }

  .scope {
    color: #9cdcfe;
    font-size: 11px;
  }

  .empty {
    text-align: center;
    color: #666;
    padding: 20px;
    margin: 0;
  }
</style>
