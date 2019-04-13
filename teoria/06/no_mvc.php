<?php
    $articles = [
        'Understanding MVC in PHP' => 'This article covers the basics of MVC web frameworks.',
        'MVC in PHP' => 'The model view controller pattern is the most used pattern for today’s world web applications.',
        'PHP Basic' => 'Basic features and functionalities of PHP language.',
        'PHP POO' => 'Object Oriented Programming on PHP.'
    ];
    $pagetitle = "List of Articles (No MVC)";
?>
<!DOCTYPE html>
<style>
    table {
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid #999;
        padding: 0.5rem;
        text-align: left;
    }    
</style>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?= $pagetitle ?></title>
    </head>
    <body>
        <h1><?= $pagetitle ?></h1>
        <a href='../index.html#06mvc'>Back to the start</a>
        <hr>
        <p>
            <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $title => $content) : ?>
                <tr>
                    <td><?= htmlspecialchars($title) ?></td>
                    <td><?= htmlspecialchars($content) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </p>
    </body>
</html>