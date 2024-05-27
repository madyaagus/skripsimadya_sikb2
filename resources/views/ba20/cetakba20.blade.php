<!DOCTYPE html>
<html>
<head>
    <title>Cetak PDF Berita Acara Pengembalian (Ba-20)</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

/* tr:nth-child(even) {
  background-color: #dddddd;
} */

h3{
  text-align: center;
}
</style>

</head>
<body onclick="window:print()">

<h3>Berita Acara Pengembalian (BA-20)</h3>

<table>
  <thead>
    <tr>
      <th>NO</th>
      <th>NAMA TERDAKWA</th>
      <th>HARI</th>
      <th>TANGGAL</th>
      <th>JAKSA</th>
      <th>NAMA PENERIMA</th>
      <th>KASI BB</th>
      <th>SAKSI 1</th>
      <th>SAKSI 2</th>
      <th>STATUS</th>
    </tr>
  </thead>

  <tbody>
    <?php $i = 1; ?>
    @foreach ($data as $item)
    <tr>
      <td>{{ $i }}</td>
      <td>{{ $item->terdakwa_nama }}</td>
      <td>{{ $item->hari }}</td>
      <td>{{ $item->tanggal }}</td>
      <td>{{ $item->jaksa_nama }}</td>
      <td>{{ $item->nama_penerima }}</td>
      <td>{{ $item->kasi_bb_nama }}</td>
      <td>{{ $item->saksi1_nama }}</td>
      <td>{{ $item->saksi2_nama }}</td>
      <td>
        @if($item->arsip !== null)
        Sudah dieksekusi
        @else
        Belum dieksekusi
        @endif
      </td>
    </tr>
    <?php $i++ ?>
    @endforeach
  </tbody>
  
</table>
 
</body>
</html>

