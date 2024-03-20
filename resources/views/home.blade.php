@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$user_count}}</h3>
    
                    <p>Nombre d'utilisateurs </p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person"></i>
                  </div>
                  
                </div>
              </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$tech_count}}</h3>
  
                  <p>Techniciens</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$manager_count}}</h3>
  
                  <p>Administrateurs techniques</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
 
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$report_count}}</h3>
  
                  <p>Total d'incidents</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
          </div>
          <div class="row">
            
            <div class="col-lg-4 col-4">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$taux}}<sup style="font-size: 20px">%</sup></h3>
  
                  <p>Taux de l’intervention</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                
              </div>
            </div>
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$report_resolue_count}}</h3>
    
                    <p>Total d'incidents resolues</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  
                </div>
              </div>
            <!-- ./col -->
 
            <!-- ./col -->
            <div class="col-lg-4 col-4">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$report_encours_count}}</h3>
  
                  <p>Total d'incidents en cours</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <!-- PIE CHART -->
            <div class="col-lg-12 col-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Types d'incidents</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- Main row -->

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection

@push('js_file')
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script>

$(function() {
    var values = {!! json_encode($values,JSON_HEX_TAG) !!};
    var keys = {!! json_encode($keys,JSON_HEX_TAG) !!};
    var donutData        = {
    labels: keys,
    datasets: [
        {
        data: values,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
    ]
    }


    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: pieOptions
    })
});

</script>

@endpush
