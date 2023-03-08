<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    {{--    <div class="py-12">--}}
    {{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
    {{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
    {{--                <div class="p-6 bg-white border-b border-gray-200">--}}
    {{--                    You're logged in!--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-black-500 ">
            <thead class="text-xs text-black-700 uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">Prenom</th>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Numero telephone</th>
                <th scope="col" class="px-6 py-3" colspan="2"><a href="{{route('client.create')}}"><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div></a></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $var)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$var->firstname}}</td>
                    <td class="px-6 py-4">{{$var->lastname}}</td>
                    <td class="px-6 py-4">{{$var->phonenumber}}</td>
                    <td class="px-6 py-4"><a href="/client/{{$var->id}}"><div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Show') }}
                                </x-primary-button>
                            </div></a></td>
                    <td class="px-6 py-4"><a href="/client/{{$var->id}}/edit"><div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </div></a></td>
                    <td class="px-6 py-4"><a href="/treatement/{{$var->id}}/list"><div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ml-4">
                                        {{ __('Traitements') }}
                                    </x-primary-button>
                                </div></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
