<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Kelasmi;
use App\Models\Periode;
use App\Models\Pesertakelas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataKelas = Kelas::query()
            ->join('periode', 'periode.id', '=', 'kelas.periode_id')
            ->select('kelas.id', 'kelas.kelas', 'periode.periode', 'periode.ket_periode')

            ->get();
        return view('kelas/kelas', ['DataKelas' => $dataKelas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = Periode::all();
        return view(
            'kelas/addkelas',
            [
                'periode' => $periode
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $kelas = new Kelas();
        $kelas->kelas = $request->kelas;
        $kelas->periode_id = $request->periode_id;
        $kelas->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        Kelas::destroy($kelas->id);
        return redirect()->back();
    }
    public function pesertakolektif()
    {
        $kelas = Kelasmi::query()
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->join('periode', 'periode.id', '=', 'kelasmi.periode_id')
            ->select('kelasmi.id', 'kelas.kelas', 'periode.periode', 'periode.ket_periode')
            ->get();

        $Datasiswa = Siswa::query()
            ->orderBy('jenis_kelamin')
            ->orderBy('nama_siswa')
            ->select('siswa.*')
            ->get();
        return view('kelas_mi/pesertakolektif', ['Datasiswa' => $Datasiswa, 'kelas' => $kelas]);
    }
    public function StoreKolektif(Request $request)
    {
        foreach ($request->siswa as $siswa) {
            $peserta = new Pesertakelas();
            $peserta->siswa_id = $siswa;
            $peserta->kelasmi_id = $request->kelasmi_id;
            $peserta->save();
        }
        return redirect()->back();
    }
}
