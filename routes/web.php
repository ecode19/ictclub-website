<?php

use App\Models\event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CyberSecurityController;
use App\Http\Controllers\GraphicsDesigningController;
use App\Http\Controllers\ProgrammingController;

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
    $news = event::all();
    return view('index', compact('news'));
});

Auth::routes(['verify' => true]);


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'getAllUsers'])->name('get.AllUsers');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about.page');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact.page');
Route::post('/message', [App\Http\Controllers\HomeController::class, 'message'])->name('message');
Route::get('/departments', [App\Http\Controllers\HomeController::class, 'departments'])->name('department.page');
Route::get('departments/programming', [App\Http\Controllers\HomeController::class, 'programmingDepartment'])->name('programming');
Route::get('departments/graphics-designing', [App\Http\Controllers\HomeController::class, 'graphicsDesigningDepartment'])->name('graphics.department');
Route::get('departments/computer-networking', [App\Http\Controllers\HomeController::class, 'networkingDepartment'])->name('networking.department');

Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacy-policy.page');
Route::get('/licence and use', [App\Http\Controllers\HomeController::class, 'licenceAndUse'])->name('licence and use.page');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// Defining super Admin Routes
Route::controller(AdminController::class)->prefix('admin')->group(function () {
//pdfs
Route::get('/all-members', 'allRegisteredMembersPDF')->name('all.registered.members');
    Route::get('/assign-admin', 'showAssignForm')->name('showAssignForm');
    Route::post('/assign-admin', 'assignAdmin')->name('assignAdmin');
    Route::delete('/delete-admin/{id}', 'deleteAdmin')->name('delete.admin');
    Route::get('AdminDashboard', 'Dashboard')->name('AdminDashboard');
    Route::get('comments', 'comments')->name('admin.comments');
    Route::delete('/comment-destroty{id}', 'commentDestroy')->name('admin.destroy.comment');
    Route::get('post_page', 'post')->name('post_event');
    Route::get('add_Member', 'addMember')->name('admin.register.member');
    Route::delete('/delete/member/{id}', 'memberDestroy')->name('destroy.member');
    Route::get('resource_repository', 'Repository')->name('resource_repository');
    //super admin resource routes
    Route::post('storeResource', 'storeResource')->name('storeResource');
    Route::post('uploadResource', 'uploadResource')->name('admin.upload.resources');
    Route::get('preview/{file}', 'documentPreview')->name('admin.document.preview');
    route::delete('/delete/resource/{id}', 'destroy')->name('resource.destroy');
    Route::get('member_list', 'memberList')->name('member_list');
    //super admin department routes
    Route::get('departments', 'departments')->name('departments');
    Route::get('add_department', 'addDepartment')->name('add_department');
    route::delete('/admin/delete-department/{id}', 'departmentDestroy')->name('admin.department.destroy');

    Route::get('update/{id}', 'update')->name('update');
    Route::put('edit/{id}', 'edit')->name('edit');
    Route::post('eventUpload', 'eventUpload')->name('eventUpload');
    Route::get('events', 'events')->name('events');
    Route::post('newDepartment', 'newDepartment')->name('newDepartment');
    Route::post('newMember', 'newMember')->name('newMember');
    //financial related routes
    Route::get('/financial-panel', 'financialPanel')->name('admin.financial.panel');
});

