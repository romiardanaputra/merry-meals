@extends('partner.dashboard')
@section('partnerContent')
<main class="font-poppins">
    <div class="form-register-fields w-full pr-[5rem] mx-[10px]">
        @foreach($partners as $partner)
        @if ($partner->userID == auth()->user()->id)
        <form action="" class="flex flex-col space-y-[24px]" method="POST" enctype="multipart/form-data">
            @csrf
            <img class="w-[562px] h-[316px]" src="{{ asset('storage/' . $partner->restaurantImage) }}" alt="">
            <p>Restaurant Name : {{ $partner->restaurantName }}</p>
            <p>Owner Name : {{ $partner->ownerName }}</p>
            <p>Restaurant Address : {{ $partner->restaurantAddress }}</p>
            <p>Restaurant Contact : {{ $partner->restaurantContact }}</p>
            <p>Restaurant Food Type : {{ $partner->foodType }}</p>
        </form>
        @endif
        @endforeach
    </div> <!-- form-register-fields -->
</main>
@endsection