<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rendez-vous</title>
<body>
<x-app-layout>
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" >
            {{ __('Rendez-vous') }}
        </h2>
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <br><h6 colspan="2" style="color:green">{{Session::get('success')}}</h6>
        @endif
        <div class="flex justify-center align-items-center" >
            @if($week!=date("W"))
                <form method="post" action="/RDV/switch2/{{$week-1}}" style="display: inline-block;">
                    @csrf
                    <div class="flex items-center justify-end">
                        <x-primary-button  name="previous-week" class="ml-4" type="submit" style="display: inline; margin-right: 14px;">
                            {{ __('<-') }}
                        </x-primary-button>
                    </div>
                </form>
            @endif
            <?php
            $year = date("Y");
            $date = new DateTime();
            $date->setISODate($year, $week);
            $monday = $date->format('M d');
            $date->modify('sunday this week');
            $sunday = $date->format('d, Y');
            echo "<h3><strong>{$monday} - {$sunday}</strong></h3>";?>
            <form id="form" method="post" action="/RDV/switch2/{{$week+1}}" style="display: inline-block;">
                @csrf
                <div class="flex items-center justify-end ">
                    <x-primary-button name="next-week" class="ml-4" type="submit" style="display: inline;">
                        {{ __('->') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
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
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Telephone</th>
                <th scope="col" class="px-6 py-3">Year</th>
                <th scope="col" class="px-6 py-3">Month</th>
                <th scope="col" class="px-6 py-3">Week</th>
                <th scope="col" class="px-6 py-3">Day</th>
                <th scope="col" class="px-6 py-3">Time</th>
                <th scope="col" class="px-6 py-3">Etat</th>
                <th scope="col" class="px-24 py-3" colspan="2"><a href="/RDV/create" ><div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4" style="background-color: green;">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div></a></th>
            </tr>
            </thead>
            <tbody>
            @foreach($rdvs as $rdv)
                {{--{{dd($rdv,$months[$rdv->month])}}--}}
                <tr class="bg-white border-b hover:bg-gray-200">
                    <td class="px-6 py-4">{{$rdv->name}}</td>
                    <td class="px-6 py-4">{{$rdv->telephone}}</td>
                    <td class="px-6 py-4">{{$rdv->year}}</td>
                    <td class="px-6 py-4">{{$months[$rdv->month]}}</td>
                    <td class="px-6 py-4">{{$rdv->week}}</td>
                    <?php $jour=$rdv->day+1; $semaine = intval($rdv->week); $year = intval($rdv->year)?>
                    <td class="px-6 py-4">{{date("Y-m-d", mktime(0, 0, 0, 1, ($rdv->week - 1) * 7 + $rdv->day+2, $rdv->year))}} ({{$days[$rdv->day]}})</td>
                    <td class="px-6 py-4">{{$times[$rdv->time]}}</td>
                    @if($rdv->etat=='raté')
                        <td class="px-6 py-4" style="color:red">{{$rdv->etat}}</td>
                    @elseif($rdv->etat=='terminé')
                        <td class="px-6 py-4" style="color:green">{{$rdv->etat}}</td>
                    @else
                        <td class="px-6 py-4">{{$rdv->etat}}</td>
                    @endif
                    <td scope="col" class="px-6 py-3" >
                        <form action="/RDV/{{$rdv->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Remove') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </td>
                    <td scope="col" class="px-6 py-3" >
                        <form action="/RDV/{{$rdv->id}}/edit" method="post">
                            @csrf
                            @method('GET')
                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

</body>
</html>
