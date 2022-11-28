@extends('layout.main')
@section('component_content')

<main class="font-poppins">
    <h3 class="hidden">loggin as {{ auth()->user()->role }}</h3>
    

    <div class="bg-admin w-full flex flex-row h-fit">

        <div class="sidebar w-[350px] min-h-screen max-h-fit px-[40px] py-[66px] bg-[#282222] flex flex-col justify-between items-center">
            <div class="flex flex-col">
                <div class="sidebar-logo w-full h-[100px] flex flex-row space-x-[9px] mb-[66px]">
                    <div class="s-logo w-[170px] h-[100px] bg-[#FFFDF6] flex items-center justify-center rounded-[50%]">
                        <img src="/images/MerryMealLogo-02.png" alt="merry_logo" class="w-[70px] h-[70px]">
                    </div> <!-- s-logo -->

                    <div class="s-logo-name flex flex-col text-[#FFFDF6] font-semibold h-[32px] w-full space-y-[-7px] justify-center items-center m-auto">
                        <h1 class="text-[16.07px] tracking-[5px] w-full">MERRY MEAL</h1>
                        <h2 class="text-[10.71px] tracking-[3.3px] w-full">MEALS ON WHEELS</h2>
                    </div> <!-- s-logo-name -->
                </div> <!-- sidebar-logo -->

                <div class="sidebar-navigation flex flex-col space-y-[18px]">
                    <a href=""><button class="w-full h-[50px] bg-[#282222] border-2 border-solid border-[#FFFDF6] text-[#FFFDF6] duration-700 hover:bg-[#FFFDF6] hover:text-[#282222]">Users List</button></a>

                    <a href=""><button class="w-full h-[50px] bg-[#282222] border-2 border-solid border-[#FFFDF6] text-[#FFFDF6] duration-700 hover:bg-[#FFFDF6] hover:text-[#282222]">Partners List</button></a>

                    <a href=""><button class="w-full h-[50px] bg-[#282222] border-2 border-solid border-[#FFFDF6] text-[#FFFDF6] duration-700 hover:bg-[#FFFDF6] hover:text-[#282222]">Food Menu List</button></a>

                    <a href=""><button class="w-full h-[50px] bg-[#282222] border-2 border-solid border-[#FFFDF6] text-[#FFFDF6] duration-700 hover:bg-[#FFFDF6] hover:text-[#282222]">Donation List</button></a>
                </div> <!-- sidebar-navigation -->
            </div> <!-- flex -->

            <div class="sidebar-logout w-full">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="#"><button type="submit" class="w-full h-[50px] bg-[#282222] border-2 border-solid border-[#FFFDF6] text-[#FFFDF6] duration-700 hover:bg-[#FFFDF6] hover:text-[#282222]">Logout</button></a>
                </form>
            </div> <!-- sidebar-logout -->
        </div> <!-- sidebar -->

        <div class="bg-dashboard-info w-full min-h-screen max-h-fit bg-[#FFFCF0] p-[60px] flex flex-col space-y-[15px]">
            <div class="dash-user-info w-full h-fit py-[35px] px-[50px] bg-[#FFFDF6] m-auto shadow-[0px_8px_50px_rgba(174,168,135,0.5)]">
                <h1 class="text-[#282222] text-[20px]"><b>Hi,</b> {{ auth()->user()->username }}</h1>
            </div> <!-- dash-user-info -->

            <div class="dash-database w-full h-fit p-[50px] bg-[#FFFDF6] m-auto shadow-[0px_8px_50px_rgba(174,168,135,0.5)] space-y-[35px]">
                <h1 class="font-semibold text-[20px]">Users Database</h1>

                <div class=" h-[350px] w-full overflow-auto">
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
                        
                        <tbody class="text-[10px] h-[85px]">
                            <tr class="border-2 border-[#282222] break-words">
                                <td>Fullname goes here</td>
                                <td>Username goes here</td>
                                <td>E-mail goes here</td>
                                <td>Phone Number goes here</td>
                                <td>Age goes here</td>
                                <td>Role goes here</td>
                                <td>
                                    <div class="flex flex-col space-y-[10px] my-[10px]">
                                        <a href=""><button class="w-1/2 h-fit bg-[#4CAF3C] p-[5px] text-[#FFFDF6] duration-700 hover:scale-105">Update</button></a>
                                    
                                        <a href=""><button class="w-1/2 h-fit bg-[#AF433C] p-[5px] text-[#FFFDF6] duration-700 hover:scale-105">Delete</button></a>
                                    </div> <!-- flex -->
                                </td>                            
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- table-overflow -->                
            </div> <!-- dash-database -->

            <div class="dash-copyright text-[#282222] text-[12px] text-center">
                <h1>&copy; 2022 All Rights Reserved | Merry Meal</h1>
            </div> <!-- dash-copyright -->
        </div> <!-- bg-dashboard-info -->

    </div> <!-- bg-admin -->
</main>
@endsection