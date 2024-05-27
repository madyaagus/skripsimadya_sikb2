<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
  
  <style>
    body {
      margin-top: 50px; /* Sesuaikan besarnya margin sesuai kebutuhan */
      margin-bottom: 50px;
    }

    .gambar {
      width: 130px; /* Lebar gambar 100% dari parent (col-md-4) */
      height: 130px;
      
      /* height: auto;  */
    }

    .container2 {
      text-align: center; /* Meletakkan teks di tengah */
      font-size: 30px;
    }
    
    .container{
      text-align: start;
    }
    /* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
     */
    
    .subjudul {
      text-align: center;
      font-size: 18px; /* Ukuran font untuk judul */
    }

     .alamat {
      font-size: 14px; /* Ukuran font untuk alamat */
    }
    
    .garis1{
    border-top:3px solid black;
    height: 2px;
    border-bottom:1px solid black;
    }

    .global{
      font-family: 'Roboto', sans-serif;
    }

    th {
      font-weight: normal; /* Menghilangkan bold pada elemen <th> */
      text-align: left; /* Menetapkan teks pada elemen <th> menjadi rata kiri */
    }

    .container3 {
      text-align: center; /* Meletakkan teks di tengah */
    }

    td {
      font-weight: normal; /* Menghilangkan bold pada elemen <th> */
      text-align: left; /* Menetapkan teks pada elemen <th> menjadi rata kiri */
      padding-left: 5px;
      vertical-align: top;
    }

    td.keluar-kembali {
      text-align: center;
    }
    
    </style>
</head>
<body>

  <div class="global" style="margin: 30px;">

  <div class="container">
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th class="gambar" width="10%" style="vertical-align: c"><img src="{{ URL::to('assets/img/logo kejaksaan.png') }}" alt="Gambar" class="gambar"></th>
        <th width="90%">
          <h3 style="text-align: center"><b>KEJAKSAAN AGUNG RI</b></h3>
          <h3 style="text-align: center"><b>KEJAKSAAN TINGGI SUMATERA BARAT</b></h3>
          <h3 style="text-align: center">KEJAKSAAN NEGERI SIJUNJUNG</h3>
          <p class="alamat" style="text-align: center">Jl. Jenderal Sudirman No. 4 , Muaro Sijunjung, Kabupaten Sijunjung. 27511</p>
        </th>
      </tr>
    </table>
        <hr class="garis1">
        <p text-align="center" class="subjudul"><u><b>BERITA ACARA PINJAM PAKAI BARANG BUKTI SIDANG</b></u></p>
  </div>
  
    <br>
 
    <div class="container" style="margin-right: 10px; ">
      <table style="width:100%;">
        <tr>
          <th width=25% style="vertical-align: top">Kepada</th>
          <th width=5% style="vertical-align: top">:</th> 
          <th width=70% style="vertical-align: top"> Kasi Pengelolaan Barang Bukti dan Barang Rampasan Kejaksaan Negeri Sijunjung</th>
        </tr>
        <tr>
          <th width=25% style="vertical-align: top">Dari JPU</th>
          <th width=5% style="vertical-align: top">:</th> 
          <th width=70% style="vertical-align: top">{{ $dataFilter->jaksa_nama }}</th>
        </tr>
        <tr>
          <th width=25% style="vertical-align: top">Tanggal</th>
          <th width=5% style="vertical-align: top">:</th> 
          <th width=70% style="vertical-align: top">{{ \Carbon\Carbon::parse($dataFilter->tgl_peminjaman)->locale('id')->isoFormat('D MMMM Y') }}</th>
        </tr>
        <tr>
          <th width=25% style="vertical-align: top">Sifat</th>
          <th width=5% style="vertical-align: top">:</th> 
          <th width=70% style="vertical-align: top">Biasa</th>
        </tr>
        <tr>
          <th width=25% style="vertical-align: top">Perihal</th>
          <th width=5% style="vertical-align: top">:</th> 
          <th width=70% style="vertical-align: top">Pengeluaran Pinjam Pakai Barang Bukti Sidang</th>
        </tr>
      </table>
    </div>

    <br>

    <div>
