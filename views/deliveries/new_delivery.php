<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Delivery
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-8">
            <div class="box">
            
            <div class="box-body">
                <?php echo form_open('delivery/delivery_insert');?>
              
               
            <div class="control-group">
              <label class="control-label">Job Id :</label>
              <div class="controls">
                <select class="form-control" name="jobid" />
                <?php dropdown_tool('jobs','id',""); ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Order Id :</label>
              <div class="controls">
                <select class="form-control" name="orderid" />
                <?php dropdown_tool('orders','id',""); ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Username</label>
              <div class="controls">
                <select class="form-control"  name="userid" />
                <?php dropdown_tool('users','username',""); ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Delivery date :</label>
              <div class="controls">
                <input type="text" name="ddate" data-date="<?php echo date('d-m-Y');?>" data-date-format="dd-mm-yyyy" class="datepicker form-control">
                <span class="help-block">Date with Formate of  (dd-mm-yy)</span> </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
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