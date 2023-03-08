<?php
//hey motherfucker
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RDVController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TreatementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeanceController;
use App\Http\Middleware\Client;
use App\Models\Treatment;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*----------------------------------- Create superadmin for first time -----------------------------------*/
Route::get('/superadmin',[AdminController::class,'superadmin']);

/*-----------------------------------------Access for Clients-----------------------------------------*/

// Route::group(['middleware'=>['auth', 'client']],function(){

//     Route::get('/dashboard', function () {return view('dashboard');})
//         ->name('dashboard');

// });
/*-----------------------------------------Access for client(non admin)-----------------------------------------*/

Route::middleware(['auth', 'client'])->group(function(){

    Route::get('/dashboard', [ClientController::class, 'clientprofile'])
        ->name('dashboard');

    Route::post('/dashboard/{id}',[ClientController::class, 'clientupdate'])
        ->name('update-user');

    Route::get('/usertraitement',[ClientController::class, 'index2'])
        ->name('client.usertraitement1');

    Route::get('/usertraitement/{user}',[ClientController::class, 'getUserTraitements'])
        ->name('client.usertraitement');

    Route::get('/traitement/{id}', [TreatementController::class, 'show2'])
        ->name('usertreatement.show2');


});

/* -----------------------------------------routes without Access permission-----------------------------------------*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('admin/login',[AdminController::class,'login'])
    ->name('admin.login');

Route::post('RDV/{number}',[RDVController::class, 'store']);
Route::get('RDV/create',[RDVController::class,'create']);

Route::post('/RDV/switch1/{week}',[RDVController::class, 'switch1']);
Route::post('/RDV/switch2/{week}',[RDVController::class, 'switch2']);


/*-----------------------------------------Access for Admins-----------------------------------------*/


Route::middleware(['admin'])->resource('RDV', RDVController::class)->except(['create','update']);


Route::group(['middleware' => 'admin'], function () {

    Route::get('service',[ServiceController::class,'index'])
        ->name('service.index');

    Route::prefix('admin')->group(function(){

        Route::get('/login',[AdminController::class,'loginform'])
            ->name('admin.loginform');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        Route::post('/logout',[AdminController::class, 'logout'])
            ->name('admin.logout');
    });

    Route::prefix('client')->group(function(){
        Route::get('/index',[ClientController::class,'index'])
            ->name('client.index');

        Route::get('/create', [ClientController::class, 'create'])
            ->name('client.create');

        Route::post('/store',[ClientController::class, 'store'])
            ->name('client.store');

        Route::get('/{client}', [ClientController::class, 'show'])
            ->name('client.show');

        Route::get('/{client}/edit', [ClientController::class, 'edit'])
            ->name('client.edit');

        Route::put('/{client}',[ClientController::class, 'update'])
            ->name('client.update');
    });

    Route::prefix('seance')->group(function() {

        Route::get('/{id}', [SeanceController::class, 'show'])
            ->name('seance.show');

        Route::get('/{id}/{treatement}/edit', [SeanceController::class, 'edit'])
            ->name('seance.edit');

        Route::put('/{id}',[SeanceController::class, 'update'])
            ->name('seance.update');

    });

    Route::prefix('treatement')->group(function() {

        Route::get('/{user}/list',[TreatementController::class,'list'])
            ->name('treatement.list');

        Route::get('/{id}', [TreatementController::class, 'show'])
            ->name('treatement.show');
    });

        /*-----------------------------------------Access for SuperAdmin-----------------------------------------*/
    Route::group(['middleware' => 'superadmin'], function () {

        Route::prefix('admin')->group(function(){

            Route::get('/index',[AdminController::class,'index'])
                ->name('admin.index');

            Route::get('/create', [AdminController::class, 'create'])
                ->name('admin.create');

            Route::post('/store',[AdminController::class, 'store'])
                ->name('admin.store');

            Route::get('/{admin}', [AdminController::class, 'show'])
                ->name('admin.show');

            Route::get('/{admin}/edit', [AdminController::class, 'edit'])
                ->name('admin.edit');

            Route::put('/{admin}',[AdminController::class, 'update'])
                ->name('admin.update');
        });

        Route::prefix('treatement')->group(function(){

            Route::get('/{user}/create',[TreatementController::class,'create'])
                ->name('treatement.create');

            Route::post('/store',[TreatementController::class, 'store'])
                ->name('treatement.store');

            Route::get('/{id}/{user}/edit', [TreatementController::class, 'edit'])
                ->name('treatement.edit');

            Route::put('/{id}',[TreatementController::class, 'update'])
                ->name('treatement.update');
        });

        Route::prefix('seance')->group(function(){
            Route::get('/{treatement}/create',[SeanceController::class,'create'])
                ->name('seance.create');

            Route::post('/store',[SeanceController::class, 'store'])
                ->name('seance.store');
        });
        Route::resource('/service',ServiceController::class)
            ->except(['index']);
    });
    Route::put('RDV/{week}/{id}',[RDVController::class,'update']);

});


require __DIR__.'/auth.php';
