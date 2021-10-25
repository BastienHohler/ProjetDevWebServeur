<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    session_start();
    echo "Bienvenue ".$_SESSION['userName'];
     ?>
    <a href="/deleteUser/2">supprimer mon compte</a>
  </body>
</html>
