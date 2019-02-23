<?php

namespace Models;

class Article
{
    public $title;
    public $content;

    public function __construct($title = null, $content = null)
    {
        $this->title = $title;
        $this->content = $content;
    }
    
    public static function all()
    {
        return [
            1 => new Article('Understanding MVC in PHP', 'This article covers the basics of MVC web frameworks.'),
            2 => new Article('MVC in PHP', 'The model view controller pattern is the most used pattern for today’s world web applications.'),
            3 => new Article('PHP Basic', 'Basic features and functionalities of PHP language.'),
            4 => new Article('PHP POO', 'Object Oriented Programming on PHP.')
        ];
    }
}
