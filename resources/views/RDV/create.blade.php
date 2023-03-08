    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rendez-vous</title>
    <script>
        var times = @json($times, JSON_FORCE_OBJECT);
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("#day-select").addEventListener("change", function () {
                // Get the selected place
                var day = this.value;

                // Get the second select option
                var timeSelect = document.querySelector("#time-select");

                // Clear the second select option
                timeSelect.innerHTML = "<option value=''>Select a time</option>";

                // If a day is selected
                if (day) {
                    // Get the times for the selected day
                    var options = Object.keys(times[day]);

                    // Add the entries to the second select option
                    options.forEach(function(key) {
                        var option = document.createElement("option");
                        option.value = key;
                        option.text = times[day][key];
                        timeSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            New rendez-vous
        </h2>
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <br><h6 colspan="2" style="color:green">{{\Illuminate\Support\Facades\Session::get('success')}}</h6>
        @elseif(\Illuminate\Support\Facades\Session::has('error'))
                <h6 style="color:red">{{\Illuminate\Support\Facades\Session::get('error')}}</h6>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-2 lg:px-2">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-center align-items-center">
                        @if($week!=date("W"))
                            <form method="post" action="/RDV/switch1/{{$week-1}}" style="display: inline-block;">
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
                        <form id="form" method="post" action="/RDV/switch1/{{$week+1}}" style="display: inline-block;">
                            @csrf
                            <div class="flex items-center justify-end ">
                                <x-primary-button name="next-week" class="ml-4" type="submit" style="display: inline;">
                                    {{ __('->') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    <form id="myform" action="/RDV/{{$week}}" method="POST">
                        @csrf
                        <div>
                            <!-- Name -->
                            <div >
                                <x-input-label for="name" :value="__('Name')" />

                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="telephone" :value="__('Telephone')" />

                                <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required autofocus />

                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>
                            @if(Auth::guard('admin')->check())
                                <div class="mt-4">
                                    <x-input-label for="uniquenumber" :value="__('Unique phone number')" style="display: inline-block;" />
                                    <input id="uniquenumber" class="mt-1" type="checkbox" name="uniquenumber" value="true" autofocus style="display: inline-block; margin-left: 14px;" />
                                    <x-input-error :messages="$errors->get('uniquenumber')" class="mt-2" />
                                </div>
                            @endif
                            <div class="mt-4">
                                <x-input-label for="day-select" :value="__('Day')" />

                                <select id="day-select" name="day" required>
                                    <option value="">Select a day</option>'
                                    @if((getdate()['wday'])!=0)
                                    <?php $options=array(
                                    '<option value="0">Monday</option>',
                                    '<option value="1">Tuesday</option>',
                                    '<option value="2">Wednesday</option>',
                                    '<option value="3">Thursday</option>',
                                    '<option value="4">Friday</option>',
                                    '<option value="5">Saturday</option>') ?>
                                    @for($i=getdate()['wday']-1;$i<count($options);$i++)
                                        <?php echo $options[$i] ?>
                                    @endfor
                                    @endif
                                </select>

                                <x-input-error :messages="$errors->get('Day')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="time-select" :value="__('Time')" />

                                <select id="time-select" name="time" required>
                                    <option value=''>Select a time</option>
                                </select>

                                <x-input-error :messages="$errors->get('Day')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button id="submitBtn" class="ml-4" type="submit">
                                {{ __('Confirmer') }}
                            </x-primary-button>
                            <x-primary-button class="ml-4" type="reset">
                                {{ __('Annuler') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</body>
</html>
