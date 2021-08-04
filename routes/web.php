<?php

use App\Http\Controllers\Representative\Representative;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    return view('auth.login');
});

Route::get('/manageRepresentative', [Representative::class ,'index'])->name('showRep');
Route::get('/not-allowed', function(){
    return view('unAuth.not');
})->name('notAllowed');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'admin','namespace'=>'App\Http\Controllers\Admin','middleware'=>'auth','middleware'=>'admin'],function(){

    Route::get('/profile/{id}', 'ProfileController@profile');

    // Route::get('/home-admin', 'UserController@home');
    Route::get('/displayAllUsers', 'UserController@getAllUsers');
    Route::get('/addUser', 'UserController@adduser');
    Route::post('/storeUser', 'UserController@storeUser')->name('storeUser');
    Route::get('/editUser/{id}', 'UserController@editUser');
    Route::put('/userUpdate/{id}', 'UserController@userUpdate');
    Route::delete('/deleteUser/{id}', 'UserController@deleteUser');

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

    Route::get('/manageCompany', 'CompanyController@getAllCompanies');
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
    
    Route::get('/itemUses/{id}', 'UsesController@getItemUses');
    Route::get('/addUse/{id}', 'UsesController@addUse');
    Route::get('/addUseExist/{id}', 'UsesController@addUseExist');
    Route::post('/storeUse', 'UsesController@storeUse');
    Route::post('/storeUsesExist', 'UsesController@storeUsesExist');
    Route::get('/editUse/{id}', 'UsesController@editUse');
    Route::put('/updateUse/{id}', 'UsesController@updateUse');
    Route::delete('/deleteUse/{id}', 'UsesController@deleteUse');

    Route::get('/manageSamples', 'SampleController@getAllSamples');
    Route::get('/addSample', 'SampleController@addSample');
    Route::post('/storeSample', 'SampleController@storeSample');
    Route::get('/editSample/{id}', 'SampleController@editSample');
    Route::put('/updateSample/{id}', 'SampleController@updateSample');
    Route::delete('/deleteSample/{id}', 'SampleController@deleteSample');

    Route::get('/managePlanTypes', 'PlanTypeController@getAllPlanTypes');
    Route::get('/addPlanType', 'PlanTypeController@addPlanType');
    Route::post('/storePlanType', 'PlanTypeController@storePlanType');
    Route::get('/editPlanType/{id}', 'PlanTypeController@editPlanType');
    Route::put('/updatePlanType/{id}', 'PlanTypeController@updatePlanType');
    Route::delete('/deletePlanType/{id}', 'PlanTypeController@deletePlanType');

});
Route::group(['prefix'=>'managerMarketing','namespace'=>'App\Http\Controllers\Managers\marketing','middleware'=>'auth','middleware'=>'managerMarketing'],function(){
    Route::get('/profile/{id}', 'ProfileController@profile');
    Route::put('/profileUpdate/{id}', 'ProfileController@profileUpdate');

    // Route::get('/managerMarketing/home', 'SalesobjectiveController@home')->name('home');
    Route::get('/manageSalesObjectives', 'SalesobjectiveController@getAllSalesObjectives');
    Route::get('/addSalesObjective', 'SalesobjectiveController@addSalesObjective');
    Route::post('/storeSalesObjective', 'SalesobjectiveController@storeSalesObjective');
    Route::get('/editSalesObjective/{id}', 'SalesobjectiveController@editSalesObjective');
    Route::put('/updateSalesObjective/{id}', 'SalesobjectiveController@updateSalesObjective');
    Route::delete('/deleteSalesObjective/{id}', 'SalesobjectiveController@deleteSalesObjective');
    Route::get('/distributeSalesObjective/{id}', 'SalesobjectiveController@distributeSalesObjective');
    Route::post('/storeDistributedSalesObjForSup', 'SalesobjectiveController@storeDistributedSalesObjForSup');
    
    Route::get('/manageSupervisors', 'SupervisorController@getAllSupervisor');
    Route::get('/addSupervisor', 'SupervisorController@addSupervisor');
    Route::post('/storeSupervisor', 'SupervisorController@storeSupervisor');
    Route::get('/editSupervisor/{id}', 'SupervisorController@editSupervisor');
    Route::put('/supervisorUpdate/{id}', 'SupervisorController@updateSupervisor');
    Route::get('/mainAreaSupervised/{id}', 'SupervisorController@getSupervisorAreas');
    Route::delete('/deleteSupervisor/{id}', 'SupervisorController@deleteSupervisor');
    
    Route::get('/manageTasks', 'TaskController@getAllTasks');
    Route::get('/addTask', 'TaskController@addTask');
    Route::post('/storeTask', 'TaskController@storeTask');
    Route::get('/editTask/{id}', 'TaskController@editTask');
    Route::put('/updateTask/{id}', 'TaskController@updateTask');
    Route::delete('/deleteTask/{id}', 'TaskController@deleteTask');

    Route::get('/manageSamples', 'SampleController@getAllSamples');
    Route::get('/supervisorSamples/{id}', 'SampleController@getSupervisorSamples');
    Route::delete('/deleteSupervisorSamples/{id}', 'SampleController@deleteSupervisorSamples');
    Route::get('/addSupervisorSample/{id}', 'SampleController@addSample');
    Route::post('/storeSupervisorSample/{id}', 'SampleController@storeSample');
    Route::get('/editSupervisorSample/{id}', 'SampleController@editSample');
    Route::put('/updateSupervisorSample/{id}', 'SampleController@updateSample');
    Route::delete('/deleteSupervisorSample/{id}', 'SampleController@deleteSupervisorSample');

    Route::get('/manageCompanies', 'CompanyController@getAllCompanies');
    Route::get('/companyAdd', 'CompanyController@addCompany');
    Route::post('/companyStore', 'CompanyController@storeCompany');
    Route::get('/companyEdit/{id}', 'CompanyController@editCompany');
    Route::put('/companyUpdate/{id}', 'CompanyController@UpdateCompany');
    Route::delete('/companyDelete/{id}', 'CompanyController@deleteCompany');

    Route::get('/manageCategory', 'CategoryController@getAllCategories');
    Route::get('/categoryAdd', 'CategoryController@addCategory');
    Route::post('/categoryStore', 'CategoryController@storeCategory');
    Route::get('/categoryEdit/{id}', 'CategoryController@editCategory');
    Route::put('/categoryUpdate/{id}', 'CategoryController@UpdateCategory');
    Route::delete('/categoryDelete/{id}', 'CategoryController@deleteCategory');

    Route::get('/manageItem/{have_category}', 'ItemController@getAllItems');
    Route::get('/itemAdd/{have_category}', 'ItemController@addItem');
    Route::post('/itemStore/{have_category}', 'ItemController@storeItem');
    Route::get('/itemEdit/{id}', 'ItemController@editItem');
    Route::get('/itemEditNoCat/{id}', 'ItemController@editItem');
    Route::put('/itemUpdate/{id}', 'ItemController@UpdateItem');
    Route::delete('/itemDelete/{id}', 'ItemController@deleteItem');

    Route::get('/itemUses/{id}', 'UsesController@getItemUses');
    Route::get('/itemUsesNoCat/{id}', 'UsesController@getItemUses');    
    Route::get('/addUse/{id}', 'UsesController@addUse');
    Route::get('/addUseExist/{id}', 'UsesController@addUseExist');
    Route::post('/storeUse', 'UsesController@storeUse');
    Route::post('/storeUsesExist', 'UsesController@storeUsesExist');
    Route::get('/editUse/{id}', 'UsesController@editUse');
    Route::put('/updateUse/{id}', 'UsesController@updateUse');
    Route::delete('/deleteUse/{id}', 'UsesController@deleteUse');
    
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
    
    Route::get('/managePlanTypes', 'PlanTypeController@getAllPlanTypes');
    Route::get('/addPlanType', 'PlanTypeController@addPlanType');
    Route::post('/storePlanType', 'PlanTypeController@storePlanType');
    Route::get('/editPlanType/{id}', 'PlanTypeController@editPlanType');
    Route::put('/updatePlanType/{id}', 'PlanTypeController@updatePlanType');
    Route::delete('/deletePlanType/{id}', 'PlanTypeController@deletePlanType');

});

