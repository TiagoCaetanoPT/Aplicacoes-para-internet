<?php

namespace Api;

class Route
{
    // URL Format: index.php?path1/path2/path3&paramA=valueA&paramB=valueB
    private function __construct()
    {
        $this->root = ltrim(dirname($_SERVER['SCRIPT_NAME']),'/');
        $this->httpQueryString = $_SERVER['QUERY_STRING'];
        $queryStringParts = explode('&', $this->httpQueryString);
        $pathInfo = explode('/', $queryStringParts[0]);
        $this->httpQueryString = $queryStringParts[1] ?? "";
        if (count($pathInfo) > 0) {
            $this->httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
            $this->controller = $pathInfo[0];
            $this->action = 'index';
            if (count($pathInfo) > 1) {
                $this->action = $pathInfo[1];
            }
        }
    }
    
    public function execute()
    {
        if (!$this->controller) {
            die("Should have a default route");
        }
        $className = 'Controllers\\'.ucfirst($this->controller).'Controller';
        $methodName = $this->httpMethod.ucfirst($this->action);

        $instance = new $className;
        // IMPROVE: use remaining pathinfo to pass parameters
        return $instance->$methodName();
    }

    private static $singleton;
    public static function defaultRoute()
    {
        if (is_null(self::$singleton)) {
            self::$singleton = new Route;
        }
        return self::$singleton;
    }
}
