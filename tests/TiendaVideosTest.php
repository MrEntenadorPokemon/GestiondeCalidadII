<?php

use PHPUnit\Framework\TestCase;
use App\TiendaVideos;

class TiendaVideosTest extends TestCase {
    private TiendaVideos $tienda;

    protected function setUp(): void {
        $this->tienda = new TiendaVideos();
    }

    public function testAgregarVideoYConsultarCopias() {
        $this->tienda->agregarVideo("Matrix", 3);
        $this->assertEquals(3, $this->tienda->consultarCopiasDisponibles("Matrix"));
    }

    public function testAlquilarVideoReduceCopias() {
        $this->tienda->agregarVideo("Matrix", 2);
        $this->tienda->alquilarVideo("Matrix");

        $this->assertEquals(1, $this->tienda->consultarCopiasDisponibles("Matrix"));
    }

    public function testDevolverVideoAumentaCopias() {
        $this->tienda->agregarVideo("Matrix", 1);
        $this->tienda->alquilarVideo("Matrix");
        $this->tienda->devolverVideo("Matrix");

        $this->assertEquals(1, $this->tienda->consultarCopiasDisponibles("Matrix"));
    }

    public function testAlquilarVideoSinCopiasLanzaExcepcion() {
        $this->tienda->agregarVideo("Matrix", 1);
        $this->tienda->alquilarVideo("Matrix");

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("No hay copias disponibles");

        $this->tienda->alquilarVideo("Matrix");
    }

    public function testAlquilarVideoInexistenteLanzaExcepcion() {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("El video no existe");

        $this->tienda->alquilarVideo("Inexistente");
    }
}
