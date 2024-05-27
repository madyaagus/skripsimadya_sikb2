<title>SOP</title>

@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    border: 1px solid #ddd;
                }

                th, td {
                    padding: 20px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }

                th {
                    background-color: #D24545;
                }

                tr:nth-child(even) {
                    background-color: #E4DEBE;
                }

                a {
                    color: #BF3131; /* Anda bisa mengganti "red" dengan warna lain sesuai keinginan */
                }
            </style>

            <h3 style="text-align: center">-- STANDAR OPERASIONAL PROSEDUR --</h3>
            <h3 style="text-align: center">KEJAKSAAN NEGERI SIJUNJUNG</h3>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama SOP</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Contoh data
                    $data = [
                        ['SOP AMBIL BARANG BUKTI', 'https://drive.google.com/file/d/14THxzg12_Cv8F4kPZy2PU0zqttdVKG7U/view?usp=sharing'],
                        ['SOP ANTAR BARANG BUKTI', 'https://drive.google.com/file/d/1PlMeVlGTjzbjV5ujJvx90w0kFwlN7o3h/view?usp=sharing'],
                        ['SOP PEMUSNAHAN', 'https://drive.google.com/file/d/1Lr4rGOCPUg7NeUHAjMK6xyuWKa_0vH8G/view?usp=sharing'],
                        ['SOP TAHAP II (Penerimaan barang bukti dari penyidik)', 'https://drive.google.com/file/d/1101ISL9kSLlOjdyRkQ26j_y-xecmiRSl/view?usp=sharing']
                    ];
            
                    // Nomor awal
                    $no = 1;
            
                    // Loop untuk menampilkan data
                    foreach ($data as $item) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $item[0]; ?></td>
                        <td><a href="<?php echo $item[1]; ?>" target="_blank">Link File </a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            
        </div>          
    </div>
@endsection