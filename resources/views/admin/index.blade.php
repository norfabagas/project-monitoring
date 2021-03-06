@extends('layouts.admin')

@section('breadcrumb')
<li class="breadcrumb-item active">My Dashboard</li>
@endsection

@section('content')
<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-comments"></i>
        </div>
        <div class="mr-5">{{ $projects }} Total Projects</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/project') }}">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-list"></i>
        </div>
        <div class="mr-5">{{ $running }} Project berjalan</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/project') }}?status=running">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-shopping-cart"></i>
        </div>
        <div class="mr-5">{{ $finish }} Projects Selesai</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/project') }}?status=finish">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          <i class="fa fa-fw fa-support"></i>
        </div>
        <div class="mr-5">{{ $deadline }} Projects mendekati deadline</div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="{{ url('admin/project') }}?status=deadline">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fa fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>

<!-- Area Chart Example-->
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-area-chart"></i> Omset tahun {{ date('Y') }}</div>
  <div class="card-body">
    <canvas id="myAreaChart" width="100%" height="30"></canvas>
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-area-chart"></i> Pengeluaran tahun {{ date('Y') }}</div>
  <div class="card-body">
    <canvas id="myAreaChart2" width="100%" height="30"></canvas>
  </div>
</div>


      <div class="row">
              <div class="col-lg-8">
                <!-- Example Bar Chart Card-->
                <div class="card mb-3">
                  <div class="card-header">
                    <i class="fa fa-bar-chart"></i> Grafik Keuntungan {{ date('Y') }}</div>
                  <div class="card-body">
                    <canvas id="myBarChart" width="100" height="50"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <!-- Example Pie Chart Card-->
                <div class="card mb-3">
                  <div class="card-header">
                    <i class="fa fa-pie-chart"></i> Project Distribution</div>
                  <div class="card-body">
                    <canvas id="myPieChart" width="100%" height="100"></canvas>
                  </div>
                </div>
              </div>
            </div>
@endsection

@section('script')
<!-- Custom scripts for this page-->
<script src="{{ asset('template/js/sb-admin-datatables.min.js') }}"></script>
<script src="{{ asset('template/js/sb-admin-charts.js') }}"></script>

<script>
// -- Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
    datasets: [{
      label: "Revenue",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [{{ $rev[1] }}, {{ $rev[2] }}, {{ $rev[3] }}, {{ $rev[4] }}, {{ $rev[5] }}, {{ $rev[6] }}, {{ $rev[7] }}, {{ $rev[8] }}, {{ $rev[9] }}, {{ $rev[10] }}, {{ $rev[11] }}, {{ $rev[12] }}],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'year'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: {{ $revenue }},
          maxTicksLimit: 4
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
</script>

<script>
// -- Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"],
    datasets: [{
      label: "Revenue",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: [{{ $o[1] }}, {{ $o[2] }}, {{ $o[3] }}, {{ $o[4] }}, {{ $o[5] }}, {{ $o[6] }}, {{ $o[7] }}, {{ $o[8] }}, {{ $o[9] }}, {{ $o[10] }}, {{ $o[11] }}, {{ $o[12] }}],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: {{ $omset }},
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
</script>

<script>
// -- Area Chart Example
var ctx = document.getElementById("myAreaChart2");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"],
    datasets: [{
      label: "Revenue",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: [{{ $p[1] }}, {{ $p[2] }}, {{ $p[3] }}, {{ $p[4] }}, {{ $p[5] }}, {{ $p[6] }}, {{ $p[7] }}, {{ $p[8] }}, {{ $p[9] }}, {{ $p[10] }}, {{ $p[11] }}, {{ $p[12] }}],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: {{ $pengeluaran }},
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
</script>

<script>
// -- Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Studi Kelayakan", "Riset Pasar", "Pelatihan", "Pengawasan"],
    datasets: [{
      data: [{{ $category['studi'] }}, {{ $category['riset'] }}, {{ $category['pelatihan'] }}, {{ $category['pengawasan'] }}],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});
</script>
@endsection
