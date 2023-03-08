<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Treatement for Client_id : {{$user}}
            <div class="flex items-center justify-end">
                <a href="/client/{{$user}}">
                    <x-primary-button class="ml-4">
                        Show Client
                    </x-primary-button>
                </a></div>
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
                <th scope="col" class="px-6 py-3">Date de Creation</th>
                <th scope="col" class="px-6 py-3">Etat</th>
                <th scope="col" class="px-6 py-3">Prix</th>
                <th scope="col" class="px-6 py-3">Montant non regle</th>
                @if(Auth::guard("admin")->user()->is_superadmin == 1)
                <th scope="col" class="px-6 py-3"><a href="/treatement/{{$user}}/create"><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('ADD') }}
                            </x-primary-button>
                        </div></a></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($treatement as $var)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$var->created_at}}</td>
                    <td class="px-6 py-4">{{$var->Etat}}</td>
                    <td class="px-6 py-4">{{$var->Prix}}</td>
                    <td class="px-6 py-4">{{$var->MontantNonRegle}}</td>

                    @if(Auth::guard("admin")->user()->is_superadmin == 1)
                    <td class="px-6 py-4"><a href="/treatement/{{$var->id}}/{{$user}}/edit"><div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </div></a></td>
                    @elseif(\Illuminate\Support\Facades\Auth::user())

                    <td class="px-6 py-4"><a href="/treatement/{{$var->id}}"><div class="flex items-center justify-end mt-4">
                    <td class="px-6 py-4">
                        <a href="/treatement/{{$var->id}}/{{$user}}/edit">
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </div>
                        </a>
                    </td>
                    @endif
                    <td class="px-6 py-4">
                        <a href="/treatement/{{$var->id}}">
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Seances') }}
                                </x-primary-button>
                            </div>
                        </a>
                    </td>

                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
