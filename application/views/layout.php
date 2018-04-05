<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>لوحة التحكم</title>
    <base href="<?php echo base_url(); ?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
     <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="assets/dist/fonts/fonts-fa.css">
    <link rel="stylesheet" href="assets/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="assets/dist/css/rtl.css">
       <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="assets/dist/js/bootstrap3-typeahead.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      
      <style>
          input[type="number"]::-webkit-outer-spin-button,
          input[type="number"]::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
          }
          input[type="number"] {
              -moz-appearance: textfield;
          }
          .label.label-danger.validation-error {
              display: block;
              text-align: right;
              font-size: 14px;
          }
          .dataTables_filter {
              text-align: left !important;
          }
          .pagination {
              float:left;
          }
      </style>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="admin" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>لوحة</b> التحكم</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>لوحة</b> التحكم</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Admin</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="auth/logout" class="btn btn-default btn-flat">تسجيل الخروج</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-right image">
              <img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>
              <a href="admin"><i class="fa fa-circle text-success"></i> متصل</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="admin/add">
                <i class="fa fa-edit"></i> <span>اضافة حوالة</span>
              </a>
            </li>
            <li class="treeview">
              <a href="admin/customers">
                <i class="fa fa-user"></i> <span>جميع الزبائن</span>
              </a>
            </li>
            <li class="treeview">
              <a href="admin/editexp">
                <i class="fa fa-file"></i> <span>الحوالات الصادرة</span>
              </a>
            </li>
            <li class="treeview">
              <a href="admin/editimp">
                <i class="fa fa-file"></i> <span>الحوالات الواردة</span>
              </a>
            </li>
            <li class="treeview">
              <a href="auth/change_password">
                <i class="fa fa-lock"></i> <span>تغيير كلمة السر</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            لوحة التحكم
          </h1>
        </section>
        <section class="content">
            <?php if ($this->session->flashdata('type') != null) { ?>
            
            <?php
                $type='';
                switch ($this->session->flashdata('type')) {
                    case 'error' : $type='alert-danger'; break;
                    case 'success' : $type='alert-success'; break;
                    case 'warning' : $type='alert-warning'; break;
                }
                echo '<div class="alert '.$type.' alert-dismissible" role="alert" style="padding-right: 10px;">';
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                echo $this->session->flashdata('msg');
                echo '</div>'; 
            ?>
        <?php } ?>
          <?php
          if( $this->session->flashdata('message')  || $this->session->flashdata('error')){
          ?>
            <div class="alert  alert-dismissable <?php echo isset($_SESSION['message'])? 'alert-success': 'alert-danger'?>">
                <button type="button"
                        class="close"
                        data-dismiss="alert">
                    x
                </button>
              <h4><?php echo isset($_SESSION['message'])?  $_SESSION['message'] : $_SESSION['error']; ?> </h4>
              
            </div>
          <?php } 
          if(isset($content)){
              
              $this->load->view($content);
          } 
          ?>          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-left hidden-xs">
          <b>نسخة</b> 1.0
        </div>
        <strong>حقوق النشر &copy; 2017.</strong> جميع الحقوق محفوظة.
      </footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

 
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <!-- <script src="plugins/knob/jquery.knob.js"></script> -->
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
     <!-- InputMask -->
    <script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- datetable -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="assets/plugins/datatables/Arabic.json"></script>
    <!-- datepicker -->
    <script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/datepicker/locales/bootstrap-datepicker.ar.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="assets/dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <div id="iframModal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body"></div>  
            </div>
        </div>
    </div>
      <script>
          $(function() {
              $(document).on('click', ".ifram" ,function() {
                  $("#iframModal .modal-body").html('<iframe src="' + $(this).attr("href") +'" frameborder="0" width="100%" height="520px"></iframe>');
                  $("#iframModal .modal-title").text($(this).attr("title"));
                  $("#iframModal").modal("show");
                  return false;
              });
          });
      </script>
      <div id="ConfirmDelete" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">تأكيد حذف</h4>
                </div>
                <div class="modal-body">
                    <p>هل تود حذف هذا العنصر ؟</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default" data-dismiss="modal">الغاء الامر</a>
                    <a class="btn btn-danger">نعم, متأكد</a>
                </div>
            </div>
        </div>
    </div>
<script>
     $(function() {
        $(document).on("click", ".ConfirmDelete", function() {
            $("#ConfirmDelete").modal("show");
            $("#ConfirmDelete .btn-danger").attr("href", $(this).attr("href"));
            return false;
        }); 
     });
</script>
      <script>
                $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                    $(".alert").slideUp(500);
                });
            </script>
  </body>
</html>
