@extends('layout.main')
@section('component_content')
<main class="font-poppins">

    <div class="bg-dashboard-member bg-[#FFFCF0] min-h-screen max-h-fit px-[147px] py-[55px]">
        <div
            class="welcome-board bg-[#FFFDF6] h-[100px] flex items-center justify-center text-[20px] text-[#282222] font-semibold shadow-[0px_8px_50px_rgba(174,168,135,0.5)] mb-[55px]">
            <h1>Welcome to your dashboard!</h1>
        </div> <!-- welcome-board -->
        <div class="dashboard-member-information h-[481px] w-full flex flex-row justify-between space-x-[5rem]">
            <div
                class="dashboard-member-information-user bg-[#FFFDF6] h-[full] w-[350px] shadow-[0px_8px_50px_rgba(174,168,135,0.5)] px-[66px] py-[55px] flex flex-col justify-between text-[#282222]">
                <div class="user-info h-fit w-full text-center">
                    <h1 class="text-[20px] font-semibold">{{ auth()->user()->username }}</h1>
                    <p class="text-[14px]">{{ auth()->user()->email }}</p>
                    <p class="text-[12px] text-[#898989]">{{ auth()->user()->phoneNumber }}</p>
                </div> <!-- user-info -->

                <div class="user-address h-fit w-full text-center">
                    <p class="text-[14px]">{{ auth()->user()->address }}</p>
                </div> <!-- user-address -->

                <div class="user-button flex flex-col space-y-[10px]">

                    <form action="{!! route('logout') !!}" method="POST">
                        @csrf
                        <a href="">
                            <button type="submit"
                                class="h-[44px] w-full border-2 border-[#282222] text-[16px] font-semibold duration-700 hover:scale-105">Log
                                Out</button>
                        </a>
                    </form>
                </div> <!-- user-button -->

            </div> <!-- dashboard-member-information-user -->

            <div
                class="dashboard-member-information-order-history bg-[#FFFDF6] h-full w-full shadow-[0px_8px_50px_rgba(174,168,135,0.5)] flex flex-col space-y-[36px] px-[47px] pt-[55px]">

                <div class="order-history-text text-[#282222] text-[20px] font-semibold">
                    <h1>Incoming Order</h1>
                </div> <!-- order-history-text -->

                <div class="bg-order-history-histories h-full w-full flex flex-col overflow-auto">
                    @foreach ($orders as $order)
                    <div class="order-histories h-[109px] w-full border-b-2 flex flex-row justify-between">
                        
                        <div class="history-histories-image">
                            <img src="{{ asset( 'storage/' . $order->meal->mealImage) }}" class="h-[89px] w-[157px] object-cover"
                                alt="">
                        </div> <!-- history-histories-image -->
                            
                            <div class="restaurant-stat-1 text-start">
                                <h1 class="text-[14px] font-semibold w-full">{{ $order->meal->mealName}}</h1>
                                <div class="restaurant-misc">                                        
                                    <p class="text-[12px]"><i class="fa-solid fa-utensils"></i> {{ $order->partner->restaurantName }}</p>
                                    <p class="text-[12px] capitalize"><i class="fa-solid fa-box-open"></i> {{ $order->mealPackage }} | {{ $order->foodTemperature }}</p>
                                    <p class="text-[12px]"><i class="fa-solid fa-route"></i> {{ $order->range }} KM</p>
                                    <p class="text-[12px] w-[150px] truncate"><i class="fa-solid fa-location-dot"></i> {{ $order->user->address }}</p>
                                </div> <!-- restaurant-misc -->
                            </div> <!-- restaurant-stat-1 -->                                    
                            
                            <div class="restaurant-stat-2 text-start">                                    
                                <p class="text-[12px]"><i class="fa-solid fa-user"></i> {{ $order->user->fullName }}</p>
                                @if ($order->status == 'on going')
                                <p class="text-[12px] text-orange-600 capitalize"><i class="fa-regular fa-hourglass-half"></i> {{ $order->status }}</p>
                                <p class="text-[12px] text-blue-600 capitalize"><i class="fa-solid fa-motorcycle"></i> {{ auth()->user()->fullName }}
                                </p>
                                @elseif($order->status == 'delivered')
                                <p class="text-[12px] text-green-600 capitalize"><i class="fa-solid fa-check"></i> {{ $order->status }}</p>
                                @endif
                                <p class="text-[12px]"><i class="fa-solid fa-clock"></i> {{ $order->created_at }}</p>
                            </div> <!-- restaurant-stat-2 -->                        

                        <div class="order-histories-button h-[89px] w-[147px] flex flex-col items-center justify-center space-y-[1px]">
                            <form action="{{ route('volunteer.update', [
                                'orderStatus' => $orderStatus = 'on going',
                                'volunteerID' => $volunteerID = auth()->user()->id,
                                $order->id,
                            ]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if ($order->status == 'delivered')
                                <button class="bg-green-600 h-[40px] w-[147px] text-[#FFFDF6] text-[16px] font-semibold rounded-xl capitalize"
                                    disabled>{{ $order->status }}</button>
                                @elseif($order->status == 'canceled')
                                <button
                                    class="bg-red-600 h-[40px] w-[147px] text-[#FFFDF6] text-[16px] font-semibold rounded-xl capitalize"
                                    disabled>{{ $order->status }}</button>
                                @elseif($order->status == 'preparation')
                                <button
                                    class="bg-orange-600 h-[40px] w-[147px] text-[#FFFDF6] text-[16px] font-semibold duration-700 hover:scale-95 rounded-xl"
                                    type="submit">Take Order</button>
                                @endif
                            </form>

                            <form action="{{ route('volunteer.update',[
                                 'volunteerID' => $volunteerID = auth()->user()->id,
                                $order->id,
                                'orderStatus' => $orderStatus = 'delivered'
                            ]) }}" method="POST">
                            @csrf
                            @method('PUT')
                                @if ($order->status == 'on going')
                                <button
                                    class="bg-green-600 h-[40px] w-[147px] text-[#FFFDF6] text-[16px] font-semibold duration-700 hover:scale-95 p-[20px] flex justify-center items-center rounded-xl">Done</button>
                                @endif
                            </form>

                            <form action="{{ route('volunteer.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if ($order->status == 'canceled')
                                <button
                                    class="bg-orange-600 h-[40px] w-[147px] text-[#FFFDF6] text-[16px] font-semibold duration-700 hover:scale-95 p-[20px] flex justify-center items-center rounded-xl"
                                    type="submit">Delete
                                </button>
                                @endif
                            </form>
                        </div> <!-- order-histories-button -->
                    </div> <!-- order-histories -->
                    @endforeach
                </div> <!-- bg-order-history-histories -->

            </div> <!-- dashboard-member-information-order-history -->

        </div> <!-- dashboard-member-information -->

        <div class="copyright text-[#282222] text-[12px] text-center mt-[55px]">
            <h1>&copy; 2022 All Rights Reserved | Merry Meal</h1>
        </div> <!-- copyright -->

    </div> <!-- bg-dashboard-member -->

</main>

@endsection