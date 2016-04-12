<?php $dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("pasc");

session_start();
if(isset($_SESSION['cuenta'])){
    $username = $_SESSION['cuenta'];
} else {
	die("<script>location.href = 'http://localhost/pasc2/index.php'</script>");
}
$query = mysql_query("Select * from director where nomina = '".$username."'");
$rowdire = mysql_fetch_assoc($query);

if(isset($_POST['matricula'])){
	$query = mysql_query("Select matricula from alumno where matricula = ".$_POST['matricula']);
	if(!is_bool($query)){
		$row = mysql_fetch_assoc($query);
		if(strlen($row['matricula'])>0){
		$_SESSION['alumnoconsulta']  = $_POST['matricula'];
		die("<script>location.href = 'http://localhost/pasc2/consultaalumno.php'</script>");
		}
	}else{
		if(isset($_SESSION['alumnoconsulta'])){
		$_SESSION['alumnoconsulta'] = $_SESSION['alumnoconsulta'];
		}
	}
	
}
if(isset($_POST['clave'])){
	$query = mysql_query("Select idMateria from materia where idMateria = '".$_POST['clave']."'");
	if(!is_bool($query)){
		$row = mysql_fetch_assoc($query);
		if(strlen($row['idMatria'])>0){
		$_SESSION['materiaconsulta']  = $_POST['clave'];
		echo $row['matricula'];
		die("<script>location.href = 'http://localhost/pasc2/materia.php'</script>");
		}
	}
}
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Wed Oct 01 2014 03:07:23 GMT+0000 (UTC) -->
<html data-wf-site="5409c89a6774599c3d7eeb34" data-wf-page="5409fe2b50c3bd3f1b90afb4">
<head>
  <meta charset="utf-8">
  <title>Director</title>
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
      <div class="datosalumno">
        <div class="w-row">
          <div class="w-col w-col-4"><a class="button botonblack" href="#">Registrar Nuevo plan de carrera</a>
          </div>
          <div class="w-col w-col-2"></div>
          <div class="w-col w-col-1"></div>
          <div class="w-col w-col-3">
            <div><strong>Nombre:</strong> <?php echo $rowdire['nombre']?>
            </div>
          </div>
          <div class="w-col w-col-2">
            <div><strong>Carrera:</strong> <?php echo $rowdire['carrera']?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <div class="w-container centeredcontent">
      <div class="w-row">
        <div class="w-col w-col-3"></div>
        <div class="w-col w-col-6 loginsection">
          <h3 class="bienvenida">Bienvenido Director de Carrera</h3>
          <div class="introtext">A conitnuación puede consultar las materias cursables de su carrera y el estado de la selección de cursables de sus alumnos.</div>
        </div>
        <div class="w-col w-col-3"></div>
      </div>
      <div class="w-row espacioarribaabajo">
        <div class="w-col w-col-6">
          <div class="w-form">
            <form class="studentblock" id="email-form" name="alumno" data-name="Email Form" method="post" action="director.php">
              <h3 class="bienvenida">Alumnos</h3>
              <label for="Matricula">Consulta de alumnos por matrícula</label>
              <div class="w-row">
                <div class="w-col w-col-2"></div>
                <div class="w-col w-col-6">
                  <input class="w-input" id="Matricula" type="text" placeholder="Ej. 1224622 o 1111821" name="matricula" data-name="Matricula">
                </div>
                <div class="w-col w-col-2">
                  <input class="w-button submit-button" type="submit" value="Buscar" data-wait="Buscando..." wait="Buscando...">
                </div>
                <div class="w-col w-col-2"></div>
              </div>
            </form>
            <?php	
			if(isset($_POST['matricula'])){
						$query = mysql_query("Select matricula from alumno where matricula = ".$_POST['matricula']);
						if(is_bool($query)){
							echo '<div class="w-form-fail" style="display: block;"><p>Favor de ingresar un valor nunmérico (matrícula sin "A0") en el espacio de la matrícula</p></div>';
						}else {
							$row = mysql_fetch_assoc($query);
							if(strlen($row['matricula'])==0){
								echo '<div class="w-form-fail" style="display: block;"><p>No existe un alumno con la matrícula '.$_POST['matricula'].'</p></div>';
							}
						}
						
				}
			?>
          </div><a class="button submit-button espacioabajo" href="allstudents.php">Ver todos los alumnos</a>
        </div>
        <div class="w-col w-col-6">
          <h3 class="bienvenida">Materias</h3>
          <div class="w-form">
            <form class="studentblock" id="email-form" name="email-form" data-name="Email Form" method="post" action="director.php">
              <label for="Matricula">Consulta de materia por clave de materia</label>
              <div class="w-row">
                <div class="w-col w-col-2"></div>
                <div class="w-col w-col-6">
                  <input class="w-input" id="Clave" type="text" placeholder="Ej. IQ1001" name="clave" data-name="Clave">
                </div>
                <div class="w-col w-col-2">
                  <input class="w-button submit-button" type="submit" value="Buscar" data-wait="Buscando..." wait="Buscando...">
                </div>
                <div class="w-col w-col-2"></div>
              </div>
            </form>
            <?php
            if(isset($_POST['clave'])){
						$query = mysql_query("Select idmateria from materia where idmateria = '".$_POST['clave']."'");
						if(is_bool($query)){
							echo '<div class="w-form-fail" style="display: block;"><p>Favor de ingresar un valor nunmérico (matrícula sin "A0") en el espacio de la matrícula</p></div>';
						}else {
							$row = mysql_fetch_assoc($query);
							if(strlen($row['idmateria'])==0){
								echo '<div class="w-form-fail" style="display: block;"><p>No existe una metateira con la clave '.$_POST['clave'].'</p></div>';
							}
						}
					}
			?>

          </div><a class="button submit-button espacioabajo" href="allsubjects.php">Ver todas las materias</a>
        </div>
      </div>
    </div>
  </div>
  <div class="logout"><a class="button logout" href="logout.php">Salir</a>
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