<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\terdakwa;
use App\Models\peminjaman_bb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class peminjamanbbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Pencarian data
        // strlen yaitu mengecek apakah ada kata kunci atau tidak
        // or where jika kata kunci nya lebih dari satu jadi ga harus sesuai nim
        // else itu jika 
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        $katakunci = $request->katakunci;
        $jumlahbaris = 10;
        if(strlen($katakunci)){
            $data = peminjaman_bb::leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'peminjaman_bb.terdakwa')
            ->leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'peminjaman_bb.jaksa')
            ->leftJoin('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.petugas_bb')
            ->leftJoin('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
            ->select(
                'peminjaman_bb.*',
                'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                'jaksa_pegawai.nama_pegawai as jaksa_nama',
                'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama',
                'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama'
            )  
            ->where(function($query) use ($katakunci) {
                $query->where('tgl_peminjaman','like',"%$katakunci%")
                ->orWhere('terdakwa_terdakwa.nama_terdakwa','like',"%$katakunci%")
                ->orWhere('jaksa_pegawai.nama_pegawai','like',"%$katakunci%")
                ->orWhere('petugas_bb_pegawai.nama_pegawai','like',"%$katakunci%")
                ->orWhere('kasi_bb_pegawai.nama_pegawai','like',"%$katakunci%")
                ->orWhere('jadwal_ambil','like',"%$katakunci%")
                ->orWhere('jadwal_kembali','like',"%$katakunci%")
                ->orWhere('status_peminjaman','like',"%$katakunci%");
            })->paginate($jumlahbaris);
        } else {
            $data = peminjaman_bb::leftJoin('terdakwa as terdakwa_terdakwa', 'terdakwa_terdakwa.id_terdakwa', '=', 'peminjaman_bb.terdakwa')
            ->leftJoin('pegawai as jaksa_pegawai', 'jaksa_pegawai.id_pegawai', '=', 'peminjaman_bb.jaksa')
            ->leftJoin('pegawai as petugas_bb_pegawai', 'petugas_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.petugas_bb')
            ->leftJoin('pegawai as kasi_bb_pegawai', 'kasi_bb_pegawai.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
            ->select(
                'peminjaman_bb.*',
                'terdakwa_terdakwa.nama_terdakwa as terdakwa_nama',
                'jaksa_pegawai.nama_pegawai as jaksa_nama',
                'petugas_bb_pegawai.nama_pegawai as petugas_bb_nama',
                'kasi_bb_pegawai.nama_pegawai as kasi_bb_nama'
            )
            ->orderBy('tgl_peminjaman', 'desc')->paginate($jumlahbaris);
        }
        return view ('peminjaman_bb.index')->with('data', $data);
        
        // paginate() untuk menampilkan data ga semua nya dibagi gitu
        // $data = contoh::orderBy('nim', 'desc')->paginate(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['terdakwa']=terdakwa::all();
        $data['jaksa'] = pegawai::where('status', 'jaksa')->get();
        $data['petugas_bb'] = pegawai::where('status', 'tata usaha')->get();
        $data['kasi_bb'] = pegawai::where('status', 'jaksa')->get();
        return view ('peminjaman_bb.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('tgl_peminjaman', $request->tgl_peminjaman);
        Session::flash('terdakwa', $request->terdakwa);
        Session::flash('jaksa', $request->jaksa);
        Session::flash('petugas_bb', $request->petugas_bb);
        Session::flash('kasi_bb', $request->kasi_bb);
        Session::flash('jadwal_ambil', $request->jadwal_ambil);
        Session::flash('jadwal_kembali', $request->jadwal_kembali);
        Session::flash('dokumentasi_bon', $request->dokumentasi_bon);
        Session::flash('status_peminjaman', $request->status_peminjaman);

        //contoh itu nama table, dan nim itu nama kolom nya
        $request->validate([ 
            'tgl_peminjaman' => 'required',
            'terdakwa' => 'required',
            'jaksa' => 'required',
            'petugas_bb' => 'required',
            'kasi_bb' => 'required',
            // 'jadwal_ambil' => 'required',
            // 'jadwal_kembali' => 'required',
            // 'status_peminjaman' => 'required',
        ], [ 
            'tgl_peminjaman' => 'Tanggal Peminjaman wajib diisi',
            'terdakwa.required' => 'Terdakwa wajib diisi',
            'jaksa.required' => 'Jaksa wajib diisi',
            'petugas_bb.required' => 'Petugas BB wajib diisi',
            'kasi_bb.required' => 'Kasi BB wajib diisi',
            // 'jadwal_ambil.required' => 'Jadwal Ambil wajib diisi',
            // 'jadwal_kembali.required' => 'Jadwal Kembali wajib diisi',
            // 'status_peminjaman.required' => 'Status wajib diisi',
        ]);

        $data = [
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'terdakwa' => $request->terdakwa,
            'jaksa' => $request->jaksa,
            'petugas_bb' => $request->petugas_bb,
            'kasi_bb' => $request->kasi_bb,
            'jadwal_ambil' => $request->jadwal_ambil,
            'jadwal_kembali' => $request->jadwal_kembali,
            'dokumentasi_bon' => $request->dokumentasi_bon,
            'status_peminjaman' => (
                empty($request->jadwal_ambil) && empty($request->jadwal_kembali) ? 'Diajukan' :
                (!empty($request->jadwal_ambil) && empty($request->jadwal_kembali) ? 'Dipinjam' :
                (!empty($request->jadwal_ambil) && !empty($request->jadwal_kembali) ? 'Dikembalikan' : 'Status Tidak Dikenali'))
            ),
        ];

        
            peminjaman_bb::create($data);
            
            // Redirect dengan pesan sukses
            return redirect()->to('peminjaman_bb')->with('success', 'Berhasil menambahkan data');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataterdakwa = terdakwa::all();
        $datajaksa = pegawai::where('status', 'jaksa')->get();
        $datapetugasbb = pegawai::where('status', 'tata usaha')->get();
        $datakasibb = pegawai::where('status', 'jaksa')->get();
        $data = peminjaman_bb::where('id_peminjaman', $id)->first();
        return view('peminjaman_bb.edit')
                        ->with('data', $data)
                        ->with('dataterdakwa', $dataterdakwa)
                        ->with('datajaksa', $datajaksa)
                        ->with('datapetugasbb', $datapetugasbb)
                        ->with('datakasibb', $datakasibb);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([ 
            'tgl_peminjaman' => 'required',
            'terdakwa' => 'required',
            'jaksa' => 'required',
            'petugas_bb' => 'required',
            'kasi_bb' => 'required',
            // 'jadwal_ambil' => 'required',
            // 'jadwal_kembali' => 'required',
            // 'status_peminjaman' => 'required',
        ], [ 
            'tgl_peminjaman' => 'Tanggal Peminjaman wajib diisi',
            'terdakwa.required' => 'Terdakwa wajib diisi',
            'jaksa.required' => 'TJaksa wajib diisi',
            'petugas_bb.required' => 'Petugas BB wajib diisi',
            'kasi_bb.required' => 'Kasi BB wajib diisi',
            // 'jadwal_ambil.required' => 'Jenis Ambil wajib diisi',
            // 'jadwal_kembali.required' => 'Jadwal Kembali wajib diisi',
            // 'status_peminjaman.required' => 'Status wajib diisi',
        ]);

        $data = [
            'tgl_peminjaman' => $request->tgl_peminjaman,
            'terdakwa' => $request->terdakwa,
            'jaksa' => $request->jaksa,
            'petugas_bb' => $request->petugas_bb,
            'kasi_bb' => $request->kasi_bb,
            'jadwal_ambil' => $request->jadwal_ambil,
            'jadwal_kembali' => $request->jadwal_kembali,
            'dokumentasi_bon' => $request->dokumentasi_bon,
            'status_peminjaman' => (
                empty($request->jadwal_ambil) && empty($request->jadwal_kembali) ? 'Diajukan' :
                (!empty($request->jadwal_ambil) && empty($request->jadwal_kembali) ? 'Dipinjam' :
                (!empty($request->jadwal_ambil) && !empty($request->jadwal_kembali) ? 'Dikembalikan' : 'Status Tidak Dikenali'))
            ),
        ];

            peminjaman_bb::where('id_peminjaman', $id)->update($data);
            return redirect()->to('peminjaman_bb')->with('success', 'Berhasil melakukan update data');
       
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        peminjaman_bb::where('id_peminjaman', $id)->delete();
        return redirect()->to('peminjaman_bb')->with('success', 'Berhasil melakukan delete data');
    }

    public function print($id)
    {
        $dataFilter = peminjaman_bb::join('pegawai as jaksa_pegawai_print', 'jaksa_pegawai_print.id_pegawai', '=', 'peminjaman_bb.jaksa')
            ->join('pangkat as jaksa_pangkat', 'jaksa_pegawai_print.id_pangkat', '=', 'jaksa_pangkat.id_pangkat') // Join dengan tabel pangkat untuk jaksa
            ->join('terdakwa as terdakwa_terdakwa_print', 'terdakwa_terdakwa_print.id_terdakwa', '=', 'peminjaman_bb.terdakwa')
            ->join('pegawai as petugas_bb_pegawai_print', 'petugas_bb_pegawai_print.id_pegawai', '=', 'peminjaman_bb.petugas_bb')
            ->join('pangkat as petugas_pangkat', 'petugas_bb_pegawai_print.id_pangkat', '=', 'petugas_pangkat.id_pangkat') // Join dengan tabel pangkat untuk petugas
            ->join('pegawai as kasi_bb_pegawai_print', 'kasi_bb_pegawai_print.id_pegawai', '=', 'peminjaman_bb.kasi_bb')
            ->join('pangkat as kasi_pangkat', 'kasi_bb_pegawai_print.id_pangkat', '=', 'kasi_pangkat.id_pangkat') // Join dengan tabel pangkat untuk kasi
            ->select(
                'peminjaman_bb.*',
                'terdakwa_terdakwa_print.nama_terdakwa as terdakwa_nama',
                'terdakwa_terdakwa_print.pasal as terdakwa_pasal',
                'terdakwa_terdakwa_print.barang_bukti as terdakwa_barang_bukti',
                'petugas_bb_pegawai_print.nama_pegawai as petugas_bb_nama',
                'petugas_pangkat.nama_pangkat as petugas_bb_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk petugas
                'petugas_bb_pegawai_print.nip as petugas_bb_nip',
                'jaksa_pegawai_print.nama_pegawai as jaksa_nama',
                'jaksa_pangkat.nama_pangkat as jaksa_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk jaksa
                'jaksa_pegawai_print.nip as jaksa_nip',
                'kasi_bb_pegawai_print.nama_pegawai as kasi_bb_nama',
                'kasi_pangkat.nama_pangkat as kasi_bb_pangkat', // Ambil nama_pangkat dari tabel pangkat untuk kasi
                'kasi_bb_pegawai_print.nip as kasi_bb_nip',
            )
            ->where('peminjaman_bb.id_peminjaman', $id)
            ->first();

        return view('peminjaman_bb.nota', compact('dataFilter'));
    }
}
