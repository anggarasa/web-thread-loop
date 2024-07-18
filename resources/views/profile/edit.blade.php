<x-layout-auth>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h2 class="font-semibold text-xl mt-7 text-gray-800 leading-tight">
        {{ __('Ubah Password') }}
    </h2>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
       
        {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('home.profile-edit') --}}
                {{-- @include('profile.partials.update-profile-information-form') --}}
            {{-- </div>
        </div> --}}

        <div class="p-4 sm:p-8 bg-white shadow-lg border border-black sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div> --}}
        </div>
    </div>
</div>
</x-layout-auth>
