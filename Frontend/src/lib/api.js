import { consoleOutput, symbolTable, errors } from './store.js';

// Use Vite env var if provided; default to proxy path `/api` to avoid CORS in dev
const API_URL = import.meta.env.VITE_API_URL || '/api';

/**
 * Cliente API para Golampi IDE
 */

/**
 * Ejecuta código Golampi
 */
export async function executeCode(code) {
  try {
    const response = await fetch(`${API_URL}/execute`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ code }),
    });
    
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}`);
    }
    
    const result = await response.json();
    return result;
    
  } catch (error) {
    console.error('API Error:', error);
    return {
      success: false,
      error: error.message,
      output: [],
      errors: [{
        type: 'Connection',
        description: `Failed to connect to backend: ${error.message}`,
        line: 0,
        column: 0
      }],
      symbolTable: [],
      executionTime: '0ms'
    };
  }
}

/**
 * Obtiene solo errores
 */
export async function getErrors(code) {
  try {
    const response = await fetch(`${API_URL}/errors`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ code }),
    });
    
    const result = await response.json();
    return result;
    
  } catch (error) {
    return {
      success: false,
      errors: [],
      errorCount: 0
    };
  }
}

/**
 * Obtiene solo tabla de símbolos
 */
export async function getSymbols(code) {
  try {
    const response = await fetch(`${API_URL}/symbols`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ code }),
    });
    
    const result = await response.json();
    return result;
    
  } catch (error) {
    return {
      success: false,
      symbolTable: [],
      symbolCount: 0
    };
  }
}

/**
 * Limpia todos los datos
 */
export function clearAll() {
  consoleOutput.set([]);
  symbolTable.set([]);
  errors.set([]);
}