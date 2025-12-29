<?php
use App\Http\Middleware\AuthCustom;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\AdminController;
use function Pest\Laravel\withMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::post('/login', function () {
//     return view('login');
// })->name('login');

// Route::post('/regi', function () {
//     return view('regi');
// });

// Route::post('/show', function () {
//     return view('show');
// })->name('show');


Route::get('/', function () {
    return view('welcome');
});

/* Show login page */
Route::get('/login', function () {
    return view('login');
})->name('login');


Route::post('login-check',[UserController::class,'login'])->name('login-check');

Route::get('/regi', function () {
    return view('regi');
})->name('regi');

Route::post('/regi-store',[UserController::class, 'store'])->name('store');
Route::post('/regi', function () {
    return redirect('/login');
});

/* Show dashboard */
Route::get('/admin_show', [UserController::class,'show']) ->middleware('auth.custom')->name('show');

// Route::get('/user_show', function () {
//     return view('user_show');
// });

Route::get('/user/{id}/edit', [UserController::class,'edit'])
    ->middleware('auth.custom')
    ->name('user.edit');

Route::put('/user/{id}/update', [UserController::class,'update'])
    ->middleware('auth.custom')
    ->name('user.update');

Route::delete('/user/{id}/delete', [UserController::class,'delete'])
    ->middleware('auth.custom')
    ->name('user.delete');

      Route::get('/user_show', function () {
        return view('user_show');
    })->middleware('auth.custom')
->name('user_show');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['auth.custom'])->group(function () {

  

    Route::get('/pay', [PaymentController::class, 'showPayPage'])
        ->name('pay');

    Route::post('/create-order', [PaymentController::class, 'createOrder'])
        ->name('order.create');

    Route::post('/payment-success', [PaymentController::class, 'paymentSuccess'])
        ->name('payment.success');
});

Route::get('/send-users-pdf', [AdminController::class, 'sendUsersPDF'])
    ->middleware([AuthCustom::class, IsAdmin::class])
    ->name('admin.send.users.pdf');
