<!DOCTYPE html>
<html>
<head>
    <title>Rekapan Data Pemusnahan(BA-23)</title>
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
            width: 16%;
        }

        th:nth-child(3) { /* Lebar kolom BARANG BUKTI */
            width: 39%;
        }

        th:nth-child(4) { /* Lebar kolom JENIS PERKARA */
            width: 36%;
        }

        th:nth-child(5) { /* Lebar kolom JUMLAH BARANG */
            width: 6%;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }

        td:nth-child(5) {
            text-align: center;
        }

        th {
            font-weight: normal;
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

<h3>DAFTAR BARANG BUKTI YANG DIMUSNAHKAN</h3>
@if($start_date && $end_date)
    <h4>PADA TANGGAL {{ \Carbon\Carbon::parse($start_date)->locale('id')->isoFormat('DD MMMM YYYY') }} s.d. {{ \Carbon\Carbon::parse($end_date)->locale('id')->isoFormat('DD MMMM YYYY') }}</h4>
@endif

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA TERPIDANA, NO. DAN TGL PUTUSAN</th>
                <th>BARANG BUKTI</th>
                <th>JENIS PERKARA</th>
                {{-- <th>JUMLAH BARANG</th> --}}
            </tr>
            <tr class="no-bold">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            @foreach ($dataFilter as $item)
                <tr style="vertical-align: top">
                    <td>{{ $i }}</td>
                    <td><strong>{{ $item->terdakwa_nama }}</strong>, Putusan Pengadilan Tinggi Padang nomor : {{ $item->terdakwa_no_putusan }} tanggal {{ \Carbon\Carbon::parse($item->terdakwa_tgl_putusan)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                    <td>{!! $item->terdakwa_barang_bukti !!}</td>
                    <td>Pasal : {{ $item->terdakwa_pasal }}<br>Putusan : {{ $item->terdakwa_putusan_penahanan }}</td>
                    {{-- <td>{{ $item-> }}</td> --}}
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