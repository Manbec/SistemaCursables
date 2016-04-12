<?php $dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("pasc");

session_start();
//$username = $_SESSION['cuenta'];
$username = 1228536;

$query = mysql_query('SELECT Matricula, nombres, apellidopat, apellidomat from alumno where matricula = '.$username);
$row = mysql_fetch_assoc($query);
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Wed Oct 01 2014 03:07:23 GMT+0000 (UTC) -->
<html data-wf-site="5409c89a6774599c3d7eeb34" data-wf-page="5409f2f06774599c3d7eef08">
<head>
  <meta charset="utf-8">
  <title>cursablesalumno - Samuel's Blank Site</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/pasc.webflow.css">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]
      }
    });
  </script>
  <script type="text/javascript" src="js/modernizr.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="https://daks2k3a4ib2z.cloudfront.net/placeholder/favicon.ico">
</head>
<body>
  <div class="header-container">
    <div class="w-container">
      <img src="images/encabezado.png" alt="5409cc7f50c3bd3f1b90ad39_encabezado.png">
    </div>
  </div>
  <div>
    <div class="w-container centeredcontent">
      <div class="datosalumno">
        <div class="w-row">
          <div class="w-col w-col-2"></div>
          <div class="w-col w-col-5">
            <div><strong>Nombre:</strong> <?php echo utf8_encode($row['nombres']." ".$row['apellidopat']." ".$row['apellidomat'])?>
            </div>
          </div>
          <div class="w-col w-col-3">
            <div><strong>Matrícula:</strong> <?php echo $row['Matricula']?>
            </div>
          </div>
          <div class="w-col w-col-2"></div>
        </div>
        <div class="w-row">
          <div class="w-col w-col-2"></div>
          <div class="w-col w-col-5">
            <div><strong>Consulta:&nbsp;</strong>Materias Asesoradas</div>
          </div>
          <div class="w-col w-col-3">
            <div><strong>Campus:&nbsp;</strong>Guadalajara</div>
          </div>
          <div class="w-col w-col-2"></div>
        </div>
      </div>
      <div class="w-row selectionwidget">
        <div class="w-col w-col-4"></div>
        <div class="w-col w-col-4 loginsection">
          <h3 class="introtext">Ya has realizado tu selección de materias cursables.&nbsp;</h3>
          <div class="introtext">Puedes consultarlas a continucación:</div>
          <div class="w-row">
          
          	<div class="w-row datossemetre">
                      <div class="w-col w-col-3">
                        <h5>Materia</h5>
                      </div>
                      <div class="w-col w-col-6"></div>
                      <div class="w-col w-col-3">
                        <h5>Unidades</h5>
                      </div>
            </div>
                    	<?php
                        $query = mysql_query('SELECT nombre, idmateria, unidades FROM materia NATURAL JOIN (
 SELECT idmateria FROM cursablesSeleccionadas WHERE matricula = '.$username.') AS T');
                        //Copiar los filas del query a la página
                        while ($row = mysql_fetch_assoc($query)){
                            echo '<div class="w-row listadomateriashistorico">';
                           print '<div class="w-col w-col-3"><div>'.$row['idmateria'].'</div></div>';
                            print utf8_encode('<div class="w-col w-col-6"><div>'.$row['nombre'].'</div></div>');
                            print '<div class="w-col w-col-3"><div>'.$row['unidades']."</div></div>";
							echo '</div>';
						}
					    ?>
          </div>
          
          <div class="introtext">Si tienes alguna duda o deseas hacer cambios puedes acudir con tu director de carrera.</div><a class="button submit-button espacioarriba" href="index.php">Salir</a>
        </div>
        <div class="w-col w-col-4"></div>
      </div>
    </div>
  </div>
  <div>
    <div class="w-container footer">
      <div><strong>PASC</strong>
        <br>Plataforma de Autoselección de Cursables
        <br>D.R.© Instituto Tecnológico y de Estudios Superiores de Monterrey, México. 2014.</div>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/webflow.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>