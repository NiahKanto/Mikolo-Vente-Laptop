<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="black-dashboard.css" rel="stylesheet">
    <title>Log in</title>
</head>
<body>
<div class="main-panel">
<div class="content">
<div class="col-8">
<div class="card" style="padding: 2%">
<h1>Coucou Admin</h1>
    <form action="<?php echo url('/loginAdmin'); ?>" method="get">
        Entrez votre pseudo : <input class="form-control" type="text" name="pseudo" required/><br>
        Entrez votre mot de passe : <input class="form-control" type="password" name="mdp" required /><br>
        <button type="submit" class="btn btn-primary btn-lg btn-block button-prevent-multiple-submits">
            <i class="spinner fa fa-spinner fa-spin"></i> Log in 
        </button>
    </form>
</div>
</div>
</div>
</div>
</body>
</html>