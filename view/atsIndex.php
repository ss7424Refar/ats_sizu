<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../resource/img/3.ico"/>
  <title>Automation Test System | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
    <!--PACE-->
  <link rel="stylesheet" href="../plugins/pace/pace.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../dist/css/skins/skin-blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../dist/js/html5shiv.min.js"></script>
    <script src="../dist/js/respond.min.js"></script>
    <![endif]-->

  <!-- Google Font -->
    <link rel="stylesheet" href="../dist/css/googleFont.css">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<!--<body class="hold-transition skin-blue sidebar-mini">-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
    <?php include 'header.php';?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview active" >
          <a href="#"><i class="fa fa-wrench"></i> <span>Add Task</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="addTaskJumpStart.php"><i class="fa fa-circle-o text-yellow"></i> Jump Start</a></li>
<!--              <li><a href="addTaskTreboot.php"><i class="fa fa-circle-o text-aqua"></i> Treboot</a></li>-->
          </ul>
        </li>
          <li class="header">INFO</li>
          <li class="treeview" >
              <a href="#"><i class="fa fa-link"></i> <span>Task Manager</span>
                  <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="taskManagerForJump.php"><i class="fa fa-circle-o text-red"></i> Jump Start</a></li>
              </ul>
          </li>
          <li class="header">CHECK OUT</li>
          <li>
              <a href="portCheck.php"><i class="fa fa-link"></i> <span>Port Status</span></a>
          </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <section class="content">
          <div class="callout callout-info">
              <h4>Reminder!</h4>
              Instructions for how to use modals are available on the
              <a href="http://getbootstrap.com/javascript/#modals">Bootstrap documentation</a>
          </div>
          <div class="row">
              <div class="col-xs-12">
                  <div class="box box-default">
                      <div class="box-header with-border">
                          <h3 class="box-title">Modal Examples</h3>
                      </div>
                      <div class="box-body">
<!--                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">-->
<!--                              Launch Default Modal-->
<!--                          </button>-->
<!--                          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">-->
<!--                              Launch Info Modal-->
<!--                          </button>-->
<!--                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger">-->
<!--                              Launch Danger Modal-->
<!--                          </button>-->
<!--                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-warning">-->
<!--                              Launch Warning Modal-->
<!--                          </button>-->
                            <div class="row">
                                <div class="col-md-7">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>

                                </div>
                                <div class="col-md-5">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                                        Launch Success Modal
                                    </button>

                                </div>

                            </div>

                      </div>
                  </div>
              </div>
          </div>
              <div class="box box-default panel-group" id="accordion1">
                  <div class="box-header with-border">
                      <h3 class="box-title">Modal Examples</h3>
                  </div>
                  <div class="box-body">

                      <button type="button" class="btn btn-info btn-block" data-toggle="collapse"
                              data-target="#collapseO">
                          简单的可折叠组件
                      </button>

                      <div id="collapseO" class="panel-collapse collapse in">
                          <div class="panel-body form-horizontal">

                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
                                      <div class="col-sm-4">
                                          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                      </div>
                                      <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
                                      <div class="col-sm-4">
                                          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
                                      <div class="col-sm-4">
                                          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                      </div>
                                      <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
                                      <div class="col-sm-4">
                                          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-1 control-label">TestDMIReset</label>
                                      <div class="col-sm-4"  style="padding-top: 7px;padding-left: 14px">
                                          <label style="margin-right: 19px">
                                              <input type="checkbox" name="customer" value="default" /> default
                                          </label>
                                          <label style="margin-right: 19px">
                                              <input type="checkbox" name="customer" value="customer" /> customer
                                          </label>
                                          <label  style="margin-right: 19px">
                                              <input type="checkbox" name="customer" value="customer" /> customer
                                          </label>
                                          <label style="margin-right: 19px">
                                              <input type="checkbox" name="customer" value="customer" /> customer
                                          </label>
                                      </div>
                                      <label class="col-sm-1 control-label">TestDMIReset</label>
                                      <div class="col-sm-4"  style="padding-top: 7px;padding-left: 14px">
                                          <label style="margin-right: 19px">
                                              <input type="radio" name="customer" value="default" /> default
                                          </label>
                                          <label>
                                              <input type="radio" name="customer" value="customer" /> customer
                                          </label>
                                      </div>
                                  </div>
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-1 control-label">Email</label>
                                  <div class="col-sm-4">
                                      <select class="form-control">
                                          <option>option 1</option>
                                          <option>option 2</option>
                                          <option>option 3</option>
                                          <option>option 4</option>
                                          <option>option 5</option>
                                      </select>
                                  </div>
                                  <label for="inputEmail3" class="col-sm-1 control-label">Email</label>

                              </div>
                              <hr>
                              <button type="button" class="btn btn-success pull-right">
                                  delete Success Modal
                              </button>
                      </div>
                  </div>
                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary pull-right">Submit</button>
                  </div>
              </div>

      </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <?php include 'footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!--PACE-->
<script src="../plugins/pace/pace.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<script>
    $(function () {
        $('.select2').select2();


    });
</script>

</body>
</html>