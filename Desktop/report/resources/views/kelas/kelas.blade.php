<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Kelas') }}
        </h2>
    </x-slot>
    <div class="p-4">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">

                    <div class=" flex gap-1">
                        <a href="/addkelas">
                            <button class=" bg-blue-500 text-white p-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </a>
                        <a href="/kelas_mi">
                            <div class=" ">
                                <button class=" bg-blue-500 text-white py-1 px-2 rounded-md d-inline-block">
                                    Kelas Mi
                                </button>
                            </div>
                        </a>
                    </div>

                    <Table class=" w-full sm:w-1/2">
                        <thead class=" bg-gray-100">
                            <tr class=" border ">
                                <th class=" py-1">#</th>
                                <th class=" text-left">Kelas</th>
                                <th class=" text-left">Periode</th>
                                <th class=" text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($DataKelas->count() != null)
                            @foreach ($DataKelas as $buah)
                            <tr class=" border hover:bg-green-100">
                                <th class=" text-center">{{$loop->iteration}}</th>
                                <td> {{$buah->kelas}}</td>
                                <td> {{$buah->periode}} {{$buah->ket_periode}}</td>
                                <td class=" text-center py-1">
                                    <form action="/kelas/{{$buah->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class=" bg-red-500 text-white p-1 rounded-md"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td>
                                    Data Tidak ditemukan
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