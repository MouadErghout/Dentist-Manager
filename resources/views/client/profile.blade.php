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
    background-color: #2d3748;
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
                    mon profile
                </div>
                
            </div>
        </div>
    </div>
    <!-- End of Navbar -->

        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-gray-800">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                            alt="">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $user->firstname }} {{ $user->lastname }}</h1>
                    <h6 class="text-gray-600 font-lg text-semibold leading-6">Dentist Client</h6>
                    <br>
                    <p class="text-sm text-gray-700 hover:text-gray-800 leading-6">this is your profile page where you can
                        access all the informations about you and your treatements and the services provided by the Doctor
                    </p>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span class="text-gray-900">Member since</span>
                            <span class="ml-auto">{{ $user->created_at }}</span>
                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>
              
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">

                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">First Name</div>
                                <div class="px-4 py-2">{{ $user->firstname }}</div>
                            </div>

                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Last Name</div>
                                <div class="px-4 py-2">{{ $user->lastname }}</div>
                            </div>
                            
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Contact No</div>
                                <div class="px-4 py-2">{{ $user->phonenumber }}</div>
                            </div>

                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">CIN</div>
                                <div class="px-4 py-2">{{ $user->cin }}</div>
                            </div>
                            
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <div class="px-4 py-2">
                                    <a class="text-blue-500" href="mailto:jane@example.com">{{ $user->email }}</a>
                                </div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Birthday</div>
                                <div class="px-4 py-2">{{ $user->birthday }}</div>
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Social Security Number</div>
                                <div class="px-4 py-2">{{ $user->numero_securite_sociale }}</div>
                            </div>
                        </div>

                        <button id="modifyBtn" class="bg-custom-color hover:bg-blue-900 text-white font-bold py-2 px-10 rounded" data-toggle="modal" data-target="#modifyModal">
                            Modify 
                        </button>
                        <div class="modal" tabindex="-1" role="dialog" id="modifyModal">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Modify User</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form id="modifyForm">
                                    @csrf               
                                    <div ><label>First Name:</label>
                                    <input type="text" name="firstname" value="{{$user->firstname}}"></div>

                                    <div ><label>Last Name:</label>
                                    <input type="text" name="lastname" value="{{$user->lastname}}"></div>

                                    <div ><label>Email:</label>
                                    <input type="email" name="email" value="{{$user->email}}"></div>

                                    <div ><label>Contact No:</label>
                                    <input type="text" name="phonenumber" value="{{$user->phonenumber}}"></div>

                                    <div ><label>CIN:</label>
                                    <input type="text" name="cin" value="{{$user->cin}}"></div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>                        
                    </div>
                    
                   
                    
                </div>
                
                <!-- End of profile tab -->
            </div>
        </div>
</div>

<script>
    
    $("#modifyBtn").click(function(){
        console.log("Modify button clicked");
        $("#modifyForm").show();
    });
    
    $("#updateBtn").click(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"{{route('update-user', ['id' => $user->id])}}",
            data:$("#modifyForm").serialize(),
            success:function(data){
             $("#modifyModal .close").trigger("click");
             console.log("success",data);
             location.reload();            
            }
        });
    });

    
</script>