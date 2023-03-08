<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Treatement_id : {{$treatement->id}}
            </h2>
            <div class="flex items-center justify-end">
                <a href="/usertraitement/{{ Auth::user()->id }}">
                    <x-primary-button class="ml-4">
                        Treatement List
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
                <th scope="col" class="px-6 py-3">Etat</th>
                <th scope="col" class="px-6 py-3">Prix</th>
                <th scope="col" class="px-6 py-3">Montant non regle</th>
            </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$treatement->created_at}}</td>
                <td class="px-6 py-4">{{$treatement->Etat}}</td>
                <td class="px-6 py-4">{{$treatement->Prix}}</td>
                <td class="px-6 py-4">{{$treatement->MontantNonRegle}}</td>
            </tr>
                </tbody>
        </table>
        </div>
    </div>
    <div class="w-full flex items-center justify-center mt-5">
        <div class="flex items-center">
            <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-black-900 md:text-4xl">Seances</h2>
        </div>
    </div>
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
            @foreach($seances as $var)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$var->created_at}}</td>
                    <td class="px-6 py-4">{{$var->updated_at}}</td>
                    <td class="px-6 py-4">{{$var->description}}</td>
                    <td class="px-6 py-4">{{$var->montant}}</td>
                    <td class="px-6 py-4">{{$var->service->Designation}}</td>


                </tr>
            @endforeach
        </table>
        </div>
    </div>
</x-app-layout>
