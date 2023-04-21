<?php
class Conjunto
{
    private $elementos;

    public function __construct($elementos = [])
    {
        $this->elementos = $elementos;
    }

    public function interseccion($conjunto)
    {
        $interseccion = [];
        foreach ($this->elementos as $elemento) {
            if (in_array($elemento, $conjunto->elementos) && !in_array($elemento, $interseccion)) {
                $interseccion[] = $elemento;
            }
        }
        return new Conjunto($interseccion);
    }

    public function union($conjunto)
    {
        $union = [];
        foreach ($this->elementos as $elemento) {
            if (!in_array($elemento, $union)) {
                $union[] = $elemento;
            }
        }
        foreach ($conjunto->elementos as $elemento) {
            if (!in_array($elemento, $union)) {
                $union[] = $elemento;
            }
        }
        return new Conjunto($union);
    }

    public function diferencia($conjunto)
    {
        $diferencia = [];
        foreach ($this->elementos as $elemento) {
            if (!in_array($elemento, $conjunto->elementos) && !in_array($elemento, $diferencia)) {
                $diferencia[] = $elemento;
            }
        }
        return new Conjunto($diferencia);
    }

    public function obtenerElementos()
    {
        return $this->elementos;
    }
}
