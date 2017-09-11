<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo lang('edit_group_heading');?>
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
            <div class="box">
            <h3 class="box-title"><?php echo lang('edit_group_subheading');?></h3>
            <div class="box-body">
<?php echo form_open(current_url());?>

                <div class="form-group">
            <?php echo lang('edit_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name,'','class="form-control"');?>
      </div>

      <div class="form-group">
            <?php echo lang('edit_group_desc_label', 'description');?> <br />
            <?php echo form_input($group_description,'','class="form-control"');?>
      </div>

                <div class="form-group"><?php echo form_submit('submit', lang('edit_group_submit_btn'),'class="btn btn-success"');?></div>

<?php echo form_close();?>
      <div id="infoMessage"><?php echo $message;?></div>
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



