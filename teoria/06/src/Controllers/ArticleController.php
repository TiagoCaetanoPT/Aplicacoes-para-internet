<?php
namespace Controllers;

use Models\Article;

class ArticleController
{
    public function getArticles()
    {
        // EXTRA: handle filters, sort, etc...
        $articles = Article::all();
        $pagetitle = "List of Articles";

        // render_view is defined on support/html_helper.php
        render_view('articles', compact('articles', 'pagetitle'));
    }
}
