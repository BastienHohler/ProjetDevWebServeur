<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="/user" method="post">
      <div class="user">
        <label for="nom">Nom: </label>
        <input type="text" name="nom" value="">
        <label for="prenom">Prénom: </label>
        <input type="text" name="prenom" value="">
        <label for="login">Login: </label>
        <input type="text" name="login" value="">
        <label for="password">Password: </label>
        <input type="text" name="password" value="">
        <br>
        <label for="mail">Mail: </label>
        <input type="text" name="mail" value="">
        <br>
        <label for="anonyme">Voulez-vous être anonyme ? </label>
        <input type="checkbox" name="anonyme" value="">
        <br>
        <label for="etat">Avez-vous le covid 19 ? </label>
        <input type="checkbox" name="etat" value="">
      </div>
      <div class="adresse">
        <label for="rue">Rue: </label>
        <input type="text" name="rue" value="">
        <label for="ville">Ville: </label>
        <input type="text" name="ville" value="">
        <label for="cp">Code Postal: </label>
        <input type="text" name="cp" value="">
        <label for="pays">Pays: </label>
        <input type="text" name="pays" value="">
      </div>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>
