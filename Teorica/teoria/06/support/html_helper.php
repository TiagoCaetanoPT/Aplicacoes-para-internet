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
