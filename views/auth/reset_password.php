<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EPOD | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()."assets/";?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   <b>EPOD </b>Admin
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3 class="login-box-msg"><?php echo lang('reset_password_heading');?></h3>
    <p>Enter your new password below</p>
<?php if ($message != "") { ?>
                        <div id="infoMessage" class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>
    <?php echo form_open('auth/reset_password/' . $code);?>

    <div class="form-group">
		<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
		<?php echo form_input($new_password,'','class="form-control"');?>
	</div>

    <div class="form-group">
		<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
		<?php echo form_input($new_password_confirm,'','class="form-control"');?>
	</div>

	<?php echo form_input($user_id);?>
	<?php echo form_hidden($csrf); ?>

    <div class="form-group"><?php echo form_submit('submit', lang('reset_password_submit_btn'),'class="btn btn-primary"');?></div>

<?php echo form_close();?>

    <!-- /.social-auth-links -->

    

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()."assets/";?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()."assets/";?>js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()."assets/";?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
