<?php
session_start();
unset($_SESSION['error']);
// Genero una copia de lo recibido del POST para agregarle las imagenes
$proyectoAGuardar = $_POST;
$titleNuevo = $_POST['title'];

$allProjects = file_get_contents("../projects/all-projects.json");

//chequeo que haya proyectos
if(!isset($allProjects)){
  $allProjects = [];
}else{
  $allProjects = objectToArray(json_decode($allProjects));
  for($i = 0; $i<sizeof($allProjects);$i++){
    if($allProjects[$i]['title'] == $titleNuevo){
      $_SESSION['error'] = "A Project with that name already exists. Please choose a new project name.";
      header("Location: ../index.php");
    }
  }
}
//Crear subcarpeta para guardar imagenes del proyecto
mkdir('../images/'.$_POST["title"], 0777, true);

//Background img
$target_dir = "../images/".$_POST["title"]."/";
$target_file = $target_dir . basename($_FILES["img-background"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Checkea si la imagen es fake
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["img-background"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//guardar imagen
move_uploaded_file($_FILES["img-background"]["tmp_name"], $target_file);
$proyectoAGuardar["img-background"] = $_POST["title"]."/".$_FILES["img-background"]["name"];

//img circular
$target_dir = "../images/".$_POST["title"]."/";
$target_file = $target_dir . basename($_FILES["img-circular"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Checkea si la imagen es fake
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["img-circular"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//guardar imagen
move_uploaded_file($_FILES["img-circular"]["tmp_name"], $target_file);
$proyectoAGuardar["img-circular"] = $_POST["title"]."/".$_FILES["img-circular"]["name"];

//img rectangular
$target_dir = "../images/".$_POST["title"]."/";
$target_file = $target_dir . basename($_FILES["img-rectangular"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Checkea si la imagen es fake
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["img-rectangular"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
//guardar imagen
move_uploaded_file($_FILES["img-rectangular"]["tmp_name"], $target_file);
$proyectoAGuardar["img-rectangular"] = $_POST["title"]."/".$_FILES["img-rectangular"]["name"];

//Imagenes del carrousel
for($i = 0; $i < sizeof($_FILES["img-carrousel"]["name"]);$i++){
  $target_dir = "../images/".$_POST["title"]."/";
  $target_file = $target_dir . basename($_FILES["img-carrousel"]["name"][$i]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Checkea si la imagen es fake
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["img-carrousel"]["tmp_name"][$i]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  //guardar imagenes
  move_uploaded_file($_FILES["img-carrousel"]["tmp_name"][$i], $target_file);
  $proyectoAGuardar["img-carrousel"][$i] = $_POST["title"]."/".$_FILES["img-carrousel"]["name"][$i];
}

//Obtener el array con todos los proyectos
$allProjects = file_get_contents("../projects/all-projects.json");

//Hacer backup de los proyectos
$backup = fopen("../projects/backup-projects.json", "w") or die ("Error: Unable to save backup");
fwrite($backup, $allProjects);
fclose($backup);

//chequeo que haya proyectos
if(!isset($allProjects)){
  $allProjects = [];
}else{
  $allProjects = objectToArray(json_decode($allProjects));
}

//Pasar los proyectos a un array
array_push($allProjects, $proyectoAGuardar);

//GUARDADO EN JSON
$fp = fopen('../projects/all-projects.json', 'w') or die ("Error: Unable to save the project");
fwrite($fp, json_encode($allProjects));
fclose($fp);

header('Location: ../list-projects.php');

//funcion para convertir objetos StdClass a Arrays
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
?>
