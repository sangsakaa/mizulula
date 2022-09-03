<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kelasmi;
use App\Models\Periode;
use App\Models\Pesertakelas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KelasmiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPeriode = Periode::orderBy('periode')->get();
        $dataKelas = Kelas::query()
            ->join('periode', 'periode.id', '=', 'kelas.periode_id')
            ->select('kelas.kelas', 'kelas.id', 'periode.periode', 'periode.ket_periode',)
            ->get();
        $kelasMI = Kelasmi::query()
            ->join('periode', 'periode.id', '=', 'kelasmi.periode_id')
            ->leftjoin('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->select('kelasmi.id', 'kelasmi.kelas_id', 'periode.periode', 'periode.ket_periode', 'kuota', 'kelas.kelas')
            ->get();
        // dd($kelasMI);
        return view('kelas_mi/kelas_mi', ['kelasMI' => $kelasMI,  'dataKelas' => $dataKelas, 'dataPeriode' => $dataPeriode]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataKelas = Kelas::all();
        return view('kelas_mi/addkelas_mi', ['dataKelas' => $dataKelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas = new Kelasmi();
        $kelas->kelas_id = $request->kelas_id;
        $kelas->periode_id = $request->periode_id;
        $kelas->kuota = $request->kuota;
        $kelas->save();
        return redirect('kelas_mi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kelasmi $kelasmi)

    {
        // dd($kelasmi);
        $datakelasmi = Kelasmi::query()
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->find($kelasmi)->first();
        $dataKelas = Pesertakelas::query()
            ->join('siswa', 'siswa.id', '=', 'pesertakelas.siswa_id')
            ->join('kelasmi', 'kelasmi.id', '=', 'pesertakelas.kelasmi_id')
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->select('siswa.nama_siswa', 'siswa.kota_asal', 'pesertakelas.id', 'kelas.kelas')
            ->where('pesertakelas.kelasmi_id', $kelasmi->id)
            ->get();

        return view(
            'kelas_mi/pesertakelas',
            [
                'dataKelas' => $dataKelas,
                'datakelasmi' => $datakelasmi,
                'kelasmi' => $kelasmi
            ]
        );
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
    public function destroy(Kelasmi $kelasmi)
    {
        Kelasmi::destroy($kelasmi->id);
        return redirect()->back();
    }
    public function hapus(Pesertakelas $pesertakelas)
    {
        Pesertakelas::destroy($pesertakelas->id);
        return redirect()->back();
    }
}
