<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengaturan') }}
        </h2>
    </x-slot>
    <div class=" grid grid-cols-2 gap-2 px-2 py-2">
        <div class="">
            <div class=" mx-auto ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" bg-white border-b border-gray-200">
                        <div class=" p-6 grid grid-cols-1">
                            <span>form </span>
                            <form action="/siswa" method="post">
                                @csrf
                                <label for="">Nama lengkap</label>
                                <input name="nama" type="text" class=" w-full py-1 rounded-md" placeholder=" masukan nama lengkap">
                                <label for="">Jenis Kelamin</label>
                                <select name="jk" id="" class=" w-full py-1 rounded-md">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L"> Laki Laki </option>
                                    <option value="P"> Perempuan </option>
                                </select>
                                <button type="submit" class=" px-2 py-1 bg-blue-600 text-white rounded-md mt-1">Simpan</button>
                                <a href="/siswa" class=" px-2 py-1 bg-red-600 text-white rounded-md mt-1">
                                    Batal
                                </a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class=" mx-auto ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" bg-white border-b border-gray-200">
                        <div class=" p-6 grid grid-cols-1">

                            <table class=" border">
                                <thead class=" border">
                                    <tr>
                                        <th class=" border px-2">#</th>
                                        <th class=" border px-2 text-center">Daftar Raport</th>
                                        <th class=" border px-2 text-center">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($raport as $list)
                                    <tr>
                                        <th class=" border">

                                            <a href="/report/{{$list->id}}"> {{$loop->iteration}}</a>
                                        </th>
                                        <th class=" border px-2 text-left">

                                            <a href="/report/{{$list->id}}"> {{$list->nama_siswa}}</a>
                                        </th>
                                        <th class=" border px-2 text-center">

                                            <a href="/report/{{$list->id}}"> {{$list->kelas}}</a>
                                        </th>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>