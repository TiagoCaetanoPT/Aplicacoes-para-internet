<?php

class Product
{
    protected $type;
    protected $title;
    protected $price;
    
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
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Product Class v.1</title>
    </head>
    <body>
        <h1>Product Class v.1</h1>
        <a href='../index.html#05poo'>Back to the start</a>
        <hr>
        <p>
            <?php
                $p1 = new Product("dvd", "TRON: Legacy", 25);
                echo $p1;
            ?>
        </p>
    </body>
</html>
