<!DOCTYPE html>

<html lang="fr">
<head>

    <meta charset="UTF-8">
    <title>signUp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="./css/main.css" rel="stylesheet" media="all">
</head>
<body>
<div class="page-wrapper bg-gra-04 p-t-45 p-b-50">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">sign in</h2>
            </div>
            <div class="card-body">
                <form action="/authentication" method="post">
                    <div class="form-row m-b-55">
                        <div class="name"></div>
                        <div class="value">
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="text" name="login">
                                        <label class="label--desc">login</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group-desc">
                                        <input class="input--style-5" type="password" name="password">
                                        <label class="label--desc">password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div style="margin-top:50px;margin-left:35%;">
                            <button class="btn btn--radius-2 btn--red" type="submit">Login</button>
                        </div>
                </form>
                <form action="/signUp" method="get">
                        <div style="margin-top:50px;margin-left:35%;">
                            <p> Toujours pas inscrit ? </p>
                            <button class="btn btn--radius-2 btn--green" type="submit">Register</button>
                        </div>
                </form>
            </div>
            <p class="messageError">{{messageError}}</p>
        </div>
    </div>
</div>
</body>
</html>
