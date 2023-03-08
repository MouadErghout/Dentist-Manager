<style>
    :root {
        --main-color: #2d3748;
    }

    .bg-main-color {
        background-color: var(--main-color);
    }

    .text-main-color {
        color: var(--main-color);
    }

    .border-main-color {
        border-color: var(--main-color);
    }
    .bg-custom-color {
    background-color: #4a76a8;
    }
    .bg-custom-color-hover {
        background-color: #03274d;
    }
</style>

<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




<div class="bg-gray-100">
 <div class="w-full text-white bg-main-color">
        <div x-data="{ open: false }"
            class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="p-4 flex flex-row items-center justify-between">
                <div class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
                    mes traitements
                </div>
                
                
            </div>
        </div>
    </div>
</div> 




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
            @foreach($traitements as $var)
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$var->created_at}}</td>
                    <td class="px-6 py-4">{{$var->Etat}}</td>
                    <td class="px-6 py-4">{{$var->Prix}}</td>
                    <td class="px-6 py-4">{{$var->MontantNonRegle}}</td>
                            
                        
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end mt-4">
                            <a href="/traitement/{{$var->id}}">
                                <x-primary-button class="ml-4">
                                    {{ __('Seances') }}
                                </x-primary-button>
                            </a>
                        </div>
                </td>

                </tr>
            @endforeach
        </tbody>
            
    </table>
</div>

