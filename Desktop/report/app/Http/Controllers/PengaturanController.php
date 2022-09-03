<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Nilaimapel;
use App\Models\Pesertakelas;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function pengaturan()
    {

        $raport = Pesertakelas::query()
            ->join('siswa', 'siswa.id', '=', 'pesertakelas.siswa_id')
            ->join('kelasmi', 'kelasmi.id', '=', 'pesertakelas.kelasmi_id')
            ->join('kelas', 'kelas.id', '=', 'kelasmi.kelas_id')
            ->select('pesertakelas.id', 'siswa.nama_siswa', 'kelas.kelas')
            ->get();
        return view('pengaturan/pengaturan', ['raport' => $raport]);
    }
}
