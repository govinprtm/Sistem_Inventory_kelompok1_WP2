<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid px-3">
      <div class="row">
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid px-3 pb-3">
      <!-- Small boxes (Stat box) -->
      <?php if ($is_admin == true) { ?>
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $total_products ?></h3>
                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag text-blue"></i>
              </div>
              <a href="<?php echo base_url('products/') ?>" class="small-box-footer bg-light text-dark">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $total_paid_sales ?></h3>
                <p>Penjualan Lunas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars text-green"></i>
              </div>
              <a href="<?php echo base_url('sales/') ?>" class="small-box-footer bg-light text-dark">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $total_stores ?></h3>
                <p>Suplier</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-home text-red"></i>
              </div>
              <a href="<?php echo base_url('stores/') ?>" class="small-box-footer bg-light text-dark">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $total_users; ?></h3>
                <p>Pengguna</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people text-yellow"></i>
              </div>
              <a href="<?php echo base_url('users/') ?>" class="small-box-footer bg-light text-dark">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      <?php } else { ?>
        <div class="row">
          <div class="col-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $total_products ?></h3>

                <p>Total Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag text-blue"></i>
              </div>
              <a href="<?php echo base_url('products/') ?>" class="small-box-footer text-dark">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-6">
            <!-- small box -->
            <div class="small-box">
              <div class="inner">
                <h3><?php echo $total_paid_orders ?></h3>

                <p>Total Penjualan Lunas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars text-green"></i>
              </div>
              <a href="<?php echo base_url('orders/') ?>" class="small-box-footer text-dark">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      <?php } ?>

      <div class="row">
        <div class="col-md-6">
          <!-- /.box -->
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">TOTAL PENJUALAN LUNAS</h2>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Tahun - Bulan</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($results as $k => $v) : ?>
                    <tr>
                      <td><?php echo $k; ?></td>
                      <td><?php

                          echo $company_currency . ' ' . $v;
                          //echo $v;

                          ?></td>
                    </tr>
                  <?php endforeach ?>

                </tbody>
                <tbody>
                  <tr>
                    <th>Total Jumlah</th>
                    <th>
                      <?php //echo $company_currency . ' ' . array_sum($parking_data); 
                      ?>
                      <?php echo array_sum($results); ?>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">TAGIHAN PELANGGAN TERHUTANG</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <div class="position-relative">
                <canvas id="barChart1" style="height: 280px;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">TAGIHAN YANG PERLU KAMU BAYAR</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <div class="position-relative">
                <canvas id="barChart2" style="height: 280px;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">TOTAL PENDAPATAN TAHUN <?= date('Y'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              <div class="position-relative">
                <canvas id="barChart" style="height: 350px;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#dashboardMainMenu .nav-link").addClass('active');
  });
</script>

<script type="text/javascript">
  var report_data = <?php echo '[' . implode(',', $results) . ']'; ?>;

  $(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var areaChartData = {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: '',
        fillColor: 'rgba(210, 214, 222, 1)',
        strokeColor: 'rgba(210, 214, 222, 1)',
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: report_data
      }]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = areaChartData
    barChartData.datasets[0].fillColor = '#4BC0C0';
    barChartData.datasets[0].strokeColor = '#4BC0C0';
    barChartData.datasets[0].pointColor = '#4BC0C0';
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: false
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })


  var unpaid_sales_data = <?php echo '[' . implode(',', $unpaid_sales) . ']'; ?>;

  $(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var areaChartData = {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: '',
        fillColor: 'rgba(210, 214, 222, 1)',
        strokeColor: 'rgba(210, 214, 222, 1)',
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: unpaid_sales_data
      }]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart1').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = areaChartData
    barChartData.datasets[0].fillColor = '#4BC0C0';
    barChartData.datasets[0].strokeColor = '#4BC0C0';
    barChartData.datasets[0].pointColor = '#4BC0C0';
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: false
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })


  var unpaid_purchase_data = <?php echo '[' . implode(',', $unpaid_purchases) . ']'; ?>;

  $(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var areaChartData = {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: '',
        fillColor: 'rgba(210, 214, 222, 1)',
        strokeColor: 'rgba(210, 214, 222, 1)',
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: unpaid_purchase_data
      }]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = areaChartData
    barChartData.datasets[0].fillColor = '#FF3D67';
    barChartData.datasets[0].strokeColor = '#FF3D67';
    barChartData.datasets[0].pointColor = '#FF3D67';
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: false
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>