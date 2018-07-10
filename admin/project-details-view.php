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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-19175540-9', 'auto');
        ga('send', 'pageview');
    </script>
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
                      <div class="row">
                        <h3 class="box-title m-b-0 col-sm-6">Project modify view </h3>
                        <div class="col-sm-6 text-right">
                        <form action="php/project-deleter.php" method="get" >
                          <input type="hidden" name="projectName" value="<?php echo $_SESSION['project']['title']?>">
                          <button type="submit" class="btn btn-danger waves-effect waves-light m-r-10" onClick="botonDelete(event)">DELETE PROJECT</button>
                        </form>
                      </div>
                    </div>
                        <p class="text-muted m-b-30 font-13"> Update an existing project </p>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="php/project-update-handler.php" method="post" enctype="multipart/form-data">
                                    <!-- text inputs-->
                                  <div class="form-group row">
                                      <label for="title" class="col-2 col-form-label">Title</label>
                                      <div class="col-10">
                                          <input type="hidden" value="<?php echo $_SESSION['project']['title'] ?>" name="viejoTitle">
                                          <input class="form-control" type="text" value="<?php echo $_SESSION['project']['title'] ?>" placeholder="Project's title" name="title" id="title" required>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="location" class="col-2 col-form-label">Location</label>
                                      <div class="col-10">
                                          <input class="form-control" type="text" value="<?php echo $_SESSION['project']['location'] ?>" placeholder="Project's location" name="location" id="location" required>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-2 col-form-label">Category</label>
                                      <div class="input-group col-10">
                                          <select class="custom-select col-12" name="category" id="category" required>
                                              <option selected><?php echo $_SESSION['project']['category'] ?></option>
                                              <option value="Educational Space">Educational Space</option>
                                              <option value="Hospitality Interiors">Hospitality Interiors</option>
                                              <option value="Hotel Interiors">Hotel Interiors</option>
                                              <option value="Office Interiors">Office Interiors</option>
                                              <option value="Residential Interiors">Residential Interiors</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="area" class="col-2 col-form-label">Area</label>
                                    <div class="input-group col-10">
                                        <input type="text" class="form-control"  value="<?php echo $_SESSION['project']['area'] ?>" placeholder="Enter the size" name="area" id="area" required>
                                        <span class="input-group-addon">m2</span>
                                    </div>

                                  </div>
                                  <div class="form-group row">
                                      <label for="city" class="col-2 col-form-label">City</label>
                                      <div class="col-10">
                                          <input class="form-control" type="text" value="<?php echo $_SESSION['project']['city'] ?>" placeholder="City" name="city" id="city" required>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="country" class="col-2 col-form-label">Country</label>
                                      <div class="col-10">
                                          <input class="form-control" type="text" value="<?php echo $_SESSION['project']['country'] ?>" placeholder="Country" name="country" id="country" required>
                                      </div>
                                  </div>
                                  <!-- terminan text inputs-->

                                  <!-- file input -->
                                  <div class="form-group row">
                                    <div class="form-group col-sm-6">
                                      <label class="col-sm-12">Background Image</label>
                                      <div class="col-sm-12">
                                          <input id="img-background" name="img-background" type="file" class="file" data-show-preview="true">
                                      </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                      <label class="col-sm-12">Existing Background Image</label>
                                      <div class="col-sm-12">
                                          <a class="col-sm-12" target="_blank" href="<?php echo 'images/'.$_SESSION['project']['img-background'] ?>"><?php echo $_SESSION['project']['img-background'] ?></a>
                                      </div>
                                    </div>
                                  </div>
                                    <!--termina el file input -->
                                    <!-- Habria que ver si el creator es el mismo que esta uploadeando el project u otra persona -->
                                  <div class="form-group row">
                                      <label for="creator" class="col-2 col-form-label">Creator</label>
                                      <div class="col-10">
                                          <input class="form-control" type="text" value="<?php echo $_SESSION['project']['creator'] ?>" placeholder="Project's creator" name="creator" id="creator" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-12">Project description No1</label>
                                      <div class="col-md-12">
                                          <textarea id="textarea1" name="textarea1" class="form-control" rows="5" style="resize: none; margin-bottom: 10px;" required><?php echo $_SESSION['project']['textarea1'] ?></textarea>
                                      </div>
                                      <br>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-12">Project description No2</label>
                                      <div class="col-md-12">
                                          <textarea id="textarea2" name="textarea2" class="form-control" rows="5" style="resize: none; margin-bottom: 10px;" required><?php echo $_SESSION['project']['textarea2'] ?></textarea>
                                      </div>
                                      <br>
                                  </div>

                                  <div class="form-group">
                                      <label class="col-sm-12">Project status</label>
                                      <div class="col-sm-12">
                                          <select class="custom-select col-12" name="status" id="status" required>
                                              <option selected><?php echo $_SESSION['project']['status'] ?></option>
                                              <option value="In process.">In process.</option>
                                              <option value="Completed.">Completed.</option>
                                          </select>
                                      </div>
                                  </div>
                                  <!-- file input -->
                                  <div class="form-group row">
                                    <div class="form-group col-sm-6">
                                      <label class="col-sm-12">Circular Image</label>
                                      <div class="col-sm-12">
                                          <input id="img-circular" name="img-circular" type="file" class="file" data-show-preview="true">
                                      </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                      <label class="col-sm-12">Existing Circular Image</label>
                                      <div class="col-sm-12">
                                          <a class="col-sm-12" target="_blank" href="<?php echo 'images/'.$_SESSION['project']['img-circular'] ?>"><?php echo $_SESSION['project']['img-circular'] ?></a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="form-group col-sm-6">
                                      <label class="col-sm-12">Rectangular Image</label>
                                      <div class="col-sm-12">
                                          <input id="img-rectangular" name="img-rectangular" type="file" class="file" data-show-preview="true">
                                      </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                      <label class="col-sm-12">Existing Rectangular Image</label>
                                      <div class="col-sm-12">
                                          <a class="col-sm-12" target="_blank" href="<?php echo 'images/'.$_SESSION['project']['img-rectangular'] ?>"><?php echo $_SESSION['project']['img-rectangular'] ?></a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-12">Multiple image upload for carrousel</label>
                                      <div class="col-sm-12">
                                        <input id="img-carrousel" name="img-carrousel[]" type="file" multiple>
                                      </div>

                                  </div>

                                  <label class="col-sm-12">Existing images in the carrousel</label>
                                  <div class="col-sm-12">
                                    <?php for($j = 0; $j<sizeof($_SESSION['project']['img-carrousel']);$j++){ ?>
                                      <a class="col-sm-12" target="_blank" href="<?php echo 'images/'.$_SESSION['project']['img-carrousel'][$j] ?>"><?php echo $_SESSION['project']['img-carrousel'][$j] ?></a>
                                    <?php } ?>
                                  </div>
                                  <div class="form-group">
                                  </div>



                                    <!--termina el file input -->

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                    <a href="list-projects.php" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                                </form>
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
    <!--Delete button-->
    <script>
      function botonDelete(event) {
          if(confirm('Are you sure you want to delete the project?')){
          }else{
            event.preventDefault();
            location.reload();
        }
      }
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
  </body>

</html>
