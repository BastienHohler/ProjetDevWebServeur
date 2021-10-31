{% include 'nav.php' %}

{% if group != null %}
<div class="text-center fontblack"> 
  <h3>Messagerie du groupe '{{group.getName()}}'</h3>
</div>
<br>
{% endif %}
<div class="title">
  <a href='/messagerie/new'>
    <button class="btn btn--green">Envoyer un message</button>
  </a>
</div>
<br>
{% if messages==null %}
<div class='info'>
  <p> Aucun message. </p>
</div>
{% else %}
<div class="container">
  <div class="row">
    <div class="col-3 border">
      <h3 class="text-center">Expéditeur</h3>
    </div>
    <div class="col border">
      <h3 class="text-center">Contenu</h3>
    </div>
    <div class="col-1">
      <p class="msg_open"></p>
    </div>
  </div>

  {% for msg in messages %}
  <div class="row">
    <div class="col-3 border">
      <p class="msg_sender text-center">{{msg.getSender().getFullName()}}</p>
    </div>
    <div class="border col">
      <div>
        <p class="">{{msg.getContents()}}</p>
      </div>
    </div>
    <div class="col-1 ">
      <p class="msg_del"><a href="/deleteMessage/{{msg.getIdMessage()}}"><i class="fas fa-trash-alt"></i></a></p>
    </div>
  </div>
  {% endfor %}
</div>
{% endif %}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>