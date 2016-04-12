<?php $dbh=mysql_connect ("localhost", "root", "") or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ("pasc");

session_start();
//$username = $_SESSION['cuenta'];
$username = 1228536;
				$carrera = array();
				$query = mysql_query('SELECT acronimo,plan from alumno where matricula = '.$username);
            	if($row = mysql_fetch_assoc($query)) { 
				  $carrera = $row;
             	}
				$completadoreg = false;
            	$query = mysql_query('SELECT estadoReg from alumno where matricula = '.$username);
            	if($row = mysql_fetch_assoc($query)) { 
				  if($row['estadoReg'] == 't'){ //Si la columna del estado del registro contiene 't'
						 $completadoreg = true;
				  }
             	}

                  if($completadoreg) {
                  		die("<script>location.href = 'http://localhost/pasc2/cursablesalumno.php'</script>");
                  }

$query = mysql_query('SELECT Matricula, nombres, apellidopat, apellidomat from alumno where matricula = '.$username);
if($row = mysql_fetch_assoc($query)) {

}


$materiasSeleccionadas = array();
?>
<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com-->
<!-- Last Published: Wed Oct 01 2014 03:07:23 GMT+0000 (UTC) -->
<html data-wf-site="5409c89a6774599c3d7eeb34" data-wf-page="5409d6bb6774599c3d7eec99">
<head>
  <meta charset="utf-8">
  <title>seleccion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="generator" content="Webflow">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/webflow.css">
  <link rel="stylesheet" type="text/css" href="css/pasc.webflow.css">
  <style type="text/css">


	.multipleSelectBoxControl span{	/* Labels above select boxes*/
		font-family:arial;
		font-size:11px;
		font-weight:bold;
	}
	.multipleSelectBoxControl div select{	/* Select box layout */
		font-family:arial;
		height:100%;
	}
	.multipleSelectBoxControl input{	/* Small butons */
		width:25px;	
	}
	
	.multipleSelectBoxControl div{
		float:left;
	}
		
	.multipleSelectBoxDiv
	</style>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Exo:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"]
      }
    });
	
	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, October 2005
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/
	
		
	var fromBoxArray = new Array();
	var toBoxArray = new Array();
	var selectBoxIndex = 0;
	var arrayOfItemsToSelect = new Array();
	
	
	function moveSingleElement()
	{
		var selectBoxIndex = this.parentNode.parentNode.id.replace(/[^\d]/g,'');
		var tmpFromBox;
		var tmpToBox;
		if(this.tagName.toLowerCase()=='select'){			
			tmpFromBox = this;
			if(tmpFromBox==fromBoxArray[selectBoxIndex])tmpToBox = toBoxArray[selectBoxIndex]; else tmpToBox = fromBoxArray[selectBoxIndex];
		}else{
		
			if(this.value.indexOf('>')>=0){
				tmpFromBox = fromBoxArray[selectBoxIndex];
				tmpToBox = toBoxArray[selectBoxIndex];			
			}else{
				tmpFromBox = toBoxArray[selectBoxIndex];
				tmpToBox = fromBoxArray[selectBoxIndex];	
			}
		}
		
		for(var no=0;no<tmpFromBox.options.length;no++){
			if(tmpFromBox.options[no].selected){
				tmpFromBox.options[no].selected = false;
				tmpToBox.options[tmpToBox.options.length] = new Option(tmpFromBox.options[no].text,tmpFromBox.options[no].value);
				
				for(var no2=no;no2<(tmpFromBox.options.length-1);no2++){
					tmpFromBox.options[no2].value = tmpFromBox.options[no2+1].value;
					tmpFromBox.options[no2].text = tmpFromBox.options[no2+1].text;
					tmpFromBox.options[no2].selected = tmpFromBox.options[no2+1].selected;
				}
				no = no -1;
				tmpFromBox.options.length = tmpFromBox.options.length-1;
											
			}			
		}
		
		
		var tmpTextArray = new Array();
		for(var no=0;no<tmpFromBox.options.length;no++){
			tmpTextArray.push(tmpFromBox.options[no].text + '___' + tmpFromBox.options[no].value);			
		}
		tmpTextArray.sort();
		var tmpTextArray2 = new Array();
		for(var no=0;no<tmpToBox.options.length;no++){
			tmpTextArray2.push(tmpToBox.options[no].text + '___' + tmpToBox.options[no].value);			
		}		
		tmpTextArray2.sort();
		
		for(var no=0;no<tmpTextArray.length;no++){
			var items = tmpTextArray[no].split('___');
			tmpFromBox.options[no] = new Option(items[0],items[1]);
			
		}		
		
		for(var no=0;no<tmpTextArray2.length;no++){
			var items = tmpTextArray2[no].split('___');
			tmpToBox.options[no] = new Option(items[0],items[1]);			
		}
	}
	
	function sortAllElement(boxRef)
	{
		var tmpTextArray2 = new Array();
		for(var no=0;no<boxRef.options.length;no++){
			tmpTextArray2.push(boxRef.options[no].text + '___' + boxRef.options[no].value);			
		}		
		tmpTextArray2.sort();		
		for(var no=0;no<tmpTextArray2.length;no++){
			var items = tmpTextArray2[no].split('___');
			boxRef.options[no] = new Option(items[0],items[1]);			
		}		
		
	}
	function moveAllElements()
	{
		var selectBoxIndex = this.parentNode.parentNode.id.replace(/[^\d]/g,'');
		var tmpFromBox;
		var tmpToBox;		
		if(this.value.indexOf('>')>=0){
			tmpFromBox = fromBoxArray[selectBoxIndex];
			tmpToBox = toBoxArray[selectBoxIndex];			
		}else{
			tmpFromBox = toBoxArray[selectBoxIndex];
			tmpToBox = fromBoxArray[selectBoxIndex];	
		}
		
		for(var no=0;no<tmpFromBox.options.length;no++){
			tmpToBox.options[tmpToBox.options.length] = new Option(tmpFromBox.options[no].text,tmpFromBox.options[no].value);			
		}	
		
		tmpFromBox.options.length=0;
		sortAllElement(tmpToBox);
		
	}
	
	
	/* This function highlights options in the "to-boxes". It is needed if the values should be remembered after submit. Call this function onsubmit for your form */

	
	function createMovableOptions(fromBox,toBox,totalWidth,totalHeight,labelLeft,labelRight)
	{		
		fromObj = document.getElementById(fromBox);
		toObj = document.getElementById(toBox);
		
		arrayOfItemsToSelect[arrayOfItemsToSelect.length] = toObj;

		
		fromObj.ondblclick = moveSingleElement;
		toObj.ondblclick = moveSingleElement;

		
		fromBoxArray.push(fromObj);
		toBoxArray.push(toObj);
		
		var parentEl = fromObj.parentNode;
		
		var parentDiv = document.createElement('DIV');
		parentDiv.className='multipleSelectBoxControl';
		parentDiv.id = 'selectBoxGroup' + selectBoxIndex;
		parentDiv.style.width = totalWidth + 'px';
		parentDiv.style.height = totalHeight/2 + 'px';
		parentEl.insertBefore(parentDiv,fromObj);
		
		
		var subDiv = document.createElement('DIV');
		subDiv.style.width = (Math.floor(totalWidth/2) - 15) + 'px';
		fromObj.style.width = (Math.floor(totalWidth/2) - 15) + 'px';

		var label = document.createElement('SPAN');
		label.innerHTML = labelLeft;
		subDiv.appendChild(label);
		
		subDiv.appendChild(fromObj);
		subDiv.className = 'multipleSelectBoxDiv';
		parentDiv.appendChild(subDiv);
		
		
		var buttonDiv = document.createElement('DIV');
		buttonDiv.style.verticalAlign = 'middle';
		buttonDiv.style.paddingTop = ((totalHeight - label.offsetHeight)*(0.20)) + 'px';
		buttonDiv.style.width = '30px';
		buttonDiv.style.textAlign = 'center';
		parentDiv.appendChild(buttonDiv);
		
		var buttonRight = document.createElement('INPUT');
		buttonRight.type='button';
		buttonRight.value = '>';
		buttonDiv.appendChild(buttonRight);	
		buttonRight.onclick = moveSingleElement;	
		
		var buttonLeft = document.createElement('INPUT');
		buttonLeft.style.marginTop='10px';
		buttonLeft.type='button';
		buttonLeft.value = '<';
		buttonLeft.onclick = moveSingleElement;
		buttonDiv.appendChild(buttonLeft);		
		
		var subDiv = document.createElement('DIV');
		subDiv.style.width = (Math.floor(totalWidth/2) - 15) + 'px';
		toObj.style.width = (Math.floor(totalWidth/2) - 15) + 'px';

		var label = document.createElement('SPAN');
		label.innerHTML = labelRight;
		subDiv.appendChild(label);
				
		subDiv.appendChild(toObj);
		parentDiv.appendChild(subDiv);		
		
		toObj.style.height = (totalHeight - label.offsetHeight)/2 + 'px';
		fromObj.style.height = (totalHeight - label.offsetHeight)/2 + 'px';

			
		selectBoxIndex++;
		

	}
	
		function selectAll(selectBox,selectAll) { 
			
			// have we been passed an ID 
			if (typeof selectBox == "string") { 
				selectBox = document.getElementById(selectBox);
			} 
			// is the select box a multiple select box? 
			if (selectBox.type == "select-multiple") { 
				for (var i = 0; i < selectBox.options.length; i++) { 
					 selectBox.options[i].selected = selectAll; 
				} 
			}
		}
	
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
            <div><strong>Nombre: </strong><?php echo utf8_encode($row['nombres']." ".$row['apellidopat']." ".$row['apellidomat'])?>
            </div>
          </div>
          <div class="w-col w-col-3">
            <div><strong>Matrícula: </strong><?php echo $row['Matricula']?>
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
          <div class="introtext">Haz click sobre las materias que deseas elegir como cursables y envíalas al recuadro de la derecha. Cuando termines, pulsa "enviar" para confirmar tu selección.</div>
          <div class="w-row">
            <div class="w-col w-col-6">
            <!--Previo a la selección -->
             <?php
        //echo "Tabla Paciente \n";
		//crear la matriz con las materias del alumno
		$materiasalumno = array();
		$query = mysql_query('SELECT idMateria,estado from cursa where (Matricula = '.$username.")");
		$materiasalumnoSize=0;
        while ($row =  mysql_fetch_assoc($query)) {
				array_push($materiasalumno, $row);
				$materiasalumnoSize++;
        }
       	//verificar arreglo de materias del alumno
		/*for ($i = 0; $i < $materiasalumnoSize; $i++){
			echo "<li>".$materiasalumno[$i]['idMateria']."|".$materiasalumno[$i]['estado']."</li>";
		}*/
		
		//agarrar materias no aprobadas para ver si el alumno es legible
		$materiasPorCursar = array();
		$PorCursarSIZE = 0;
		for ($i = 0; $i < $materiasalumnoSize; $i++){
			if($materiasalumno[$i]['estado']!="A" && $materiasalumno[$i]['estado']!="CU"){
				array_push($materiasPorCursar, $materiasalumno[$i]);
				$PorCursarSIZE++;
			}
		}
		//verificar arreglo de materias por cursar
		/*for ($i = 0; $i < $PorCursarSIZE; $i++){
			echo "<li>".$materiasPorCursar[$i]['idMateria']."|".$materiasPorCursar[$i]['estado']."</li>";
		}*/		
		//generar matriz de requisitos
		$query = mysql_query("SELECT idMateria,requisito from requisitos where acronimo = '".$carrera['acronimo']."' AND plan = '".$carrera['plan']."'");
		$requisitos=array();
		$requisitosSize=0;
        while ($row = mysql_fetch_assoc($query)) {
				array_push($requisitos, $row);
				$requisitosSize++;
        }
		/*for ($i = 0; $i < $requisitosSize; $i++){
			echo "<li>".$requisitos[$i]['idMateria']." - ".$requisitos[$i]['requisito']."</li>";
		}*/
		//$materiasalumno, $materiasPorCursar y $requisitos
		function matchEstado($mat,$est, $materiasalumno){
			for($i=0; $i<count($materiasalumno);$i++){
				if($materiasalumno[$i]['idMateria'] == $mat){
					if($materiasalumno[$i]['estado'] == $est){
						return true;
					}
					else{
						return false;
					}
				}
			}
			return false;
		}
		
		function validarmateria($reqs,$reqSize,$matID, $matsalumn, $matalumnSize){
			$cursable = true;
			for ($i = 0; ($i < $reqSize) && $cursable; $i++){
				if($reqs[$i]['idMateria']==$matID && strpos($reqs[$i]['requisito'],'TOEFL') == false){
					 $ands = explode("&",$reqs[$i]['requisito']); //Division por requisitos "y" entre grupos de materias
					 for($k=0; $k<count($ands);$k++){
						 $ors =  explode(",", $ands[$k]);
						 $cursable = false;
						 for($j=0; $j<count($ors);$j++){
							 $eval= explode("|", $ors[$j]);
							 if(matchEstado($eval[0],$eval[1],$matsalumn)){
								 $cursable = true;
								 break;
							 }
						 }
						 if(!$cursable){
							 break;
						 }
					 }
					return $cursable;
				}
			}
			return $cursable;
		}
		
		$cursables = array();
		$cursablesSize=0;
		for ($i = 0; $i < $PorCursarSIZE; $i++){
			$query = mysql_query("Select requisito from requisitos where idMateria = '".$materiasPorCursar[$i]['idMateria']."'");
			$row = mysql_fetch_assoc($query);
			if (strlen($row['requisito']) == 0){
				array_push($cursables,$materiasPorCursar[$i]);
				$cursablesSize++;
				continue;
			}
			if(validarmateria($requisitos,$requisitosSize, $materiasPorCursar[$i]['idMateria'], $materiasalumno, $materiasalumnoSize)){
				array_push($cursables,$materiasPorCursar[$i]);
				$cursablesSize++;
			}
		}
		//print_r($cursables);
		//imprimircursables generadas
		/*for ($i = 0; $i < $cursablesSize; $i++){
			echo "<li>".$cursables[$i]['idMateria']."</li>";
		}*/
		
		//imprimir cuantas materias no ha cursado y de ahi cuantas son cursable
		//echo "Materias: ".$PorCursarSIZE." Cursables: ".$cursablesSize;
		
		for ($i = 0; $i < $cursablesSize; $i++){
			$query = mysql_query("INSERT INTO CURSABLESTEMP VALUES ('".$username."','".$cursables[$i]['idMateria']."')");
			//mysql_fetch_assoc($query);
		}
		
		$query = mysql_query("select distinct idmateria, nombre from cursablestemp natural join materia where cursablestemp.idmat = materia.idMateria");
		$cursables = array();
		$cursablesSize =0;
		while ($row = mysql_fetch_assoc($query)) {
				array_push($cursables, $row);
				$cursablesSize++;
        }
		//imprimircursables generadas
		//print_r($cursables);
		/*for ($i = 0; $i < $cursablesSize; $i++){
			echo "<li>".$cursables[$i]['idmateria']."|".$cursables[$i]['nombre']."</li>";
		}*/
		
		$query = mysql_query("delete from cursablestemp");
        //mysql_fetch_assoc($query);
		$numSeleccionadas=0;
		function alerteishon(){
	echo '<SCRIPT>
	alert('.$numSeleccionadas.');
	</SCRIPT>';
}
		
      ?> <!--Fin de previo a la selección -->
            </div>
            <div class="w-col w-col-6"></div>
          </div>
          <div class="w-form login">
            <div style="vertical-align: middle;">
             <!--<form method="post" action="#" onsubmit="asignarCursables()"> -->
                <form action="seleccion.php" class="form-signin" role="form" method="post" style="margin-left: -35%;">
                <select multiple name="fromBox" id="fromBox">
                        <?php for ($i = 0; $i < $cursablesSize; $i++){
                            echo utf8_encode('<option value="'.$cursables[$i]['idmateria'].'">'.$cursables[$i]['idmateria'].", ".$cursables[$i]['nombre']."</option>");
                        }
                        echo "Materias: ".$PorCursarSIZE." Cursables: ".$cursablesSize;
                        
                      ?>
                </select>
                <select name="seleccionadas[]" multiple="multiple" id="toBox">
                </select>
             <div  style="text-align: center; margin-top: 5px; margin-bottom: 5px;">
                <button onclick="selectAll('toBox',selectAll)">Confirmar Selección</button> <!-- type="submit"-->
             </div>
                </form>
                <?php 
    $materiasSeleccionadas = array();
    if(isset($_POST['seleccionadas'])){
        
        foreach($_POST['seleccionadas'] as $value)
        {
            $query =  mysql_query("INSERT INTO CURSABLESSELECCIONADAS VALUES (".$username.",'".$value."')");
        }
        $query =  mysql_query("UPDATE ALUMNO SET ESTADOREG = 'true' WHERE MATRICULA = '".$username."'");
   		 die("<script>location.href = 'http://localhost/pasc2/success.php'</script>");
    }
    ?>
          </div>
          <div class="introtext">Puedes mover los elementos haciendo click en los botones o dando doble click sobre alguna de las opciones</div>
          <script type="text/javascript">
createMovableOptions("fromBox","toBox",500,300,'Materias disponibles','Materias seleccionadas');
</script>
        </div>
        <div class="w-col w-col-4"></div>
      </div>
    </div>
  </div>
  <div class="logout"><a class="button logout" href="allsubjects.html">Salir</a>
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