// Defining programming admin Routes
Route::controller(ProgrammingController::class)->prefix('admin/departments')->middleware('auth', 'programming')->group(function () {
    Route::get('programming/dashboard', 'programmingDepartment')->name('programming.dashboard');
    //programming member
    Route::get('/programming/register-member', 'register')->name('programming.register.member');
    Route::post('/register-programming-member', 'newProgrammingMember')->name('new.programming.member');
    Route::get('/programming/programming-members', 'programmingMembers')->name('programming.members');
    Route::get('/programming/registration-numbers', 'registerNumbers')->name('programming.register.number');

    Route::get('/programming/update/{id}', 'memberUpdateView')->name('programming.member.update');
    Route::put('/programming/edit/{id}', 'edit')->name('programming.member.edit');

    Route::delete('/programming-member/delete/{id}', 'memberDestroy')->name('programming.member.delete');
    //programming routes related to event
    Route::get('/programming/create-event', 'createEvent')->name('programming.create.event');
    Route::post('/programming/post-event', 'eventUpload')->name('programming.postEvent');
    Route::get('/programming/event-details/{id}', 'programmingEventDetails')->name('programming.event.details');
    Route::delete('/programming/event/{id}', 'eventDestroy')->name(('programming.destroy.event'));
    //programming routes related to resources
    Route::get('/programming/post-resources', 'resources')->name('programming.post-resources');
    Route::post('/programming-upload-resource', 'uploadResource')->name('programming.upload.resource');
    Route::get('/programming/preview/{file}', 'documentPreview')->name('programming.resource.preview');
    Route::get('/programming/update-resource/{id}', 'resourceUpdateView')->name('programming.resource.update.view');
    Route::get('/programming/programming-resources', 'programmingResources')->name('programming.resource.view');
    route::delete('/delete/resource/{id}', 'destroy')->name('resource.destroy');
    //programming routes related to finance
    route::get('/programming/department-financial-panel', 'programmingFinancial')->name('programming.financial.panel');
    //programming routes related to messages from website users
    Route::get('/programming-messages', 'programmingMessages')->name('programming.messages');
    Route::delete('/programming/message-destroty{id}', 'messageDestroy')->name('programming.message.destroy');
    Route::get('/name/search', 'searchByRegNumber')->name('names.search');

    // Route::get('/name/search', 'searchByRegNumber')->name('names.search');
    // Route::get('/cyber-security/registration-numbers', 'registerNumbers')->middleware('cyber-security')->name('cyber-security.register.number');
    Route::post('/store', 'store')->name('store'); ///storing registration numbers
});

//cyber security department routes
Route::controller(CyberSecurityController::class)->prefix('admin/departments')->middleware('auth', 'cyber-security')->group(function () {
    Route::get('/cyber-security/dashboard', 'cyberSecurityDepartment')->name('cyberSecurity.department');
    //cyber security routes related to cyber member
    Route::get('/cyber-security/register-member', 'register')->name('cyber-security.register.member');
    route::post('/cyber-security/register-member', 'newCyberMember')->name('cyber-security.new.member');
    Route::get('/cyber-security/cyber-security-members', 'cyberMembers')->name('cyber-security.members');

    Route::get('/cyber-security/update/{id}', 'update')->name('cyber-security.member.update');
    Route::put('cyber-security/edit/{id}', 'edit')->name('cyber-security.member.edit');

    Route::get('/cyber-security/registration-numbers', 'registerNumbers')->name('cyber-security.register.number');
    Route::delete('/delete/member/{id}', 'memberDestroy')->name('cyber-security.member.destroy');
    //cyber security related to cyber event
    Route::get('/cyber-security/create-event', 'createEvent')->name('cyber-security.create.event');
    Route::post('/cyber-security/post-event', 'eventUpload')->name('cyber-security.postCyberEvent');
    Route::get('/cyber-security/event-details/{id}', 'cyberEventDetails')->name('cyber-security.event.details');
    Route::delete('/cyber-security/event/{id}', 'eventDestroy')->name(('cyber-security.destroy.event'));
    //cyber security routes related to cyber resources
    Route::get('/cyber-security/post-resources', 'resources')->name('cyber-security.post-resources');
    Route::post('/uploading-cyber-resource', 'uploadResource')->name('cyber-security.upload.resource');
    Route::get('/cyber-security/preview/{file}', 'documentPreview')->name('cyber-security.resource.preview');
    Route::get('/cyber-security/update-resource/{id}', 'resourceUpdateView')->name('cyber-security.resource.update.view');
    Route::get('/cyber-security/cyber-resources', 'cyberResources')->name('cyber-security.resource.view');
    //programming routes related to finance
    route::get('/cyber-security/department-financial-panel', 'cyberFinancial')->name('cyber-security.financial.panel');
    route::delete('/delete/resource/{id}', 'destroy')->name('resource.destroy');
    //cyber security routes related to messages from website users
    Route::get('/cyberSecurity-messages', 'cyberMessages')->name('cyber-security.messages');
    Route::delete('/cyber-security/message-destroty{id}', 'messageDestroy')->name('cyber-security.message.destroy');
    Route::get('/name/search', 'searchByRegNumber')->name('names.search');
});

