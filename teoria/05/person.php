<?php
class Person
{
    private $canDance = true;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function dance()
    {
        return $this->canDance ? "I'm dancing!" : "I can’t dance!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Person Class</title>
    </head>
    <body>
        <h1>Person Class</h1>
        <a href='../index.html#05poo'>Back to the start</a>
        <hr>
        <p>
            <?php
                $me = new Person("John");
                echo $me->dance();
            ?>
        </p>
    </body>
</html>
