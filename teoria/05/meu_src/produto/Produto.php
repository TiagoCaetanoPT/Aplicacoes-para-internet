<?php

namespace meu\produto;

class Produto
{
    protected $type;
    protected $title;
    protected $price;
    const VAT = 0.23;
    
    public function __construct($type, $title, $price)
    {
        $this->type = $type;
        $this->title = $title;
        $this->price = $price;
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function __toString()
    {
        $text = '[type='.$this->type;
        $text .= '; title='.$this->title.'; price = '.$this->price.']';
        return $text;
    }

    public function priceWithVAT()
    {
        return $this->price * (1 + self::VAT);
    }
}
