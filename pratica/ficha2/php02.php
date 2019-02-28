<!DOCTYPE html>
<html lang=pt dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP: Times table</title>

    <link rel="stylesheet" href="style.css">

  </head>
  <body>

    <h1>Exercicio 2</h1>

    <table>
      <thead>
        <tr>
          <th>*</th>
            <?php for ($cabecalho=1; $cabecalho <= 10; $cabecalho++) { ?>
              <th><?=$cabecalho ?></th>
            <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php for ($coluna=1; $coluna <= 10; $coluna++) { ?>
        <tr>
          <th><?= $coluna ?></th>
          <?php for ($linha=1; $linha <= 10; $linha++) { ?>
            <?php if ($coluna==$linha) :?>
              <td class="diag"><?=$linha*$coluna ?></td>
            <?php else: ?>
              <td><?=$linha*$coluna ?></td>
            <?php endif; ?>
          <?php } ?>

        </tr>
          <?php } ?>
      </tbody>
    </table>

  </body>
</html>