Route::group(['prefix'=>'managerSales','namespace'=>'App\Http\Controllers\Managers\sales','middleware'=>'auth','middleware'=>'managerSales'],function(){
    // Route::get('/home-manager-sales', 'SalesobjectiveController@home');
    Route::get('/profile/{id}', 'ProfileController@profile');
    Route::put('/profileUpdate/{id}', 'ProfileController@profileUpdate');

    Route::get('/manageRepresentatives', 'RepresentativeController@getAllRepresentatives');
    Route::get('/addRepresentative', 'RepresentativeController@addRepresentative');
    Route::post('/storeRepresentative', 'RepresentativeController@storeRepresentative');
    Route::get('/editRepresentative/{id}', 'RepresentativeController@editRepresentative');
    Route::put('/updateRepresentative/{id}', 'RepresentativeController@updateRepresentative');
    Route::get('/showSubareas/{id}', 'RepresentativeController@showSubareas');
    Route::get('/addRepSubareas/{id}', 'RepresentativeController@addRepSubareas');
    Route::post('/storeRepSubareas/{id}', 'RepresentativeController@storeRepSubareas');
    Route::delete('/deleteRepresentative/{id}', 'RepresentativeController@deleteRepresentative');

    Route::get('/manageMainAreas', 'MainAreaController@getAllAreas');
    Route::get('/addMainArea', 'MainAreaController@addMainArea');
    Route::post('/storeMainArea', 'MainAreaController@storeMainArea');
    Route::get('/editMainArea/{areaid}', 'MainAreaController@editMainArea');
    Route::put('/UpdateMainArea/{areaid}', 'MainAreaController@UpdateMainArea');
    Route::delete('/deleteMainArea/{id}', 'MainAreaController@deleteMainArea');
    Route::get('/supAreas/{id}', 'MainAreaController@getSupAreasForMainArea');

    Route::get('/manageSubAreas', 'SubAreaController@getAllSubArea');
    Route::get('/addSubArea/{id}', 'SubAreaController@addSubArea');
    Route::post('/storeSubArea/{id}', 'SubAreaController@storeSubArea');
    Route::get('/editSubArea/{areaid}', 'SubAreaController@editSubArea');
    Route::put('/UpdateSubArea/{areaid}', 'SubAreaController@UpdateSubArea');
    Route::get('/showRepresentatives/{id}', 'SubAreaController@showRepresentatives');
    Route::delete('/deleteSubArea/{id}', 'SubAreaController@deleteSubArea');

    Route::get('/manageCustomers', 'CustomerController@getAllCustomers');
    Route::get('/addCustomer', 'CustomerController@addCustomer');
    Route::post('/storeCustomer', 'CustomerController@storeCustomer');
    Route::get('/editCustomer/{id}', 'CustomerController@editCustomer');
    Route::put('/updateCustomer/{id}', 'CustomerController@updateCustomer');
    Route::get('/activateCustomer/{id}', 'CustomerController@activateCustomer');
    Route::get('/notActivateCustomer/{id}', 'CustomerController@notActivateCustomer');
    Route::delete('/deleteCustomer/{id}', 'CustomerController@deleteCustomer');
    
    Route::get('/manageOrders', 'OrderController@getAllOrders');
    Route::get('/addOrder', 'OrderController@addOrder');
    Route::post('/storeOrder', 'OrderController@storeOrder');
    Route::get('/editOrder/{id}', 'OrderController@editOrder');
    Route::put('/updateOrder/{id}', 'OrderController@updateOrder');
    Route::delete('/deleteOrder/{id}', 'OrderController@deleteOrder');
    
    Route::get('/manageTasks', 'TaskController@getAllTasks');
    Route::get('/addTask', 'TaskController@addTask');
    Route::post('/storeTask', 'TaskController@storeTask');
    Route::get('/editTask/{id}', 'TaskController@editTask');
    Route::put('/updateTask/{id}', 'TaskController@updateTask');
    Route::delete('/deleteTask/{id}', 'TaskController@deleteTask');
    
    Route::get('/manageServices', 'ServiceController@getAllServices');
    Route::get('/addService', 'ServiceController@addService');
    Route::post('/storeService', 'ServiceController@storeService');
    Route::get('/editService/{id}', 'ServiceController@editService');
    Route::put('/updateService/{id}', 'ServiceController@updateService');
    Route::get('/activateService/{id}', 'ServiceController@activateService');
    Route::get('/notActivateService/{id}', 'ServiceController@notActivateService');
    Route::delete('/deleteService/{id}', 'ServiceController@deleteService');

});

