<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Service id : {{$service->id}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="/service/{{$service->id}}">
                    @method('PUT')
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
                            <x-input-label for="code" :value="__('Code')" />

                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" value="{{$service->code}}" required autofocus />

                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="Designation" :value="__('Designation')" />

                            <x-text-input id="Designation" class="block mt-1 w-full" type="text" name="Designation" value="{{$service->Designation}}" required autofocus />

                            <x-input-error :messages="$errors->get('Designation')" class="mt-2" />
                        </div>
                        </div>
                        <div class="grid grid-rows-1 gap-2">
                        <div>
                            <x-input-label for="Description" :value="__('Description')" />

                            <x-text-input id="Description" class="block mt-1 w-full" type="text" name="Description" value="{{$service->Description}}" required autofocus />

                            <x-input-error :messages="$errors->get('Description')" class="mt-2" />
                        </div>
                        </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
