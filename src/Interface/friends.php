<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link href="./css/main.css" rel="stylesheet" media="all">
    <title></title>
  </head>
  <body>
  <header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/friend" class="nav-link px-2 link-dark">Friends</a></li>
          <li><a href="/messagerie" class="nav-link px-2 link-dark">Messages</a></li>
          <li><a href="/group" class="nav-link px-2 link-dark">Groupe</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-end" id="dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" >
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="/deleteUser/{{id}}">Delete account</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/signOut">Sign out</a></li>
          </ul>
        </div>
        <p style="margin-left: 15px;">{{name}}</p>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col border">
      <h2 class="text-center">Amis</h2>
      <br><br>
  {% for friend in listFriends %}
    <div class="row border">
        <div class="col"><p class="friends">{{friend.prenom}} {{friend.nom}}</p></div>
        <div class="col"><p class="delFriends"><a href="/deleteFriend/{{friend.id_friend}}"><i class="fas fa-trash-alt"></i></a></p></div>
    </div>
    {% endfor %}
      </div>
      <div class="col border">
      <h2 class="text-center">Demande en attente</h2>
      <br><br>
  {% for friendPending in listPending %}
    <div class="row border">
        <div class="col"><p class="pending">{{friendPending.prenom}} {{friendPending.nom}}</p></div>
        <div class="col"><p class="delPending"><a href="/deleteFriend/{{friendPending.id_friend}}"><i class="fas fa-trash-alt"></i></a></p></div>
    </div>
    {% endfor %}
      </div>
      <div class="col border">
      <h2 class="text-center">Demande d'ami</h2>
      <br><br>
  {% for friendRequest in listRequest %}
    <div class="row border">
        <div class="col"><p class="applicant">{{friendRequest.prenom}} {{friendRequest.nom}}</p></div>
        <div class="col">
          <div class="row">
            <div class="col"><form action="/friend" method="post">
                              <div style="">
                                  <input type="hidden" name="id_friend" value="{{friendRequest.id_friend}}">
                                  <button class="btn--radius-2 btn--green" style="width:100px;" type="submit">Accept</button>
                              </div>
                            </form>
            </div>
            <div class="col"><a href="/deleteFriend/{{friendRequest.id}}"><i class="fas fa-trash-alt"></i></a></div>
          </div>
      </div>
    </div>
    {% endfor %}
      </div>
    </div>
  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
