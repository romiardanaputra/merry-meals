@extends('components.admin')
@section('admin_content')
<table class="table-fixed w-full text-center text-[#282222] font-semibold border-2 border-[#282222] border-collapse">
    <thead class="text-[12px] bg-[#282222] text-[#FFFDF6] h-[45px]">
        <tr>
            <th>Fullname</th>
            <th>Username</th>
            <th>E-mail</th>
            <th>Phone Number</th>
            <th>Age</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    @foreach ($users as $user)
    <tbody class="text-[10px] h-[85px]">
        <tr class="border-2 border-[#282222] break-words">
            <td>{{ $user->fullName }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phoneNumber }}</td>
            <td>{{ $user->age }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <div class="flex flex-col space-y-[10px] my-[10px]">
                    <a href="{{ route('admin.edit', $user->id) }}"><button
                            class="w-1/2 h-fit bg-[#4CAF3C] p-[5px] text-[#FFFDF6] duration-700 hover:scale-105">Update</button></a>
                    <form action="{{ route('admin.destroy', $user->id) }}" method='POST'>
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