Route::group(['prefix'=>'supervisor','namespace'=>'App\Http\Controllers\Supervisor','middleware'=>'auth','middleware'=>'supervisor'],function(){
    Route::get('/profile/{id}', 'ProfileController@profile');

    // Route::get('/home', 'RepresentativeController@home');
    Route::get('/manageRepresentatives', 'RepresentativeController@getAllRepresentatives');
    Route::get('/addRepresentative', 'RepresentativeController@addRepresentative');
    Route::post('/storeRepresentative', 'RepresentativeController@storeRepresentative');
    Route::get('/editRepresentative/{id}', 'RepresentativeController@editRepresentative');
    Route::put('/updateRepresentative/{id}', 'RepresentativeController@updateRepresentative');
    Route::get('/showRepresentatives/{id}', 'RepresentativeController@showRepresentatives');
    Route::get('/showSubareas/{id}', 'RepresentativeController@showSubareas');
    Route::get('/addRepSubareas/{id}', 'RepresentativeController@addRepSubareas');
    Route::post('/storeRepSubareas/{id}', 'RepresentativeController@storeRepSubareas');
    // Route::post('/storeRepSubareas/{id}', 'RepresentativeController@storeRepSubareas');
    Route::delete('/deleteRepresentative/{id}', 'RepresentativeController@deleteRepresentative');

    Route::get('/manageRepItems', 'RepItemController@getAllRepItems');
    // Route::get('/addRepItem', 'RepItemController@addRepItem');
    // Route::post('/storeRepItem', 'RepItemController@storeRepItem');
    Route::get('/editRepItems/{id}', 'RepItemController@editRepItems');
    Route::put('/updateRepItems/{id}', 'RepItemController@updateRepItem');
    // Route::delete('/deleteRepItem/{id}', 'RepItemController@deleteRepItem');

    Route::get('/manageTests', 'TestController@getAllTests');
    Route::get('/addTest', 'TestController@addTest');
    Route::post('/storeTest', 'TestController@storeTest');
    Route::get('/editTest/{id}', 'TestController@editTest');
    Route::put('/updateTest/{id}', 'TestController@updateTest');
    Route::delete('/deleteTest/{id}', 'TestController@deleteTest');

    Route::get('/manageTestReps/{id}', 'TestController@getAllTestReps');
    Route::get('/manageTestTypes/{id}', 'TestController@getAllTestTypes');
    Route::get('/addTestReps/{id}', 'TestController@addTestReps');
    Route::post('/storeTestReps/{id}', 'TestController@storeTestReps');
    Route::delete('/deleteTestRep', 'TestController@deleteTestRep');

    Route::get('/manageQuestions', 'QuestionController@getAllQuestions')->name('manageQuestions');
    Route::get('/addQuestion', 'QuestionController@addQuestion')->name('addQuestion');
    Route::post('/storeQuestion/{id}', 'QuestionController@storeQuestion');
    Route::get('/editQuestion', 'QuestionController@editQuestion')->name('editQuestion');
    Route::put('/updateQuestion/{id}', 'QuestionController@updateQuestion');
    Route::delete('/deleteQuestion', 'QuestionController@deleteQuestion')->name('deleteQuestion');

    Route::get('/manageDoctors', 'DoctorController@getAllDoctors');
    Route::get('/addDoctor', 'DoctorController@addDoctor');
    Route::post('/storeDoctor', 'DoctorController@storeDoctor');
    Route::get('/editDoctor/{id}', 'DoctorController@editDoctor');
    Route::put('/updateDoctor/{id}', 'DoctorController@updateDoctor');
    Route::get('/activateDoctor/{id}', 'DoctorController@activateDoctor');
    Route::get('/notActivateDoctor/{id}', 'DoctorController@notActivateDoctor');
    Route::delete('/deleteDoctor/{id}', 'DoctorController@deleteDoctor');

    Route::get('/manageCustomers', 'CustomerController@getAllCustomers');
    Route::get('/addCustomer', 'CustomerController@addCustomer');
    Route::post('/storeCustomer', 'CustomerController@storeCustomer');
    Route::get('/editCustomer/{id}', 'CustomerController@editCustomer');
    Route::put('/updateCustomer/{id}', 'CustomerController@updateCustomer');
    Route::get('/activateCustomer/{id}', 'CustomerController@activateCustomer');
    Route::get('/notActivateCustomer/{id}', 'CustomerController@notActivateCustomer');
    Route::delete('/deleteCustomer/{id}', 'CustomerController@deleteCustomer');
    
    Route::get('/manageOrders', 'OrderController@getAllOrders');
    Route::get('/addOrder', 'OrderController@addOrder');
    Route::post('/storeOrder', 'OrderController@storeOrder');
    Route::get('/editOrder/{id}', 'OrderController@editOrder');
    Route::put('/updateOrder/{id}', 'OrderController@updateOrder');
    Route::delete('/deleteOrder/{id}', 'OrderController@deleteOrder');
    
    Route::get('/managePlanTypes', 'PlanTypeController@getAllPlanTypes');
    Route::get('/addPlanType', 'PlanTypeController@addPlanType');
    Route::post('/storePlanType', 'PlanTypeController@storePlanType');
    Route::get('/editPlanType/{id}', 'PlanTypeController@editPlanType');
    Route::put('/updatePlanType/{id}', 'PlanTypeController@updatePlanType');
    Route::delete('/deletePlanType/{id}', 'PlanTypeController@deletePlanType');
    
    Route::get('/manageSamples', 'SampleController@getAllSamples');
    Route::get('/addSample', 'SampleController@addSample');
    Route::post('/storeSample', 'SampleController@storeSample');
    Route::get('/editDividedSample/{id}', 'SampleController@editDividedSample');
    Route::put('/updateDividedSample/{id}', 'SampleController@updateDividedSample');
    Route::delete('/deleteSample/{id}', 'SampleController@deleteSample');
    Route::get('/divideSample/{id}', 'SampleController@divideSample');
    Route::post('/storeDividedSample', 'SampleController@storeDividedSample');
    Route::get('/displaySampleReps/{id}', 'SampleController@displaySampleReps');

    Route::get('/manageCompanies', 'CompanyController@getAllCompanies');
    Route::get('/companyAdd', 'CompanyController@addCompany');
    Route::post('/companyStore', 'CompanyController@storeCompany');
    Route::get('/companyEdit/{id}', 'CompanyController@editCompany');
    Route::put('/companyUpdate/{id}', 'CompanyController@UpdateCompany');
    Route::delete('/companyDelete/{id}', 'CompanyController@deleteCompany');

    Route::get('/manageCategory', 'CategoryController@getAllCategories');
    Route::get('/categoryAdd', 'CategoryController@addCategory');
    Route::post('/categoryStore', 'CategoryController@storeCategory');
    Route::get('/categoryEdit/{id}', 'CategoryController@editCategory');
    Route::put('/categoryUpdate/{id}', 'CategoryController@UpdateCategory');
    Route::delete('/categoryDelete/{id}', 'CategoryController@deleteCategory');

    Route::get('/manageItem/{have_category}', 'ItemController@getAllItems');
    Route::get('/itemAdd/{have_category}', 'ItemController@addItem');
    Route::post('/itemStore/{have_category}', 'ItemController@storeItem');
    Route::get('/itemEdit/{id}', 'ItemController@editItem');
    Route::get('/itemEditNoCat/{id}', 'ItemController@editItem');
    Route::put('/itemUpdate/{id}', 'ItemController@UpdateItem');
    Route::delete('/itemDelete/{id}', 'ItemController@deleteItem');

    Route::get('/itemUses/{id}', 'UsesController@getItemUses');
    Route::get('/itemUsesNoCat/{id}', 'UsesController@getItemUses');    
    Route::get('/addUse/{id}', 'UsesController@addUse');
    Route::get('/addUseExist/{id}', 'UsesController@addUseExist');
    Route::post('/storeUse', 'UsesController@storeUse');
    Route::post('/storeUsesExist', 'UsesController@storeUsesExist');
    Route::get('/editUse/{id}', 'UsesController@editUse');
    Route::put('/updateUse/{id}', 'UsesController@updateUse');
    Route::delete('/deleteUse/{id}', 'UsesController@deleteUse');
    
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

    Route::get('/manageChargedTasks', 'TaskController@getAllChargedTasks');
    Route::get('/performTask/{id}', 'TaskController@performTask');
    Route::post('/storePerformTask/{id}', 'TaskController@storePerformTask');
    Route::get('/manageDistributedTasks', 'TaskController@getAllDistributedTasks');
    Route::get('/addDistributedTask', 'TaskController@addDistributedTask');
    Route::post('/storeDistributedTask', 'TaskController@storeDistributedTask');
    Route::get('/editDistributedTask/{id}', 'TaskController@editDistributedTask');
    Route::put('/updateDistributedTask/{id}', 'TaskController@updateDistributedTask');
    Route::delete('/deleteDistributedTask/{id}', 'TaskController@deleteDistributedTask');
    
    Route::get('/managePlanTypes', 'PlanTypeController@getAllPlanTypes');
    Route::get('/addPlanType', 'PlanTypeController@addPlanType');
    Route::post('/storePlanType', 'PlanTypeController@storePlanType');
    Route::get('/editPlanType/{id}', 'PlanTypeController@editPlanType');
    Route::put('/updatePlanType/{id}', 'PlanTypeController@updatePlanType');
    Route::delete('/deletePlanType/{id}', 'PlanTypeController@deletePlanType');

    Route::get('/manageServices', 'ServiceController@getAllServices');
    Route::get('/addService', 'ServiceController@addService');
    Route::post('/storeService', 'ServiceController@storeService');
    Route::get('/editService/{id}', 'ServiceController@editService');
    Route::put('/updateService/{id}', 'ServiceController@updateService');
    Route::get('/activateService/{id}', 'ServiceController@activateService');
    Route::get('/notActivateService/{id}', 'ServiceController@notActivateService');
    Route::delete('/deleteService/{id}', 'ServiceController@deleteService');

    Route::get('/manageVisits', 'VisitController@getAllVisits');
    Route::get('/addVisit', 'VisitController@addVisit');
    Route::post('/storeVisit', 'VisitController@storeVisit');
    Route::get('/editVisit/{id}', 'VisitController@editVisit');
    Route::put('/updateVisit/{id}', 'VisitController@updateVisit');
    Route::delete('/deleteVisit/{id}', 'VisitController@deleteVisit');

    Route::get('/manageTrainingCourses', 'TrainingCourseController@getAllCourses');
    Route::get('/addCourse', 'TrainingCourseController@addCourse');
    Route::post('/storeCourse/{id?}', 'TrainingCourseController@storeCourse');
    Route::get('/editCourse/{id}', 'TrainingCourseController@editCourse');
    Route::put('/updateCourse/{id}', 'TrainingCourseController@updateCourse');
    Route::delete('/deleteCourse/{id}', 'TrainingCourseController@deleteCourse');

    Route::get('/manageSalesObjectives', 'SalesobjectiveController@getAllSalesObjectives');
    Route::get('/addDividedSalesObjective/{id}', 'SalesobjectiveController@addDividedSalesObjective');
    Route::post('/storeDividedSalesObjective/{id}', 'SalesobjectiveController@storeDividedSalesObjective');
    Route::get('/editDividedSalesObjective/{id}', 'SalesobjectiveController@editDividedSalesObjective');
    Route::put('/updateDividedSalesObjective/{id}', 'SalesobjectiveController@updateDividedSalesObjective');
    Route::delete('/deleteDividedSalesObjective/{id}', 'SalesobjectiveController@deleteDividedSalesObjective');
    Route::get('/divideSalesObjective/{id}', 'SalesobjectiveController@divideSalesObjective');
    Route::post('/storeDividedSalesObjectives', 'SalesobjectiveController@storeDividedSalesObjectives');
    Route::get('/displaySalesObjectiveReps/{id}', 'SalesobjectiveController@displaySalesObjectiveReps');

    Route::get('/manageStudies', 'StudyController@getAllStudies');
    Route::get('/addStudy', 'StudyController@addStudy');
    Route::post('/storeStudy', 'StudyController@storeStudy');
    Route::get('/editStudy/{id}', 'StudyController@editStudy');
    Route::put('/UpdateStudy/{id}', 'StudyController@UpdateStudy');
    Route::delete('/deleteStudy/{id}', 'StudyController@deleteStudy');
    
    Route::get('/studyStrengths/{id}', 'StrengthController@getStudyStrengths');
    Route::get('/addStrength/{id}', 'StrengthController@addStrength');
    Route::post('/storeStrength', 'StrengthController@storeStrength');
    Route::get('/editStrength/{id}', 'StrengthController@editStrength');
    Route::put('/updateStrength/{id}', 'StrengthController@updateStrength');
    Route::delete('/deleteStrength/{id}', 'StrengthController@deleteStrength');
    // Route::get('/addStrengthsExist/{id}', 'StrengthController@addStrengthsExist');
    // Route::post('/storeStrengthsExist', 'StrengthController@storeStrengthsExist');
});

