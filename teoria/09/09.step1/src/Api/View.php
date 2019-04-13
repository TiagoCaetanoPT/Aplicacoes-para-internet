<?php

namespace Api;

class View
{
    private $name;
    private $vars;

    private function __construct($name, $vars)
    {
        $this->name = $name;
        $this->vars = $vars;
    }

    public function render()
    {
        foreach ($this->vars as $name => $value) {
            $$name = $value;
        }

        include('views/header.view.php');
        include('views/'.str_replace('.', '/', $this->name).'.view.php');
        include('views/footer.view.php');
    }

    public static function create($name, $vars)
    {
        return new View($name, $vars);
    }
}
