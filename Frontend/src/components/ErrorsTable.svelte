<script>
  import { errors } from '../lib/store.js';
</script>

<div class="errors-container">
  {#if $errors.length > 0}
    <table class="errors-table">
      <thead>
        <tr>
          <th>#</th>
          <th>Tipo</th>
          <th>Descripcion</th>
          <th>Line</th>
          <th>Column</th>
        </tr>
      </thead>
      <tbody>
        {#each $errors as error}
          <tr class="error-row">
            <td class="error-id">{error.id || error.line}</td>
            <td class="error-type">{error.type}</td>
            <td class="error-desc">{error.description}</td>
            <td class="error-line">{error.line}</td>
            <td class="error-col">{error.column}</td>
          </tr>
        {/each}
      </tbody>
    </table>
  {:else}
    <div class="empty-state">
      <svg width="48" height="48" viewBox="0 0 24 24" fill="#6A9955">
        <circle cx="12" cy="12" r="10" stroke="#6A9955" fill="none" stroke-width="2"/>
        <path d="M8 12l3 3 5-6" stroke="#6A9955" stroke-width="2" fill="none"/>
      </svg>
      <p>No se encontraron errores. ¡El código es válido!</p>
    </div>
  {/if}
</div>

<style>
  .errors-container {
    height: 100%;
    overflow-y: auto;
    padding: 12px;
    background: #1E1E1E;
  }
  
  .errors-table {
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
  
  .error-row:hover {
    background: #252526;
  }
  
  .error-id,
  .error-line,
  .error-col {
    text-align: center;
    color: #858585;
  }
  
  .error-type {
    color: #F48771;
    font-weight: 600;
  }
  
  .error-desc {
    color: #D4D4D4;
  }
  
  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    gap: 16px;
    color: #858585;
  }
</style>