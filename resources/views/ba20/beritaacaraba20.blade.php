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
        <th style="text-align: end">BA-20</th>
      </tr>
      <tr>
        <th style="text-align: start">Berdasarkan Ketuhanan Yang Maha Esa" </th>
      </tr>    
    </table>
  </div>

  <div class="container" style="text-align: center">
    <p style="margin-bottom: 0%; margin-top:10px">BERITA ACARA</p>
    <p><u>PENGEMBALIAN BARANG BUKTI</u></p>
  </div>

  <br>

  <div class="container">
    <p>&nbsp; &nbsp; &nbsp; &nbsp; Pada hari ini {{ $dataFilter->hari }} tanggal {{ \Carbon\Carbon::parse($dataFilter->tanggal)->locale('id')->isoFormat('D MMMM Y') }} bertempat di Kantor Kejaksaan Negeri Sijunjung, kami :</p>
  </div>

  <div class="container" style="margin-left: 30px">
    <table style="width: 100%">
      <tr>
        <th width="3%">1.</th>
        <th width="20%">Nama</th>
        <th witdh="2%">:</th>
        <th width="75%">{{ $dataFilter->jaksa_nama }}</th>
      </tr>
      <tr>
        <th width="3%"></th>
        <th width="20%">Pangkat/NIP.</th>
        <th witdh="2%">:</th>
        <th width="75%">{{ $dataFilter->jaksa_pangkat }} / {{ $dataFilter->jaksa_nip }}</th>
      </tr>
      <tr>
        <th width="3%"></th>
        <th width="20%">Jabatan</th>
        <th witdh="2%">:</th>
        <th width="75%">Jaksa Penuntut Umum</th>
      </tr> 
    </table>
  </div>

  <div class="container">
    <p style="margin-top: 20px">berdasarkan:</p>
    <table style="width: 100%">
      <tr>
        <th width="3%" style="vertical-align: top">1.</th>
        <th width="97%" style="text-align: justify">Surat Perintah Kepala Kejaksaan Negeri Sijunjung Nomor {{ $dataFilter->terdakwa_print_p48 }}
          tanggal {{ \Carbon\Carbon::parse($dataFilter->tgl_p48)->locale('id')->isoFormat('D MMMM Y') }} dalam perkara atas nama terdakwa/terpidana {{ $dataFilter->terdakwa_nama }}
          melanggar Pasal {{ $dataFilter->terdakwa_pasal }}.
        </th>
      </tr>
      <tr>
        <th width="3%" style="vertical-align: top">2.</th>
        <th width="97%" style="text-align: justify">Bahwa Barang bukti tersebut tidak diperlukan lagi untuk <s>kepentingan penyelidikan</s>/penuntutan
          karena perkaranya <s>dihentikan penyidikan/penuntutannya/dikesampingkan untuk kepentingan umum</s>/untuk
          pelaksanaan Putusan Pengadilan Negeri Muaro Nomor: {{ $dataFilter->terdakwa_no_putusan }} Tanggal {{ \Carbon\Carbon::parse($dataFilter->terdakwa_tgl_putusan)->locale('id')->isoFormat('D MMMM Y') }}
          telah mengembalikan barang bukti berupa : 
        </th>
      </tr>
    </table>
  </div>

  <div class="container">
    <table style="width: 100%">
      <tr>
        <th width="3%" style="vertical-align: top"></th>
        <th width="97%" style="text-align: justify">{!! $dataFilter->barang_bukti_ba20 !!}</th>
      </tr>
    </table>
  </div>


  <div class="container">
    <table style="width: 100%">
      <tr>
        <th width="3%" style="vertical-align: top;"></th>
        <th width="97%" style="text-align: justify">Dikembalikan kepada {{ $dataFilter->dikembalikan }}</th>
      </tr>
    </table>
  </div>

  <div class="container">
    <table>
      <tr>
        <th width="12%"></th>
        <th width="15%">Nama</th>
        <th width="2%">:</th>
        <th width="79%" style="text-align: justify">{{ $dataFilter->nama_penerima }}</th>
      </tr>
      <tr>
        <th width="12%"></th>
        <th width="15%">Pekerjaan</th>
        <th width="2%">:</th>
        <th width="79%" style="text-align: justify">{{ $dataFilter->pekerjaan_ba20 }}</th>
      </tr>
      <tr>
        <th width="12%"></th>
        <th width="15%">Alamat</th>
        <th width="2%">:</th>
        <th width="79%" style="text-align: justify">{{ $dataFilter->alamat_ba20 }}</th>
      </tr>
    </table>
  </div>

  <br>

  <div class="container">
    <p style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; Demikian Berita Acara ini dibuat dengan sebenarnya atas kekuatan sumpah
      jabatan, kemudian ditutup dan ditanda tangani pada hari dan tanggal tersebut di atas.
    </p>
  </div>
  
    <div class="container" style="margin-top: 20px">
      <table style="width: 100%; border-collapse: collapse;">
          <tr>
              <th style="width: 50%; text-align: center; padding: 8px; vertical-align: top;">Yang menerima,</th>
              <th style="width: 50%; text-align: center; padding: 8px;">Yang mengembalikan<br>Jaksa Penuntut Umum</th>
          </tr>
          <tr>
            <th style="width: 50%; text-align: center; padding-top: 80px;"></th>
            <th style="width: 50%; text-align: center; padding-top: 80px;"></th>
        </tr>
        <tr>
          <th style="width: 50%; text-align: center; vertical-align: top;"><strong><u>{{ $dataFilter->nama_penerima }}</u></strong></th>
          <th style="width: 50%; text-align: center;"><strong><u>{{ $dataFilter->jaksa_nama }}</u></strong><br>{{ $dataFilter->jaksa_pangkat }} / {{ $dataFilter->jaksa_nip }}</th>
      </tr>
      </table>
    </div>

    <div class="container" style="margin-top: 20px">
      <table style="width: 100%; border-collapse: collapse;">
          <tr>
              <th style="width: 80%; text-align: center; padding-top: 8px;">Diketahui oleh : </th>
          </tr>
          <tr>
            <th style="width: 80%; text-align: center;">Kepala Seksi Pengelolaan B. Bukti dan B. Rampasan</th>
          </tr>
          <tr>
            <th style="width: 80%; text-align: center; padding-top: 80px;"></th>
          </tr>
          <tr>
            <th style="width: 80%; text-align: center;"><strong><u>{{ $dataFilter->kasi_bb_nama }}</u></strong>
            <br>{{ $dataFilter->kasi_bb_pangkat }} / {{ $dataFilter->kasi_bb_nip }}</th>
          </tr>
      </table>
    </div>

    <br>

    <div class="container">
      <table style="width: 100%; border-collapse: collapse;">
        <p style="margin-bottom: 0%">Saksi-saksi :</p>
        <tr>
          <th width="3%">1.</th>
          <th width="40%">{{ $dataFilter->saksi1_nama}}</th>
          <th>(..............................)</th>
        </tr>
        <tr>
          <th width="3%">2.</th>
          <th width="40%">{{ $dataFilter->saksi2_nama}}</th>
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