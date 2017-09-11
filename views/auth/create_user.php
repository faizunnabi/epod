<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New User
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-8">
             <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
                <?php if ($message != "") { ?>
                        <div id="infoMessage" class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>
<?php echo form_open_multipart("auth/create_user");?>

     <div class="control-group">
            <?php echo lang('create_user_fname_label', 'first_name');?>
         <div class="controls">
            <?php echo form_input($first_name,'','class="form-control"');?>
         </div>
      </div>

      <div class="control-group">
            <?php echo lang('create_user_lname_label', 'last_name');?>
          <div class="controls">
            <?php echo form_input($last_name,'','class="form-control"');?>
          </div>
      </div>
      <div class="control-group">
        <label>Profile picture:</label>
         <div class="controls">
            <input type="file" name="media" class="form-control" />
         </div>
      </div>
      <?php
      if($identity_column!=='email') {
          echo '<div class="control-group">';
          echo lang('create_user_identity_label', 'identity');
          echo '<div class="controls">';
          echo form_error('identity');
          echo form_input($identity,'','class="form-control"');
          echo '</div></div>';
      }
      ?>
      
      <div class="control-group">
            <?php echo lang('create_user_company_label', 'company');?> 
          <div class="controls">
            <?php echo form_input($company,'','class="form-control"');?>
          </div>
      </div>

      <div class="control-group">
            <?php echo lang('create_user_email_label', 'email');?> 
          <div class="controls">
            <?php echo form_input($email,'','class="form-control"');?>
          </div>
      </div>

      <div class="control-group">
            <?php echo lang('create_user_phone_label', 'phone');?>
          <div class="controls">
            <?php echo form_input($phone,'','class="form-control"');?>
          </div>
      </div>

      <div class="control-group">
            <?php echo lang('create_user_password_label', 'password');?> 
          <div class="controls">
            <?php echo form_input($password,'','class="form-control"');?>
          </div>
      </div>

      <div class="control-group">
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> 
          <div class="controls">
            <?php echo form_input($password_confirm,'','class="form-control"');?>
          </div>
      </div>
                <div class="control-group">
    <div class="checkbox">
      
          <h3>Member of groups</h3>
                        <label class="checkbox">
                            <input type="checkbox" name="groups[]" value="1">
              Admin              </label>
                        <label class="checkbox">
                            <input type="checkbox" name="groups[]" value="2">
              Delivery_Boys              </label>
          
          </div>
</div>

<br/>
      <div class="form-actions"><?php echo form_submit('submit', lang('create_user_submit_btn'),'class="btn btn-success"');?></div>

<?php echo form_close();?>
</div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
    
</script>
<?php include APPPATH . 'views/footer.php'; ?>