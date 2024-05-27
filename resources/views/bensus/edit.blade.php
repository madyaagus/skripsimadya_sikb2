<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

<!-- Tautkan Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<title>Edit Data BA Bensus</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')


    <!-- START FORM -->
    <form action='{{ url('beritaacara/bensus/'.$data->id_ba23) }}' method='post'>
        @csrf 
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <a href="{{ url('beritaacara/bensus') }}" class="btn btn-secondary">
                <i class="fa-solid fa-angles-left"></i> Kembali</a>

            <div class="mb-3 row">
                <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                <div class="col-sm-10">
                    <select class="form-select" name='hari' id="hari">
                        <option value="">--Pilih--</option>
                        <option value="Senin" {{ old('hari', $data->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('hari', $data->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('hari', $data->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('hari', $data->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('hari', $data->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('hari', $data->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        <option value="Minggu" {{ old('hari', $data->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tgl_bensus" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name='tgl_bensus' id="tgl_bensus" value="{{ $data->tgl_bensus }}">
                </div>
            </div>  
            <div class="mb-3 row">
                <label for="jaksa" class="col-sm-2 col-form-label">Jaksa</label>
                <div class="col-sm-10">
                    <select name="jaksa" id="jaksa" class="form-select">
                        <option value="">--Pilih--</option>
                            @foreach ($datajaksa as $jaksaitem)
                                <option value="{{ $jaksaitem->id_pegawai }}" {{ $data->jaksa == $jaksaitem->id_pegawai ? 'selected' : '' }}>
                                    {{ $jaksaitem->nama_pegawai }}</option>
                            @endforeach
                    </select>
                </div>
            </div> 
            <div class="mb-3 row">
                <label for="terdakwa" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                <div class="col-sm-10">
                    <select name="terdakwa" id="terdakwa" class="form-select">
                        <option value="">--Pilih--</option>
                            @foreach ($dataterdakwa as $terdakwaitem)
                                <option value="{{ $terdakwaitem->id_terdakwa }}" {{ $data->terdakwa == $terdakwaitem->id_terdakwa ? 'selected' : '' }}>
                                    {{ $terdakwaitem->nama_terdakwa }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jumlah_uang" class="col-sm-2 col-form-label">Jumlah Uang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='jumlah_uang' id="jumlah_uang" value="{{ $data->jumlah_uang }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="keterangan_uang" class="col-sm-2 col-form-label">Keterangan Uang</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='keterangan_uang' id="keterangan_uang" value="{{ $data->keterangan_uang }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bendahara" class="col-sm-2 col-form-label">Bendahara</label>
                <div class="col-sm-10">
                    <select name="bendahara" id="bendahara" class="form-select">
                        <option value="">--Pilih--</option>
                            @foreach ($databendahara as $bendaharaitem)
                                <option value="{{ $bendaharaitem->id_pegawai }}" {{ $data->bendahara == $bendaharaitem->id_pegawai ? 'selected' : '' }}>
                                    {{ $bendaharaitem->nama_pegawai }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tujuan_setoran" class="col-sm-2 col-form-label">Tujuan Setoran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='tujuan_setoran' id="tujuan_setoran" value="{{ $data->tujuan_setoran }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bank_setoran" class="col-sm-2 col-form-label">Bank Setoran</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='bank_setoran' id="bank_setoran" value="{{ $data->bank_setoran }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat_bank" class="col-sm-2 col-form-label">Alamat Bank</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='alamat_bank' id="alamat_bank" value="{{ $data->alamat_bank }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="saksi1" class="col-sm-2 col-form-label">Saksi 1</label>
                <div class="col-sm-10">
                    <select name="saksi1" id="saksi1" class="form-select">
                        <option value="">--Pilih--</option>
                            @foreach ($datasaksi1 as $saksi1item)
                                <option value="{{ $saksi1item->id_pegawai }}" {{ $data->saksi1 == $saksi1item->id_pegawai ? 'selected' : '' }}>
                                    {{ $saksi1item->nama_pegawai }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="saksi2" class="col-sm-2 col-form-label">Saksi 2</label>
                <div class="col-sm-10">
                    <select name="saksi2" id="saksi2" class="form-select">
                        <option value="">--Pilih--</option>
                            @foreach ($datasaksi2 as $saksi2item)
                                <option value="{{ $saksi2item->id_pegawai }}" {{ $data->saksi2 == $saksi2item->id_pegawai ? 'selected' : '' }}>
                                    {{ $saksi2item->nama_pegawai }}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="arsip" class="col-sm-2 col-form-label">Arsip</label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" name="arsip" id="arsip" placeholder="Masukkan tautan Google Drive " value="{{ old('arsip', $data->arsip) }}">
                    <div>
                        @if($data->arsip)
                             <small class="text-muted">Tautan arsip sebelum di edit : </small>
                            <a href="{{ $data->arsip }}" target="_blank">{{ $data->arsip }}</a>
                        @endif
                    </div>
                    <small class="text-muted">Contoh tautan Google Drive: https://drive.google.com/your-link-here</small>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-10">
                    <button type="submit" name="submit" style="border: none; background: #789461; display: flex; align-items: center; border-radius:5px; padding: 10px; width: 90px;">
                        <i class="fa-solid fa-bookmark" style="font-size: 18px; color:white;"></i>
                        <span style="margin-left: 5px; color:white;">Simpan</span>
                    </button>
                </div>
            </div>    
        </div>
    </form>
    <!-- AKHIR FORM --> 

</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $('#terdakwa').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#hari').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#jaksa').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#bendahara').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#saksi1').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });

        $('#saksi2').select2({
            placeholder: '--Pilih--',
            allowClear: true,
            width: 'resolve',
            tags: false, // Tidak memungkinkan input baru (tags)
            minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
        });
    });
</script>

</body>        
       
</div>
</div>
@endsection
