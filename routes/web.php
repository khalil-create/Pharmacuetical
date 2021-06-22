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
    return view('welcome');
});

Route::get('/manageRepresentative', [Representative::class ,'index'])->name('showRep');
Route::get('/not-allowed', function(){
    return view('unAuth.not');
})->name('notAllowed');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'admin','namespace'=>'App\Http\Controllers\Admin','middleware'=>'auth','middleware'=>'admin'],function(){

    // Route::get('/home-admin', 'UserController@home');
    Route::get('/displayAllUsers', 'UserController@getAllUsers');
    Route::get('/addUser', 'UserController@adduser');
    Route::post('/storeUser', 'UserController@storeUser')->name('storeUser');
    Route::get('/editUser/{id}', 'UserController@editUser');
    Route::put('/userUpdate/{id}', 'UserController@userUpdate');
    Route::delete('/deleteUser/{id}', 'UserController@deleteUser');
    
    // Route::get('/manageManagers', 'ManagerController@getAllManagers');
    // Route::get('/addManager', 'ManagerController@addManager');
    // Route::post('/storeManager', 'ManagerController@storeManager');
    // Route::get('/editManager/{id}', 'ManagerController@editManager');
    // Route::put('/updateManager/{id}', 'ManagerController@updateManager');
    // Route::delete('/deleteUser/{id}', 'UserController@deleteUser');

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
    
    
    Route::get('/manageSamples', 'SampleController@getAllSamples');
    Route::get('/addSample', 'SampleController@addSample');
    Route::post('/storeSample', 'SampleController@storeSample');
    Route::get('/editSample/{id}', 'SampleController@editSample');
    Route::put('/updateSample/{id}', 'SampleController@updateSample');
    Route::delete('/deleteSample/{id}', 'SampleController@deleteSample');

    Route::get('/itemUses/{id}', 'UsesController@getItemUses');
    Route::get('/addUse/{id}', 'UsesController@addUse');
    Route::get('/addUseExist/{id}', 'UsesController@addUseExist');
    Route::post('/storeUse', 'UsesController@storeUse');
    Route::post('/storeUsesExist', 'UsesController@storeUsesExist');
    Route::get('/editUse/{id}', 'UsesController@editUse');
    Route::put('/updateUse/{id}', 'UsesController@updateUse');
    Route::delete('/deleteUse/{id}', 'UsesController@deleteUse');
    
});
Route::group(['prefix'=>'managerMarketing','namespace'=>'App\Http\Controllers\Managers\marketing','middleware'=>'auth','middleware'=>'managerMarketing'],function(){
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
    Route::get('/addSample', 'SampleController@addSample');
    Route::post('/storeSample', 'SampleController@storeSample');
    Route::get('/editSample/{id}', 'SampleController@editSample');
    Route::put('/updateSample/{id}', 'SampleController@updateSample');
    Route::delete('/deleteSample/{id}', 'SampleController@deleteSample');

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

    Route::get('/manageItem', 'ItemController@getAllItems');
    Route::get('/itemAdd', 'ItemController@addItem');
    Route::post('/itemStore', 'ItemController@storeItem');
    Route::get('/itemEdit/{id}', 'ItemController@editItem');
    Route::put('/itemUpdate/{id}', 'ItemController@UpdateItem');
    Route::delete('/itemDelete/{id}', 'ItemController@deleteItem');
    
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
});

Route::group(['prefix'=>'manageSales','namespace'=>'App\Http\Controllers\Managers\sales','middleware'=>'auth','middleware'=>'manageSales'],function(){
    // Route::get('/home-manager-sales', 'SalesobjectiveController@home');
    
});

Route::group(['prefix'=>'supervisor','namespace'=>'App\Http\Controllers\Supervisor','middleware'=>'auth','middleware'=>'supervisor'],function(){
    // Route::get('/home', 'RepresentativeController@home');
    Route::get('/manageRepresentatives', 'RepresentativeController@getAllRepresentatives');
    Route::get('/addRepresentative', 'RepresentativeController@addRepresentative');
    Route::post('/storeRepresentative', 'RepresentativeController@storeRepresentative');
    Route::get('/editRepresentative/{id}', 'RepresentativeController@editRepresentative');
    Route::put('/updateRepresentative/{id}', 'RepresentativeController@updateRepresentative');
    Route::get('/showRepresentatives/{id}', 'RepresentativeController@showRepresentatives');
    Route::get('/showMainareas/{id}', 'RepresentativeController@showMainareas');
    Route::post('/storeRepMainArea/{id}', 'RepresentativeController@storeRepMainArea');
    Route::post('/storeRepSubareas/{id}', 'RepresentativeController@storeRepSubareas');

    Route::get('/manageTests', 'TestController@getAllTests');
    Route::get('/addTest', 'TestController@addTest');
    Route::post('/storeTest', 'TestController@storeTest');
    Route::get('/editTest/{id}', 'TestController@editTest');
    Route::put('/updateTest/{id}', 'TestController@updateTest');
    Route::delete('/deleteTest/{id}', 'TestController@deleteTest');

    Route::get('/manageQuestions/{id}', 'QuestionController@getAllQuestions');
    Route::get('/addQuestion/{id}', 'QuestionController@addQuestion');
    Route::post('/storeQuestion/{id}', 'QuestionController@storeQuestion');
    Route::get('/editQuestion/{id}', 'QuestionController@editQuestion');
    Route::put('/updateQuestion/{id}', 'QuestionController@updateQuestion');
    Route::delete('/deleteQuestion/{id}', 'QuestionController@deleteQuestion');

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

    Route::get('/manageItem', 'ItemController@getAllItems');
    Route::get('/itemAdd', 'ItemController@addItem');
    Route::post('/itemStore', 'ItemController@storeItem');
    Route::get('/itemEdit/{id}', 'ItemController@editItem');
    Route::put('/itemUpdate/{id}', 'ItemController@UpdateItem');
    Route::delete('/itemDelete/{id}', 'ItemController@deleteItem');

    Route::get('/itemUses/{id}', 'UsesController@getItemUses');
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

Route::group(['prefix'=>'representative','namespace'=>'App\Http\Controllers\Representative','middleware'=>'auth','middleware'=>'repScience'],function(){
    // Route::get('/home', 'RepresentativeController@home');
    Route::get('/manageDoctors', 'DoctorController@getAllDoctors');
    Route::get('/addDoctor', 'DoctorController@addDoctor');
    Route::post('/storeDoctor', 'DoctorController@storeDoctor');
    Route::get('/editDoctor/{id}', 'DoctorController@editDoctor');
    Route::put('/updateDoctor/{id}', 'DoctorController@updateDoctor');
    Route::delete('/deleteDoctor/{id}', 'DoctorController@deleteDoctor');

    Route::get('/manageCustomers', 'CustomerController@getAllCustomers');
    Route::get('/addCustomer', 'CustomerController@addCustomer');
    Route::post('/storeCustomer', 'CustomerController@storeCustomer');
    Route::get('/editCustomer/{id}', 'CustomerController@editCustomer');
    Route::put('/updateCustomer/{id}', 'CustomerController@updateCustomer');
    Route::delete('/deleteCustomer/{id}', 'CustomerController@deleteCustomer');

});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
