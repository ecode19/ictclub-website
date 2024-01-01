<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// Defining Admin Routes
Route::controller(AdminController::class)->prefix('admin')->middleware('admin')->group(function(){
Route::get('AdminDashboard', 'Dashboard')->name('AdminDashboard');
Route::get('post_page', 'post')->name('post_event');
Route::get('add_Member','addMember')->name('add_Member');
Route::get('resource_repository','Repository')->name('resource_repository');
Route::post('storeResource','storeResource')->name('storeResource');
Route::get('member_list','memberList')->name('member_list');
Route::get('departments','departments')->name('departments');
Route::get('add_department','addDepartment')->name('add_department');
Route::get('update/{id}','update')->name('update');
Route::put('edit/{id}','edit')->name('edit');
Route::post('eventUpload', 'eventUpload')->name('eventUpload');
Route::get('events','events')->name('events');
Route::post('newDepartment','newDepartment')->name('newDepartment');
Route::post('newMember','newMember')->name('newMember');
    });



    // Defining user Routes
Route::controller(UserController::class)->prefix('user')->middleware(['user', 'payment'])->group(function(){
Route::get('Dashboard', 'Dashboard')->name('Dashboard');
//    Route::get('event', 'event')->name('event');
    Route::get('membershipCard', 'membershipCard')->name('membershipCard');
    Route::get('announcement', 'announcement')->name('announcement');
    Route::get('resourcesView', 'resourcesView')->name('resourcesView');
    Route::get('accessDenied', 'accessDenied')->name('accessDenied');
    Route::get('profileUpdate/{id}', 'profileUpdate')->name('profileUpdate');
    Route::put('updateProfile', 'updateProfile')->name('updateProfile');
    Route::get('EventDetails/{id}', 'showEventDetails')->name('EventDetails');
    Route::get('discusion_forum', 'discusionForum')->name('discusion_forum');
    });

// Defining user Routes
Route::controller(UserController::class)->prefix('user')->group(function(){
    Route::get('accessDenied', 'accessDenied')->name('accessDenied');
});

// Route::get('admin', function () {
//     return view('admin');
// })->name('admin')->middleware('admin');

// Route::get('user', function () {
//     return view('user');
// })->name('user')->middleware('user');
