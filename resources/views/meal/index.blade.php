@extends('layout.main')
@section('component_content')
@foreach($meals as $meal)
<div class="card w-96 bg-base-100 shadow-xl">
    <figure><img src="{{ asset( 'storage/' . $meal->path) }}" alt="Meal-image" /></figure>
    <div class="card-body">
        <h2 class="card-title">{{$meal->name }}</h2>
        <p>{{ $meal->ingredient }}</p>
        <div class="card-actions justify-end">
            <button class="btn btn-primary">Order Now</button>
        </div>
    </div>
</div>
@endforeach
@endsection