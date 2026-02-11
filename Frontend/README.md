# 🎨 GolampiDE - Frontend

Interfaz web moderna y modular para el intérprete del lenguaje Golampi, construida con **Svelte** y **Vite**.

## 📋 Características

- ✅ Editor de código con sintaxis destacada
- ✅ Ejecución en tiempo real del código Golampi
- ✅ Consola interactiva con salida formateada
- ✅ Tabla de símbolos en vivo
- ✅ Reporte de errores detallado
- ✅ Historial de ejecuciones
- ✅ Tema oscuro profesional
- ✅ Interfaz completamente modular

## 🏗️ Estructura de Carpetas

```
Frontend/
├── src/
│   ├── components/
│   │   ├── Editor.svelte          # Componente principal del editor
│   │   ├── Console.svelte         # Consola de salida
│   │   └── SymbolTable.svelte     # Tabla de símbolos
│   ├── lib/
│   │   ├── api.js                 # Cliente API REST
│   │   └── store.js               # Stores globales (Svelte)
│   ├── App.svelte                 # Componente raíz
│   ├── main.js                    # Entrada de la aplicación
│   └── app.css                    # Estilos globales
├── public/                        # Activos públicos
├── package.json                   # Dependencias del proyecto
├── vite.config.js                 # Configuración de Vite
└── README.md                      # Este archivo
```

## 🚀 Inicio Rápido

### Requisitos
- Node.js 16+
- npm o yarn

### Instalación

```bash
# Instalar dependencias
cd Frontend
npm install

# Iniciar servidor de desarrollo
npm run dev
```

El frontend estará disponible en `http://localhost:5173`

### Build para Producción

```bash
npm run build
npm run preview
```

## 📡 Conexión con la API

El cliente API está configurado para conectar con el backend en `http://localhost:8000`.

### Endpoints disponibles

#### POST /api/execute
Ejecuta código Golampi y retorna la salida.

```javascript
const result = await GolampiAPI.executeCode(code);
```

**Respuesta:**
```json
{
  "success": true,
  "output": ["línea 1", "línea 2"],
  "errors": [],
  "symbolTable": [
    {
      "name": "variable",
      "type": "int32",
      "value": 42,
      "scope": "global"
    }
  ],
  "timestamp": "2024-02-10 10:30:45"
}
```

#### POST /api/validate
Valida la sintaxis del código sin ejecutarlo.

```javascript
const result = await GolampiAPI.validateCode(code);
```

#### POST /api/symbol-table
Obtiene la tabla de símbolos de una ejecución.

```javascript
const result = await GolampiAPI.getSymbolTable(code);
```

#### GET /api/examples
Obtiene ejemplos de código.

```javascript
const examples = await GolampiAPI.getExamples();
```

#### GET /api/language-info
Obtiene información del lenguaje.

```javascript
const info = await GolampiAPI.getLanguageInfo();
```

## 🎛️ Stores (Estado Global)

El proyecto usa **Svelte stores** para manejar el estado global:

```javascript
import { 
  editorCode,        // Código actual
  consoleOutput,     // Salida de la consola
  errors,            // Errores encontrados
  symbolTable,       // Tabla de símbolos
  isExecuting,       // Flag de ejecución
  theme,             // Tema actual
  activePanel,       // Panel activo
  executionHistory   // Historial
} from '$lib/store.js';
```

### Funciones de utilidad

```javascript
import { 
  addConsoleOutput,
  clearConsole,
  addError,
  addToHistory
} from '$lib/store.js';

// Agregar línea a la consola
addConsoleOutput({ 
  type: 'output', 
  message: 'Hola', 
  timestamp: '10:30:45' 
});

// Limpiar todo
clearConsole();

// Agregar error
addError({ 
  type: 'SEMANTIC_ERROR', 
  message: 'Variable no definida', 
  line: 5,
  column: 10
});

// Agregar al historial
addToHistory({ code, timestamp, success, executionTime });
```

## 🎨 Personalización de Temas

El proyecto viene con un tema oscuro profesional. Para cambiar colores, edita las variables CSS en `src/components/Editor.svelte`:

```css
--color-primary: #4a9eff;
--color-bg-dark: #1e1e1e;
--color-bg-secondary: #252526;
--color-text: #d4d4d4;
```

## 📦 Dependencias

- **svelte**: Framework reactivo
- **vite**: Herramienta de build moderna
- **@sveltejs/vite-plugin-svelte**: Plugin de Vite para Svelte

## 🔧 Scripts Disponibles

```bash
npm run dev      # Iniciar servidor de desarrollo
npm run build    # Construir para producción
npm run preview  # Previsualizar build de producción
```

## 📝 Ejemplo de Uso

```svelte
<script>
  import GolampiAPI from '$lib/api.js';
  import { editorCode } from '$lib/store.js';

  async function executeCode() {
    const result = await GolampiAPI.executeCode($editorCode);
    console.log(result);
  }
</script>

<button on:click={executeCode}>
  Ejecutar
</button>
```

## 🐛 Solución de Problemas

### La API no responde
- Verifica que el backend está corriendo en `http://localhost:8000`
- Revisa la configuración de proxy en `vite.config.js`

### Los estilos no se aplican
- Limpia el caché: `npm run build && npm run preview`
- Verifica que los estilos estén importados en `App.svelte`

### Errores de CORS
- El backend debe tener habilitado CORS
- Verifica los headers en la configuración del servidor PHP

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el repositorio
2. Crea una rama feature (`git checkout -b feature/AmazingFeature`)
3. Commit los cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## 📧 Soporte

Para reportar problemas o sugerencias, abre un issue en el repositorio.

---

**Hecho con ❤️ para OLC2 - Universidad San Carlos de Guatemala**

**Why is HMR not preserving my local component state?**

HMR state preservation comes with a number of gotchas! It has been disabled by default in both `svelte-hmr` and `@sveltejs/vite-plugin-svelte` due to its often surprising behavior. You can read the details [here](https://github.com/sveltejs/svelte-hmr/tree/master/packages/svelte-hmr#preservation-of-local-state).

If you have state that's important to retain within a component, consider creating an external store which would not be replaced by HMR.

```js
// store.js
// An extremely simple external store
import { writable } from 'svelte/store'
export default writable(0)
```
