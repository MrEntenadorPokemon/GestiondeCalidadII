<?php
namespace App\Tests;

use App\CarritoCompra;
use PHPUnit\Framework\TestCase;

class CarritoCompraTest extends TestCase {
    private $carrito;

    protected function setUp(): void {
        $this->carrito = new CarritoCompra();
    }

    public function testAgregarProductoNormal() {
        $this->carrito->agregarProducto("Laptop", 2);
        $this->assertEquals(2, $this->carrito->obtenerCantidad("Laptop"),
            "Debe haber 2 unidades de Laptop en el carrito");
    }

    public function testQuitarProductoNormal() {
        $this->carrito->agregarProducto("Mouse", 3);
        $this->carrito->quitarProducto("Mouse", 1);
        $this->assertEquals(2, $this->carrito->obtenerCantidad("Mouse"),
            "Debe haber 2 unidades de Mouse tras quitar 1");
    }

    public function testObtenerCantidadProductoInexistente() {
        $this->assertEquals(0, $this->carrito->obtenerCantidad("Teclado"),
            "Producto inexistente debe devolver 0");
    }

    public function testAgregarProductoCantidadNegativa() {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La cantidad debe ser positiva");
        $this->carrito->agregarProducto("Laptop", -1);
    }

    public function testQuitarProductoExcedeCantidad() {
        $this->carrito->agregarProducto("Mouse", 2);
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Cantidad a quitar excede lo disponible");
        $this->carrito->quitarProducto("Mouse", 3);
    }
}