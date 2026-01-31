@extends('admin.dashboard')
@section('dashboard_admin')
<table class="table-fixed w-full text-center text-[#282222] font-semibold border-2 border-[#282222] border-collapse">
    <thead class="text-[12px] bg-[#282222] text-[#FFFDF6] h-[45px]">
        <tr>
            <th>No</th>
            <th>Donator Name</th>
            <th>Donation Amount</th>
            <th>Donator E-mail</th>
            <th>Donator Phone Number</th>
            <th>Donator Description</th>
        </tr>
    </thead>
    @foreach ($donators as $donator)
    <tbody class="text-[10px] h-[85px]">
        <tr class="border-2 border-[#282222] break-words">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $donator->donatorName }}</td>
            <td>${{ $donator->donationAmount }}</td>
            <td>{{ $donator->donatorEmail }}</td>
            <td>{{ $donator->donatorPhone }}</td>
            <td>{{ $donator->description }}</td>
        </tr>
    </tbody>
    @endforeach
</table>
@endsection