<?php

namespace meu\produto;

class BlueRay extends Produto
{
    protected $year;

    public function __construct($title, $price, $year)
    {
        parent::__construct("Blue Ray", $title, $price);
        $this->year = $year;
    }
    public function getYear()
    {
        return $this->year;
    }
    
    public function __toString()
    {
        return 'Blue Ray['.parent::__toString().'; year='.$this->year.']';
    }
}
