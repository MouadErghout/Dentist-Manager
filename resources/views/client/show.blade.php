<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$client->firstname}}  {{$client->lastname}}
        </h2>
    </x-slot>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-black-500 ">
            <thead class="text-xs text-black-700 uppercase">
            <tr>
                <th scope="col" class="px-6 py-3">Prenom</th>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">date de naissance</th>
                <th scope="col" class="px-6 py-3">Numero telephone</th>
                <th scope="col" class="px-6 py-3">CIN</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Numero securite sociale</th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b hover:bg-gray-200">
                <td class="px-6 py-4">{{$client->firstname}}</td>
                <td class="px-6 py-4">{{$client->lastname}}</td>
                <td class="px-6 py-4">{{$client->birthday}}</td>
                <td class="px-6 py-4">{{$client->phonenumber}}</td>
                <td class="px-6 py-4">{{$client->cin}}</td>
                <td class="px-6 py-4">{{$client->email}}</td>
                <td class="px-6 py-4">{{$client->numero_securite_sociale}}</td>
                <td class="px-6 py-4"><a href="/client/{{$client->id}}/edit"><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div></a></td>
                <td class="px-6 py-4"><a href="/treatement/{{$client->id}}/list"><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Traitements') }}
                            </x-primary-button>
                        </div></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
