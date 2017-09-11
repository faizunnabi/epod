<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delivery detail
        <small>Control panel</small>
      </h1>
      
          <?php echo $this->breadcrumbs->show();?>
      
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-8">
            <div class="box">
            
            <div class="box-body">
              <table class="table table-bordered table-striped">
              <tbody>
                  <?php
                    foreach($data as $d){
                       echo '<tr><td>Id:</td><td>'.$d->id.'</td></tr>'; 
                       echo '<tr><td>Job Id:</td><td>'.$d->job_id.'</td></tr>';
                       echo '<tr><td>Order Id:</td><td>'.$d->order_id.'</td></tr>';
                       echo '<tr><td>User Id:</td><td>'.$d->user_id.'</td></tr>';
                       echo '<tr><td>Accepted Date:</td><td>'.$d->d_date.'</td></tr>';                      
                    }
                    ?>
              </tbody>
            </table>
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