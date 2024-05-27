<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

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
{{-- 
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Papan Kontrol</h3>
                        <br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Semua Perkara</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Sudah Inkrah</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Belum Inkrah</button>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
                          </div>
                    </div>
                </div>
            </div> --}}

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

@endsection
