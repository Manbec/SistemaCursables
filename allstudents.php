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

$query = mysql_query("select carrera from director where nomina = '".$username."'");
			  		$row = mysql_fetch_assoc($query);
					$carreradir = $row['carrera'];

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
		if(strlen($row['idMateria'])>0){
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
<html data-wf-site="5409c89a6774599c3d7eeb34" data-wf-page="540a27d8b1e337411bfff507">
<head>
  <meta charset="utf-8">
  <title>allstudents</title>
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
          <div class="w-col w-col-2">
            <div><strong>Consulta de alumnos</strong>
            </div>
          </div>
          <div class="w-col w-col-4"><a class="button botonblack" href="#">Registrar nuevo plan de carrera</a>
          </div>
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
    <div class="w-container centeredcontent consulta">
      <div class="w-tabs" data-duration-in="300" data-duration-out="100">
        <div class="w-tab-menu">
          <a class="w-tab-link <?php 
					  if(!(isset($_POST['matricula'])||isset($_POST['clave']))){echo 'w--current';}?> w-inline-block" data-w-tab="Todos">
                      <?php $query = mysql_query("Select Count(matricula) as totalalumn from alumno WHERE acronimo = '".$carreradir."'");
					  		$row = mysql_fetch_assoc($query);?>
            <div>Todos los alumnos (<?php echo $row['totalalumn'];?>)</div>
          </a>
          <a class="w-tab-link w-inline-block" data-w-tab="Seleccionadas">
           <?php $query = mysql_query("Select Count(matricula) as totalalumn from alumno where estadoReg = 't' AND acronimo = '".$carreradir."'");
					  		$row = mysql_fetch_assoc($query);?>
            <div>Cursables Seleccionadas (<?php echo $row['totalalumn'];?>)</div>
          </a>
          <a class="w-tab-link w-inline-block" data-w-tab="Pendientes">
          <?php $query = mysql_query("Select Count(matricula) as totalalumn from alumno where estadoReg = 'f' AND acronimo = '".$carreradir."'");
					  		$row = mysql_fetch_assoc($query);?>
            <div>Pendientes (<?php echo $row['totalalumn'];?>)</div>
          </a>
          <a class="w-tab-link <?php 
					  if((isset($_POST['matricula'])||isset($_POST['clave']))){echo 'w--current';}?> w-inline-block" data-w-tab="Otra Consulta">
            <div>Realizar otra consulta</div>
          </a>
        </div>
        <div class="w-tab-content espacioarribaabajo">
          <div class="w-tab-pane" data-w-tab="Todos">
            <div class="w-row listadomateriashistorico">
            		  <div class="w-col w-col-3">
                        <h5>Alumno</h5>
                      </div>
                      <div class="w-col w-col-6">
                      </div>
                      <div class="w-col w-col-3">
                        <h5>Materias</h5>
                      </div>
            </div>
            <?php

				$query = mysql_query("select matricula, nombres, apellidopat, apellidomat, nombre, idmateria, unidades from (SELECT * from alumno where acronimo = '".$carreradir."') AS A natural join (SELECT nombre, idmateria, unidades FROM materia NATURAL JOIN (
 SELECT idmateria FROM cursablesSeleccionadas) AS T) AS T");
                        //Copiar los filas del query a la página
						$alumnos = array();
						
                        while ($row = mysql_fetch_assoc($query)){
							array_push($alumnos,$row);
						}
						for($i=0; $i<count($alumnos);$i++){
							echo '<div class="w-row listadomateriashistorico espacioabajo">';
							$curralumn = $alumnos[$i]['matricula'];
							//Imprimre nombre
							print utf8_encode('<div class="w-col w-col-3"><div>'.$alumnos[$i]['nombres'].''.$alumnos[$i]['apellidopat'].''.$alumnos[$i]['apellidomat'].'<br>'.$alumnos[$i]['matricula'].'</div></div>');
							//Crea la segunda columna dentro de la cual habrá una fila para crear las materias
							echo '<div class="w-col w-col-9"><div class="w-row listadomateriashistorico">';
							
                           print '<div class="w-col w-col-2"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['idmateria'].'</div></div></div>';
                            print utf8_encode('<div class="w-col w-col-9"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['nombre'].'</div></div></div>');
							print '<div class="w-col w-col-1"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['unidades'].'</div></div></div>';
							echo '</div>';
							
							while($i<count($alumnos) && $curralumn = $alumnos[$i]['matricula']){
								
							echo '<div class="w-row listadomateriashistorico">';
                           print '<div class="w-col w-col-2"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['idmateria'].'</div></div></div>';
                            print utf8_encode('<div class="w-col w-col-9"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['nombre'].'</div></div></div>');
							print '<div class="w-col w-col-1"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['unidades'].'</div></div></div>';						
							echo '</div>';
							$i++;
							}
							echo '</div>';echo '</div>';
						}

			?>
          </div>
          <div class="w-tab-pane" data-w-tab="Seleccionadas">
          		 <div class="w-row listadomateriashistorico">
            		  <div class="w-col w-col-3">
                        <h5>Alumno</h5>
                      </div>
                      <div class="w-col w-col-6">
                      </div>
                      <div class="w-col w-col-3">
                        <h5>Materias</h5>
                      </div>
            </div>
            <?php
				$query = mysql_query("select matricula, nombres, apellidopat, apellidomat, nombre, idmateria, unidades from (select * from alumno where estadoReg = 't' AND acronimo = '".$carreradir."') AS A natural join (SELECT nombre, idmateria, unidades FROM materia NATURAL JOIN (
 SELECT idmateria FROM cursablesSeleccionadas) AS T) AS T ");
                        //Copiar los filas del query a la página
						$alumnos = array();
						
                        while ($row = mysql_fetch_assoc($query)){
							array_push($alumnos,$row);
						}
						for($i=0; $i<count($alumnos);$i++){
							echo '<div class="w-row listadomateriashistorico espacioabajo">';
							$curralumn = $alumnos[$i]['matricula'];
							//Imprimre nombre
							print utf8_encode('<div class="w-col w-col-3"><div>'.$alumnos[$i]['nombres'].''.$alumnos[$i]['apellidopat'].''.$alumnos[$i]['apellidomat'].'<br>'.$alumnos[$i]['matricula'].'</div></div>');
							//Crea la segunda columna dentro de la cual habrá una fila para crear las materias
							echo '<div class="w-col w-col-9"><div class="w-row listadomateriashistorico">';
							
                           print '<div class="w-col w-col-2"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['idmateria'].'</div></div></div>';
                            print utf8_encode('<div class="w-col w-col-9"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['nombre'].'</div></div></div>');
							print '<div class="w-col w-col-1"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['unidades'].'</div></div></div>';
							echo '</div>';
							
							while($i<count($alumnos) && $curralumn = $alumnos[$i]['matricula']){
								
							echo '<div class="w-row listadomateriashistorico">';
                           print '<div class="w-col w-col-2"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['idmateria'].'</div></div></div>';
                            print utf8_encode('<div class="w-col w-col-9"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['nombre'].'</div></div></div>');
							print '<div class="w-col w-col-1"><div class="listadomateriashistorico"><div>'.$alumnos[$i]['unidades'].'</div></div></div>';						
							echo '</div>';
							$i++;
							}
							echo '</div>';echo '</div>';
						}

			?>
          </div>
          <div class="w-tab-pane" data-w-tab="Pendientes">
             <div class="w-row listadomateriashistorico">
            		  <div class="w-col w-col-3">
                        <h5>Alumno</h5>
                      </div>
                      <div class="w-col w-col-6">
                      </div>
                      <div class="w-col w-col-3">
                        <h5>Materias</h5>
                      </div>
            </div>
            <?php

				$query = mysql_query("select matricula, nombres, apellidopat, apellidomat from alumno where estadoreg='f' AND acronimo = '".$carreradir."'");
                        //Copiar los filas del query a la página
						$alumnos = array();
						
                        while ($row = mysql_fetch_assoc($query)){
							array_push($alumnos,$row);
						}
						for($i=0; $i<count($alumnos);$i++){
							echo '<div class="w-row listadomateriashistorico espacioabajo">';
							$curralumn = $alumnos[$i]['matricula'];
							//Imprimre nombre
							print utf8_encode('<div class="w-col w-col-3"><div>'.$alumnos[$i]['nombres'].' '.$alumnos[$i]['apellidopat'].' '.$alumnos[$i]['apellidomat'].'<br>'.$alumnos[$i]['matricula'].'</div></div>');
							//Crea la segunda columna dentro de la cual habrá una fila para crear las materias
							echo '<div class="w-col w-col-9">N/A</div>';
							echo '</div>';
						}

			?>
          </div>
          <div class="w-tab-pane w--tab-active" data-w-tab="Otra Consulta">
            <div class="w-row">
              <div class="w-col w-col-6">
                <div class="w-form">
                  <form class="studentblock" id="email-form" name="email-form" data-name="Email Form" method="post" action="allstudents.php">
                    <h3 class="bienvenida">Alumnos</h3>
                    <label for="Matricula">Consulta de alumnos por matrícula</label>
                    <div class="w-row">
                      <div class="w-col w-col-2"></div>
                      <div class="w-col w-col-6">
                        <input class="w-input" id="matricula" type="text" placeholder="Ej. 1224622 o 1111821" name="matricula" data-name="matricula">
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
                  <div class="w-form-done">
                    <p>Thank you! Your submission has been received!</p>
                  </div>
                  <div class="w-form-fail">
                    <p>Oops! Something went wrong while submitting the form :(</p>
                  </div>
                </div><a class="button submit-button espacioabajo" href="allstudents.php">Ver todos los alumnos</a>
              </div>
              <div class="w-col w-col-6">
                <h3 class="bienvenida">Materias</h3>
                <div class="w-form">
                  <form class="studentblock" id="email-form" name="email-form" method="post" data-name="Email Form" action="allstudents.php">
                    <label for="Matricula">Consulta de materia por clave de materia</label>
                    <div class="w-row">
                      <div class="w-col w-col-2"></div>
                      <div class="w-col w-col-6">
                        <input class="w-input" id="clave" type="text" placeholder="Ej. IQ1001" name="clave" data-name="clave">
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
                  <div class="w-form-done">
                    <p>Thank you! Your submission has been received!</p>
                  </div>
                  <div class="w-form-fail">
                    <p>Oops! Something went wrong while submitting the form :(</p>
                  </div>
                </div><a class="button submit-button espacioabajo" href="allsubjects.php">Ver todas las materias</a>
              </div>
            </div>
          </div>
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