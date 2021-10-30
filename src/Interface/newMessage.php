{% include 'nav.php' %}
<link href="../css/main.css" rel="stylesheet" media="all">
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
