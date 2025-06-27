{{-- kế thừa --}}
@extends('layouts.main')

@section('main-content')
    <div class="flex gap-x-1.5">
        <div class="flex flex-col grow">
            <h1 class="text-center text-4xl font-semibold mb-4">Top 10 khối A</h1>

            {{-- Bọc trong container có overflow --}}
            <div class="overflow-y-auto w-full">
                <table class="table-fixed w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                STT</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                SBD</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                Toán
                            </th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                Vật lý</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                Hóa học</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($top10 as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 truncate">{{ $student->sbd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $student->toan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $student->ngu_van }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $student->ngoai_ngu }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-gray-500 italic py-2">No data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- //*Chart Library: https://github.com/icehouse-ventures/laravel-chartjs --}}
@endsection
