<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="black-dashboard.css" rel="stylesheet">
    <title>Log in</title>
    <?php
        if(isset($data['erreur'])){
            $erreur=$data['erreur'];
        }
        else{$erreur=null;}
        if(isset($data['info'])){
            $info=$data['info'];
        }
        else{$info=null;}
    ?>
</head>
<body>
<div class="main-panel">
<div class="content">
<div class="col-8">
<div class="card" style="padding: 2%">
    <form action="<?php echo url('/login'); ?>" class="box form-prevent-multiple-submits" method="post">
        @csrf
        @method('GET')
        Entrez votre pseudo : <input class="form-control" type="text" name="pseudo" required/><br>
        Entrez votre mot de passe : <input class="form-control" type="password" name="mdp" required /><br>
        <div class="" ></div>
        <div class="d-flex justify-content-around align-items-center mb-4">
            <a href="<?php echo url('/affInscri'); ?>">S'inscrire</a>
        </div>
        <?php if($erreur!=null){ ?>
        <div class="alert alert-danger">
            <span><b> Erreur :  </b><?php echo ($erreur) ?></span>
        </div>
        <?php } ?>
        <?php if($info!=null){ ?>
        <div class="alert alert-info">
            <span><b> Info :  </b><?php echo ($info) ?></span>
        </div>
        <?php } ?>
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