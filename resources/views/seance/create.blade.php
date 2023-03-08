<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New Seance
            <a href="/treatement/{{$treatement}}"><div class="flex items-center justify-end">
                    <x-primary-button class="ml-4">
                        Seance List
                    </x-primary-button>
                </div></a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('seance.store') }}">
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
                <div>
                    <x-input-label for="description" :value="__('Description')" />

                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="montant" :value="__('Montant')" />

                    <x-text-input id="montant" class="block mt-1 w-full" type="number" step="0.01" name="montant" :value="old('montant')" required autofocus />

                    <x-input-error :messages="$errors->get('montant')" class="mt-2" />
                </div>
                </div>
                <div class="grid grid-rows-1 gap-2">
                <div>
                    <x-input-label for="id_service" :value="__('Service')" />

                    <select  id="id_service" class="block mt-1 w-full" name="id_service">
                        <option></option>
                        @foreach($sevices as $var)
                            <option value="{{$var->id}}">{{$var->Designation}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('montant')" class="mt-2" />
                </div>
            </div>
            </div>

            <input name="id_treatment" value="{{$treatement}}" hidden>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('ADD') }}
                </x-primary-button>
            </div>
        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
