<script>
  import { consoleOutput } from '../lib/store.js';
  
  let consoleElement;
  
  $: if (consoleElement) {
    consoleElement.scrollTop = consoleElement.scrollHeight;
  }
  
  function getTypeIcon(type) {
    switch(type) {
      case 'system': return '>';
      case 'success': return '✓';
      case 'error': return '✗';
      case 'debug': return '[debug]';
      case 'info': return '→';
      default: return '>';
    }
  }
  
  function getTypeClass(type) {
    return type || 'output';
  }
</script>

<div class="console-container" bind:this={consoleElement}>
  {#each $consoleOutput as item, index (index)}
    <div class="console-line {getTypeClass(item.type)}">
      <span class="console-prefix">{getTypeIcon(item.type)}</span>
      <span class="console-message">{item.message}</span>
    </div>
  {/each}
  
  {#if $consoleOutput.length === 0}
    <div class="console-empty">
      <p>Console output will appear here...</p>
    </div>
  {/if}
</div>

<style>
  .console-container {
    height: 100%;
    overflow-y: auto;
    padding: 12px;
    background: #1E1E1E;
    font-family: 'Consolas', 'Courier New', monospace;
    font-size: 13px;
    line-height: 1.6;
  }
  
  .console-container::-webkit-scrollbar {
    width: 10px;
  }
  
  .console-container::-webkit-scrollbar-track {
    background: #252526;
  }
  
  .console-container::-webkit-scrollbar-thumb {
    background: #464647;
    border-radius: 5px;
  }
  
  .console-line {
    display: flex;
    gap: 8px;
    margin-bottom: 2px;
    color: #D4D4D4;
  }
  
  .console-prefix {
    color: #858585;
    flex-shrink: 0;
    min-width: 20px;
  }
  
  .console-message {
    flex: 1;
    word-break: break-word;
  }
  
  .console-line.system {
    color: #4A9EFF;
  }
  
  .console-line.success {
    color: #6A9955;
  }
  
  .console-line.error {
    color: #F48771;
  }
  
  .console-line.debug {
    color: #858585;
    font-style: italic;
  }
  
  .console-line.info {
    color: #CE9178;
  }
  
  .console-empty {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #858585;
  }
</style>