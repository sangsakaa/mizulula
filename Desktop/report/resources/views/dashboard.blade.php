<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="p-4">
        <div class=" mx-auto ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-2 bg-white border-b border-gray-200">
                    <div class=" grid sm:grid-cols-6 grid-cols-1 gap-2 ">
                        <div class=" bg-blue-500 py-1">
                            <div class=" py-2 grid grid-cols-2 ">
                                <div>
                                    <span class=" px-4 uppercase text-white">Total </span>
                                </div>
                                <div class="  text-white">
                                    <p class=" text-5xl">{{$siswa}}</p>
                                </div>
                            </div>
                        </div>
                        <div class=" bg-blue-500 py-1">
                            <div class=" py-2 grid grid-cols-2 ">
                                <div>
                                    <span class=" px-4 uppercase text-white">Total </span>
                                </div>
                                <div class="  text-white">
                                    <p class=" text-5xl">{{$siswa}}</p>
                                </div>
                            </div>
                        </div>
                        <div class=" bg-blue-500 py-1">
                            <div class=" py-2 grid grid-cols-2 ">
                                <div>
                                    <span class=" px-4 uppercase text-white">Total </span>
                                </div>
                                <div class="  text-white">
                                    <p class=" text-5xl">{{$siswa}}</p>
                                </div>
                            </div>
                        </div>
                        <div class=" bg-blue-500 py-1">
                            <div class=" py-2 grid grid-cols-2 ">
                                <div>
                                    <span class=" px-4 uppercase text-white">Total </span>
                                </div>
                                <div class="  text-white">
                                    <p class=" text-5xl">{{$siswa}}</p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>