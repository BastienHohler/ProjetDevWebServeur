{% include 'nav.php' %}
<!-- Trigger the modal with a button -->
<div class="text-center"><button type="button" class="btn btn--red  btn-lg" data-toggle="modal" data-target="#myModal">Créer un groupe</button></div>
<br>
{% if grpsUser==null %}
<div class='info'>
  <p> Vous ne faites parti d'aucun groupe. </p>
</div>
{% else %}
<div class='title fontblack'>
  <p> Vos groupes : </p>
</div>
<div class="container">
  <div class="row">
    <div class="col-3 border">
      <h3 class="text-center">Nom du groupe</h3>
    </div>
    <div class="col border">
      <h3 class="text-center">Membres</h3>
    </div>
    <div class="col-3 border">
      <h3 class="text-center">Créateur</h3>
    </div>
    <div class="col-1 border"></div>
  </div>

  {% for grp in grpsUser %}
  <div class="row">
    <div class="col-3 border">
      <h4 class="text-center">{{grp.getName()}}</h4>
    </div>
    <div class="border col">
      {% for usr in grp.getUsers() %}
      <p class="text-center">
        {{usr.getFullName()}}
      </p>
      {% endfor %}

    </div>
    <div class="col-3 border text-center">{{grp.getUsers()[0].getFullName()}}</div>
    <div class="col-1 border text-center">
      <p class="msg_del"><a href="messagerie/group/{{grp.getIdGroup()}}">Messagerie</a></p>
      {% if grp.getUsers()[0].getId() == user_id %}
      <p class="msg_del"><a href="/groups/delete/{{grp.getIdGroup()}}">Supprimer</a></p>
      {% else %}

      <p class="msg_del"><a href="/groups/leave/{{grp.getIdGroup()}}">Quitter</a></p>
      {% endif %}
    </div>
  </div>


  {% endfor %}
</div>

{% endif %}


{% if availableGrps == null %}
<div class='info'>
  <p> Aucun nouveau groupe à rejoindre. </p>
</div>
{% else %}
<div class='title fontblack'>
  <p> Rejoindre un groupe </p>
</div>
<div class="container">
  <div class="row">
    <div class="col-3 border">
      <h3 class="text-center">Nom du groupe</h3>
    </div>
    <div class="col border">
      <h3 class="text-center">Membres</h3>
    </div>
    <div class="col-3 border">
      <h3 class="text-center">Créateur</h3>
    </div>
    <div class="col-1 border"></div>
  </div>
  {% for grp in availableGrps %}
  <div class="row">
    <div class="col-3 border">
      <p class="text-center">{{grp.getName()}}</p>
    </div>
    <div class="border col">
      {% for usr in grp.getUsers() %}
      <p class="text-center">
        {{usr.getFullName()}}
      </p>
      {% endfor %}
    </div>
    <div class="col-3 border text-center">{{grp.getUsers()[0].getFullName()}}</div>
    <div class="col-1 border text-center"><a href="/groups/join/{{grp.getIdGroup()}}"> Rejoindre </a> </div>
  </div>

  {% endfor %}
  {% endif %}
</div>

<div id="myModal" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Créer un groupe</h4>
      </div>
      <div class="modal-body">
        <form action="/groups" method="post">
          <div>
            <div class="input-group-desc">
              <input class="input--style-5" type="text" name="grp_name">
              <div>
                <label>Nom du groupe</label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Créer</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>