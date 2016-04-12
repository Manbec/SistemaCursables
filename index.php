<?php $dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("pasc");?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Wed Oct 01 2014 03:07:23 GMT+0000 (UTC) -->
<html data-wf-site="5409c89a6774599c3d7eeb34" data-wf-page="5409c89a6774599c3d7eeb35">
<head>
  <meta charset="utf-8">
  <title>PASC</title>
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
      <div class="w-row">
        <div class="w-col w-col-4"></div>
        <div class="w-col w-col-4 loginsection">
          <h3>¡Bienvenid@!</h3>
          <div class="introtext">Para seleccionar tus materias cursables, por favor escribe a continuación tu matrícula (Sin A0, ejemplo: 1222456) y la contraseña que te fue asignada para el acceso.</div>
          <div class="w-form login"></div>
            <form id="form-signin" name="signin" data-name="signinForm" method="post">
              <input class="w-input field" id="matricula" type="text" placeholder="Matrícula" name="matricula" data-name="matricula" required="required" autofocus="autofocus">
              <input class="w-input field" id="password" type="password" placeholder="Contraseña" name="password" data-name="Contraseña" required="required">
              <input class="w-button submit-button" type="submit" value="Ingresar" data-wait="Cargando..." wait="Cargando...">
            </form>
            
<?php
$username = '';
$submittedacc = '';
if(isset($_POST['matricula'])){ $username = $_POST['matricula']; }
if(isset($_POST['password'])){ $submittedacc = $_POST['password']; }
if(isset($_POST['matricula']) && is_numeric($_POST['matricula'])){

$username = trim($username);
$splituser = str_split($username);
$userlen = count($splituser);
$deliberate = "cursa".$splituser[$userlen-3].$splituser[$userlen-2].$splituser[$userlen-1]."2014";

//echo $deliberate." ".$submittedacc;

	$correctaccess = false;
	$query =  mysql_query('SELECT Matricula from alumno where matricula = '.$username);
	if($row = mysql_fetch_assoc($query)) {
				if($row['Matricula'] == $username){
					if($deliberate==$submittedacc){
						$correctaccess = true;
					}
				}
    }
	if($correctaccess){
		session_start();
		$_SESSION['cuenta']= $username;
		die("<script>location.href = 'http://localhost/pasc2/seleccion.php'</script>");
	}
	//Implementación temporal del log-in del director de carrera
	else if($username == null || $submittedacc ==null){
                  //Supongo que esto lo dejaron en blanco a propósito
    }
	else{
		echo '<div class="w-form-fail" style="display: block;"><p>Información de inicio de sesión incorrecta</p></div>';
	}
	}
else if (!empty($username) and $username[0] == "L"){
	$query = mysql_query("Select nomina from director where nomina ='".$username."'");
	$row = mysql_fetch_assoc($query);
	if(strlen($row['nomina'])>0){
	 session_start();
	 $_SESSION['cuenta']= $username;
	 die("<script>location.href = 'http://localhost/pasc2/director.php'</script>");
	}else{
		echo '<div class="w-form-fail" style="display: block;"><p>Información de inicio de sesión incorrecta</p></div>';
	}
}
else if($username == "" && $submittedacc == ""){
				  //Supongo que esto lo dejaron en blanco a propósito
	}
else{
		echo '<div class="w-form-fail" style="display: block;"><p>Favor de ingresar un valor nunmérico en el espacio de la matrícula</p></div>';
	}
?>
          
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