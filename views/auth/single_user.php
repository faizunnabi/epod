<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User details
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-5">
            <div class="box">
            
            <div class="box-body box-profile">
                  <?php
                    foreach($records as $d){
                       echo '<img class="profile-user-img img-responsive img-circle" src="'.base_url()."assets/img/profile/".$d->profile_pic.'" alt="User profile picture">';
                       echo '<ul class="list-group list-group-unbordered">';
                       echo '<li class="list-group-item"><b>User Id</b> <span class="pull-right"><a class="left_text">'.$d->id.'</a></span></li>';
                       echo '<li class="list-group-item"><b>Username</b> <span class="pull-right"><a class="left_text">'.$d->username.'</a></span></li>'; 
                       echo '<li class="list-group-item"><b>Full Name</b> <span class="pull-right"><a class="left_text">'.$d->first_name." ".$d->last_name.'</a></span></li>'; 
                       echo '<li class="list-group-item"><b>Email Id</b> <span class="pull-right"><a class="left_text">'.$d->email.'</a></span></li>'; 
                       echo '<li class="list-group-item"><b>Mobile No.</b> <span class="pull-right"><a class="left_text">'.$d->phone.'</a></span></li>'; 
                       echo '<li class="list-group-item"><b>Company</b> <span class="pull-right"><a class="left_text">'.$d->company.'</a></span></li>';  
                       echo '<li class="list-group-item"><b>Role</b> <span class="pull-right"><a class="left_text">';
                        foreach($group as $g){
											    echo $g->name.' , ';												 
											  }
                       echo '</a></span></li>';
                       echo '</ul>';
                       
                    }
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
