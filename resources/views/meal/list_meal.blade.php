@extends('admin.dashboard')
@section('dashboard_layout')
<table class="table-fixed w-full text-center text-[#282222] font-semibold border-2 border-[#282222] border-collapse">
    <thead class="text-[12px] bg-[#282222] text-[#FFFDF6] h-[45px]">
        <tr>
            <th>Meal Name</th>
            <th>Meal Ingredients</th>
            <th>Meal Image</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach ($meals as $meal)
    <tbody class="text-[10px] h-[85px]">
        <tr class="border-2 border-[#282222] break-words">
            <td>{{ $meal->name }}</td>
            <td>{{ $meal->ingredient }}</td>
            <div class="flex justify-center items-center w-full">
                <td><img class="h-[120x] w-[120px] object-fill m-auto" src="{{ asset('storage/'.$meal->path)  }}"
                        alt="meal-image">
                </td>
            </div>
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
@endsection