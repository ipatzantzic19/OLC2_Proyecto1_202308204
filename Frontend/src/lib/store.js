import { writable } from 'svelte/store';

// Código del editor
export const editorCode = writable(`Escribe tu codigo Golampi aquì...`);

// Salida de consola
export const consoleOutput = writable([]);

// Tabla de símbolos
export const symbolTable = writable([]);

// Errores
export const errors = writable([]);

// Estado de ejecución
export const isExecuting = writable(false);