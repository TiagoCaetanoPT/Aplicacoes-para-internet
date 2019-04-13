<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Blocos embebidos PHP e HTML</title>
    </head>
    <body>
        <h1>Exemplo de Blocos embebidos PHP e HTML</h1>
        <a href='../index.html#03php'>Voltar ao ínicio</a>
        <hr>
        <table border="1">
        <?php for ($i = 1; $i <= 100; $i++) : ?>
                <tr>
                    <td>Nº<?= $i; ?></td>
                        <?php if (($i % 2) == 0) : ?>
                            <td>Linha Par</td>
                        <?php else : ?>                            
                            <td>Linha  Impar</td>
                        <?php endif; ?>                            
                    <td>Conteudo estático prevalece sobre o conteúdo dinâmico</td>
                </tr>
        <?php endfor; ?>
        </table>
    </body>
</html>
