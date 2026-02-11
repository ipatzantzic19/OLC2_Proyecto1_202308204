/**
 * API Client para conectar con el Backend
 */

const API_BASE_URL = 'http://localhost:8000/api';

class GolampiAPI {
  /**
   * Ejecuta código Golampi
   * @param {string} code - Código a ejecutar
   * @returns {Promise<Object>} Resultado de la ejecución
   */
  static async executeCode(code) {
    try {
      const response = await fetch(`${API_BASE_URL}/execute`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code }),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      return {
        success: false,
        error: error.message,
        output: [],
        errors: [
          {
            type: 'RUNTIME_ERROR',
            message: error.message,
            line: 0,
            column: 0,
          },
        ],
      };
    }
  }

  /**
   * Valida la sintaxis del código
   * @param {string} code - Código a validar
   * @returns {Promise<Object>} Resultado de validación
   */
  static async validateCode(code) {
    try {
      const response = await fetch(`${API_BASE_URL}/validate`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code }),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      return {
        success: false,
        error: error.message,
      };
    }
  }

  /**
   * Obtiene la tabla de símbolos de una ejecución
   * @param {string} code - Código ejecutado
   * @returns {Promise<Object>} Tabla de símbolos
   */
  static async getSymbolTable(code) {
    try {
      const response = await fetch(`${API_BASE_URL}/symbol-table`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code }),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      return {
        success: false,
        error: error.message,
        symbols: [],
      };
    }
  }

  /**
   * Obtiene ejemplos de código
   * @returns {Promise<Object>} Lista de ejemplos
   */
  static async getExamples() {
    try {
      const response = await fetch(`${API_BASE_URL}/examples`);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      return {
        success: false,
        error: error.message,
        examples: [],
      };
    }
  }

  /**
   * Obtiene información del lenguaje
   * @returns {Promise<Object>} Información del lenguaje
   */
  static async getLanguageInfo() {
    try {
      const response = await fetch(`${API_BASE_URL}/language-info`);

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      return {
        success: false,
        error: error.message,
        info: {},
      };
    }
  }
}

export default GolampiAPI;
