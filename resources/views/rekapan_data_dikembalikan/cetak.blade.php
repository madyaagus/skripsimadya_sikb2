<!DOCTYPE html>
<html>
<head>
    <title>Rekapan Data yang Dikembalikan(BA-20)</title>
    <style>
        @page {
            size: landscape;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        h3 {
            text-align: center;
        }

        h4 {
            text-align: center;
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
            width: 16%;
        }

        th:nth-child(4) { /* Lebar kolom JENIS PERKARA */
            width: 15%;
        }

        th:nth-child(5) { /* Lebar kolom JUMLAH BARANG */
            width: 15%;
        }

        th:nth-child(6) { /* Lebar kolom JUMLAH BARANG */
            width: 36%;
        }

        th:nth-child(7) { /* Lebar kolom JUMLAH BARANG */
            width: 10%;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<h3>Rekapan Data yang Dikembalikan(BA-20)</h3>
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
                <th>NAMA PENERIMA</th>
                <th>ARSIP</th>
                <th>STATUS</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            @foreach ($dataFilter as $item)
                <tr style="vertical-align: top">
                    <td>{{ $i }}</td>
                    <td>{{ $item->terdakwa_nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('DD MMMM YYYY') }}</td>
                    <td>{{ $item->jaksa_nama }}</td>
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->arsip }}</td>
                    <td>{{ $item->status_ba20 }}</td>
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