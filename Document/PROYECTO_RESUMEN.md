# 📦 Proyecto Golampi - Backend Base

## 🎯 Resumen

Este es el **backend base** para el intérprete de Golampi. Está diseñado usando:
- **ANTLR4** para análisis léxico y sintáctico
- **PHP 8.0+** como lenguaje de implementación
- **Patrón Visitor** para el recorrido del árbol sintáctico
- **Traits** para organización modular del código

## 📂 Estructura del Proyecto

```
golampi-backend/
│
├── Golampi.g4                    # ⭐ Gramática ANTLR completa del lenguaje
│
├── composer.json                 # Configuración de Composer
├── .gitignore                    # Archivos a ignorar en Git
│
├── README.md                     # Documentación principal
├── IMPLEMENTATION.md             # Guía de implementación paso a paso
│
├── src/
│   ├── Traits/
│   │   ├── ErrorHandler.php         # 🔧 Trait: Manejo de errores
│   │   └── SymbolTableManager.php   # 🔧 Trait: Tabla de símbolos
│   │
│   ├── Runtime/
│   │   ├── Value.php                # 💎 Clase para valores en runtime
│   │   └── Environment.php          # 🌍 Entorno de variables (scopes)
│   │
│   └── Visitor/
│       ├── BaseVisitor.php          # 🏗️ Visitor base con traits y funciones embebidas
│       └── GolampiVisitor.php       # 🎨 Implementación con operadores aritméticos
│
└── examples/
    ├── test.php                  # Script de ejemplo para usar el intérprete
    └── test1.golampi             # Código de ejemplo en Golampi
```

## ✅ Lo que YA está implementado

### 1. Gramática Completa (Golampi.g4)
- ✅ Declaración de variables (`var`, `:=`)
- ✅ Constantes (`const`)
- ✅ Tipos: int32, float32, bool, rune, string
- ✅ Operadores aritméticos (+, -, *, /, %)
- ✅ Operadores relacionales (==, !=, >, <, >=, <=)
- ✅ Operadores lógicos (&&, ||, !)
- ✅ Control de flujo (if, switch, for)
- ✅ Funciones con parámetros y retornos múltiples
- ✅ Arreglos unidimensionales y multidimensionales
- ✅ Punteros (& y *)
- ✅ Comentarios de línea y bloque

### 2. Sistema de Tipos (Runtime/Value.php)
- ✅ Clase `Value` con soporte para todos los tipos primitivos
- ✅ Manejo de `nil`
- ✅ Conversión a bool, string
- ✅ Factory methods para crear valores

### 3. Entorno de Variables (Runtime/Environment.php)
- ✅ Manejo de scopes anidados
- ✅ Búsqueda de variables en scopes padres
- ✅ Define, get, set de variables

### 4. Manejo de Errores (Traits/ErrorHandler.php)
- ✅ Registro de errores léxicos, sintácticos y semánticos
- ✅ Almacenamiento con línea y columna
- ✅ Generación de reportes

### 5. Tabla de Símbolos (Traits/SymbolTableManager.php)
- ✅ Manejo de scopes dinámicos
- ✅ Registro de símbolos con tipo, valor, línea y columna
- ✅ Búsqueda en scopes anidados
- ✅ Generación de reporte de tabla de símbolos

### 6. Visitor Base (Visitor/BaseVisitor.php)
- ✅ Funciones embebidas:
  - `fmt.Println()` - Imprimir en consola
  - `len()` - Longitud de strings/arreglos
  - `now()` - Fecha y hora actual
  - `substr()` - Subcadena
  - `typeOf()` - Tipo de una variable
- ✅ Manejo de output
- ✅ Registro de funciones definidas por usuario

### 7. Operaciones Aritméticas (Visitor/GolampiVisitor.php)
- ✅ Suma con tabla de compatibilidad completa
- ✅ Resta con compatibilidad de tipos
- ✅ Multiplicación (incluye repetición de strings)
- ✅ División (con manejo de división por cero)
- ✅ Módulo
- ✅ Comparaciones (==, !=, >, <, >=, <=)
- ✅ Operadores lógicos con **cortocircuito** (&&, ||)

## 🚀 Próximos Pasos

### Paso 1: Generar el Parser
```bash
# Descargar ANTLR 4.13.1
wget https://www.antlr.org/download/antlr-4.13.1-complete.jar

# Generar código PHP desde la gramática
java -jar antlr-4.13.1-complete.jar -Dlanguage=PHP -visitor -no-listener Golampi.g4 -o generated/
```

### Paso 2: Conectar el Visitor

Después de generar el parser, necesitas:

1. Modificar `src/Visitor/GolampiVisitor.php` para extender el visitor generado:

```php
<?php
namespace Golampi\Visitor;

require_once __DIR__ . '/../../generated/GolampiVisitor.php';

class GolampiVisitor extends \GolampiVisitor {
    use \Golampi\Traits\ErrorHandler;
    use \Golampi\Traits\SymbolTableManager;
    
    // Los métodos que ya están implementados...
}
```