<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Sehubungan dengan Jadwal Persidangan pada hari {{ \Carbon\Carbon::parse($dataFilter->tgl_peminjaman)->locale('id')->isoFormat('dddd') }} tanggal {{ \Carbon\Carbon::parse($dataFilter->tgl_peminjaman)->locale('id')->isoFormat('D MMMM Y') }} atas nama terdakwa sebagai berikut :
      </p>
    </div>

    <div class="container">
      <table border="1" style="width:100%; text-align:center;">
            <thead>
                <tr>
                  <th width="3%" rowspan="2" style="text-align: center">No.</th>
                  <th width="20%" rowspan="2" style="text-align: center">Nama Terdakwa</th>
                  <th width="17%" rowspan="2" style="text-align: center">Pasal</th>
                  <th width="37%" rowspan="2" style="text-align: center">Barang Bukti</th>
                  <th width="15%" colspan="2" style="text-align: center">Paraf dan Jam</th>
                  <th width="8%"rowspan="2" style="text-align: center">Ket</th>
                </tr>
                <tr>
                  <td class="keluar-kembali">Keluar</td>
                  <td class="keluar-kembali">Kembali</td>
                </tr>
            </thead>

            <tbody>
              <?php $i = 1; ?>
                  <tr>
                      <td>{{ $i }}</td>
                      <td>{{$dataFilter->terdakwa_nama }}</td>
                      <td>{{$dataFilter->terdakwa_pasal }}</td>
                      <td>{!! $dataFilter->terdakwa_barang_bukti !!}</td>
                      <td></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <?php $i++ ?>

          </tbody>
      </table>
    </div>

    <div class="container">
      <tr>Untuk itu kami memohon agar mengeluarkan barang bukti tersebut diatas untuk dibawa kepersidangan. 
      </tr> <br>
      <tr>Demikian kami sampaikan untuk menjadi maklum.</tr>
    </div>

    <div class="container" style="margin-top: 20px">
      <table style="width: 100%; border-collapse: collapse;">
          <tr>
              <th style="width: 50%; text-align: center; padding: 8px;">PETUGAS BARANG BUKTI</th>
              <th style="width: 50%; text-align: center; padding: 8px;">JAKSA PENUNTUT UMUM</th>
          </tr>
          <tr>
            <th style="width: 50%; text-align: center; padding-top: 80px;"><strong><u>{{$dataFilter->petugas_bb_nama }}</u></strong></th>
            <th style="width: 50%; text-align: center; padding-top: 80px;"><strong><u>{{$dataFilter->jaksa_nama }}</u></strong></th>
        </tr>
        <tr>
          <th style="width: 50%; text-align: center;">{{$dataFilter->petugas_bb_pangkat }} / NIP {{$dataFilter->petugas_bb_nip }}</th>
          <th style="width: 50%; text-align: center;">{{$dataFilter->jaksa_pangkat }} / NIP {{$dataFilter->jaksa_nip }}</th>
      </tr>
      </table>
    </div>

    <div class="container" style="margin-top: 20px">
      <table style="width: 100%; border-collapse: collapse;">
          <tr>
              <th style="width: 80%; text-align: center; padding-top: 8px;"><strong>Mengetahui,</strong></th>
          </tr>
          <tr>
            <th style="width: 80%; text-align: center;">KEPALA SEKSI PENGELOLAAN BARANG BUKTI DAN BARANG RAMPASAN</th>
          </tr>
          <tr>
            <th style="width: 80%; text-align: center; padding-top: 80px;"><strong><u>{{$dataFilter->kasi_bb_nama }}</u></strong></th>
          </tr>
          <tr>
            <th style="width: 80%; text-align: center;">{{$dataFilter->kasi_bb_pangkat }} / NIP {{$dataFilter->kasi_bb_nip }}</th>
          </tr>
      </table>
    </div>

  </div>

  <script type="text/javascript">
    window.print();
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>