<?php
namespace App;

class CarritoCompra {
    private $productos = [];

    public function agregarProducto(string $nombre, int $cantidad): void {
        if ($cantidad <= 0) {
            throw new \InvalidArgumentException("La cantidad debe ser positiva");
        }

        if (!isset($this->productos[$nombre])) {
            $this->productos[$nombre] = 0;
        }

        $this->productos[$nombre] += $cantidad;
    }

    public function quitarProducto(string $nombre, int $cantidad): void {
        if (!isset($this->productos[$nombre])) {
            throw new \InvalidArgumentException("El producto no existe en el carrito");
        }

        if ($cantidad <= 0) {
            throw new \InvalidArgumentException("La cantidad debe ser positiva");
        }

        if ($cantidad > $this->productos[$nombre]) {
            throw new \InvalidArgumentException("Cantidad a quitar excede lo disponible");
        }

        $this->productos[$nombre] -= $cantidad;

        if ($this->productos[$nombre] === 0) {
            unset($this->productos[$nombre]);
        }
    }

    public function obtenerCantidad(string $nombre): int {
        return $this->productos[$nombre] ?? 0;
    }
}
