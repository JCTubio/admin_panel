<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="<?php echo $_SESSION['avatar'] ?>" alt="user-img" class="img-circle"></div> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username'];?> <span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="php/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li> <a href="index.php" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="&#xe00b;"></i> <span class="hide-menu"> New Project <span class="fa arrow"></span></span></a></li>
            <li> <a href="list-projects.php" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="&#xe008;"></i> <span class="hide-menu text-danger"> View all projects <span class="fa arrow"></span></span></a></li>
            <li><a href="php/logout.php" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
          </ul>
    </div>
</div>
<!-- Left navbar-header end -->
