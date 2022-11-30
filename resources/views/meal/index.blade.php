<<<<<<< Updated upstream
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
=======
@extends('components.admin')
@section('admin_content')
<table class="table-fixed w-full text-center text-[#282222] font-semibold border-2 border-[#282222] border-collapse">
    <thead class="text-[12px] bg-[#282222] text-[#FFFDF6] h-[45px]">
        <tr>
            <th>Meal Name</th>
            <th>Meal Ingredients</th>
            <th>Meal Image</th>
            <th>Action</th>
            {{-- <th>Phone Number</th>
            <th>Age</th>
            <th>Role</th>
            <th>Action</th> --}}
        </tr>
    </thead>
    @foreach ($meals as $meal)
    <tbody class="text-[10px] h-[85px]">
        <tr class="border-2 border-[#282222] break-words">
            <td>{{ $meal->name }}</td>
            <td>{{ $meal->ingredient }}</td>
            <div class="flex justify-center items-center w-full">
                <td ><img class="h-[120x] w-[120px] object-fill m-auto" src="{{ asset('storage/'.$meal->path)  }}" alt="meal-image"></td>
            </div>
            {{-- <td>{{ $meal->phoneNumber }}</td>
            <td>{{ $meal->age }}</td>
            <td>{{ $meal->role }}</td> --}}
            <td>
                <div class="flex flex-col space-y-[10px] my-[10px]">
                    <a href="{{ route('meal.edit', $meal->id) }}"><button
                            class="w-1/2 h-fit bg-[#4CAF3C] p-[5px] text-[#FFFDF6] duration-700 hover:scale-105">Update</button></a>
                    <form action="{{ route('meal.destroy', $meal->id) }}" method='POST'>
                        @csrf
                        @method('DELETE')
                        <a href="#"><button type="submit"
                                class="w-1/2 h-fit bg-[#AF433C] p-[5px] text-[#FFFDF6] duration-700 hover:scale-105">Delete</button></a>
                    </form>
                </div> <!-- flex -->
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
>>>>>>> Stashed changes
@endsection