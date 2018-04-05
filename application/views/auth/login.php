<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>لوحة التحكم | تسجيل الدخول</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-box-body">
        <?php if(isset($message)){
        ?>
        <div class="alert alert-dismissable alert-success">
                <button type="button"
                        class="close"
                        data-dismiss="alert">
                    x
                </button>
              <h4 dir="rtl"><?php echo $message ?> </h4>
              
        </div>
        <?php } ?>
        <p class="login-box-msg">قم بتسجيل الدخول</p>
        <form method="post" action="login">
          <div class="form-group has-feedback">
            <input dir="rtl" type="text" name="email" class="form-control" placeholder="البريد الاكتروني">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input dir="rtl" type="password" name="password" class="form-control" placeholder="كلمة السر">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">سجل الدخول</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../assets/plugins/iCheck/icheck.min.js"></script>
  </body>
</html>