Route::group(['prefix'=>'repScience','namespace'=>'App\Http\Controllers\Representatives\Science','middleware'=>'auth','middleware'=>'repScience'],function(){
    Route::get('/profile/{id}', 'ProfileController@profile');
    
    // Route::get('/home', 'RepresentativeController@home');
    Route::get('/manageDoctors', 'DoctorController@getAllDoctors')->name('show.doctors');
    Route::get('/addDoctor', 'DoctorController@addDoctor');
    Route::post('/storeDoctor', 'DoctorController@storeDoctor');
    Route::get('/editDoctor/{id}', 'DoctorController@editDoctor');
    Route::put('/updateDoctor/{id}', 'DoctorController@updateDoctor');
    Route::delete('/deleteDoctor/{id}', 'DoctorController@deleteDoctor');

    Route::get('/manageCustomers', 'CustomerController@getAllCustomers')->name('show.customers');
    Route::get('/addCustomer', 'CustomerController@addCustomer');
    Route::post('/storeCustomer', 'CustomerController@storeCustomer');
    Route::get('/editCustomer/{id}', 'CustomerController@editCustomer');
    Route::put('/updateCustomer/{id}', 'CustomerController@updateCustomer');
    Route::delete('/deleteCustomer/{id}', 'CustomerController@deleteCustomer');
    
    Route::get('/manageOrders', 'OrderController@getAllOrders');
    Route::get('/addOrder', 'OrderController@addOrder');
    Route::post('/storeOrder', 'OrderController@storeOrder');
    Route::get('/editOrder/{id}', 'OrderController@editOrder');
    Route::put('/updateOrder/{id}', 'OrderController@updateOrder');
    Route::delete('/deleteOrder/{id}', 'OrderController@deleteOrder');

    Route::get('/manageAlternatives', 'AlternativeController@getAllAlternatives')->name('show.alternatives');
    Route::get('/addAlternative', 'AlternativeController@addAlternative');
    Route::post('/storeAlternative', 'AlternativeController@storeAlternative');
    Route::get('/editAlternative/{id}', 'AlternativeController@editAlternative');
    Route::put('/updateAlternative/{id}', 'AlternativeController@updateAlternative');
    Route::delete('/deleteAlternative/{id}', 'AlternativeController@deleteAlternative');

    Route::get('/manageCompetitionServices', 'CompetitionServiceController@getAllCompetitionServices');
    Route::get('/addCompetitionService', 'CompetitionServiceController@addCompetitionService');
    Route::post('/storeCompetitionService', 'CompetitionServiceController@storeCompetitionService');
    Route::get('/editCompetitionService/{id}', 'CompetitionServiceController@editCompetitionService');
    Route::put('/updateCompetitionService/{id}', 'CompetitionServiceController@updateCompetitionService');
    Route::delete('/deleteCompetitionService/{id}', 'CompetitionServiceController@deleteCompetitionService');

    Route::get('/managePromotionMaterials', 'PromotionController@getAllPromotionMaterials');
    Route::get('/addPromotionMaterial', 'PromotionController@addPromotionMaterial');
    Route::post('/storePromotionMaterial', 'PromotionController@storePromotionMaterial');
    Route::get('/editPromotionMaterial/{id}', 'PromotionController@editPromotionMaterial');
    Route::put('/updatePromotionMaterial/{id}', 'PromotionController@updatePromotionMaterial');
    Route::delete('/deletePromotionMaterial/{id}', 'PromotionController@deletePromotionMaterial');

    Route::get('/managePlans', 'PlanController@getAllPlans')->name('show.plans');
    Route::get('/addPlan', 'PlanController@addPlan');
    Route::post('/storePlan', 'PlanController@storePlan');
    Route::get('/editPlan/{id}', 'PlanController@editPlan');
    Route::put('/updatePlan/{id}', 'PlanController@updatePlan');
    Route::delete('/deletePlan/{id}', 'PlanController@deletePlan');

    Route::get('/planDetials/{id}', 'PlanCustController@planDetials');
    Route::post('/storePlanCustomer/{id}', 'PlanCustController@storePlanCustomer');
    Route::get('/editPlanCustomer/{id}', 'PlanCustController@editPlanCustomer');
    Route::put('/updatePlanCustomer/{id}', 'PlanCustController@updatePlanCustomer');
    Route::delete('/deletePlanCustomer/{id}', 'PlanCustController@deletePlanCustomer');

    Route::get('/manageServices', 'ServiceController@getAllServices')->name('show.services');
    Route::get('/addService', 'ServiceController@addService');
    Route::post('/storeService', 'ServiceController@storeService');
    Route::get('/editService/{id}', 'ServiceController@editService');
    Route::put('/updateService/{id}', 'ServiceController@updateService');
    Route::delete('/deleteService/{id}', 'ServiceController@deleteService');
    
    Route::get('/manageVisits', 'VisitController@getAllVisits');
    Route::get('/addVisit', 'VisitController@addVisit');
    Route::post('/storeVisit', 'VisitController@storeVisit');
    Route::get('/editVisit/{id}', 'VisitController@editVisit');
    Route::put('/updateVisit/{id}', 'VisitController@updateVisit');
    Route::delete('/deleteVisit/{id}', 'VisitController@deleteVisit');
    
    Route::get('/manageCourses', 'TrainingCourseController@getAllCourses')->name('show.courses');
    
    Route::get('/manageTests', 'TestController@getAllTests')->name('show.tests');
    Route::get('/repTests/{id}', 'TestController@getRepTests');
    Route::post('/storeRepTest/{id}', 'TestController@storeRepTest');
    Route::get('/editVisit/{id}', 'VisitController@editVisit');
    Route::put('/updateVisit/{id}', 'VisitController@updateVisit');
    Route::delete('/deleteVisit/{id}', 'VisitController@deleteVisit');

    Route::get('/showStudies', 'StudyController@getAllStudies')->name('show.studies');

    Route::get('/showSalesObjectives', 'SalesobjectiveController@getAllSalesObjectives')->name('show.objectives');

    Route::get('/showChargedTasks', 'TaskController@getAllChargedTasks')->name('show.tasks');
    Route::get('/performTask/{id}', 'TaskController@performTask');
    Route::post('/storePerformTask/{id}', 'TaskController@storePerformTask');

});
Route::group(['prefix'=>'repSales','namespace'=>'App\Http\Controllers\Representatives\Sales','middleware'=>'auth','middleware'=>'repSales'],function(){
    Route::get('/profile/{id}', 'ProfileController@profile');
    Route::put('/profileUpdate/{id}', 'ProfileController@profileUpdate');

    Route::get('/manageCustomers', 'CustomerController@getAllCustomers');
    Route::get('/addCustomer', 'CustomerController@addCustomer');
    Route::post('/storeCustomer', 'CustomerController@storeCustomer');
    Route::get('/editCustomer/{id}', 'CustomerController@editCustomer');
    Route::put('/updateCustomer/{id}', 'CustomerController@updateCustomer');
    Route::get('/activateCustomer/{id}', 'CustomerController@activateCustomer');
    Route::get('/notActivateCustomer/{id}', 'CustomerController@notActivateCustomer');
    Route::delete('/deleteCustomer/{id}', 'CustomerController@deleteCustomer');
    
    Route::get('/manageOrders', 'OrderController@getAllOrders');
    Route::get('/addOrder', 'OrderController@addOrder');
    Route::post('/storeOrder', 'OrderController@storeOrder');
    Route::get('/editOrder/{id}', 'OrderController@editOrder');
    Route::put('/updateOrder/{id}', 'OrderController@updateOrder');
    Route::delete('/deleteOrder/{id}', 'OrderController@deleteOrder');
    
    Route::get('/showChargedTasks', 'TaskController@getAllChargedTasks');
    Route::get('/performTask/{id}', 'TaskController@performTask');
    Route::post('/storePerformTask/{id}', 'TaskController@storePerformTask');
    
    Route::get('/manageServices', 'ServiceController@getAllServices');
    Route::get('/addService', 'ServiceController@addService');
    Route::post('/storeService', 'ServiceController@storeService');
    Route::get('/editService/{id}', 'ServiceController@editService');
    Route::put('/updateService/{id}', 'ServiceController@updateService');
    Route::get('/activateService/{id}', 'ServiceController@activateService');
    Route::get('/notActivateService/{id}', 'ServiceController@notActivateService');
    Route::delete('/deleteService/{id}', 'ServiceController@deleteService');

});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
