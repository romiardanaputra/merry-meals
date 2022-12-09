@extends('layout.main')
@section('component_content')
<main class="font-poppins">

    <div class="bg-dashboard-member bg-[#FFFCF0] min-h-screen max-h-fit px-[147px] py-[55px]">

        <div class="welcome-board bg-[#FFFDF6] h-[100px] flex items-center justify-center text-[20px] text-[#282222] font-semibold shadow-[0px_8px_50px_rgba(174,168,135,0.5)] mb-[55px]">
            <h1>Welcome to your dashboard!</h1>
        </div> <!-- welcome-board -->

        <div class="dashboard-member-information h-[481px] w-full flex flex-row justify-between">
            
            <div class="dashboard-member-information-user bg-[#FFFDF6] h-[full] w-[350px] shadow-[0px_8px_50px_rgba(174,168,135,0.5)] px-[66px] py-[55px] flex flex-col justify-between text-[#282222]">

                <div class="user-info h-fit w-full text-center">
                    <h1 class="text-[20px] font-semibold">Username</h1>
                    <p class="text-[14px]">User email</p>
                    <p class="text-[12px] text-[#898989]">User contact</p>
                </div> <!-- user-info -->

                <div class="user-address h-fit w-full text-center">
                    <p class="text-[14px]">User address</p>
                </div> <!-- user-address -->

                <div class="user-button flex flex-col space-y-[10px]">
                    <a href="">
                        <button class="h-[44px] w-full border-2 bg-[#282222] border-[#282222] text-[#FFFCF0] text-[16px] font-semibold duration-700 hover:scale-105">Take Survey</button>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="">
                            <button type="submit" class="h-[44px] w-full border-2 border-[#282222] text-[16px] font-semibold duration-700 hover:scale-105">Log Out</button>
                        </a>
                    </form>
                </div> <!-- user-button -->

            </div> <!-- dashboard-member-information-user -->

            <div class="dashboard-member-information-order-history bg-[#FFFDF6] h-full w-[760px] shadow-[0px_8px_50px_rgba(174,168,135,0.5)] flex flex-col space-y-[36px] px-[47px] pt-[55px]">

                <div class="order-history-text text-[#282222] text-[20px] font-semibold">
                    <h1>Order History</h1>
                </div> <!-- order-history-text -->

                <div class="bg-order-history-histories h-full w-full flex flex-col overflow-auto">

                    <div class="order-histories h-[109px] w-full border-b-2 flex flex-row justify-between">
                        <div class="separation flex flex-row space-x-[17px]">

                            <div class="history-histories-image h-[89px] w-[159px]">
                                <img src="" class="h-[89px] w-[159px]" alt="">
                            </div> <!-- history-histories-image -->                    

                            <div class="order-histories-status h-[89px] w-[111px] flex flex-col justify-between text-center">
                                <div class="separation text-[#282222]">
                                    <h1 class="text-[14px] font-semibold">British Salad</h1>
                                    <p class="text-[12px]">On Delivery</p>
                                </div> <!-- separation -->

                                <p class="text-[12px]">27 November 14:28</p>
                            </div> <!-- order-histories-status -->
                                                        
                        </div> <!-- separation -->

                        <div class="order-histories-button h-[89px] w-[147px] flex items-center">
                            <a href="">
                                <button class="bg-[#AF433C] h-[44px] w-[147px] text-[#FFFDF6] text-[16px] font-semibold duration-700 hover:scale-90">Cancel</button>
                            </a>
                        </div> <!-- order-histories-button -->
                    </div> <!-- order-histories -->

                </div> <!-- bg-order-history-histories -->

            </div> <!-- dashboard-member-information-order-history -->

        </div> <!-- dashboard-member-information -->

        <div class="copyright text-[#282222] text-[12px] text-center mt-[55px]">
            <h1>&copy; 2022 All Rights Reserved | Merry Meal</h1>
        </div> <!-- copyright -->

    </div> <!-- bg-dashboard-member -->

</main>

@endsection