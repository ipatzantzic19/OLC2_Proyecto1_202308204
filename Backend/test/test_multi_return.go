package main

import "fmt"

func main() {
	// Test de múltiples retornos y asignación
	x, y, z := getData()
	fmt.Println("Valores:", x, y, z)
}

func getData() (int32, int32, bool) {
	return 10, 20, true
}
