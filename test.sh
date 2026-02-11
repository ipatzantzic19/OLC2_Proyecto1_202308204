#!/bin/bash

# Script para iniciar el proyecto

echo "🚀 Iniciando Golampi Development Environment"
echo ""

# Obtener la ruta del script
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Colores
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Función para imprimir mensajes
print_header() {
    echo -e "${BLUE}════════════════════════════════════════${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}════════════════════════════════════════${NC}"
}

# Verificar si se ejecuta desde el directorio raíz
if [ ! -f "Frontend/package.json" ] || [ ! -f "Backend/composer.json" ]; then
    echo -e "${RED}❌ Este script debe ejecutarse desde la raíz del proyecto${NC}"
    exit 1
fi

# Iniciar Backend
print_header "Iniciando Backend (Puerto 8000)"
cd Backend
php -S 0.0.0.0:8000 > /tmp/backend.log 2>&1 &
BACKEND_PID=$!
echo -e "${GREEN}✅ Backend iniciado (PID: $BACKEND_PID)${NC}"
echo ""

# Esperar a que el backend se inicie
sleep 2

# Verificar que el backend está corriendo
if ! kill -0 $BACKEND_PID 2>/dev/null; then
    echo -e "${RED}❌ Error al iniciar el backend${NC}"
    cat /tmp/backend.log
    exit 1
fi

# Iniciar Frontend
print_header "Iniciando Frontend (Puerto 5173)"
cd "$SCRIPT_DIR/Frontend"

# Instalar dependencias si es necesario
if [ ! -d "node_modules" ]; then
    echo "📦 Instalando dependencias del frontend..."
    npm install > /tmp/npm-install.log 2>&1
    if [ $? -ne 0 ]; then
        echo -e "${RED}❌ Error al instalar dependencias${NC}"
        cat /tmp/npm-install.log
        kill $BACKEND_PID
        exit 1
    fi
fi

npm run dev > /tmp/frontend.log 2>&1 &
FRONTEND_PID=$!
echo -e "${GREEN}✅ Frontend iniciado (PID: $FRONTEND_PID)${NC}"
echo ""

# Esperar a que el frontend se inicie
sleep 3

# Verificar que el frontend está corriendo
if ! kill -0 $FRONTEND_PID 2>/dev/null; then
    echo -e "${RED}❌ Error al iniciar el frontend${NC}"
    cat /tmp/frontend.log
    kill $BACKEND_PID
    exit 1
fi

# Mostrar información
print_header "Información de Acceso"
echo -e "${YELLOW}Frontend:${NC} http://localhost:5173"
echo -e "${YELLOW}Backend API:${NC} http://localhost:8000/api"
echo ""
echo -e "${YELLOW}Para detener, presiona Ctrl+C${NC}"
echo ""

# Mantener el script activo
trap "kill $BACKEND_PID $FRONTEND_PID 2>/dev/null; exit" SIGINT
wait