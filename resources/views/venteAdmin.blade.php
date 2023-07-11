<!DOCTYPE html>
<html lang="en">
<head>
<?php 
  $liste=$data['vente'];
  $pv=$data['pv'];
  $idpv=$data['idpv'];
  $npv=$data['npv'];
  $string=$data['string'];
  $stringpv=$data['stringpv'];
  $tab=explode("|",$string);
  for($i=0;$i<count($tab)-1;$i++){
    $val=explode(";",$tab[$i]);
    $vmois[$i]=$val[2];
  }
?>
<script type="text/javascript">
  var jan=<?php echo($vmois[0]);?>;
  var fev=<?php echo($vmois[1]);?>;
  var mar=<?php echo($vmois[2]);?>;
  var avr=<?php echo($vmois[3]);?>;
  var mai=<?php echo($vmois[4]);?>;
  var jui=<?php echo($vmois[5]);?>;
  var juil=<?php echo($vmois[6]);?>;
  var aou=<?php echo($vmois[7]);?>;
  var sep=<?php echo($vmois[8]);?>;
  var oct=<?php echo($vmois[9]);?>;
  var nov=<?php echo($vmois[10]);?>;
  var dec=<?php echo($vmois[11]);?>;
   function initDashboardPageCharts() {
    gradientBarChartConfiguration = {
      maintainAspectRatio: false,
      legend: {
        display: false
      },

      tooltips: {
        backgroundColor: '#f5f5f5',
        titleFontColor: '#333',
        bodyFontColor: '#666',
        bodySpacing: 4,
        xPadding: 12,
        mode: "nearest",
        intersect: 0,
        position: "nearest"
      },
      responsive: true,
      scales: {
        yAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            suggestedMin: 0,
            suggestedMax: <?php echo(count($liste)); ?>,
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }],

        xAxes: [{

          gridLines: {
            drawBorder: false,
            color: 'rgba(29,140,248,0.1)',
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9e9e9e"
          }
        }]
      }
    };

    var ctx = document.getElementById("CountryChart").getContext("2d");

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors"];

    var myChart = new Chart(ctx, {
      type: 'line',
      responsive: true,
      legend: {
        display: false
      },
      data: {
        labels: ['JAN','FEV','MAR','AVR','MAI','JUI','JUIL','AOU','SEP','OCT','NOV','DEC'],
        datasets: [{
          fill: true,
          backgroundColor: gradientStroke,
          hoverBackgroundColor: gradientStroke,
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          data: [jan,fev,mar,avr,mai,jui,juil,aou,sep,oct,nov,dec],
        }]
      },
      options: gradientBarChartConfiguration
    });

  }
  window.addEventListener("load", function () {
        initDashboardPageCharts();
    });
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
          <li  >
          <a href="/pointvente">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Point de vente</p>
            </a>
          </li>
          <li >
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
          <li class="active ">
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
      <div class="row" >
    <div class="col-6">
      <h1>Total vente global
      <form method="get" action="/pdfvente" id="myform" >
        <input hidden name="type" value="0"/>
        <input hidden name="string" value="<?php echo ($string);?>"/>
      <button class="btn" id="btnGlobal" >Generer PDF</button>
  </form></h1>
      <form method="get" action="/vente">
      <input type="number" name="annee" required><button type="submit" >Voir</button>
    </form>
      <div class="col-7 card card-chart" style="padding:2%;">
          <div class="chart-area">
            <canvas id="CountryChart"></canvas>  
          </div>    
        </div>
      <div class="card " style="padding: 2%">

    <table style="text-align:center" >
        <tr>
            <th>Mois</th>
            <th>Quantite</th>
            <th>Montant</th>
        </tr>
        <?php 
            for($i=0;$i<count($liste);$i++){?>
              <tr>
                    <td><?php echo($liste[$i]->mois);?></td>
                  <td><?php echo($liste[$i]->nb);?></td>
                  <td><?php echo($liste[$i]->montant);?></td>
              </tr>
            <?php }
        ?>
        <tr>
          <?php $total=$data['total']; ?>
                    <td></td>
                  <td><?php echo($total[0]);?></td>
                  <td><?php echo($total[1]);?></td>
              </tr>
    </table>
    </div>
    </div>
    <div class="col-6">
    <h1>Total vente PV-<?php echo($npv); ?><br></h1>
    <form method="get" action="/vente" >
    <select name="idpv" >
      <option value="0">...</option>
        <?php
          for($i=0;$i<count($pv);$i++){ ?>
            <option value="<?php echo ($pv[$i]->id) ?>"><?php echo ($pv[$i]->lieu) ?></option> <?php
          }
        ?>
    </select>
    <input type="number" name="anneepv" required>
    <button class="btn btn-primary" type="submit" ><i class="tim-icons icon-zoom-split"></i></button>
    </form>
    <?php if($idpv!=null){ ?>
      <a href="/pdfventepv?string=<?php echo ($stringpv);?>" ><button class="btn" >Generer PDF</button></a>
    <?php } ?>
    <div class="card " style="padding: 2%">
    <table style="text-align:center" >
        <tr>
            <th>Mois</th>
            <th>Quantite</th>
            <th>Montant</th>
        </tr>
        <?php 
        if($idpv!=null){
            for($i=0;$i<count($idpv);$i++){?>
              <tr>
                    <td><?php echo($idpv[$i]->mois);?></td>
                  <td><?php echo($idpv[$i]->nb);?></td>
                  <td><?php echo($idpv[$i]->montantmontant);?>Ar</td>
              </tr>
            <?php }}?>
            <?php if($idpv!=null){ $totalpv=$data['totalpv']; ?>
                    <td></td>
                  <td><?php echo($totalpv[0]);?></td>
                  <td><?php echo($totalpv[1]);}?></td>
              </tr>
            
      
    </table>
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
            let downloadBtn = document.querySelector('#btnGlobal');
        downloadBtn.addEventListener('click', () => {
          let canvas = document.querySelector('#CountryChart');
          canvas.toBlob((blob) => {
              
              const reader = new FileReader();
              reader.addEventListener("load", () => {
                const base64String = reader.result;
                var formulaire = document.getElementById("myform");
                setImagePdf(base64String);
                formulaire.submit();
              });
              reader.readAsDataURL(blob);
              

          }, 'image/jpeg');

      });

      function setImagePdf(base){
        var xhr; 
            try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
            catch (e) 
            {
                try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
                catch (e2) 
                {
                  try {  xhr = new XMLHttpRequest();  }
                  catch (e3) {  xhr = false;   }
                }
            }

            xhr.open("get", "/upload?image=" + encodeURIComponent(base));

            xhr.send();
      }

    </script>
</body>

</html>