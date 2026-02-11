/**
 * Stores globales usando Svelte stores
 */

import { writable } from 'svelte/store';

/**
 * Código actual en el editor
 */
export const editorCode = writable(`package main

Func main() {
  // Inicializa variables locales
  var message string = "Starting interpreter...";
  print(message);
  
  for i := 0; i < 5; i++ {
    processData(i);
  }
}

Func processData(val int) {
  println("ID: ", val);
}`);

/**
 * Salida de la consola
 */
export const consoleOutput = writable([]);

/**
 * Errores encontrados
 */
export const errors = writable([]);

/**
 * Tabla de símbolos
 */
export const symbolTable = writable([]);

/**
 * Estado de ejecución
 */
export const isExecuting = writable(false);

/**
 * Tema actual (light/dark)
 */
export const theme = writable('dark');

/**
 * Panel activo (editor/symbolTable)
 */
export const activePanel = writable('symbolTable');

/**
 * Historial de ejecuciones
 */
export const executionHistory = writable([]);

/**
 * Función para agregar salida a la consola
 */
export function addConsoleOutput(message) {
  consoleOutput.update(items => [...items, message]);
}

/**
 * Función para limpiar la consola
 */
export function clearConsole() {
  consoleOutput.set([]);
  errors.set([]);
  symbolTable.set([]);
}

/**
 * Función para agregar error
 */
export function addError(error) {
  errors.update(items => [...items, error]);
}

/**
 * Función para agregar al historial
 */
export function addToHistory(execution) {
  executionHistory.update(items => [execution, ...items]);
}
