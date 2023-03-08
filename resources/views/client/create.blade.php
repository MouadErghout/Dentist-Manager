<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Client
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('client.store') }}">
                        @csrf
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <div class="alert alert-success shadow-lg bg-green-500">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>{{\Illuminate\Support\Facades\Session::get('success')}}</span>
                                </div>
                            </div>
                        @elseif(\Illuminate\Support\Facades\Session::has('error'))
                            <div class="alert alert-error shadow-lg bg-red-600">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>{{\Illuminate\Support\Facades\Session::get('error')}}</span>
                                </div>
                            </div>
                        @endif
                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid grid-rows-2 gap-2">
                        <!-- Name -->
                        <div >
                            <x-input-label for="firstname" :value="__('Prenom')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />

                            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="lastname" :value="__('Nom')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />

                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>
                        </div>
                        <div class="grid grid-rows-2 gap-2">

                        <div>
                            <x-input-label for="birthday" :value="__('Date de Naissance')" />

                            <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus />

                            <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="phonenumber" :value="__('Numero Telephone')" />

                            <x-text-input id="phonenumber" class="block mt-1 w-full" type="tel" name="phonenumber" :value="old('phonenumber')" required autofocus/>

                            <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
                        </div>
                        </div>
                        <div class="grid grid-rows-2 gap-2">
                        <div class="mt-4">
                            <x-input-label for="cin" :value="__('CIN')" />

                            <x-text-input id="" class="block mt-1 w-full" type="text" name="cin" :value="old('cin')"/>

                            <x-input-error :messages="$errors->get('cin')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        </div>
                        <div class="grid grid-rows-2 gap-2">
                        <div class="mt-4">
                            <x-input-label for="numero_securite_sociale" :value="__('numero securite sociale')" />

                            <x-text-input id="numero_securite_sociale" class="block mt-1 w-full" type="text" name="numero_securite_sociale" :value="old('numero_securite_sociale')"/>

                            <x-input-error :messages="$errors->get('numero_securite_sociale')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        </div>
                        <div class="grid grid-rows-1 gap-2">
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
