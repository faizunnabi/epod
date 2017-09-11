<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('deactivate_heading');?>
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <h3 class="box-title"><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></h3>
            <div class="box-body">
<?php echo form_open("auth/deactivate/".$user->id);?>

  <p>
  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
  </p>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-success"');?></p>

<?php echo form_close();?>
</div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <a href="user_view.php"></a>
  </div>
<script type="text/javascript">
    
</script>
<?php include APPPATH . 'views/footer.php'; ?>