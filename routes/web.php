<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;



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
use App\Http\Controllers\ProductAjaxController;

Route::resource('products-ajax-crud', ProductAjaxController::class);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    // Route::resource('categories', CategoryController::class);

    Route::get('/categories/show', [CategoryController::class,'show'])->name('categories.show');
    Route::get('/categories/create', [CategoryController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories/add',[CategoryController::class, 'addCategory'])->name('categories.add');
    Route::get('/categories/index',[CategoryController::class, 'index'])->name('categories.index');
    Route::delete('/categories/destroy',[CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories/edit',[CategoryController::class, 'edit'])->name('categories.edit');
});



// Route::get('/', [ProductController::class, 'index']);
// Route::get('cart', [ProductController::class, 'cart'])->name('cart');
// Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
// Route::patch('update-cart', [ProductController::class, 'update'])->name('update.cart');
// Route::delete('remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');



Route::controller(ProductAjaxController::class)->group(function(){
    // Route::get('users', 'index');
    Route::get('ProductAjaxController-export', 'export')->name('ProductAjaxController.export');
    Route::post('ProductAjaxController-import', 'import')->name('ProductAjaxController.import');
});

Route::get('generate-pdf','\App\Http\Controllers\PDFController@generatePDF')->name('gen-pdf');
Route::get('send-mail', '\App\Http\Controllers\MailController@index')->name('send-mail');
