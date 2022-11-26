@extends('layout.main')
@section('component_content')
@foreach($meals as $meal)
<div class="card w-96 bg-base-100 shadow-xl">
    <figure><img src="{{ asset( 'storage/' . $meal->path) }}" alt="Meal-image" /></figure>
    <div class="card-body">
        <h2 class="card-title">{{$meal->name }}</h2>
        <p>{{ $meal->ingredient }}</p>
        <div class="card-actions justify-end">
            <a href="{{ route('meal.edit', $meal->id)}}" class="btn btn-primary">Edit</a>
            <form action="{{ route('meal.destroy', $meal->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-secondary" type="submit">Delete</button>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection