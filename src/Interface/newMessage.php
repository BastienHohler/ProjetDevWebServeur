{% include 'nav.php' %}
<link href="../css/main.css" rel="stylesheet" media="all">
<div class="page-wrapper bg-gra-04 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            {% if grp==null%}
            <div class="card-heading">
                <h2 class="title">Conversation avec {{frd.getFullName()}}</h2>
            </div>
            <div class="msg-display">
                {% for msg in msgs %}
                {% if msg.getRecipient()==frd %}
                <div class='dual'>
                    <p class="msg-del"><a href="/deleteMessage/{{msg.getIdMessage()}}"><i class="fas fa-trash-alt"></i></a></p>
                    <div class='right msg'> {{msg.getContents()}} </div>

                </div>
                {% else %}
                <div class='left msg'> {{msg.getContents()}} </div>
                {% endif %}
                {% endfor %}
            </div>
            <div class="card-body">
                <form action="/send/{{grp.getIdGroup()}}" method="post">
                    <div class="form-row m-b-55">
                        <div class="name"></div>
                        <div class="value">
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
            {% else %}
            <div class="card-heading">
                <h2 class="title">Conversation de groupe avec  '{{grp.getName()}}'</h2>
            </div>
            <div class="msg-display">
                {% for msg in msgs %}
                {% if msg.getSender().getId() == id %}
                <div class='dual'>
                    <p class="msg-del"><a href="/deleteMessage/{{msg.getIdMessage()}}"><i class="fas fa-trash-alt"></i></a></p>
                    <div class='right msg'> {{msg.getContents()}} </div>

                </div>
                {% else %}
                <div class='dualleft'>
                    <p class='aligncenter'> {{msg.getSender().getFullName()}} : </p>
                    <div class='left msg'> {{msg.getContents()}} </div>
                </div>
                {% endif %}
                {% endfor %}
            </div>
            <div class="card-body">
                <form action="/sendgroup/{{grp.getIdGroup()}}" method="post">
                    <div class="form-row m-b-55">
                        <div class="name"></div>
                        <div class="value">
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
            <div class="card-body">
                <form action="/send/{{grp.getIdGroup()}}" method="post">
                    <div class="form-row m-b-55">
                        <div class="name"></div>
                        <div class="value">
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
            <p class="messageError">{{messageError}}</p>
            <p class="messageSuccess">{{messageSuccess}}</p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>