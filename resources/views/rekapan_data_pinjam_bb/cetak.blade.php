<!DOCTYPE html>
<html>
<head>
    <title>Rekapan Data Pinjam Pakai BB untuk Kebutuhan Sidang</title>
    <style>
        @page {
            size: landscape;
        }

        body {
            font-family: arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
            font-size: 14px;
        }

        th:nth-child(1) { /* Lebar kolom NO */
            width: 3%;
        }

        th:nth-child(2) { /* Lebar kolom NAMA TERPIDANA, NO. DAN TGL PUTUSAN */
            width: 15%;
        }

        th:nth-child(3) { /* Lebar kolom BARANG BUKTI */
            width: 10%;
        }

        th:nth-child(4) { /* Lebar kolom JENIS PERKARA */
            width: 10%;
        }

        th:nth-child(5) { /* Lebar kolom JUMLAH BARANG */
            width: 34%;
        }

        th:nth-child(6) { /* Lebar kolom JUMLAH BARANG */
            width: 10%;
        }

        th:nth-child(7) { /* Lebar kolom JUMLAH BARANG */
            width: 6%;
        }

        th:nth-child(8) { /* Lebar kolom JUMLAH BARANG */
            width: 6%;
        }

        th:nth-child(9) { /* Lebar kolom JUMLAH BARANG */
            width: 6%;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }

        h3 {
            text-align: center;
        }

        h4 {
            text-align: center;
        }
    </style>
</head>
<body>

<h3>REKAPAN DATA PINJAM PAKAI BB UNTUK KEBUTUHAN SIDANG</h3>
@if($start_date && $end_date)
    <h4>PADA TANGGAL {{ \Carbon\Carbon::parse($start_date)->locale('id')->isoFormat('DD MMMM YYYY') }} s.d. {{ \Carbon\Carbon::parse($end_date)->locale('id')->isoFormat('DD MMMM YYYY') }}</h4>
@endif


    <br>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA TERDAKWA</th>
                <th>TANGGAL</th>
                <th>JAKSA</th>
                <th>BARANG BUKTI</th>
                <th>PETUGAS BB</th>
                <th>JADWAL AMBIL</th>
                <th>JADWAL KEMBALI</th>
                <th>STATUS</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            @foreach ($dataFilter as $item)
                <tr style="vertical-align: top">
                    <td>{{ $i }}</td>
                    <td>{{ $item->terdakwa_nama }}</td>
                    <td>{{ $item->tgl_peminjaman }}</td>
                    <td>{{ $item->jaksa_nama }}</td>
                    <td>{!! $item->terdakwa_barang_bukti !!}</td>
                    <td>{{ $item->petugas_bb_nama }}</td>
                    <td>{{ $item->jadwal_ambil }}</td>
                    <td>{{ $item->jadwal_kembali }}</td>
                    <td>{{ $item->status_peminjaman }}</td>
                </tr>
                <?php $i++ ?>
            @endforeach
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>
</html>