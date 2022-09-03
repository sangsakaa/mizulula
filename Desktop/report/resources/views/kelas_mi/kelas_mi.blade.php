<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Kelas MI') }}
        </h2>
    </x-slot>
    <div class="p-4">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class=" grid grid-cols-2 justify-items-end">
                        <!-- <a href="/pesertakolektif">
                            <button class=" bg-blue-600 text-white rounded-sm px-2 py-1 "> Kolektif</button>
                        </a> -->
                        <!-- <a href="/addkelas_mi">
                            <button class=" bg-blue-600 text-white rounded-sm px-2 py-1 "> Kelas Mi</button>
                        </a> -->
                    </div>
                    <div class=" w-1/2 ">

                        <div class=" grid grid-cols-1 w-full">
                            <form action="/kelas_mi" method="post">
                                @csrf

                                <select name="kelas_id" id="" class=" px-4 py-1 w-1/4  ">
                                    <option value=""> --- Pilih Kelas --- </option>
                                    @foreach ($dataKelas as $item)
                                    <option value="{{$item->id}}">{{$item->kelas}} {{$item->periode}} - {{$item->ket_periode}}</option>
                                    @endforeach
                                </select>
                                <select name="periode_id" id="" class=" px-2 py-1   ">
                                    <option value=""> -- Pilih Periode -- </option>
                                    @foreach ($dataPeriode as $item)
                                    <option value="{{$item->id}}">{{$item->periode}} - {{$item->ket_periode}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="kuota" class=" py-1 w-1/4 " placeholder=" Kuota Kelas : 40">
                                <button class=" bg-blue-600 text-white rounded-sm px-2 py-1 w-1/4  "> simpan</button>
                            </form>
                        </div>

                        <Table class=" w-full mt-1">
                            <thead>
                                <tr class=" border">
                                    <th>#</th>
                                    <th>Periode</th>
                                    <th>Kelas</th>
                                    <th class=" text-center">Kapasitas</th>
                                    <th class=" text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($kelasMI->count() != null)
                                @foreach ($kelasMI as $item)
                                <tr class=" hover:bg-green-200 border">
                                    <th class=" text-center">{{$loop->iteration}}</th>
                                    <td class=" text-center"> {{$item->periode}} {{$item->ket_periode}}</td>
                                    <td class=" text-center"><a href="/pesertakelas/{{$item->id}}"> {{$item->kelas}}</a></td>
                                    <td class=" text-center"> {{$item->kuota}}|{{$item->Hitung}}</td>
                                    <td class="  text-center py-1 grid grid-cols-1 ">
                                        <form action="/kelas_mi/{{$item->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="  bg-red-600 py-1 px-2 text-white hover:bg-purple-600 rounded-md ">delete</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class=" border text-center" colspan="5">
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
    </div>
</x-app-layout>