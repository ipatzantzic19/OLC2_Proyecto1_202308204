<script>
  import { consoleOutput, errors } from '../lib/store.js';

  let consoleContainer;

  $: if (consoleContainer) {
    consoleContainer.scrollTop = consoleContainer.scrollHeight;
  }
</script>

<div class="console" bind:this={consoleContainer}>
  {#each $consoleOutput as item, index (index)}
    <div class="console-line" class:error={item.type === 'error'} class:success={item.type === 'success'}>
      <span class="timestamp">[{item.timestamp}]</span>
      <span class="icon">
        {#if item.type === 'error'}
          ❌
        {:else if item.type === 'success'}
          ✅
        {:else}
          ➤
        {/if}
      </span>
      <span class="message">{item.message}</span>
    </div>
  {/each}

  {#if $consoleOutput.length === 0}
    <div class="placeholder">
      <p>Presiona el botón "Ejecutar" para ver los resultados aquí...</p>
    </div>
  {/if}
</div>

<style>
  .console {
    flex: 1;
    overflow-y: auto;
    padding: 12px;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.6;
    background: #1e1e1e;
  }

  .console::-webkit-scrollbar {
    width: 8px;
  }

  .console::-webkit-scrollbar-track {
    background: #252526;
  }

  .console::-webkit-scrollbar-thumb {
    background: #464647;
    border-radius: 4px;
  }

  .console::-webkit-scrollbar-thumb:hover {
    background: #5a5a5a;
  }

  .console-line {
    display: flex;
    gap: 8px;
    margin-bottom: 4px;
    color: #d4d4d4;
    word-break: break-word;
  }

  .console-line.error {
    color: #f48771;
  }

  .console-line.success {
    color: #6a9955;
  }

  .timestamp {
    color: #858585;
    flex-shrink: 0;
  }

  .icon {
    flex-shrink: 0;
  }

  .message {
    flex: 1;
  }

  .placeholder {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #666;
    text-align: center;
  }

  .placeholder p {
    margin: 0;
  }
</style>
