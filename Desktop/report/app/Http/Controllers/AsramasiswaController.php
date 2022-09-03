<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\Siswa;
use App\Models\Asramasiswa;
use Illuminate\Http\Request;
use App\Models\Pesertaasrama;
use Illuminate\Routing\Controller;

class AsramasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asrama = Asrama::all();
        $data = Asramasiswa::query()
            ->join('asrama', 'asrama.id', '=', 'asramasiswa.asrama_id')
            ->select('asramasiswa.id', 'asrama.nama_asrama', 'asrama.type_asrama', 'kuota')
            ->get();
        return view('asrama/asramasiswa', ['data' => $data, 'datasrama' => $asrama]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $asrama = Asrama::all();
        return view('asrama/addasramasiswa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asramasiswa = new Asramasiswa();
        $asramasiswa->asrama_id = $request->asrama_id;
        $asramasiswa->kuota = $request->kuota;
        $asramasiswa->save();
        return redirect('asramasiswa')->with('update');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asramasiswa  $asramasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Asramasiswa $asramasiswa)
    {
        $data = Pesertaasrama::query()
            ->join('siswa', 'siswa.id', '=', 'pesertaasrama.siswa_id')
            ->select('pesertaasrama.id', 'siswa.nama_siswa', 'siswa.jenis_kelamin', 'siswa.kota_asal')
            ->where('asramasiswa_id', $asramasiswa->id)
            ->get();
        return view('asrama/pesertaasrama', ['data' => $data, 'asramasiswa' => $asramasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asramasiswa  $asramasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Asramasiswa $asramasiswa)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asramasiswa  $asramasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asramasiswa $asramasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asramasiswa  $asramasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asramasiswa $asramasiswa)
    {
        // dd($asramasiswa);
        Asramasiswa::destroy($asramasiswa->id);
        return redirect()->back();
    }
    public function PesertaAsrama(Pesertaasrama $pesertaasrama)
    {
        // dd($pesertaasrama);
        Pesertaasrama::destroy($pesertaasrama->id);
        return redirect()->back();
    }
    public function kolelktifasrama()
    {
        $kelas = Asramasiswa::query()
            ->join('asrama', 'asrama.id', '=', 'asramasiswa.asrama_id')
            ->select('asrama.nama_asrama', 'asramasiswa.id')
            ->get();

        $Datasiswa = Siswa::query()
            ->leftjoin('pesertaasrama', 'pesertaasrama.id', '=', 'pesertaasrama.siswa_id')
            ->where('pesertaasrama.siswa_id', '=', null)
            ->select('siswa.*')
            ->get();
        return view('asrama/kolektifasrama', ['Datasiswa' => $Datasiswa, 'kelas' => $kelas]);
    }
    public function StoreKolektifasrama(Request $request)
    {
        foreach ($request->siswa as $siswa) {
            $peserta = new Pesertaasrama();
            $peserta->siswa_id = $siswa;
            $peserta->asramasiswa_id = $request->asramasiswa_id;
            $peserta->save();
        }
        return redirect()->back();
    }
}
