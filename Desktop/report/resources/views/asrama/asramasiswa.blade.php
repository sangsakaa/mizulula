<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Asrama Siswa') }}
        </h2>
    </x-slot>
    <div class="p-4">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class=" flex gap-1">
                        <a href="/addasramasiswa">
                            <button class=" bg-blue-500 text-white p-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </a>
                        <a href="/pesertaasrama">
                            <div class="">
                                <button class=" bg-blue-500 text-white py-1 px-2 rounded-md d-inline-block">
                                    Peserta Asrama
                                </button>
                            </div>
                        </a>
                    </div>
                    <form action="/asramasiswa" method="post">
                        @csrf
                        <div class=" grid grid-cols-1 sm:grid-cols-2 py-2 sm:w-1/2 w-full gap-2 ">
                            <div>
                                <select name="asrama_id" id="" class=" sm:w-full w-full py-1">
                                    <option value=""> -- Pilih Asrama --</option>
                                    @foreach($datasrama as $item )
                                    <option value="{{$item->id}}"> {{$item->nama_asrama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="text" name="kuota" class="sm:w-1/2 w-full py-1 " placeholder=" Kuota : 40">
                                <button class=" bg-blue-600 text-white rounded-md px-2 py-1"> simpan</button>
                            </div>
                        </div>
                    </form>
                    <Table class=" sm:w-1/2  w-full">
                        <thead class=" bg-gray-100">
                            <tr class=" border ">
                                <th class=" text-center px-2 border py-1">#</th>
                                <th class=" text-center px-2 border ">Nama Asrama </th>
                                <th class=" text-center px-2 border ">Asrama </th>
                                <th class=" text-center px-2 border ">Kuota</th>
                                <th class=" text-center px-2 border ">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr class=" border hover:bg-gray-100 ">
                                <td class=" px-2 border text-center">
                                    {{$loop->iteration}}
                                </td>
                                <td class=" px-2 border">
                                    <a href="pesertaasrama/{{$item->id}}">{{$item->nama_asrama}}</a>
                                </td>
                                <td class=" px-2 border text-center">
                                    {{$item->type_asrama}}
                                </td>
                                <td class=" px-2 border text-center">
                                    {{$item->kuota}}
                                </td>
                                <td class="  py-1 px-2 flex">
                                    <form action="/asramasiswa/{{$item->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class=" bg-red-500 text-white p-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </Table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>