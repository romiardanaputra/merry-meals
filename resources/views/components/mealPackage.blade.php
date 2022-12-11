@extends('layout.main')
@section('component_content')

<main class="bg-[#FFFCF0] font-poppins">
    @include('components.navbar')

    <div class="container-packaging px-[147px] py-[92px] min-h-screen max-h-fit w-full">
        <h1 class="text-[32px] font-semibold mb-[57px] text-[#282222]">Select Packaging</h1>

        <div class="package-list flex flex-row justify-center space-x-[20px] w-full">
            <div class="basic-package h-[624px] w-full bg-[#FFFDF6] shadow-[0px_8px_50px_rgba(174,168,135,0.5)]">

                <div
                    class="basic-package-content px-[150px] h-full flex flex-col items-center justify-between pb-[47px]">

                    <div class="separation">
                        <div class="basic-package-content-image h-[262px] w-[262px]">
                            <img src="/images/FoodPackageBasic.png" class="h-[262px] w-[262px]" alt="basicPackage">
                        </div> <!-- basic-package-content-image -->

                        <div
                            class="basic-package-content-text text-[#282222] flex flex-col items-center space-y-[19px]">
                            <h1 class="text-[32px] font-semibold">Basic</h1>
                            <div class="borderseparate border-2 border-[#D9D9D9] bg-[#D9D9D9] w-[262px]"></div>

                            <div class="basic-package-content-text-list w-[262px]">
                                <ul class="list-disc list-outside text-[12px] ml-[15px]">
                                    <li>Food is wrapped in plastic wrap</li>
                                    <li>The package will be send wrapped in a paper bag</li>
                                </ul>
                            </div> <!-- basic-package-content-text-list -->
                        </div> <!-- basic-package-content-text -->
                    </div> <!-- separation -->

                    <div class="basic-package-content-button">
                        <form action="{{ route('member.store', 
                        ['meal' => $meal->id, 
                        'package' => $package = 'basic',
                        'partnerID' => $meal->partnerID])
                         }}" method="POST">
                            @csrf
                            <a href="#">
                                <button
                                    class="bg-[#FFFDF6] border-2 border-[#A07C00] text-[20px] text-[#A07C00] font-semibold h-[60px] w-[250px] hover:scale-105 duration-500"
                                    type="submit">ORDER</button>
                            </a>
                        </form>
                    </div> <!-- basic-package-content-button -->
                </div> <!-- basic-package-content -->

            </div> <!-- basic-package -->

            <div class="exclusive-package h-[624px] w-full bg-[#FFFDF6] shadow-[0px_8px_50px_rgba(174,168,135,0.5)]">

                <div
                    class="exclusive-package-content px-[150px] h-full flex flex-col items-center justify-between pb-[47px]">

                    <div class="separation">
                        <div class="exclusive-package-content-image h-[262px] w-[262px]">
                            <img src="/images/FoodPackageExclusive.png" class="h-[262px] w-[262px]"
                                alt="exclusivePackage">
                        </div> <!-- exclusive-package-content-image -->

                        <div
                            class="exclusive-package-content-text text-[#282222] flex flex-col items-center space-y-[19px]">
                            <h1 class="text-[32px] font-semibold">Exclusive</h1>
                            <div class="borderseparate border-2 border-[#D9D9D9] bg-[#D9D9D9] w-[262px]"></div>

                            <div class="exclusive-package-content-text-list w-[262px]">
                                <ul class="list-disc list-outside text-[12px] ml-[15px]">
                                    <li>Frozen and heated food will be wrapped with full aluminum foil</li>
                                    <li>Food also will be wrapped in plastic wrap as a secondary packaging</li>
                                    <li>The package will be send wrapped in a paper bag</li>
                                </ul>
                            </div> <!-- exclusive-package-content-text-list -->
                        </div> <!-- exclusive-package-content-text -->
                    </div> <!-- separation -->

                    <div class="exclusive-package-content-button">
                        <form
                            action="{{ route('member.store', [
                                'meal' => $meal->id,
                                'package' => $package = 'exclusive',
                                'partnerID' => $meal->partnerID]) }}"
                            method="POST">
                            @csrf
                            <a href="#">
                                <button
                                    class="bg-[#FFFDF6] border-2 border-[#A07C00] text-[20px] text-[#A07C00] font-semibold h-[60px] w-[250px] hover:scale-105 duration-500"
                                    type="submit">ORDER</button>
                            </a>
                        </form>
                    </div> <!-- exclusive-package-content-button -->
                </div> <!-- exclusive-package-content -->
            </div> <!-- exclusive-package -->
        </div> <!-- package-list -->
    </div> <!-- container-packaging -->

    @include('components.footer')
</main>