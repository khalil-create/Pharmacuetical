<?php

use App\Http\Controllers\Representative\Representative;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/manageRepresentative', [Representative::class ,'index'])->name('showRep');

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware'=>'auth'],function(){

    Route::get('/home', 'UserController@home');
    Route::get('/displayAllUsers', 'UserController@getAllUsers');
    Route::get('/addUser', 'UserController@adduser');
    Route::post('/storeUser', 'UserController@storeUser')->name('storeUser');
    Route::get('/editUser/{id}', 'UserController@editUser');
    Route::put('/userUpdate/{id}', 'UserController@userUpdate');
    Route::delete('/deleteUser/{id}', 'UserController@deleteUser');

    Route::get('/manageSupervisors', 'SupervisorController@getAllSupervisor');
    Route::get('/addSupervisor', 'SupervisorController@addSupervisor');
    Route::post('/storeSupervisor', 'SupervisorController@storeSupervisor');
    Route::get('/editSupervisor/{id}', 'SupervisorController@editSupervisor');
    Route::put('/supervisorUpdate/{id}', 'SupervisorController@updateSupervisor');
    Route::get('/mainAreaSupervised/{id}', 'SupervisorController@getSupervisorAreas');
    Route::delete('/deleteSupervisor/{id}', 'SupervisorController@deleteSupervisor');

    Route::get('/manageMainAreas', 'MainAreaController@getAllAreas');
    Route::get('/addMainArea', 'MainAreaController@addMainArea');
    Route::post('/storeMainArea', 'MainAreaController@storeMainArea');
    Route::get('/editMainArea/{areaid}', 'MainAreaController@editMainArea');
    Route::put('/UpdateMainArea/{areaid}', 'MainAreaController@UpdateMainArea');
    Route::delete('/deleteMainArea/{id}', 'MainAreaController@deleteMainArea');
    Route::get('/supAreas/{id}', 'MainAreaController@getSupAreasForMainArea');

    Route::get('/manageSubAreas', 'SubAreaController@getAllSubArea');
    Route::get('/addSubArea/{id?}', 'SubAreaController@addSubArea');
    Route::post('/storeSubArea/{id?}', 'SubAreaController@storeSubArea');
    Route::get('/editSubArea/{areaid}', 'SubAreaController@editSubArea');
    Route::put('/UpdateSubArea/{areaid}', 'SubAreaController@UpdateSubArea');
    Route::delete('/deleteSubArea/{id}', 'SubAreaController@deleteSubArea');

    Route::get('/manageCompany', 'CompanyController@getAllCompanys');
    Route::get('/addCompany', 'CompanyController@addCompany');
    Route::post('/storeCompany', 'CompanyController@storeCompany');
    Route::get('/editCompany/{id}', 'CompanyController@editCompany');
    Route::put('/UpdateCompany/{id}', 'CompanyController@UpdateCompany');
    Route::delete('/deleteCompany/{id}', 'CompanyController@deleteCompany');
    
    Route::get('/manageCategories', 'CategoryController@getAllCategories');
    Route::get('/addCategory', 'CategoryController@addCategory');
    Route::post('/storeCategory', 'CategoryController@storeCategory');
    Route::get('/editCategory/{id}', 'CategoryController@editCategory');
    Route::put('/UpdateCategory/{id}', 'CategoryController@UpdateCategory');
    Route::delete('/deleteCategory/{id}', 'CategoryController@deleteCategory');
    
    Route::get('/manageItems', 'ItemController@getAllItems');
    Route::get('/addItem', 'ItemController@addItem');
    Route::post('/storeItem', 'ItemController@storeItem');
    Route::get('/editItem/{id}', 'ItemController@editItem');
    Route::put('/UpdateItem/{id}', 'ItemController@UpdateItem');
    Route::delete('/deleteItem/{id}', 'ItemController@deleteItem');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
