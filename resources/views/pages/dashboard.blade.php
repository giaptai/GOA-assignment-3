{{-- kế thừa --}}
@extends('main')

@section('main-content')
    <div class="place-items-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full max-w-screen-xl mx-auto mb-7">
            <div class="card px-6 py-4 shadow-md rounded-md bg-white">
                <div class="card-head">
                    <h3 class="text-lg text-center mb-2 text-gray-500 font-semibold uppercase">TỔNG THÍ SINH</h3>
                </div>
                <div class="card-body border-t border-gray-400">
                    <h4 class="text-center text-[#0f2289] font-bold text-2xl mt-3">{{ number_format($total, 0, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="card px-6 py-4 shadow-md rounded-md bg-white">
                <div class="card-head">
                    <h3 class="text-lg text-center mb-2 text-gray-500 font-semibold uppercase">điểm trung bình</h3>
                </div>
                <div class="card-body border-t border-gray-400">
                    <h4 class="text-center text-[#0f2289] font-bold text-2xl mt-3">{{ number_format($diemTb, 3, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="card px-6 py-4 shadow-md rounded-md bg-white">
                <div class="card-head">
                    <h3 class="text-lg text-center mb-2 text-gray-500 font-semibold uppercase">tổng bài thi</h3>
                </div>
                <div class="card-body border-t border-gray-400">
                    <h4 class="text-center text-[#0f2289] font-bold text-2xl mt-3">
                        {{ number_format($tongBThi, 0, ',', '.') }}</h4>
                </div>
            </div>

            <div class="card px-6 py-4 shadow-md rounded-md bg-white">
                <div class="card-head">
                    <h3 class="text-lg text-center mb-2 text-gray-500 font-semibold uppercase">điểm liệt</h3>
                </div>
                <div class="card-body border-t border-gray-400">
                    <h4 class="text-center text-[#0f2289] font-bold text-2xl mt-3">{{ number_format($failed, 0, ',', '.') }}
                    </h4>
                </div>
            </div>
        </div>

        <div class="sm:w-md md:w-2xl lg:w-10/12 block">
            <x-chartjs-component :chart="$chart" />
        </div>
        <div class="sm:w-md md:w-2xl lg:w-10/12 block">
            <x-chartjs-component :chart="$chartBar" />
        </div>
    </div>
@endsection