// Defining Graphics and Designing admin Routes
Route::controller(GraphicsDesigningController::class)->prefix('admin/departments')->middleware('auth')->group(function () {
    Route::get('graphics-designing/dashboard', 'graphicsDepartment')->name('graphics.dashboard');
    //Graphics and Designing member routes
    Route::get('/graphics/register-member', 'register')->name('graphics.register.member');
    Route::post('/register-graphics-member', 'newGraphicsgMember')->name('new.graphics.member');
    Route::get('/graphics/graphics-members', 'graphicsMembers')->name('graphics.members');
    Route::get('/graphics/registration-numbers', 'registerNumbers')->name('graphics.register.number');
    Route::get('/graphics/update-member-details/{id}', 'memberUpdateView')->name('graphics.update.member.view');
    Route::put('/edit/informations/{id}', 'edit')->name('graphics.update.member.info');
    Route::delete('/graphics-member/delete/{id}', 'memberDestroy')->name('graphics.member.delete');
    //Graphics and designing routes related to event
    Route::get('/graphics/create-event', 'createEvent')->name('graphics.create.event');
    Route::post('/graphics/post-event', 'eventUpload')->name('graphics.postEvent');
    Route::get('/graphics/event-details/{id}', 'graphicsEventDetails')->name('graphics.event.details');
    Route::delete('/graphics/event/{id}', 'eventDestroy')->name(('graphics.destroy.event'));
    //Graphics and Designing routes related to resources
    Route::get('/graphics/post-resources', 'resources')->name('graphics.post-resources');
    Route::post('/graphics-upload-resource', 'uploadResource')->name('graphics.upload.resource');
    Route::get('/graphics/update-resource/{id}', 'resourceUpdateView')->name('graphics.resource.update.view');
    Route::get('/graphics/graphics-resources', 'graphicsResources')->name('graphics.resource.view');
    Route::put('/update-resource/{id}', 'updateResourceInfo')->name('graphics.update.resource');
    route::delete('/delete/resource/{id}', 'destroy')->name('resource.destroy');
    //Graphics and Designing routes related to finance
    route::get('/department-financial-panel', 'graphicsFinancial')->name('graphics.financial.panel');
    //Graphics and Designing routes related to messages from website users
    Route::get('/graphics-messages', 'graphicsMessages')->name('graphics.messages');
    Route::delete('/graphics/message-destroty{id}', 'messageDestroy')->name('graphics.message.destroy');
    Route::get('/name/search', 'searchByRegNumber')->name('names.search');
    //document preview
    Route::get('preview/{file}', 'documentPreview')->name('graphics.resource.preview');

    // Route::get('/name/search', 'searchByRegNumber')->name('names.search');
    // Route::get('/cyber-security/registration-numbers', 'registerNumbers')->middleware('cyber-security')->name('cyber-security.register.number');

    Route::post('/store', 'store')->name('store'); ///storing registration numbers
});

// Defining user Routes
Route::controller(UserController::class)->prefix('user')->middleware(['auth', 'user', 'payment'])->group(function () {
    Route::get('Dashboard', 'Dashboard')->name('member.dashboard');
    Route::get('announcement', 'announcement')->name('announcement');
    Route::get('resources', 'resources')->name('resources.page');
    Route::get('accessDenied', 'accessDenied')->name('accessDenied');

    Route::get('profile-update/{id}', 'profileUpdate')->name('member.profile.update.form');
    Route::put('updateProfile', 'updateProfile')->name('member.profile.update');

    Route::get('EventDetails/{id}', 'showEventDetails')->name('EventDetails');
    Route::get('discusion-forum', 'discusionForum')->name('discusion-forum.page');

    //document related routes
    Route::get('preview/{file}', 'documentPreview')->name('resource.preview');
});

// Defining user Routes
Route::controller(UserController::class)->prefix('user')->group(function () {
    Route::get('accessDenied', 'accessDenied')->name('accessDenied');
});
