@extends('admin.index')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-4 col-md-8">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Menunggu persetujuan Bukti Transfer</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    Total Pengguna : {{ $buktitransfer->totalrecordbukti }} <br>
                    Total Keseluruhan Harga : Rp. {{ number_format($buktitransfer-> totalpricebukti) }}
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-8">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Total Pembelian yang di setujui</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    Total Pengguna : {{ $totpemapp->totalrecordapp }} <br>
                    Total Keseluruhan Harga : Rp. {{ number_format($totpemapp-> totalpriceapp) }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-10">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area mr-1"></i>
                    Total Perbulan dalam setahun pembelian yang di approve
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach($period as $mth)
                @php 
                setlocale(LC_TIME, 'id_ID.utf8');
                @endphp
                '{{  strftime("%b %y", $mth->getTimestamp()) }}',
                @endforeach
            ],
            datasets: [{
            label: "Sessions",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: [{{ $implodeprice }}],
            }],
        },
        options: {
            legend: {
            display: false
            }
        }
        });
    </script>
@endsection
