@extends('admin.dashboard')
@section('dashboard_admin')
<table class="table-fixed w-full text-center text-[#282222] font-semibold border-2 border-[#282222] border-collapse">
    <thead class="text-[12px] bg-[#282222] text-[#FFFDF6] h-[45px]">
        <tr>
            <th>Owner Name</th>
            <th>Restaurant Name </th>
            <th>Restaurant Contact</th>
            <th>Restaurant Address</th>
            <th>Restaurant Image</th>
            <th>Food Type</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach ($data_partners as $partner)
    <tbody class="text-[10px] h-[85px]">
        <tr class="border-2 border-[#282222] break-words">
            <td>{{ $partner->owner_name }}</td>
            <td>{{ $partner->restaurant_name }}</td>
            <td>{{ $partner->restaurant_contact }}</td>
            <td>{{ $partner->restaurant_address }}</td>
            <div class="flex justify-center items-center w-full">
                <td><img class="h-[120x] w-[120px] object-fill m-auto" src="{{ asset('storage/'.$partner->restaurant_image)  }}"
                        alt="partner-restaurant-image">
                </td>
            </div>
            <td>{{ $partner->food_type }}</td>
            <td>
                <div class="flex flex-col space-y-[10px] my-[10px]">
                    <a href="{{ route('partner_handler.edit', $partner->id) }}"><button
                            class="w-1/2 h-fit bg-[#4CAF3C] p-[5px] text-[#FFFDF6] duration-700 hover:scale-105">Update</button></a>
                    <form action="{{ route('partner_handler.destroy', $partner->id) }}" method='POST'>
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