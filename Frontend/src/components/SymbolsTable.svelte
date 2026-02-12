<script>
  import { symbolTable } from '../lib/store.js';
</script>

<div class="symbols-container">
  {#if $symbolTable.length > 0}
    <table class="symbols-table">
      <thead>
        <tr>
          <th>Identificador</th>
          <th>Tipo</th>
          <th>Valor</th>
          <th>Ambito</th>
          <th>Line</th>
          <th>Column</th>
        </tr>
      </thead>
      <tbody>
        {#each $symbolTable as symbol}
          <tr>
            <td class="identifier">{symbol.identifier}</td>
            <td class="type">{symbol.type}</td>
            <td class="value">{symbol.value}</td>
            <td class="scope">{symbol.scope}</td>
            <td class="line">{symbol.line}</td>
            <td class="column">{symbol.column}</td>
          </tr>
        {/each}
      </tbody>
    </table>
  {:else}
    <div class="empty-state">
      <p>No symbols found. Run code to see symbol table.</p>
    </div>
  {/if}
</div>

<style>
  .symbols-container {
    height: 100%;
    overflow-y: auto;
    padding: 12px;
    background: #1E1E1E;
  }
  
  .symbols-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
  }
  
  thead {
    position: sticky;
    top: 0;
    background: #252526;
  }
  
  th {
    padding: 8px;
    text-align: left;
    color: #858585;
    font-weight: 600;
    border-bottom: 1px solid #3E3E3E;
  }
  
  td {
    padding: 8px;
    border-bottom: 1px solid #3E3E3E;
  }
  
  tbody tr:hover {
    background: #252526;
  }
  
  .identifier {
    color: #4A9EFF;
    font-family: 'Consolas', monospace;
  }
  
  .type {
    color: #6A9955;
  }
  
  .value {
    color: #CE9178;
    font-family: 'Consolas', monospace;
  }
  
  .scope {
    color: #9CDCFE;
  }
  
  .line {
    color: #858585;
    text-align: center;
  }
  .column {
    color: #858585;
    text-align: center;
  }
  
  .empty-state {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #858585;
  }
</style>