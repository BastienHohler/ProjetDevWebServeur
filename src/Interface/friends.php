{% include 'nav.php' %}
<!-- Trigger the modal with a button -->
<div class="text-center"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Friend</button></div>
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
  <!-- Modal -->
  <div id="myModal" class="modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add friend</h4>
        </div>
        <div class="modal-body">
          <form action="/friend" method="post">
          <select class="form-select" name="id_friend">
            {% for nonFriend in nonFriendsList %}
              <option value="{{nonFriend.id_user}}">{{nonFriend.prenom}} {{nonFriend.nom}}</option>
              {% endfor %}
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
