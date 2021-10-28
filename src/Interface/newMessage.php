<!DOCTYPE html>
<!--<html lang="fr" dir="ltr">
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
</html>-->
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Envoyer un message</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="../css/main.css" rel="stylesheet" media="all">
</head>
<body>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Customers</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Products</a></li>
          <li><a href="/messagerie" class="nav-link px-2 link-dark">Messages</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
<div class="page-wrapper bg-gra-04 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Envoyer un message</h2>
            </div>
            <div class="card-body">
                <form action="/send" method="post">
                    <div class="form-row m-b-55">
                        <div class="name"></div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="recipient">
                                        <label class="label--desc">Destinataire (pseudo)</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="content">
                                        <label class="label--desc">Contenu du message</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div style="margin-top:50px;margin-left:35%;">
                            <button class="btn btn--radius-2 btn--red" type="submit">Envoyer</button>
                        </div>
                </form>
            </div>
            <p class="messageError">{{messageError}}</p>
            <p class="messageSuccess">{{messageSuccess}}</p>
        </div>
    </div>
</div>
</body>
</html>
