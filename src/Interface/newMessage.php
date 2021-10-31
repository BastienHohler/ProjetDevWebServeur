{% include 'nav.php' %}
<link href="../css/main.css" rel="stylesheet" media="all">
<div class="page-wrapper bg-gra-04 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Envoyer un message</h2>
            </div>
            {% if friendsList==null and groups == null %}
            <p class="messageError">Ajoutez des amis ou rejoignez un groupe</p>
            {% else %}
            <div class="card-body">

                <form action="/send" method="post">
                    <div class="form-row m-b-55">
                        <div class="name"></div>
                        <div class="value">
                            <div class="modal-body">
                                {% if friendsList != null %}
                                <select class="form-select" name="recipient">
                                <option disabled selected value> Choisir un ami </option>
                                    {% for friend in friendsList %}
                                    <option value="{{friend.id_user_friend}}">{{friend.prenom}} {{friend.nom}}</option>
                                    {% endfor %}
                                </select>
                                {% endif %}
                                {% if groups != null %}
                                <select class="form-select" name="group">
                                <option disabled selected value> Choisir un groupe </option>
                                {% for grp in groups %}
                                    <option value="{{grp.getIdGroup()}}">{{grp.getName()}}</option>
                                    {% endfor %}
                                </select>
                                {% endif %}
                            </div>
                            <div>
                                <div class="input-group-desc">
                                    <input class="input--style-5" type="text" name="content">
                                    <label class="label--desc">Contenu du message</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:50px;margin-left:35%;">
                        <button class="btn btn--radius-2 btn--red" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>
            {% endif %}
            <p class="messageError">{{messageError}}</p>
            <p class="messageSuccess">{{messageSuccess}}</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>