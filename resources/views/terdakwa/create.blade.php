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

<title>Tambah Data Terdakwa</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
          <body class="bg-light">
            <main class="container">
                @include('komponen.pesan')

                    <!-- START FORM -->
                    <form action='{{ url('terdakwa') }}' method='post'>
                        @csrf 
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <h3 style="background-color:powderblue;">Tambah Data Terdakwa</h3>
                            <a href="{{ url('terdakwa') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-angles-left"></i> Kembali</a>
                            <div class="mb-3 row">
                                <label for="nama_terdakwa" class="col-sm-2 col-form-label">Nama Terdakwa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='nama_terdakwa' id="nama_terdakwa" value="{{ Session::get('nama_terdakwa')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='tempat_lahir' id="tempat_lahir" value="{{ Session::get('tempat_lahir')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='tgl_lahir' id="tgl_lahir" value="{{ Session::get('tgl_lahir')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='umur' id="umur" value="{{ Session::get('umur')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name='jenis_kelamin' id="jenis_kelamin">
                                        <option value="">--Pilih--</option>
                                        <option value="Laki-laki" {{ Session::get('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ Session::get('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="kebangsaan" class="col-sm-2 col-form-label">Kebangsaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='kebangsaan' id="kebangsaan" value="{{ Session::get('kebangsaan')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name='agama' id="agama">
                                        <option value="">--Pilih--</option>
                                        <option value="Islam" {{ Session::get('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Protestan" {{ Session::get('agama') == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                                        <option value="Katolik" {{ Session::get('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ Session::get('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ Session::get('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Khonghucu" {{ Session::get('agama') == 'Islam' ? 'selected' : '' }}>Khonghucu</option>
                                    </select>
                            </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat_terdakwa" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat_terdakwa" id="alamat_terdakwa" class="form-control">{{ Session::get('alamat_terdakwa')}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='pekerjaan' id="pekerjaan" value="{{ Session::get('pekerjaan')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="reg_perkara" class="col-sm-2 col-form-label">Reg Perkara</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='reg_perkara' id="reg_perkara" value="{{ Session::get('reg_perkara')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="reg_bukti" class="col-sm-2 col-form-label">Reg Bukti</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='reg_bukti' id="reg_bukti" value="{{ Session::get('reg_bukti')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_penyitaan" class="col-sm-2 col-form-label">Tanggal Penyitaan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='tgl_penyitaan' id="tgl_penyitaan" value="{{ Session::get('tgl_penyitaan')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_penerimaan_bb" class="col-sm-2 col-form-label">Tanggal Penerimaan BB</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='tgl_penerimaan_bb' id="tgl_penerimaan_bb" value="{{ Session::get('tgl_penerimaan_bb')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pasal" class="col-sm-2 col-form-label">Pasal</label>
                                <div class="col-sm-10">
                                    <textarea name="pasal" id="pasal" class="form-control">{{ Session::get('pasal')}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jaksa1" class="col-sm-2 col-form-label">Jaksa 1</label>
                                <div class="col-sm-10">
                                    <select name="jaksa1" id="jaksa1" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($jaksa1 as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jaksa2" class="col-sm-2 col-form-label">Jaksa 2</label>
                                <div class="col-sm-10">
                                    <select name="jaksa2" id="jaksa2" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($jaksa2 as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_penyidik" class="col-sm-2 col-form-label">Nama Penyidik</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='nama_penyidik' id="nama_penyidik" value="{{ Session::get('nama_penyidik')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pangkat_nrp_penyidik" class="col-sm-2 col-form-label">Pangkat NRP Penyidik</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='pangkat_nrp_penyidik' id="pangkat_nrp_penyidik" value="{{ Session::get('pangkat_nrp_penyidik')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="print_p48" class="col-sm-2 col-form-label">Print P48</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='print_p48' id="print_48" value="{{ Session::get('print_48')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_48" class="col-sm-2 col-form-label">Tanggal P48</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='tgl_p48' id="tgl_p48" value="{{ Session::get('tgl_p48')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="no_putusan" class="col-sm-2 col-form-label">No Putusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='no_putusan' id="no_putusan" value="{{ Session::get('no_putusan')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="tgl_putusan" class="col-sm-2 col-form-label">Tanggal Putusan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name='tgl_putusan' id="tgl_putusan" value="{{ Session::get('tgl_putusan')}}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="barang_bukti" class="col-sm-2 col-form-label">Barang Bukti</label>
                                <div class="col-sm-10">
                                    <textarea name="barang_bukti" id="barang_bukti" class="form-control">{{ Session::get('barang_bukti')}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="status_barang_bukti" class="col-sm-2 col-form-label">Status Barang Bukti</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name='status_barang_bukti' id="status_barang_bukti">
                                        <option value="">--Pilih--</option>
                                        <option value="Tahap II" {{ Session::get('status_barang_bukti') == 'Tahap II' ? 'selected' : '' }}>Tahap II</option>
                                        <option value="Proses Sidang" {{ Session::get('status_barang_bukti') == 'Proses Sidang' ? 'selected' : '' }}>Proses Sidang</option>
                                        <option value="Restorative Justice" {{ Session::get('status_barang_bukti') == 'Restorative Justice' ? 'selected' : '' }}>Restorative Justice</option>
                                        <option value="Inkrah" {{ Session::get('status_barang_bukti') == 'Inkrah' ? 'selected' : '' }}>Inkrah</option>
                                        <option value="Banding" {{ Session::get('status_barang_bukti') == 'Banding' ? 'selected' : '' }}>Banding</option>
                                        <option value="Kasasi" {{ Session::get('status_barang_bukti') == 'Kasasi' ? 'selected' : '' }}>Kasasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="status_eksekusi" class="col-sm-2 col-form-label">Status Eksekusi</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name='status_eksekusi' id="status_eksekusi">
                                        <option value="">--Pilih--</option>
                                        <option value="Eksekusi" {{ Session::get('status_eksekusi') == 'Eksekusi' ? 'selected' : '' }}>Eksekusi</option>
                                        <option value="Dalam proses" {{ Session::get('status_eksekusi') == 'Dalam proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan_eksekusi" class="col-sm-2 col-form-label">Keterangan Eksekusi</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan_eksekusi" id="keterangan_eksekusi" class="form-control">{{ Session::get('keterangan_eksekusi')}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="keterangan_putusan" class="col-sm-2 col-form-label">Keterangan Putusan</label>
                                <div class="col-sm-10">
                                    <textarea name="keterangan_putusan" id="keterangan_putusan" class="form-control">{{ Session::get('keterangan_putusan')}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="petugas_bb" class="col-sm-2 col-form-label">Petugas BB</label>
                                <div class="col-sm-10">
                                    <select name="petugas_bb" id="petugas_bb" class="form-select">
                                        <option value="">--Pilih--</option>
                                        @foreach ($petugas_bb as $data)
                                            <option value="{{ $data->id_pegawai }}">{{ $data->nama_pegawai }}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="mb-3 row">
                                <label for="petugas_bb" class="col-sm-2 col-form-label">Petugas BB</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='petugas_bb' id="petugas_bb" value="{{ Session::get('petugas_bb')}}">
                                </div>
                            </div> --}}
                            <div class="mb-3 row">
                                <label for="putusan_penahanan" class="col-sm-2 col-form-label">Putusan Penahanan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name='putusan_penahanan' id="putusan_penahanan" value="{{ Session::get('putusan_penahanan')}}">
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
                    $('#jaksa1').select2({
                        placeholder: '--Pilih--',
                        allowClear: true,
                        width: 'resolve',
                        tags: false, // Tidak memungkinkan input baru (tags)
                        minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
                    });
            
                    $('#jaksa2').select2({
                        placeholder: '--Pilih--',
                        allowClear: true,
                        width: 'resolve',
                        tags: false, // Tidak memungkinkan input baru (tags)
                        minimumResultsForSearch: 1 // Atur ke 1 agar fitur pencarian selalu aktif
                    });
            
                    $('#petugas_bb').select2({
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
                .create(document.querySelector('#barang_bukti'))
                .catch(error => {
                    console.error(error);
                });
        </script>

        </body>        
        </div>
    </div>

@endsection
