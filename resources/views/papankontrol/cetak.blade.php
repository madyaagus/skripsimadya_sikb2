<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            size: landscape;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        h3 {
            text-align: center;
        }

        th:nth-child(1) { /* Lebar kolom NO */
            width: 5%;
        }

        th:nth-child(2) { /* Lebar kolom NAMA TERPIDANA, NO. DAN TGL PUTUSAN */
            width: 12%;
        }

        th:nth-child(3) { /* Lebar kolom BARANG BUKTI */
            width: 12%;
        }

        th:nth-child(4) { /* Lebar kolom JENIS PERKARA */
            width: 12%;
        }

        th:nth-child(5) { /* Lebar kolom JUMLAH BARANG */
            width: 12%;
        }
        
        th:nth-child(6) { /* Lebar kolom JUMLAH BARANG */
            width: 15%;
        }

        th:nth-child(7) { /* Lebar kolom JUMLAH BARANG */
            width: 15%;
        }

        th:nth-child(8) { /* Lebar kolom JUMLAH BARANG */
            width: 12%;
        }
        
        th:nth-child(9) { /* Lebar kolom JUMLAH BARANG */
            width: 5%;
        }
    </style>
</head>
<body>

<h3>PAPAN KONTROL BARANG BUKTI<br>KEJAKSAAN NEGERI SIJUNJUN</h3>

    <table>
        <thead>
            <tr>
                <th>No Urut</th>
                <th>Nama Terdakwa</th>
                <th>Tanggal</th>
                <th>No. Reg Perkara</th>
                <th>No. Reg Barang Bukti</th>
                <th>Jaksa 1</th>
                <th>Jaksa 2</th>
                <th>Status Barang Bukti</th>
                <th>Ket</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            @foreach ($dataFilter as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->nama_terdakwa }}</td>
                    <td>{{ $item->terdakwa_tgl_peminjaman }}</td>
                    <td>{{ $item->reg_perkara }}</td>
                    <td>{{ $item->reg_bukti }}</td>
                    <td>{{ $item->jaksa1_nama }}</td>
                    <td>{{ $item->jaksa2_nama }}</td>
                    <td>{{ $item->status_barang_bukti }}</td>
                    <td></td>
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