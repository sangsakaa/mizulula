<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Kelasmi;
use App\Models\Semester;
use App\Models\Nilaimapel;
use App\Models\Pesertakelas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataMapel = Mapel::all();
        $datSmt = Semester::query()
            ->join('periode', 'periode.id', '=', 'semester.periode_id')
            ->get();
        $dataGuru = Guru::all();
        $dataKelas = Kelasmi::query()
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->join('periode', 'periode.id', '=', 'kelasmi.periode_id')
            ->select('kelas.kelas', 'kelasmi.id', 'kelasmi.id', 'periode.periode', 'ket_periode')
            ->get();
        $data = Nilaimapel::query()
            ->join('kelasmi', 'kelasmi.id', '=', 'nilaimapel.kelasmi_id')
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->join('mapel', 'mapel.id', '=', 'nilaimapel.mapel_id')
            ->join('guru', 'guru.id', '=', 'nilaimapel.guru_id')
            ->join('semester', 'semester.id', '=', 'nilaimapel.semester_id')
            ->join('periode', 'periode.id', '=', 'semester.periode_id')
            ->select('nilaimapel.id', 'periode.periode', 'periode.ket_periode', 'semester.semester', 'kelas.kelas', 'guru.nama_guru', 'mapel.mapel')
            ->get();
        //dd($data);
        return view(
            'nilai/nilaimapel',
            [
                'data' => $data,
                'dataGuru' => $dataGuru,
                'dataKelas' => $dataKelas,
                'dataSmt' => $datSmt,
                'dataMapel' => $dataMapel
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd(Nilai::find($request->nilai_id[$request->pesertakelas[1]]));
        foreach ($request->pesertakelas as $peserta) {
            $nilai_id = $request->nilai_id[$peserta];
            $nilai = $nilai_id ? Nilai::find($nilai_id) : new Nilai();
            $nilai->pesertakelas_id = $peserta;
            $nilai->nilaimapel_id = $request->nilaimapel_id;
            $nilai->nilai_harian = $request->nilai_harian[$peserta];
            $nilai->nilai_ujian = $request->nilai_ujian[$peserta];
            $nilai->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilaimapel $nilaimapel)
    {
        // dd($kelasmi);
        $dataSiswa = Pesertakelas::query()
            ->join('siswa', 'siswa.id', '=', 'pesertakelas.siswa_id')
            ->join('kelasmi', 'kelasmi.id', '=', 'pesertakelas.kelasmi_id')
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->leftJoin('nilai', function ($join) use ($nilaimapel) {
                $join->on('nilai.pesertakelas_id', '=', 'pesertakelas.id')
                    ->where('nilai.nilaimapel_id', '=', $nilaimapel->id);
            })
            ->where('pesertakelas.kelasmi_id', $nilaimapel->kelasmi_id)
            ->select('pesertakelas.id', 'siswa.nama_siswa', 'kelas.kelas', 'nilai.nilai_harian', 'nilai.nilai_ujian', 'nilai.id as nilai_id')
            ->get();

        //$guruKelas = $kelasmi->query()
        // ->join('guru', 'guru.id', '=', 'nilaimapel.guru_id')
        // ->join('mapel', 'mapel.id', '=', 'nilaimapel.mapel_id')
        // ->join('kelas', 'kelas.id', '=', 'nilaimapel.kelasmi_id')
        // ->join('semester', 'semester.id', '=', 'nilaimapel.semester_id')
        // ->join('periode', 'periode.id', '=', 'semester.periode_id')
        // ->select(
        //     [
        //         'nilaimapel.id',
        //         'guru.nama_guru',
        //         'kelas.kelas',
        //         'mapel.mapel',
        //         'periode.periode',
        //         'semester.semester',
        //         'periode.ket_periode'
        //     ]
        // )
        //->find($kelasmi)->first();
        return view(
            'nilai/nilai',
            [
                //'listguru' => $guruKelas,
                'dataSiswa' => $dataSiswa,
                'nilaimapel' => $nilaimapel

            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilaimapel $nilaimapel)
    {
        Nilaimapel::destroy($nilaimapel->id);
        return  redirect()->back();
    }
    public function storeNilaimapel(Request $request)

    {
        // dd($request);
        $kelas = new Nilaimapel();
        $kelas->semester_id = $request->semester_id;
        $kelas->kelasmi_id = $request->kelasmi_id;
        $kelas->guru_id = $request->guru_id;
        $kelas->mapel_id = $request->mapel_id;
        $kelas->save();
        return redirect()->back();
    }
}
