<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delivery List
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
            
            <div class="box-body">
              <?php 
            	$template = array('table_open' => '<table class="table table-bordered table-striped dtable">');

				$this->table->set_template($template);
	            $this->table->set_heading('Id', 'Job Id', 'Order Id','Username','Delivery date','Options'); 

				foreach($records as $r){
				    $this->table->add_row($r->id,$r->job_id,$r->order_id, convert_id($r->user_id,"users")->username,$r->d_date,'<a href="'.site_url("delivery/update_show/$r->id").'"><i class="fa fa-edit"></i></a>  <a onclick="confirm_delete(this);" href="'.site_url("delivery/delete_delivery/$r->id").'"><i class="fa fa-trash"></i></a>');
				}
				echo $this->table->generate();
				?>
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