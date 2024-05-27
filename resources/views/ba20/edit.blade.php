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


<title>Edit Data BA 20</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')


    <!-- START FORM -->
    <form action='{{ url('beritaacara/ba20/'.$data->id_ba20) }}' method='post'>
        @csrf 
        @method('PUT')
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h3 style="background-color:powderblue;">Edit Berita Acara Pengembalian</h3>
            <a href="{{ url('beritaacara/ba20') }}" class="btn btn-secondary">
                <i class="fa-solid fa-angles-left"></i> Kembali</a>
               
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
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name='tanggal' id="tanggal" value="{{ $data->tanggal }}">
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
                <label for="dikembalikan" class="col-sm-2 col-form-label">Dikembalikan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='dikembalikan' id="dikembalikan" value="{{ $data->dikembalikan }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama_penerima" class="col-sm-2 col-form-label">Nama Penerima</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name='nama_penerima' id="nama_penerima" value="{{ $data->nama_penerima }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pekerjaan_ba20" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="pekerjaan_ba20" class="form-control" name='pekerjaan_ba20' id="pekerjaan_ba20" value="{{ $data->pekerjaan_ba20 }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat_ba20" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea name="alamat_ba20" id="alamat_ba20" class="form-control">{{ $data->alamat_ba20 }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kasi_bb" class="col-sm-2 col-form-label">Kasi BB</label>
                <div class="col-sm-10">
                    <select name="kasi_bb" id="kasi_bb" class="form-select">
                        <option value="">--Pilih--</option>
                            @foreach ($datakasi_bb as $kasibbitem)
                                <option value="{{ $kasibbitem->id_pegawai }}" {{ $data->kasi_bb == $kasibbitem->id_pegawai ? 'selected' : '' }}>
                                    {{ $kasibbitem->nama_pegawai }}</option>
                            @endforeach
                    </select>
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
                <label for="barang_bukti_ba20" class="col-sm-2 col-form-label">Barang Bukti</label>
                <div class="col-sm-10">
                    <textarea name="barang_bukti_ba20" id="barang_bukti_ba20" class="form-control">{{ $data->barang_bukti_ba20 }}</textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="dokumentasi" class="col-sm-2 col-form-label">Dokumentasi</label>
                <div class="col-sm-10">
                    <input type="url" class="form-control" name="dokumentasi" id="dokumentasi" placeholder="Masukkan tautan Google Drive " value="{{ old('dokumentasi', $data->dokumentasi) }}" value="{{ $data->tgl_peminjaman }}">
                    <div>
                        @if($data->dokumentasi)
                             <small class="text-muted">Tautan dokumentasi sebelum di edit : </small>
                            <a href="{{ $data->dokumentasi }}" target="_blank">{{ $data->dokumentasi }}</a>
                        @endif
                    </div>
                    <small class="text-muted">Contoh tautan Google Drive: https://drive.google.com/your-link-here</small>
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

        $('#kasi_bb').select2({
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

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#barang_bukti_ba20'))
                .catch(error => {
                    console.error(error);
                });
        </script>


</body>        
       
</div>
</div>
@endsection
