<?php

function old($name, $default = '')
{
    if (isset($_POST[$name])) {
        return $_POST[$name];
    }
    return $default;
}

// escapes the specified string by applying htmlentities.
function escape($raw)
{
    return htmlentities($raw, ENT_QUOTES, 'UTF-8');
}

function htmlErrorMessage($name, $errors)
{
    if (array_key_exists($name, $errors)) {
        return "<em>" . $errors[$name] . "</em>";
    }
    return "";
}

function route($path)
{
    $defaultRoute = Api\Route::defaultRoute();
    return $defaultRoute->route($path);
}

function action($controller, $action = null, $params = null)
{
    $defaultRoute = Api\Route::defaultRoute();
    return $defaultRoute->action($controller, $action, $params);
}

