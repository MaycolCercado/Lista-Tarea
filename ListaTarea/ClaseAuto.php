<?php
class Auto {
    public $marca;
    public $encendido = false;

    public function encender() {
        $this->encendido = true;
    }

    public function estado() {
        if ($this->encendido) {
            return "El auto {$this->marca} está rugiendo.";
        }
        return "El auto {$this->marca} está apagado.";
    }
}

$miAuto = new Auto();
$miAuto->marca = "Toyota";
echo $miAuto->estado(); 

$miAuto->encender();
echo $miAuto->estado(); 

?>