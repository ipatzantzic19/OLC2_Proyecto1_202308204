<script>
  import Editor from './components/Editor.svelte';
</script>

<main>
  <Editor />
</main>

<style>
  :global(body) {
    margin: 0;
    padding: 0;
    background: #1e1e1e;
    color: #e0e0e0;
  }

  :global(html, body, #app) {
    height: 100%;
    width: 100%;
  }

  main {
    width: 100%;
    height: 100%;
  }
</style>
