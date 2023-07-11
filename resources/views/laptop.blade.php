<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    $liste=$data['laptop'];
    $reference=$data['ref'];
?>
<script type="text/javascript">
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
    <link href="assets/demo/demo.css" rel="stylesheet" />
    <title>Title</title>
</head>
<body>
<div class="sidebar">
<div class="sidebar-wrapper">
<div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            MK
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Mikolo(<?php echo(session('utilisateur')->getPointVente()->lieu); ?>)
          </a>
        </div>
        <ul class="nav">
          <li >
          <a href="/accueil">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Reception Laptop</p>
            </a>
          </li>
          <li class="active ">
          <a href="/laptop">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Renvoi et vente</p>
            </a>
          </li>
          <li>
          <a href="/listevente">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Liste des ventes</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Mikolo</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="dropdown nav-item">
                <a href="/logout" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="/logout" class="nav-item dropdown-item">Log out</a></li>
                  <li class="dropdown-divider"></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="content">
    <div class="col-12">
    <?php if($data['erreur']!=null){ ?>
        <div class="alert alert-danger">
            <span><b> Danger :  </b><?php echo ($data['erreur']) ?></span>
        </div>
        <?php } ?>
    <div class="card " style="padding: 2%">
    <button class="btn btn-danger" data-toggle="modal" data-target="#renvoi" >Renvoi<i class="tim-icons icon-delivery-fast"></i></button>
    <button class="btn btn-info" data-toggle="modal" data-target="#vente" >Vente<i class="tim-icons icon-money-coins"></i></button>
    <table class="table">
    <tr>
            <th>Marque</th>
            <th>Reference</th>
            <th>Processeur</th>
            <th>RAM</th>
            <th>Ecran</th>
            <th>Disque Dur</th>
            <th>Prix</th>
            <th>Quantite</th>
        </tr>
        <?php 
            for($i=0;$i<count($liste);$i++){?>
              <tr>
                  <td><?php echo($liste[$i]->marque);?></td>
                  <td><?php echo($liste[$i]->reference);?></td>
                  <td><?php echo($liste[$i]->processeur." ".$liste[$i]->generation."e generation");?></td>
                  <td><?php echo($liste[$i]->ram);?>Go</td>
                  <td><?php echo($liste[$i]->ecran);?>''</td>
                  <td><?php echo($liste[$i]->disquedur);?>Go</td>
                  <td><?php echo($liste[$i]->prix);?>Ar</td>
                  <td><?php echo($liste[$i]->qte);?></td>
              </tr>
            <?php }
        ?>
    </table>

    <div class="modal modal-search fade" id="renvoi" tabindex="-1" role="dialog" aria-labelledby="renvoi" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            Renvoi de laptop
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
            <form method="get" action="<?php echo url('/insertionRenvoi'); ?>" >
            Choisissez la reference : <select class="form-control" name="idreference">
                    <?php 
                        for($i=0;$i<count($reference);$i++){ ?>
                            <option value="<?php echo ($reference[$i]->id) ?>"><?php echo ($reference[$i]->intitule) ?></option> <?php
                        }
                    ?>
                    </select><br>
                    <input name="idpointvente" type="text" hidden value="<?php echo (session('utilisateur')->idpointvente)?>" required/><br>
             Entrez quantite :        
                    <input name="qte" value="0" type="number" required/><br>
                    Entrez date :        
                    <input name="date" type="date" required/><br>
                    <button class="btn" type="submit" >Envoyer</button>
            </form>
          </div>
        </div>
      </div>

      <div class="modal modal-search fade" id="vente" tabindex="-1" role="dialog" aria-labelledby="vente" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            Vente de laptop
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
            <form method="get" action="<?php echo url('/insertionVente'); ?>" >
            Choisissez la reference : <select class="form-control" name="idreference">
                    <?php 
                        for($i=0;$i<count($reference);$i++){ ?>
                             <option value="<?php echo ($reference[$i]->id) ?>"><?php echo ($reference[$i]->intitule) ?></option> <?php
                        }
                    ?>
                    </select><br>
                    <input name="idpointvente" type="text" hidden value="<?php echo (session('utilisateur')->idpointvente)?>" required/><br>
             Entrez quantite :        
                    <input name="qte" value="0" type="number" required/><br>
                    Entrez date :        
                    <input name="date" type="date" required/><br>
                    <button class="btn" type="submit" >Envoyer</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    </div>
</div>
<script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <script src="assets/js/black-dashboard.min.js?v=1.0.0"></script>
  <script src="assets/demo/demo.js"></script>

    <script type="text/javascript">

        function setId(id,qte){
            val1=document.getElementById("transfert");
            val1.value=id;
            val2=document.getElementById("qte");
            val2.value=qte;
        }

    </script>
</body>

</html>