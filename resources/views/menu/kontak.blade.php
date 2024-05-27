<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<title>Beranda</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">            
          <img src="{{ URL::to('assets/img/kontak.svg') }}" alt="" style="display: block; margin: 0 auto; width: 700px;">
        </div>
    </div>

    <script src="{{ URL::to('front/js/bootstrap.min.js') }}"></script>
   

@endsection
