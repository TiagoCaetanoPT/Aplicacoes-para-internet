<?php

namespace Api;

class Route
{
    // URL Format: /path1/path2/path3?paramA=valueA&paramB=valueB
    private function __construct()
    {
        $this->root = ltrim(dirname($_SERVER['SCRIPT_NAME']),'/');
        $requestUri = str_replace('/index.php', '', $_SERVER['REQUEST_URI']);
        $this->httpQueryString = $_SERVER['QUERY_STRING'];
        if ($this->httpQueryString) {
            $requestUri = str_replace('?'.$this->httpQueryString, '', $requestUri);
        }
        $pathInfo = explode('/', substr($requestUri, strlen($this->root) + 1));
        if (count($pathInfo) > 0) {
            $this->httpMethod = strtolower($_SERVER['REQUEST_METHOD']);
            $this->controller = $pathInfo[0];
            $this->action = 'index';
            if (count($pathInfo) > 1) {
                $this->action = $pathInfo[1];
            }
        }
    }

    public function route($path)
    {
        return $this->root . $path;
    }

    public function action($controller, $action = null, $params = null)
    {
        $url = $this->root.'/'.$controller;
        if ($action) {
            $url .= '/'.$action;
        }
        if ($params) {
            $url .= '?'. http_build_query($params);
        }
        return $url;
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
