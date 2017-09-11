<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users List
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
	            $this->table->set_heading('User Id','Username', 'Email', 'Mobile','Options'); 

				foreach($records as $r){
				    $this->table->add_row($r->id,$r->username,$r->email, $r->phone,'<a href="'.site_url("auth/view_user").'"><i class="fa fa-search"></i></a>  <a href="'.site_url("auth/edit_user/$r->id").'"><i class="fa fa-edit"></i></a>  <a href="'.site_url("auth/delete_user/$r->id").'"><i class="fa fa-trash"></i></a>');
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
    <a href="user_view.php"></a>
  </div>
<script type="text/javascript">
    
</script>
<?php include APPPATH . 'views/footer.php'; ?>