<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Services') }}
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
    <div class="w-full flex items-center justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-black-500 ">
                <thead class="text-xs text-black-700 uppercase">
                <tr>
                    <th scope="col" class="px-6 py-3">Code</th>
                <th scope="col" class="px-6 py-3">Designation</th>
                    @if(Auth::guard("admin")->user()->is_superadmin == 1)
                    <th scope="col" class="px-6 py-3" colspan="2"><a href="{{route('service.create')}}"><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div></a></th>
                    @endif
            </tr>
                </thead>
                <tbody>
            @foreach($services as $var)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$var->code}}</td>
                    <td class="px-6 py-4">{{$var->Designation}}</td>
                    <td class="px-6 py-4"><a href="/service/{{$var->id}}"><div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Show') }}
                                </x-primary-button>
                            </div></a></td>
                    @if(Auth::guard("admin")->user()->is_superadmin == 1)
                    <td class="px-6 py-4"><a href="/service/{{$var->id}}/edit"><div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </div></a></td>
                    @endif
                </tr>
            @endforeach
                </tbody>
        </table>
        </div>
</x-app-layout>
