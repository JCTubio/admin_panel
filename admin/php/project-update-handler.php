<?php
$proyectoAGuardar = $_POST;
$titleViejo = $_POST['viejoTitle'];
$allProjects = file_get_contents("../projects/all-projects.json");

//Pasar los proyectos a un array
$allProjects = objectToArray(json_decode($allProjects));

//recupera las imagenes viejas

foreach($allProjects as $project){
    if($project['title'] == $titleViejo){
    $imgBgVieja = $project['img-background'];
    $imgCircVieja = $project['img-circular'];
    $imgRectVieja = $project['img-rectangular'];
    for($k = 0; $k<sizeof($project['img-carrousel']);$k++){
      $imgCarrouselViejas[$k] = $project['img-carrousel'][$k];
    }
  }
}

//si cambia el title crea un nuevo directorio
if($titleViejo != $proyectoAGuardar['title']){
  mkdir('../images/'.$proyectoAGuardar["title"], 0777, true);
}

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
if($_FILES['img-background']['name']){
  move_uploaded_file($_FILES["img-background"]["tmp_name"], $target_file);
  $proyectoAGuardar["img-background"] = $_POST["title"]."/".$_FILES["img-background"]["name"];
}else{
  rename("../images/".$imgBgVieja, "../images/".$imgBgVieja);
  $proyectoAGuardar["img-background"] = $imgBgVieja;
}
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
if($_FILES['img-circular']['name']){
  move_uploaded_file($_FILES["img-circular"]["tmp_name"], $target_file);
  $proyectoAGuardar["img-circular"] = $_POST["title"]."/".$_FILES["img-circular"]["name"];
}else{
  rename("../images/".$imgCircVieja, "../images/".$imgCircVieja);
  $proyectoAGuardar["img-circular"] = $imgCircVieja;
}
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
if($_FILES['img-rectangular']['name']){
  move_uploaded_file($_FILES["img-rectangular"]["tmp_name"], $target_file);
  $proyectoAGuardar["img-rectangular"] = $_POST["title"]."/".$_FILES["img-rectangular"]["name"];
}else{
  rename("../images/".$imgRectVieja, "../images/".$imgRectVieja);
  $proyectoAGuardar["img-rectangular"] = $imgRectVieja;
}

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

//Filtro el array de proyectos por si quedaron lugares vacios
$filteredArray = array_filter($allProjects);

for($o = 0; $o < sizeof($filteredArray);$o++){
  if($filteredArray[$o]['title'] == $titleViejo){
    $filteredArray[$o] = $proyectoAGuardar;
    break;
  }
}

//GUARDADO EN JSON
$fp = fopen('../projects/all-projects.json', 'w') or die ("Error: Unable to save the project");
fwrite($fp, json_encode($filteredArray));
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
