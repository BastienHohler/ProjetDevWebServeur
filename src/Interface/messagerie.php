{% include 'nav.php' %}

{% if friends==null %}
<div class='info'>
  <p> Ajoutez un ami pour discuter. </p>
</div>
{% else %}

{% for frd in friends %}
<div class="row">
  <div class="title chat">
    <a href='/messagerie/msg/{{frd.id_user_friend}}'>
      <button class="btn btn--green">Chat avec {{frd.prenom}} {{frd.nom}}</button>
    </a>
  </div>
  <br>
</div>
{% endfor %}
</div>
{% endif %}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>