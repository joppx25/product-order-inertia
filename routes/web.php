<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function ($route) {
    $route->get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    $route->group(['prefix' => 'products', 'as' => 'products.'], function ($route) {
        $route->get('/', [ProductController::class, 'index'])->name('list');
        $route->post('/store', [ProductController::class, 'store'])->name('store');
        $route->get('/create', [ProductController::class, 'create'])->name('create');
    });

    $route->group(['prefix' => 'orders', 'as' => 'orders.'], function ($route) {
        $route->get('/', [OrderController::class, 'index'])->name('list');
        $route->get('/create', [OrderController::class, 'create'])->name('create');
    });
});

