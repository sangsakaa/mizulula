<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pesertakelas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::latest()->orderBy('nama_siswa');
        if (request('cari')) {
            $data->where('nama_siswa', 'like', '%' . request('cari') . '%')
                // ->orWhere('jk', 'like', '%' . request('cari') . '%')
                // ->orWhere('tanggal_masuk', 'like', '%' . request('cari') . '%')
                ->orWhere('Kota_asal', 'like', '%' . request('cari') . '%')
                // ->orderby('tanggal_masuk')
                ->orderBy('nama_siswa');
        }
        return view('siswa/siswa', ['dataSiswa' => $data->paginate(20)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa/addsiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $siswa = $request->validate(
        //     [
        //         'nama_siswa' => 'required',
        //     ]
        // );
        $siswa = new Siswa();
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->agama = $request->agama;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->kota_asal = $request->kota_asal;
        $siswa->save();
        return redirect('siswa')->with('success', 'data berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('siswa/detailSiswa', ['siswa' => $siswa]);
    }
    public function biodata(Siswa $siswa)
    {
        return view('siswa/biodata', ['siswa' => $siswa]);
    }
    public function DetailKelas(Siswa $siswa, Kelas $kelas)
    {

        $data = siswa::query()
            ->get();
        $dataKelas = Pesertakelas::query()
            ->join('kelasmi', 'kelasmi.id', '=', 'pesertakelas.kelas_id')
            ->join('periode', 'periode.id', '=', 'kelasmi.periode_id')
            ->join('kelas', 'kelas.id', '=', 'pesertakelas.kelas_id')
            ->join('siswa', 'siswa.id', '=', 'pesertakelas.siswa_id')
            // ->where('Pesertakelas.siswa_id', $siswa->id)
            ->get();
        return view('siswa/detailSiswa', ['detailKelas' => $data, 'siswa' => $siswa, 'dataKelas' => $dataKelas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa/editsiswa', ['siswa' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        Siswa::where('id', $siswa->id)
            ->update([
                'nama_siswa' => $request->nama_siswa,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'kota_asal' => $request->kota_asal,
            ]);
        return redirect('/siswa')->with('update', 'pembaharuan data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);
        return redirect()->back()->with('delete', 'data berhasil dihapus');
    }
}
