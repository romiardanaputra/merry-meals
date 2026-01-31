<x-guest-layout>
  <div class="mx-auto mt-6 max-w-4xl p-6 max-sm:max-w-lg">
    <div class="mb-12 text-center sm:mb-16">
      <div class="flex items-center justify-center gap-4">
        <img src="{{ asset('storage/images/merry-meal-logo-2.png') }}" alt="logo" class="size-2/12 lg:size-2/12" />
        <div class="flex flex-col">
          <span class="text-lg font-bold uppercase tracking-wider">Merry Meals</span>
          <span class="text-sm font-bold uppercase tracking-widest">Meals On Wheel</span>
        </div>
      </div>
      <h4 class="mt-6 text-base font-medium text-dark">Sign up into your account</h4>
    </div>

    <form>
      <div class="grid gap-8 sm:grid-cols-2">
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-800">First Name</label>
          <input
            name="name"
            type="text"
            class="w-full rounded border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-primary transition-all focus:border-primary focus:bg-transparent focus:outline-primary"
            placeholder="Enter name"
          />
        </div>
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-800">Last Name</label>
          <input
            name="lname"
            type="text"
            class="w-full rounded border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-primary transition-all focus:border-primary focus:bg-transparent focus:outline-primary"
            placeholder="Enter last name"
          />
        </div>
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-800">Email Id</label>
          <input
            name="email"
            type="text"
            class="w-full rounded border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-primary transition-all focus:border-primary focus:bg-transparent focus:outline-primary"
            placeholder="Enter email"
          />
        </div>
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-800">Mobile No.</label>
          <input
            name="number"
            type="number"
            class="w-full rounded border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-primary transition-all focus:border-primary focus:bg-transparent focus:outline-primary"
            placeholder="Enter mobile number"
          />
        </div>
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-800">Password</label>
          <input
            name="password"
            type="password"
            class="w-full rounded border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-primary transition-all focus:border-primary focus:bg-transparent focus:outline-primary"
            placeholder="Enter password"
          />
        </div>
        <div>
          <label class="mb-2 block text-sm font-medium text-slate-800">Confirm Password</label>
          <input
            name="cpassword"
            type="password"
            class="w-full rounded border-gray-200 bg-slate-100 px-4 py-3 text-sm text-slate-800 outline-primary transition-all focus:border-primary focus:bg-transparent focus:outline-primary"
            placeholder="Enter confirm password"
          />
        </div>
      </div>

      <div class="mt-12 flex items-center justify-center">
        <x-button
          :type="App\Enum\ButtonType::SolidHover"
          :route="route('index')"
          :classes="'!border-accentSecondary !text-accentSecondary hover:!border-accentSecondary hover:!bg-accentSecondary hover:!text-dark'"
          :title="'learn more button'"
        >
          Register to Merry Meal
        </x-button>
      </div>
    </form>
  </div>
</x-guest-layout>