### Paso 3: Implementar Métodos Visit

Sigue la guía en `IMPLEMENTATION.md` para implementar cada método `visit*()` correspondiente a las reglas de la gramática.

**Orden sugerido:**
1. Literales (int, float, string, bool, nil, rune)
2. Expresiones aritméticas (ya implementadas las operaciones)
3. Variables (declaración, asignación)
4. Control de flujo (if, for)
5. Funciones
6. Arreglos

### Paso 4: Crear el API Endpoint

Crea `public/index.php` para recibir código y ejecutarlo:

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../generated/GolampiLexer.php';
require_once __DIR__ . '/../generated/GolampiParser.php';

use Golampi\Visitor\GolampiVisitor;

// Recibir código POST
$sourceCode = $_POST['code'] ?? '';

try {
    // Crear lexer y parser
    $input = InputStream::fromString($sourceCode);
    $lexer = new GolampiLexer($input);
    $tokens = new CommonTokenStream($lexer);
    $parser = new GolampiParser($tokens);
    
    // Obtener árbol sintáctico
    $tree = $parser->program();
    
    // Ejecutar visitor
    $visitor = new GolampiVisitor();
    $visitor->visit($tree);
    
    // Responder con JSON
    echo json_encode([
        'success' => true,
        'output' => $visitor->getOutputString(),
        'errors' => $visitor->getErrors(),
        'symbolTable' => $visitor->getSymbolTable()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
```

## 📋 Requerimientos del Proyecto (Checklist)

### Gramática y Parser
- [x] Gramática ANTLR4 completa
- [ ] Parser generado y funcionando
- [ ] Todos los métodos visit implementados

### Análisis Semántico
- [x] Tabla de símbolos con scopes
- [x] Validación de tipos
- [x] Detección de variables no declaradas
- [x] Detección de redeclaraciones
- [ ] Validación de tipos en asignaciones
- [ ] Validación de tipos en operaciones

### Ejecución
- [x] Funciones embebidas implementadas
- [x] Operadores aritméticos con tabla de compatibilidad
- [x] Operadores lógicos con cortocircuito
- [ ] Localización y ejecución de función main
- [ ] Manejo de break/continue/return
- [ ] Llamadas a funciones usuario
- [ ] Arreglos
- [ ] Punteros

### Reportes
- [x] Sistema de errores (léxicos, sintácticos, semánticos)
- [x] Tabla de símbolos
- [ ] Exportación a HTML/CSV

### Interfaz
- [ ] Editor de código
- [ ] Botones de acción
- [ ] Consola de salida
- [ ] Descarga de reportes

## 🎓 Características Destacadas

### ✨ Uso de Traits
El proyecto usa traits para organizar funcionalidad de manera modular:
- **ErrorHandler**: Centraliza todo el manejo de errores
- **SymbolTableManager**: Maneja la tabla de símbolos y scopes

Esto permite que cualquier clase pueda usar estas funcionalidades simplemente con:
```php
use ErrorHandler;
use SymbolTableManager;
```

### ✨ Patrón Visitor Limpio
El visitor está organizado en capas:
- **BaseVisitor**: Funcionalidad común y funciones embebidas
- **GolampiVisitor**: Implementación específica con operadores

### ✨ Sistema de Tipos Robusto
La clase `Value` encapsula completamente la gestión de tipos, facilitando:
- Verificación de tipos
- Conversiones seguras
- Manejo de nil
- Operaciones entre tipos

### ✨ Tablas de Compatibilidad Implementadas
Todas las operaciones respetan las tablas de compatibilidad del documento:
- Suma: int32+int32, int32+float32, string+string, etc.
- Multiplicación: int32*string (repetición)
- Comparaciones: solo entre tipos compatibles

## 📚 Documentación Incluida

1. **README.md**: Guía principal de configuración y uso
2. **IMPLEMENTATION.md**: Guía paso a paso con ejemplos de código
3. **Comentarios en código**: Todos los archivos están documentados

## 🔗 Referencias

- [ANTLR4 Documentation](https://github.com/antlr/antlr4)
- [ANTLR PHP Target](https://github.com/antlr/antlr4/blob/master/doc/php-target.md)
- [Go Language Specification](https://go.dev/ref/spec)

## ⚠️ Notas Importantes

1. **ANTLR JAR**: Debes descargar `antlr-4.13.1-complete.jar` manualmente
2. **Generación de Parser**: Debe ejecutarse cada vez que modifiques la gramática
3. **Visitor**: Después de generar, conecta tu GolampiVisitor con el generado
4. **Testing Incremental**: Prueba cada funcionalidad después de implementarla

---

**Proyecto académico** - Universidad San Carlos de Guatemala  
**Curso**: Organización de Lenguajes y Compiladores 2  
**Implementación**: ANTLR4 + PHP + Patrón Visitor + Traits
