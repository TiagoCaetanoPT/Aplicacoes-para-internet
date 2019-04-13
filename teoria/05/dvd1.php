<?php

class Product
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
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>DVD Class v.1</title>
    </head>
    <body>
        <h1>DVD Class v.1</h1>
        <a href='../index.html#05poo'>Back to the start</a>
        <hr>
        <p>
            <?php
                $dvd1 = new DVD("47 Ronin", 25, 2013);
                echo $dvd1;

                $dvd2 = new DVD("Matrix", 25, 1999);
                echo "<br>get_class = " . get_class($dvd2);                    // Outputs DVD
                echo "<br>get_parent_class = " . get_parent_class($dvd2);      // Outputs Product
                echo "<br>instanceof DVD = " . ($dvd2 instanceof DVD);         // Outputs 1 (true)
                echo "<br>instanceof Product = ". ($dvd2 instanceof Product);  // Outputs 1 (true)
            ?>
        </p>
    </body>
</html>
