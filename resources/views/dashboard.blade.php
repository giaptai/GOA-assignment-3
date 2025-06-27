{{-- kế thừa --}}
@extends('layouts.main')

@section('main-content')
     <div class="sm:w-md md:w-2xl lg:w-full block">
        <x-chartjs-component :chart="$chart" />
    </div>
@endsection
