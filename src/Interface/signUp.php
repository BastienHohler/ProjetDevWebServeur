<!DOCTYPE html>
<!--<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="/user" method="post">
      <div class="user">
        <label for="nom">Nom: </label>
        <input type="text" name="nom" value="">
        <label for="prenom">Prénom: </label>
        <input type="text" name="prenom" value="">
        <label for="login">Login: </label>
        <input type="text" name="login" value="">
        <label for="password">Password: </label>
        <input type="text" name="password" value="">
        <br>
        <label for="mail">Mail: </label>
        <input type="text" name="mail" value="">
        <br>
        <label for="anonyme">Voulez-vous être anonyme ? </label>
        <input type="checkbox" name="anonyme" value="">
        <br>
        <label for="etat">Avez-vous le covid 19 ? </label>
        <input type="checkbox" name="etat" value="">
      </div>
      <div class="adresse">
        <label for="rue">Rue: </label>
        <input type="text" name="rue" value="">
        <label for="ville">Ville: </label>
        <input type="text" name="ville" value="">
        <label for="cp">Code Postal: </label>
        <input type="text" name="cp" value="">
        <label for="pays">Pays: </label>
        <input type="text" name="pays" value="">
      </div>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>-->
<html lang="en"><head>

<meta charset="UTF-8">
<title>signUp</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link href="./css/main.css" rel="stylesheet" media="all">
</head>
<body>
<div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
<div class="wrapper wrapper--w790">
<div class="card card-5">
<div class="card-heading">
<h2 class="title">signUp</h2>
</div>
<div class="card-body">
<form method="POST">
<div class="form-row m-b-55">
<div class="name">Name</div>
<div class="value">
<div class="row row-space">
<div class="col-2">
<div class="input-group-desc">
<input class="input--style-5" type="text" name="nom">
<label class="label--desc">first name</label>
</div>
</div>
<div class="col-2">
<div class="input-group-desc">
<input class="input--style-5" type="text" name="prenom">
<label class="label--desc">last name</label>
</div>
</div>
</div>
</div>
</div>
<div class="form-row">
<div class="name">Company</div>
<div class="value">
<div class="input-group">
<input class="input--style-5" type="text" name="company">
</div>
</div>
</div>
<div class="form-row">
<div class="name">Email</div>
<div class="value">
<div class="input-group">
<input class="input--style-5" type="email" name="email">
</div>
</div>
</div>
<div class="form-row m-b-55">
<div class="name">Phone</div>
<div class="value">
<div class="row row-refine">
<div class="col-3">
<div class="input-group-desc">
<input class="input--style-5" type="text" name="area_code">
<label class="label--desc">Area Code</label>
</div>
</div>
 <div class="col-9">
<div class="input-group-desc">
<input class="input--style-5" type="text" name="phone">
<label class="label--desc">Phone Number</label>
</div>
</div>
</div>
</div>
</div>
<div class="form-row">
<div class="name">Subject</div>
<div class="value">
<div class="input-group">
<div class="rs-select2 js-select-simple select--no-search">
<select name="subject" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
<option disabled="disabled" selected="selected">Choose option</option>
<option>Subject 1</option>
<option>Subject 2</option>
<option>Subject 3</option>
</select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 110px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-subject-us-container"><span class="select2-selection__rendered" id="select2-subject-us-container" title="Choose option">Choose option</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
<div class="select-dropdown"></div>
</div>
</div>
</div>
</div>
<div class="form-row p-t-20">
<label class="label label--block">Are you an existing customer?</label>
<div class="p-t-15">
<label class="radio-container m-r-55">Yes
<input type="radio" checked="checked" name="exist">
<span class="checkmark"></span>
</label>
<label class="radio-container">No
<input type="radio" name="exist">
<span class="checkmark"></span>
</label>
</div>
</div>
<div>
<button class="btn btn--radius-2 btn--red" type="submit">Register</button>
</div>
</form>
</div>
</div>
</div>
</div>
</body></html>
