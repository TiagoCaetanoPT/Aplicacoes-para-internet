<?php

require_once "product.php";

class DVD extends Product
{
    protected $year;

    public function __construct($title, $price, $year)
    {
        parent::__construct("dvd", $title, $price);
        $this->year = $year;
    }
    public function getYear()
    {
        return $this->year;
    }
    
    public function __toString()
    {
        return 'DVD['.parent::__toString().'; year='.$this->year.']';
    }
}
