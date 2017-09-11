<?php
include APPPATH . 'views/header.php';
include APPPATH . 'views/sidebar.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="n_od">0</h3>

              <p>Total Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo site_url('orders/');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="n_jo">0</h3>

              <p>Jobs Assigned</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-attach"></i>
            </div>
            <a href="<?php echo site_url('jobs/');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-fuchsia">
            <div class="inner">
              <h3 id="n_r">0</h3>  
              <p>Jobs Rejected</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-cancel"></i>
            </div>
            <a href="<?php echo site_url('jobs/');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="n_hi">0</h3>

              <p>Out for Delivery</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-cart"></i>
            </div>
            <a href="<?php echo site_url('delivery/');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         
       
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-teal">
            <div class="inner">
              <h3 id="n_d">0</h3>

              <p>Total Deliveries</p>
            </div>
            <div class="icon">
              <i class="ion ion-trophy"></i>
            </div>
            <a href="<?php echo site_url('reports/delivery_report');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3 id="n_pe">0</h3>

              <p>Pending Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-flag"></i>
            </div>
            <a href="<?php echo site_url('pendingorders/');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3 id="n_us">0</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="<?php echo site_url('auth/all');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="n_su">0</h3>

              <p>Support Tickets</p>
            </div>
            <div class="icon">
              <i class="ion ion-pricetags"></i>
            </div>
            <a href="<?php echo site_url('support/');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
       
      <div class="row">
          <div class="col-sm-6">
              <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Orders Status plot</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          <div class="col-sm-6">
              <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Jobs status plot</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="linechart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript">
    var dash_data;
    function update_ui(data) {
        var mydata = JSON.parse(data);
        console.log(mydata.support);
        $('#n_od').html(mydata.n_od);
        $('#n_jo').html(mydata.n_jo);
        $('#n_hi').html(mydata.n_hi);
        $('#n_su').html(mydata.n_su);
        $('#n_pe').html(mydata.n_pe);
        $('#n_us').html(mydata.n_us);   
        $('#n_d').html(mydata.n_d);
        $('#n_r').html(mydata.n_r);
    }
    ;

    $(document).ready(function () {
        function dashboard_data_updation() {
            $.ajax({
                type: 'get',
                url: '<?php echo base_url(); ?>dashboard/test_data/',
                success: function (data) {
                    dash_data=data;
                    update_ui(data);
                }
            });
        }
        ;
        refreshIntervalId = setInterval(dashboard_data_updation, 20000);
        $.ajax({
                type: 'get',
                url: '<?php echo base_url(); ?>dashboard/test_data/',
                success: function (data) {
                    var dta=JSON.parse(data);
                    console.log(dta);
                    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                    var linechartcanvas=$('#linechart').get(0).getContext("2d");
                    var pieChart = new Chart(pieChartCanvas);
                    var lineChart=new Chart(linechartcanvas);
                    var PieData = [
                      /*{
                        value: (dta.n_hi+dta.n_pe+dta.n_d),
                        color: "#f56954",
                        highlight: "#f56954",
                        label: "Under Process"
                      },*/
                      {
                        value: dta.n_hi,
                        color: "#00a65a",
                        highlight: "#00a65a",
                        label: "Out For Delivery"
                      },
                      {
                        value: dta.n_pe,
                        color: "#f39c12",
                        highlight: "#f39c12",
                        label: "Pending Orders"
                      },
                      {
                        value: dta.n_d,
                        color: "#00c0ef",
                        highlight: "#00c0ef",
                        label: "Deliveries done"
                      }
                      
                    ];
                    var PieData1 = [
                      
                      {
                        value: dta.n_r,
                        color: "#00a65a",
                        highlight: "#00a65a",
                        label: "Jobs Rejected"
                      },
                      {
                        value: dta.n_ac,
                        color: "#f39c12",
                        highlight: "#f39c12",
                        label: "Jobs Accepted"
                      },
                      {
                        value: dta.n_un,
                        color: "#00c0ef",
                        highlight: "#00c0ef",
                        label: "Jobs Unseen"
                      }
                      
                    ];
                    var pieOptions = {
                      //Boolean - Whether we should show a stroke on each segment
                      segmentShowStroke: true,
                      //String - The colour of each segment stroke
                      segmentStrokeColor: "#fff",
                      //Number - The width of each segment stroke
                      segmentStrokeWidth: 2,
                      //Number - The percentage of the chart that we cut out of the middle
                      percentageInnerCutout: 50, // This is 0 for Pie charts
                      //Number - Amount of animation steps
                      animationSteps: 100,
                      //String - Animation easing effect
                      animationEasing: "easeOutBounce",
                      //Boolean - Whether we animate the rotation of the Doughnut
                      animateRotate: true,
                      //Boolean - Whether we animate scaling the Doughnut from the centre
                      animateScale: false,
                      //Boolean - whether to make the chart responsive to window resizing
                      responsive: true,
                      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                      maintainAspectRatio: true,
                      //String - A legend template
                      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
                    };
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    pieChart.Doughnut(PieData, pieOptions);
                    lineChart.Doughnut(PieData1, pieOptions);
                                }

            });
            
    });
</script>
<?php include APPPATH . 'views/footer.php'; ?>