<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Peserta Kelas Kolektif Asrama') }}
        </h2>
    </x-slot>
    <div class="p-4">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class=" grid justify-items-end">
                        <a href="asramasiswa">
                            <button class=" flex bg-blue-600 text-white rounded-sm px-2 py-1"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Kembali</button>
                        </a>
                    </div>

                    <form action="/kolektifasrama" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class=" py-1 w-3/5 grid grid-cols-2 gap-2 ">
                            <select name="asramasiswa_id" id="" class=" py-1 w-full" required>
                                <option value="">-- Pilih Sesui kelas --</option>
                                @foreach($kelas as $kelas )
                                <option value="{{$kelas->id}}">{{$loop->iteration}} | {{$kelas->nama_asrama}} |{{$kelas->type_asrama}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class=" w-1/5 bg-blue-600 text-white rounded-sm px-2 py-1"> Kolektif</button>
                        </div>
                        <table class=" w-1/2">
                            <thead>
                                <tr class=" border">
                                    <th><input type="checkbox" name="" id=""></th>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th> JK</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($Datasiswa->count())
                                @foreach ($Datasiswa as $item)
                                <tr class=" border hover:bg-green-200">
                                    <td class=" text-center">
                                        <input type="checkbox" name="siswa[]" value="{{$item->id}}" multiple>
                                    </td>
                                    <td class=" text-center">
                                        {{$loop->iteration}}
                                    </td>
                                    <td class=" text-left">
                                        <label for="">{{ $item->nama_siswa }}</label>
                                    </td>

                                    <td class=" text-center">
                                        <label for="">{{ $item->jenis_kelamin}}</label>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class=" border text-center" colspan="4">
                                        Tidak ada data yang ditemukan
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>