<?php

function render_view($viewName, $vars)
{
    // Declares a local variable for each pair inside $vars
    foreach ($vars as $name => $value) {
        $$name = $value;
    }

    include 'views/header.view.php';
    include 'views/'.str_replace('.', '/', $viewName).'.view.php';
    include 'views/footer.view.php';
}

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
