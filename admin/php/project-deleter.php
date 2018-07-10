<?php
session_start();
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

//primero que nada hago un $backup
$allProjects = file_get_contents("../projects/all-projects.json");

//Hacer backup de los proyectos
$backup = fopen("../projects/backup-projects.json", "w") or die ("Error: Unable to save backup");
fwrite($backup, $allProjects);
fclose($backup);

$pTitle = $_GET['projectName'];
$allProjects = objectToArray(json_decode($allProjects));

//Busca el proyecto y lo borra
for($i = 0; $i<sizeof($allProjects);$i++){
  if($allProjects[$i]['title'] == $pTitle){
    unset($allProjects[$i]);
    $fp = fopen('../projects/all-projects.json', 'w') or die ("Error: Unable to delete the project");
    fwrite($fp, json_encode($allProjects));
    fclose($fp);
    break;
  }
}
header('Location: ../list-projects.php');
  ?>
