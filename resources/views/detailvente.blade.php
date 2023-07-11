<!DOCTYPE html>
<html lang="en">
<head>
<?php 
  $liste=$data['liste'];
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
            Mikolo
          </a>
        </div>
        <ul class="nav">
          <li>
          <a href="/accueilAdmin">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Laptop</p>
            </a>
          </li>
          <li  class="active ">
          <a href="/pointvente">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Point de vente</p>
            </a>
          </li>
          <li>
          <a href="/marque">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Marque</p>
            </a>
          </li>
          <li>
          <a href="/processeur">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Processeur</p>
            </a>
          </li>
          <li>
          <a href="/reference">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Reference</p>
            </a>
          </li>
          <li>
          <a href="/utilisateur">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Utilisateur</p>
            </a>
          </li>
          <li>
          <a href="/transfert">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Transfert</p>
            </a>
          </li>
          <li>
          <a href="/vente">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Vente</p>
            </a>
          </li>
          <li>
          <a href="/benefice">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Benefice</p>
            </a>
          </li>
          <li>
          <a href="/renvoi">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Renvoi</p>
            </a>
          </li>
          <li>
          <a href="/commission">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Commission</p>
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
                <a href="" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="/logoutAdmin" class="nav-item dropdown-item">Log out</a></li>
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
    <div class="card " style="padding: 2%">
    <table class="table">
        <tr>
            <th>Date</th>
            <th>Point de vente</th>
            <th>Reference</th>
            <th>Quantite</th>
            <th>Montant</th>
        </tr>
        <?php 
            for($i=0;$i<count($liste);$i++){?>
              <tr>
                  <td><?php echo($liste[$i]->datevente);?></td>
                  <td><?php echo($liste[$i]->idpointvente);?></td>
                  <td><?php echo($liste[$i]->idreference);?></td>
                  <td><?php echo($liste[$i]->qte);?></td>
                  <td><?php echo($liste[$i]->montant);?></td>
              </tr>
            <?php }
        ?>
    </table>

  
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
    </script>
</body>

</html>