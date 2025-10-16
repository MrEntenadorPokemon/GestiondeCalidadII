<?php
namespace App;

class TiendaVideos {
    private $videos = [];
    private $alquilados = [];

    public function agregarVideo(string $titulo, int $copias): void {
        if ($copias < 0) {
            throw new \InvalidArgumentException("El número de copias debe ser positivo");
        }

        $this->videos[$titulo] = $copias;
        $this->alquilados[$titulo] = 0;
    }

    public function alquilarVideo(string $titulo): void {
        if (!isset($this->videos[$titulo])) {
            throw new \InvalidArgumentException("El video no existe");
        }

        if ($this->videos[$titulo] <= 0) {
            throw new \InvalidArgumentException("No hay copias disponibles");
        }

        $this->videos[$titulo]--;
        $this->alquilados[$titulo]++;
    }

    public function devolverVideo(string $titulo): void {
        if (!isset($this->videos[$titulo])) {
            throw new \InvalidArgumentException("El video no existe");
        }

        if ($this->alquilados[$titulo] <= 0) {
            throw new \InvalidArgumentException("El video no está alquilado");
        }

        $this->videos[$titulo]++;
        $this->alquilados[$titulo]--;
    }

    public function consultarCopiasDisponibles(string $titulo): int {
        return $this->videos[$titulo] ?? 0;
    }
}
