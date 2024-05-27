<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>Beranda</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ URL::to('assets/img/carousel/carousel-1.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ URL::to('assets/img/carousel/carousel-2.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ URL::to('assets/img/carousel/carousel-3.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ URL::to('assets/img/carousel/carousel-4.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ URL::to('assets/img/carousel/carousel-5.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ URL::to('assets/img/carousel/carousel-6.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ URL::to('assets/img/carousel/carousel-7.jpg') }}" class="d-block w-100" style="max-height: 500px; width: auto;" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
              
            <br>
            <br>


            <div class="row mb-4">
              <div class="col-xl-12 col-sm-12 col-12">
                <div class="breadcrumb-path">
                  <ul class="breadcrumb">
                    <li class="breadcumb-item">
                      @if(auth()->check() && (Auth::user()->role == 'stafbb'))
                        <h3>Staf BB Dashboard</h3>
                      @endif
                      @if(auth()->check() && (Auth::user()->role == 'jaksa'))
                        <h3>Jaksa Dashboard</h3>
                      @endif
                      @if(auth()->check() && (Auth::user()->role == 'kajari'))
                        <h3>Kajari Dashboard</h3>
                      @endif
                      @if(auth()->check() && (Auth::user()->role == 'kasibb'))
                        <h3>Kasi BB Dashboard</h3>
                      @endif
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <style>
              /* CSS untuk mengatur border radius card */
              .card {
                  border-radius: 10px; /* Atur radius border ke 10px */
              }
            </style>

            <div class="row mb-4">
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card board1 fill1" style="background-color: #7D0A0A;">
                  <div class="card-body d-flex justify-content-between">
                    <div class="card_widget_header"><a href="{{ route('ba23.index') }}">
                      <label style="color: white;">Total Berita Acara Pemusnahan</label>
                      <h2 style="color: white;">{{ $jumlahba_23}}</h2>
                    </div>
                    <div class="card_widget_img">
                      <img src="{{ asset('assets/img/ba23.png') }}" alt="icon_pemusnahan" style="width: 100px;">
                    </div>
                  </div>
                </div>
              </div></a>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card board1 fill1" style="background-color: #C6A969;">
                  <div class="card-body d-flex justify-content-between">
                    <div class="card_widget_header"><a href="{{ route('ba20.index') }}">
                      <label style="color: white;">Total Berita Acara Pengembalian</label>
                      <h2 style="color: white;">{{ $jumlahba_20}}</h2>
                    </div>
                    <div class="card_widget_img">
                      <img src="{{ asset('assets/img/ba20.png') }}" alt="icon_pengembalian" style="width: 100px;">
                    </div>
                  </div>
                </div>
              </div></a>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card board1 fill1" style="background-color: #59B4C3;">
                  <div class="card-body d-flex justify-content-between">
                    <div class="card_widget_header"><a href="{{ route('bensus.index') }}">
                      <label style="color: white;">Total Berita Acara Bensus</label>
                      <h2 style="color: white;">{{ $jumlahbensus}}</h2>
                    </div>
                    <div class="card_widget_img">
                      <img src="{{ asset('assets/img/bensus.png') }}" alt="icon_bensus" style="width: 100px;">
                    </div>
                  </div>
                </div>
              </div></a>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="card board1 fill1" style="background-color: #FF9843;">
                  <div class="card-body d-flex justify-content-between">
                    <div class="card_widget_header"><a href="{{ route('rekapan-data-pinjambb') }}">
                      <label style="color: white;">Total Peminjaman Barang Bukti</label>
                      <h2 style="color: white;">{{ $jumlahpeminjaman}}</h2>
                    </div>
                    <div class="card_widget_img">
                      <img src="{{ asset('assets/img/peminjaman.png') }}" alt="icon_peminjaman" style="width: 100px;">
                    </div>
                  </div>
                </div>
              </div></a>
            </div>

            <div class="row">
              <div class="col-xl-12 d-flex mobile-h">
                  <div class="card flex-fill">
                      <div class="card-header">
                          <div class="d-flex justify-content-between align-items-center">
                              <h5 class="card-title">Total Terdakwa berdasarkan Status Barang Bukti </h5>
                          </div>
                      </div>
                      <div class="card-body">
                          <canvas id="chartTerdakwa"></canvas>
                      </div>
                  </div>
              </div>
            </div>

            {{-- Map --}}
            <div id="map" style="height: 400px;"></div>
        </div>
    </div>

    <script src="{{ URL::to('front/js/bootstrap.min.js') }}"></script>
   
    <script>

        // Ganti dengan koordinat yang diinginkan
        var latitude = -0.66345;
        var longitude = 100.94108;

        var map = L.map('map').setView([latitude, longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Buat marker dengan bindPopup yang berisi tautan Google Maps
        var marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup('<a href="https://www.google.com/maps/place/District+Attorney+Office+of+Sijunjung/@-0.6636521,100.9384642,17z/data=!4m16!1m9!3m8!1s0x2e2b2180cae23113:0xc500e464e6997b1!2sDistrict+Attorney+Office+of+Sijunjung!8m2!3d-0.6636575!4d100.9410391!9m1!1b1!16s%2Fg%2F11fylsy3dd!3m5!1s0x2e2b2180cae23113:0xc500e464e6997b1!8m2!3d-0.6636575!4d100.9410391!16s%2Fg%2F11fylsy3dd?entry=ttu' + latitude + ',' + longitude + '" target="_blank">Kantor Kejaksaan Negeri Sijunjung</a>');

        // Buka popup saat peta dimuat
        marker.openPopup();
    </script>

    <script>
      // Ambil data untuk chart dari controller
      var chartData = @json($chartTerdakwa);

      // Buat data untuk chart
      var data = {
          labels: chartData.labels,
          datasets: [
              {
                  label: "Tahap II",
                  backgroundColor: "rgba(255, 99, 132, 0.6)",
                  borderColor: "rgba(255, 99, 132, 0.6)",
                  borderWidth: 1,
                  data: chartData.data['Tahap II']
              },
              {
                  label: "Proses Sidang",
                  backgroundColor: "rgba(54, 162, 235, 0.6)",
                  borderColor: "rgba(54, 162, 235, 0.6)",
                  borderWidth: 1,
                  data: chartData.data['Proses Sidang']
              },
              {
                  label: "Restorative Justice",
                  backgroundColor: "rgba(75, 192, 192, 0.6)",
                  borderColor: "rgba(75, 192, 192, 0.6)",
                  borderWidth: 1,
                  data: chartData.data['Restorative Justice']
              },
              {
                  label: "Inkrah",
                  backgroundColor: "rgb(253, 231, 103)",
                  borderColor: "rgb(253, 231, 103)",
                  borderWidth: 1,
                  data: chartData.data['Inkrah']
              },
              {
                  label: "Banding",
                  backgroundColor: "rgb(104, 149, 210)",
                  borderColor: "rgb(104, 149, 210)",
                  borderWidth: 1,
                  data: chartData.data['Banding']
              },
              {
                  label: "Kasasi",
                  backgroundColor: "rgb(255, 228, 201)",
                  borderColor: "rgb(255, 228, 201)",
                  borderWidth: 1,
                  data: chartData.data['Kasasi']
              }
          ]
      };

      // Pengaturan chart
      var options = {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      };

      // Mendapatkan elemen canvas
      var ctx = document.getElementById("chartTerdakwa").getContext("2d");

      // Membuat chart baru
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: data,
          options: options
      });
    </script>

    

@endsection
