{% include 'nav.php' %}
<a href="/groups/new"> Créer un groupe </a>
{% if grpsUser.isEmpty() %}
<div class='info'>
  <p> Vous ne faites parti d'aucun groupe. </p> 
</div>
{% endif %}
<div class="container">
  <div class="row">
    <div class="col-3 border">
      <h3 class="text-center">Nom</h3>
    </div>
    <div class="col border">
      <h3 class="text-center">Contenu</h3>
    </div>
    <div class="col-1">
      <p class="msg_open"></p>
    </div>
  </div>

  {% for grp in availableGrps %}
  <div class="row">
    <div class="col-3 border">
      <p class="msg_sender">{{grp.getName()}}</p>
    </div>
    <div class="dual border col">
      <div>
        {% for usr in grp.getUsers() %}
        <p class="msg_content">{{usr.getFullName()}} membres.</p>
        {% endfor %}
      </div>
      <div><a href="/groups/join/{{grp.getIdGroup()}}">  Rejoindre </a> </div>
    </div>
    <div class="col-1 ">
      <p class="msg_del"><a href="/deleteMessage/{{msg.getIdMessage()}}">delete</a></p>
    </div>
  </div>
  {% endfor %}
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>