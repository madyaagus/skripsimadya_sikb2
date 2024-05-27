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
        <th style="text-align: start;">"Demi Keadilan dan Kebenaran</th>
        <th style="text-align: end">BA-23</th>
      </tr>
      <tr>
        <th style="text-align: start">Berdasarkan Ketuhanan Yang Maha Esa" </th>
      </tr>    
    </table>
  </div>

  <br>

  <div class="container" style="text-align: center">
    <p style="margin-bottom: 0%; margin-top:10px; font-size: 22px;"><strong><u>BERITA ACARA PEMUSNAHAN BARANG BUKTI</u></strong></p>
  </div>

  <br>

  <div class="container">
    <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Pada hari ini {{ $dataFilter->hari }} tanggal {{ \Carbon\Carbon::parse($dataFilter->tgl_ba23)->locale('id')->isoFormat('D MMMM Y') }} bertempat di Kantor Kejaksaan Negeri Sijunjung :</p>
  </div>

  <div class="container" style="margin-left: 30px">
    <table style="width: 100%">
      <tr>
        <th width="7%"></th>
        <th width="13%">Nama</th>
        <th witdh="1%">: </th>
        <th width="79%">{{ $dataFilter->jaksa_nama }}</th>
      </tr>
      <tr>
        <th width="7%"></th>
        <th width="13%">Pangkat/NIP.</th>
        <th witdh="1%">: </th>
        <th width="79%">{{ $dataFilter->jaksa_pangkat }}/{{ $dataFilter->jaksa_nama }}</th>
      </tr>
      <tr>
        <th width="7%"></th>
        <th width="13%">Jabatan</th>
        <th witdh="1%">: </th>
        <th width="79%">Jaksa Penuntut Umum</th>
      </tr> 
    </table>
  </div>

  <br>

  <div class="container">
    <table style="width: 100%">
      <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Berdasarkan Putusan Pengadilan Negeri Muaro Nomor : {{ $dataFilter->terdakwa_no_putusan }}
      tanggal {{ \Carbon\Carbon::parse($dataFilter->terdakwa_tgl_putusan)->locale('id')->isoFormat('D MMMM Y') }} jo Surat Perintah Kepala Kejaksaan Negeri Sijunjung Nomor : {{ $dataFilter->terdakwa_print_p48 }} tanggal {{ \Carbon\Carbon::parse($dataFilter->terdakwa_tgl_p48)->locale('id')->isoFormat('D MMMM Y') }}
      (P - 48) yang amarnya memutuskan/memerintahkan barang bukti dalam perkara atas nama terdakwa <strong>{{ $dataFilter->terdakwa_nama }},</strong> berupa :
    </p>
    </table>
  </div>


  <div class="container">
    <table style="width: 100%">
      <tr>
        <th width="3%" style="vertical-align: top"></th>
        <th width="97%" style="text-align: justify">{!! $dataFilter->barang_bukti_ba23 !!}</th>
      </tr>
    </table>
  </div>

  <div class="container">
    <table style="width: 100%">
      <tr>
        <th width="3%" style="vertical-align: top;"></th>
        <th width="97%" style="text-align: justify">DI RAMPAS UNTUK DIMUSNAHKAN</th>
      </tr>
    </table>
  </div>

  <br>

  <div class="container">
    <p>Sehingga tidak dapat dipergunakan lagi, dengan disaksikan oleh : </p>
  </div>

  <div class="container">
    <table width="100%">
      <tr>
        <th width="2%">1.</th>
        <th width="10%">Nama</th>
        <th width="1%">:</th>
        <th width="62%" style="text-align: justify"><strong>{{ $dataFilter->saksi1_nama }}</strong></th>
      </tr>
      <tr>
        <th width="2%"></th>
        <th width="10%">Pangkat</th>
        <th width="1%">:</th>
        <th width="62%" style="text-align: justify">{{ $dataFilter->saksi1_pangkat }} / {{ $dataFilter->saksi1_nip }}</th>
      </tr>
      <tr>
        <th width="2%"></th>
        <th width="10%">Jabatan</th>
        <th width="1%">:</th>
        <th width="62%" style="text-align: justify">{{ $dataFilter->saksi1_jabatan }}</th>
      </tr>
    </table>
  </div>

  <br>

  <div class="container">
    <table width="100%">
      <tr>
        <th width="2%">2.</th>
        <th width="10%">Nama</th>
        <th width="1%">:</th>
        <th width="62%" style="text-align: justify"><strong>{{ $dataFilter->saksi2_nama }}</strong></th>
      </tr>
      <tr>
        <th width="2%"></th>
        <th width="10%">Pangkat</th>
        <th width="1%">:</th>
        <th width="62%" style="text-align: justify">{{ $dataFilter->saksi2_pangkat }} / {{ $dataFilter->saksi2_nip }}</th>
      </tr>
      <tr>
        <th width="2%"></th>
        <th width="10%">Jabatan</th>
        <th width="1%">:</th>
        <th width="62%" style="text-align: justify">{{ $dataFilter->saksi2_jabatan }}</th>
      </tr>
    </table>
  </div>

  <br>  

  <div class="container">
    <p style="text-align: justify">Telah dilaksanakan pemusnahan Barang Bukti tersebut dengan cara : <strong>Merusak dan Membakar</strong>
      sehingga tidak dapat dipergunakan lagi.
    </p>
  </div>

  <br>

  <div class="container">
    <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Demikian Berita Acara Pemusnahan Barang Bukti ini dibuat dan ditandatangani bersama
      dengan mengingat sumpah jabatan.
    </p>
  </div>
  
    <div class="container" style="margin-top: 20px">
      <table style="width: 100%; border-collapse: collapse;">
          <tr>
              <th style="width: 50%; text-align: center; padding: 8px; vertical-align: top;">Diketahui oleh :<br>Kepala Seksi Pengelolaan B. Bukti dan B.<br>Rampasan</th>
              <th style="width: 50%; text-align: center; padding: 8px; vertical-align: top;">Yang melaksanakan pemusnahan<br>Jaksa Penuntut Umum</th>
          </tr>
          <tr>
            <th style="width: 50%; text-align: center; padding-top: 80px;"></th>
            <th style="width: 50%; text-align: center; padding-top: 80px;"></th>
        </tr>
        <tr>
          <th style="width: 50%; text-align: center; vertical-align: top;"><strong><u>{{ $dataFilter->kasi_bb_nama }}</u></strong></th>
          <th style="width: 50%; text-align: center;"><strong><u>{{ $dataFilter->jaksa_nama }}</u></strong></th>
        </tr>
        <tr>
          <th style="width: 50%; text-align: center; vertical-align: top;">{{ $dataFilter->kasi_bb_pangkat }} / {{ $dataFilter->kasi_bb_nip }}</th>
          <th style="width: 50%; text-align: center;">{{ $dataFilter->jaksa_pangkat }} / {{ $dataFilter->jaksa_nip }}</th>
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