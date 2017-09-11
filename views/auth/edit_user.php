<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit User
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
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open_multipart(uri_string());?>

      <div class="control-group">
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name,'','class="form-control"');?>
      </div>

      <div class="control-group">
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name,'','class="form-control"');?>
      </div>
<div class="control-group">
        <label>Profile picture:</label>
         <div class="controls">
            <input type="file" name="media" class="form-control" />
         </div>
      </div>
      <div class="control-group">
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company,'','class="form-control"');?>
      </div>

<div class="control-group">
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone,'','class="form-control"');?>
</div>

<div class="control-group">
            <?php echo lang('edit_user_password_label', 'password');?> <br />
            <?php echo form_input($password,'','class="form-control"');?>
</div> 
<div class="control-group">
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
            <?php echo form_input($password_confirm,'','class="form-control"');?>
</div>   
<div class="control-group">
    <div class="checkbox">
      <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading');?></h3>
          <?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
              <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>

      <?php endif ?>
    </div>
</div>
      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'),'class="btn btn-primary"');?></p>

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