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

    
    </style>
</head>
<body>

  <div class="global" style="margin: 30px;">

    <div class="container">
      <table style="width: 100%; border-collapse: collapse;">
        <tr>
          <th class="gambar" width="10%"><img src="{{ URL::to('assets/img/logo kejaksaan.png') }}" alt="Gambar" class="gambar"></th>
          <th width="90%">
            <h4 style="text-align: center"><b>KEJAKSAAN REPUBLIK INDONESIA</b></h4>
            <h4 style="text-align: center"><b>KEJAKSAAN TINGGI SUMATERA BARAT</b></h4>
            <h1 style="text-align: center"><b>KEJAKSAAN NEGERI SIJUNJUNG</b></h1>
            <p class="alamat" style="text-align: center">Jl. Jenderal Sudirman No. 4 , Muaro Sijunjung, Kabupaten Sijunjung. 27511 <br>
              Telp. (0754) 20036 Fax. (0754) 21220 email: <u style="color: blue">kjrsijunjung@gmail.com</u>
            </p>
          </th>
        </tr>
      </table>
          <hr class="garis1">
          <br>
          <p text-align="center" class="subjudul"><b>BERITA ACARA PENYERAHAN UANG RAMPASAN<br>
            <u>KEPADA BENDAHARAWAN KHUSUS/ PENERIMA</u>
            </b></p>
    </div>

  <br>

  <div class="container">
    <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Pada hari ini {{ $dataFilter->hari }} tanggal {{ \Carbon\Carbon::parse($dataFilter->tgl_bensus)->locale('id')->isoFormat('D MMMM Y') }}.
      Saya <b>{{ $dataFilter->jaksa_nama }}</b> selaku Jaksa Penuntut Umum dalam perkara atas nama terpidana <b>{{ $dataFilter->terdakwa_nama }}</b>
      melanggar Pasal {{ $dataFilter->terdakwa_pasal }} serta peraturan lainnya dengan ini telah menyerahkan Uang rampasan
      sebesar Rp{{ number_format($dataFilter->jumlah_uang, 2, ',', '.') }} ({{ $dataFilter->keterangan_uang }}) Kepada :
  </p>
  </div>

  <div class="container" style="margin-left: 30px">
    <table style="width: 100%">
      <tr>
        <th width="7%"></th>
        <th width="13%">Nama</th>
        <th witdh="1%">: </th>
        <th width="79%">{{ $dataFilter->bendahara_nama }}</th>
      </tr>
      <tr>
        <th width="7%"></th>
        <th width="13%">Pangkat/NIP.</th>
        <th witdh="1%">: </th>
        <th width="79%">{{ $dataFilter->bendahara_pangkat }} / {{ $dataFilter->bendahara_nip }}</th>
      </tr>
      <tr>
        <th width="7%"></th>
        <th width="13%">Jabatan</th>
        <th witdh="1%">: </th>
        <th width="79%">Bendaharawan Khusus / Penerima</th>
      </tr> 
    </table>
  </div>

  <br>

  <div class="container">
    <table style="width: 100%">
      <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Berdasarkan Putusan Pengadilan Negeri Muaro Nomor : {{ $dataFilter->terdakwa_no_putusan }}
      tanggal {{ $dataFilter->tgl_putusan }} berkas perkara atas nama <b>{{ $dataFilter->terdakwa_nama }}</b> alamat {{ $dataFilter->terdakwa_alamat }} yang telah mempunyai kekuatan hukum
      tetap dan uang tersebut agar disetorkan ke {{ $dataFilter->tujuan_setoran }} melalui {{ $dataFilter->bank_setoran }} di {{ $dataFilter->alamat_bank }} sebagai hasil dinas kejaksaan. 
    </p>
    </table>
  </div>

  <br>

  <div class="container">
    <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Demikian Berita Acara ini dibuat dengan sebenarnya kemudian ditutup
      dan ditandatangani pada hari dan tanggal tersebut diatas.
    </p>
  </div>
  
    <div class="container" style="margin-top: 20px">
      <table style="width: 100%; border-collapse: collapse;">
          <tr>
              <th style="width: 50%; text-align: center; padding: 8px; vertical-align: top;">YANG MENERIMA</th>
              <th style="width: 50%; text-align: center; padding: 8px; vertical-align: top;">YANG MENYERAHKAN</th>
          </tr>
          <tr>
            <th style="width: 50%; text-align: center; padding-top: 80px;"></th>
            <th style="width: 50%; text-align: center; padding-top: 80px;"></th>
        </tr>
        <tr>
          <th style="width: 50%; text-align: center; vertical-align: top;"><strong><u>{{ $dataFilter->bendahara_nama }}</u></strong></th>
          <th style="width: 50%; text-align: center;"><strong><u>{{ $dataFilter->jaksa_nama }}</u></strong></th>
        </tr>
        <tr>
          <th style="width: 50%; text-align: center; vertical-align: top;">{{ $dataFilter->bendahara_pangkat }} / {{ $dataFilter->bendahara_nip }}</th>
          <th style="width: 50%; text-align: center;">{{ $dataFilter->jaksa_pangkat }} / {{ $dataFilter->jaksa_nip}} </th>
        </tr>
      </table>
    </div>

    <br>

    <div class="container">
      <table style="width: 100%; border-collapse: collapse;">
        <p style="margin-bottom: 0%">Saksi-saksi :</p>
        <tr>
          <th width="3%">1.</th>
          <th width="40%"><strong>{{ $dataFilter->saksi1_nama }}</strong></th>
          <th>(..............................)</th>
        </tr>
        <tr>
          <th width="3%">2.</th>
          <th width="40%"><strong>{{ $dataFilter->saksi2_nama }}</strong></th>
          <th>(..............................)</th>
        </tr>
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