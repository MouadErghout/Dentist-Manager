<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex items-center justify-end">
                <a href="/treatement/{{$treatement->id}}">
                    <x-primary-button class="ml-4">
                        Seance List
                    </x-primary-button>
                </a>
            </div>
        </h2>
    </x-slot>
    <div class="w-full flex items-center justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-black-500 ">
                <thead class="text-xs text-black-700 uppercase">
                <tr>
                <th scope="col" class="px-6 py-3">Date de Creation</th>
                <th scope="col" class="px-6 py-3">Dernière modification</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Montant</th>
                <th scope="col" class="px-6 py-3">Service</th>
            </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$seance->created_at}}</td>
                <td class="px-6 py-4">{{$seance->updated_at}}</td>
                <td class="px-6 py-4">{{$seance->description}}</td>
                <td class="px-6 py-4">{{$seance->montant}}</td>
                <td class="px-6 py-4">{{$service->Designation}}</td>
                <td class="px-6 py-4"><a href="/seance/{{$seance->id}}/{{$treatement->id}}/edit"><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div></a></td>
            </tr>
                </tbody>
        </table>
        </div>
    </div>
</x-app-layout>
