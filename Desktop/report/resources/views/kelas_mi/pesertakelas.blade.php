<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Kelas : {{$datakelasmi->kelas}}
        </h2>
    </x-slot>
    <div class="px-4 py-2">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">

                    <div class=" grid grid-cols-4">
                        <div>Kelas</div>
                        <div>: {{$datakelasmi->kelas}}</div>
                        <div>Kuota</div>
                        <div>: {{$datakelasmi->kuota}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class=" grid grid-cols-1 gap-1 py-1 justify-items-end">
                        <div>
                            <a href="/pesertakolektif">
                                <button class=" bg-blue-600 text-white rounded-sm px-2 py-1 "> Kolektif</button>
                            </a>
                            <a href="/kelas_mi">
                                <button class=" bg-blue-600 text-white rounded-sm px-2 py-1 "> Kembali</button>
                            </a>
                        </div>
                    </div>

                    <Table class=" table w-full">
                        <thead>
                            <tr class="border">
                                <th class=" px-2 border text-center  ">#</th>
                                <th class=" px-2 border text-left">Daftar Peserta </th>
                                <th class=" px-2 border text-left"> Kota Asal </th>
                                <th class=" px-2 border text-center"> Kelas </th>
                                <th class=" px-2 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($dataKelas->count())
                            @foreach($dataKelas as $list)
                            <tr class=" hover:bg-gray-100 ">
                                <td class=" border px-2 w-10">
                                    {{$loop->iteration}}
                                </td>
                                <td class=" border px-2">
                                    {{$list->nama_siswa}}
                                </td>
                                <td class=" border px-2">
                                    {{$list->kota_asal}}
                                </td>
                                <td class=" border px-2 text-center ">
                                    {{$list->kelas}}
                                </td>
                                <td class=" border px-2 w-5">
                                    <form action="/pesertakelas/{{$list->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="  bg-red-600 py-1 px-2 text-white hover:bg-purple-600 rounded-md "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class=" border text-center" colspan="4">
                                    Tidak ada Data ditemukan !!!
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </Table>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>