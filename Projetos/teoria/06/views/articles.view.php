<table>
<thead>
    <tr>
        <th>Title</th>
        <th>Content</th>
    </tr>
</thead>
<tbody>                
<?php foreach ($articles as $article) : ?>
    <tr>
        <td><?= htmlspecialchars($article->title) ?></td>
        <td><?= htmlspecialchars($article->content) ?></td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
