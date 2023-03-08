<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.47.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dentist-Template</title>
</head>
<body>
{{-- Navbar --}}
<div class="navbar bg-base-100">
    <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl">Dentist</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/RDV/create" >Make a Reservation</a></li>
            <li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="">Register</a>
                        @endif
                    @endauth
                @endif
            </li>
        </ul>
        {{--      <li><a href="{{route('register')}}">Join Us</a></li>--}}
    </div>
</div>

<div class="py-5 px-3 grid grid-cols-4 gap-4">
    <div class="h-64  col-span-2"><img class="w-full" src="{{asset('/images/1.jpg')}}"></div>
    <div class="place-content-center  h-96 col-start-3 col-end-5">
        <p class="mt-20 text-gray-900 text-7xl dark:text-white">You deserve a better</p>
        <p class="mx-60 text-blue-700 text-7xl dark:text-white">SMILE!</p>
        <button class="btn btn-primary text-xl ml-60 mt-7">Let us help you!</button>
    </div>
</div>

<section class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
        <figure class="max-w-screen-md mx-auto">
            <svg class="h-12 mx-auto mb-3 text-gray-400 dark:text-gray-600" viewBox="0 0 24 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" fill="currentColor"/>
            </svg>
            <blockquote>
                <p class="text-2xl font-medium text-gray-900 dark:text-white">"Dentist is just awesome. They Helped me a lot to get the smile i always wanted."</p>
            </blockquote>
            <figcaption class="flex items-center justify-center mt-6 space-x-3">
                <img class="w-6 h-6 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gouch.png" alt="profile picture">
                <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                    <div class="pr-3 font-medium text-gray-900 dark:text-white">Micheal Gough</div>
                    <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">Patient</div>
                </div>
            </figcaption>
        </figure>
    </div>
</section>
</body>
</html>
