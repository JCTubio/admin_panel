<?php session_start();
if(!isset($_SESSION['username'])){
  header('Location: admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Project Administration Panel</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <link href="css/bukowski.css" id="hover-box" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<?php
    include 'php/header.php';
    include 'php/left-sidebar.php';
?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Project administration panel</h4> </div>
            </div>
            <!-- MAIN BODY-->
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="col-sm-9 pull-right" style="margin-right: -2%;">
                          <button class="btn btn-primary filter-button" data-filter="all">All</button>
                          <button class="btn btn-default filter-button" data-filter="Educational">Educational Space</button>
                          <button class="btn btn-default filter-button" data-filter="Hospitality">Hospitality Interiors</button>
                          <button class="btn btn-default filter-button" data-filter="Hotel">Hotel Interiors</button>
                          <button class="btn btn-default filter-button" data-filter="Office">Office Interiors</button>
                          <button class="btn btn-default filter-button" data-filter="Residential">Residential Interiors</button>
                        </div>
                        <div class="sm-col-3">
                          <h3 class="box-title m-b-0">All Projects</h3>
                          <p class="text-muted m-b-30 font-13"> View all projects</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                              <div id="img-grid">
                                <ul class="grid cs-style-1 col-sm-12">
                                  <!--Arranca php para listar los proyectos-->
                              <?php  $proyectos = file_get_contents("projects/all-projects.json");
                              $proyectos = objectToArray(json_decode($proyectos));
                              foreach($proyectos as $proyecto){
                                ?>

                                	    <li class="col-sm-4 filter <?php echo strtok($proyecto['category'], ' '); ?>">
                                		      <figure>
                                			        <img class="project-gallery-ind" src="images/<?php echo $proyecto['img-background'];?>" alt="img01">
                                			        <figcaption style="background: <?php getBgColor($proyecto['category']) ?>">
                                				          <h3><?php echo $proyecto['title'] ?></h3>
                                				          <span><?php echo $proyecto['creator'] ?></span>
                                                  <form action="php/project-passer.php" method="get" >
                                                    <input type="hidden" name="projectName" value="<?php echo $proyecto['title']?>">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">View project details</button>
                                                  </form>
                                			        </figcaption>
                                      		</figure>
                                    	</li>

                                <?php
                              }
                              //foreach($Proyectos as $proyecto){
                                //var_dump($proyecto['title']);
                              //}
                              function getBgColor($var){
                                switch ($var) {
                                  case "Educational Space":
                                      echo 'rgb(70, 47, 27)';
                                      break;
                                  case "Hospitality Interiors":
                                      echo 'rgb(45, 50, 69)';
                                      break;
                                  case "Hotel Interiors":
                                      echo 'rgb(130, 108, 75)';
                                      break;
                                  case "Office Interiors":
                                      echo 'rgb(131, 127, 127)';
                                      break;
                                  case "Residential Interiors":
                                      echo 'rgb(189, 183, 158)';
                                      break;
                                  default:
                                      echo '#2c3f52';
                              }
                              }
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
                               <!--Aca termina el php-->
                             </ul>
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- TERMINA el MAIN BODY -->
            <?php include 'php/right-sidebar.php';?>
        </div>    <!-- /.col-lg-12 -->
        </div>
        <!-- /.container-fluid -->
        <?php include 'php/footer.php';?>
    </div>
    <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="../plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="../plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!-- Popup script-->
    <script type="text/javascript">
        $(document).ready(function () {
            $.toast({
                heading: 'Welcome to your control panel'
                , text: 'Use the menu on the left to add, modify or delete existing projects.'
                , position: 'top-right'
                , loaderBg: '#ff6849'
                , icon: 'info'
                , hideAfter: 3500
                , stack: 6
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

        $(".filter-button").click(function(){
            var value = $(this).attr('data-filter');

            if(value == "all")
            {
                //$('.filter').removeClass('hidden');
                $('.filter').show('1000');
            }
            else
            {
    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                $(".filter").not('.'+value).hide('3000');
                $('.filter').filter('.'+value).show('3000');

            }
        });

    });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
