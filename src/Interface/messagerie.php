{% include 'nav.php' %}
  <a href = "/messagerie/new"> Envoyer un message </a>
  {% if messages==null %} 
  <p> Vous n'avez aucun nouveau message. </p>
  {% endif %}

  {% for msg in messages %}
  <div class="row">
        <div class="col-3"><p class="msg_sender">{{msg.getSender().getFullName()}}</p></div>
        <div class="col"><p class="msg_open"><a href="/messagerie/{{msg.getIdMessage()}}">{{msg.getContents()}}</a></p></div>
        <div class="col"><p class="msg_del"><a href="/deleteMessage/{{msg.getIdMessage()}}">delete</a></p></div>
      </div>
  {% endfor %}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
