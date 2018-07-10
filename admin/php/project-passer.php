<?php
function objectToArray($d) {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }
        else {
            // Return array
            return $d;
        }
}

//Este script busca el proyecto con el nombre que le llega por GET y lo guarda en la variable $_SESSION
//Es un workaround para no usar ajax y jscript
session_start();
$pTitle = $_GET['projectName'];
$proyectos = file_get_contents("../projects/all-projects.json");
$proyectos = objectToArray(json_decode($proyectos));
foreach($proyectos as $proyecto){
  if($proyecto['title'] == $pTitle){
    $_SESSION['project'] = $proyecto;
    header('Location: ../project-details-view.php');
  }
}
//header('Location: ../list-projects.php');
 ?>
