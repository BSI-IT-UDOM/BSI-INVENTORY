<?php



use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\POSController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\MaterialController;

use App\Http\Controllers\AddonController;

use App\Http\Controllers\OrderController;

use App\Http\Controllers\ExpenseController;

use App\Http\Controllers\ReportController;

use App\Http\Controllers\SettingController;

use App\Http\Controllers\MenuController;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\InventoryController;

use App\Http\Controllers\SupplierController;

use App\Http\Controllers\Profit_LoseController;

use App\Http\Controllers\Auth\RegisterController;





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

Auth::routes();

//-------------------------------------------------------HOME PAGE-------------------------------------------------------
//display home page
Route::get('/home', [HomeController::class, 'index'])->name('home');



//-------------------------------------------------------DASHBOARD PAGE-------------------------------------------------------
//display dashboard page
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



//-------------------------------------------------------INVENTORY PAGE-------------------------------------------------------
//display inventory information
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
//search inventory
Route::get('/inventory/search', [InventoryController::class, 'search'])->name('inventory.search');



//-------------------------------------------------------SUPPLIER PAGE-------------------------------------------------------
//display supplier information
Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
//create new supplier
Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
//delete existing supplier
Route::get('supplier/destroy/{Sup_id}', [SupplierController::class, 'destroy']);
//update existing  supplier
Route::patch('/supplier_update/{Sup_id}', [SupplierController::class, 'update'])->name('supplier.update');
//search supplier
Route::get('/supplier/search', [SupplierController::class, 'search'])->name('supplier.search');
//update status of supplier
Route::post('/supplier/{id}/toggle-status', [SupplierController::class, 'toggleStatus'])->name('material.toggle-status');



//-------------------------------------------------------MATERIAL PAGE-------------------------------------------------------
//display material information
Route::get('/material', [MaterialController::class, 'index'])->name('material');
//create new material
Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
//delete existing material
Route::get('material/destroy/{Material_id}', [MaterialController::class, 'destroy']);
//search material
Route::get('/material/search', [MaterialController::class, 'search'])->name('material.search');
//update existing material
Route::patch('/material_update/{Material_id}', [MaterialController::class, 'update'])->name('material.update');
//change material status
Route::post('/material/{id}/toggle-status', [MaterialController::class, 'toggleStatus'])->name('material.toggle-status');



//-------------------------------------------------------ORDER PAGE-------------------------------------------------------
//display order information
Route::get('/order', [OrderController::class, 'index'])->name('order');
//create new order
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
//delete existing order
Route::get('order/destroy/{Order_Info_id}', [OrderController::class, 'destroy']);
//search order
Route::get('/order/search', [OrderController::class, 'search'])->name('order.search');



//-------------------------------------------------------POS PAGE-------------------------------------------------------
//display POS page
Route::get('/pos', [POSController::class, 'index'])->name('pos');
//create sale transaction
Route::post('/pos', [POSController::class, 'store'])->name('pos.store');

//-------------------------------------------------------REPORT PAGE-------------------------------------------------------
//display report page
Route::get('/report', [ReportController::class, 'index'])->name('report');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');



//-------------------------------------------------------PROFIT / LOSE PAGE-------------------------------------------------------
//display profit / lose page
Route::get('/profit_lose', [Profit_LoseController::class, 'index'])->name('profit_lose');



//-------------------------------------------------------SETTING PAGE-------------------------------------------------------
//display setting page
Route::get('/setting', [SettingController::class, 'index'])->name('setting');



//-------------------------------------------------------MENU PAGE-------------------------------------------------------
//display menu information
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
//create new menu
Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
//delete existing menu
Route::get('menu/destroy/{Menu_id}', [MenuController::class, 'destroy']);
//search menu
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');
//update existing menu
Route::patch('/menu/{Menu_id}', [MenuController::class, 'update'])->name('menu.update');
//update status menu
Route::post('/menu/{id}/toggle-status', [MenuController::class, 'toggleStatus'])->name('material.toggle-status');



//-------------------------------------------------------ADD-ON PAGE-------------------------------------------------------
//display add-on information
Route::get('/add-on', [SettingController::class, 'addon'])->name('add-on');
//create new add-on
Route::post('/add-on', [SettingController::class, 'createAddon'])->name('add-on.store');
//delete existing add-on
Route::get('add-on/destroy/{Addons_id}', [SettingController::class, 'Addondestroy']);
//search add-on
Route::get('/add-on/search', [SettingController::class, 'Addonsearch'])->name('add-on.search');
//update existing add-on
Route::patch('/add-on/{Addons_id}', [SettingController::class, 'Addonupdate'])->name('add-on.update');
//update status add-on
Route::post('/add-on/{id}/toggle-status', [SettingController::class, 'AddontoggleStatus'])->name('material.toggle-status');



//-------------------------------------------------------REGISTER PAGE-------------------------------------------------------
//display register page
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
//create register
Route::post('/register', [RegisterController::class, 'register']);




//-------------------------------------------------------SHOP PAGE-------------------------------------------------------
//display shop information
Route::get('/shop', [SettingController::class, 'shop'])->name('shop');
//create new shop
Route::post('/shop', [SettingController::class, 'ShopOperation'])->name('createShop');
//update existing shop
Route::patch('/shop/{S_id}', [SettingController::class, 'ShopOperation'])->name('updateShop');



//-------------------------------------------------------LOCATION PAGE-------------------------------------------------------
//display location information
Route::get('/location', [SettingController::class, 'location'])->name('location');
//create new location
Route::post('/location', [SettingController::class, 'location'])->name('setting.location');


//-------------------------------------------------------USER PAGE-------------------------------------------------------
//display user information
Route::get('/user', [SettingController::class, 'viewUser'])->name('user');
//Create new User
Route::post('/user', [SettingController::class, 'createUser'])->name('createUser');
//Update existing User
Route::patch('/user/{U_id}', [SettingController::class, 'updateUser'])->name('updateUser');
//Update status of user
Route::post('/user/{id}/toggle-status', [SettingController::class, 'toggleStatus']);


//-------------------------------------------------------PROFILE POPUP-------------------------------------------------------
Route::patch('/profile/{U_id}', [UserController::class, 'update'])->name('home.update');


//-------------------------------------------------------UOM PAGE-------------------------------------------------------
//display uom information
Route::get('/uom', [SettingController::class, 'uom'])->name('uom');
//create new uom

//delete existing uom

//update existing uom


//-------------------------------------------------------EXPENSE PAGE-------------------------------------------------------
//display expense information
Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
//create new expense
Route::post('/expense', [ExpenseController::class, 'create'])->name('createExpense');
//delete existing expense

//update existing expense



//-------------------------------------------------------CURRENCY PAGE-------------------------------------------------------
//display currency information
Route::get('/currency', [SettingController::class, 'currency'])->name('currency');
//create new currency

//delete existing currency

//update existing currency



//-------------------------------------------------------PAYMENT-METHOD PAGE-------------------------------------------------------
//display payment method
Route::get('/payment', [SettingController::class, 'payment'])->name('payment');
//create new payment method

//delete existing payment method

//update existing payment method


//-------------------------------------------------------SIZE PAGE-------------------------------------------------------
//display size information
Route::get('/size', [SettingController::class, 'size'])->name('size');
//create new size

//delete existing size

//update existing size



//-------------------------------------------------------MODULE PAGE-------------------------------------------------------
//display module information
Route::get('/module', [SettingController::class, 'module'])->name('module');
//update existing module


//-------------------------------------------------------MENU GROUP PAGE-------------------------------------------------------
//display menu group information
Route::get('/menu_group', [SettingController::class, 'menu_group'])->name('menu_group');
//create new menu group
//delete existing menu group
//update existing menu group


//-------------------------------------------------------MENU CATEGORY PAGE-------------------------------------------------------
//display menu category information
Route::get('/menu_category', [SettingController::class, 'menuCat'])->name('setting.menu_category');
//create new menu category
//delete existing menu category
//update existing menu category

//-------------------------------------------------------INGREDIENT PAGE-------------------------------------------------------
//display ingredient information
Route::get('/ingredient', [SettingController::class, 'ingredient'])->name('ingredient');
//create new ingredient
Route::post('/ingredient', [SettingController::class, 'creatIng'])->name('createIng');
//add more ingredient
Route::post('/ingredient/add', [SettingController::class, 'addIng'])->name('addIng');
//delete existing ingredient
//update existing ingredient
Route::patch('/ingredient/edit/{Menu_id}', [SettingController::class, 'updateIngredients'])->name('updateIngredients');

//-------------------------------------------------------OWNER PAGE-------------------------------------------------------
//display owner information
Route::get('/owner', [SettingController::class, 'owner'])->name('owner');
//update owner


//-------------------------------------------------------ROLE PAGE-------------------------------------------------------
//display role information
Route::get('/role', [SettingController::class, 'role'])->name('role');
//create new role
//delete existing role
//update existing role


//-------------------------------------------------------MATERIAL CATEGORY PAGE-------------------------------------------------------
//display material category information
Route::get('/material_category', [SettingController::class, 'materialCat'])->name('material_category');
//create new material category
Route::post('/material_category', [SettingController::class, 'materialCatOperation'])->name('create_material_category');
//delete existing material category
//update existing material category


//-------------------------------------------------------EXPENSE CATEGORY PAGE-------------------------------------------------------
//display expense category information
Route::get('/expense_category', [SettingController::class, 'expenseCat'])->name('expense_category');
//create new expense category
//delete existing expense category
//update existing expense category

//-------------------------------------------------------LOGIN INFO PAGE----------------------------------------------------
//display login info logs
Route::get('/login_logs', [SettingController::class, 'login_logs'])->name('login_logs');

//-------------------------------------------------------OPERATION INFO PAGE----------------------------------------------------
//display operation info logs
Route::get('/operation_logs', [SettingController::class, 'operation_logs'])->name('operation_logs');

//-------------------------------------------------------MATERIAL GROUP PAGE-------------------------------------------------------
//display material group information
Route::get('/material_group', [SettingController::class, 'material_group'])->name('material_group');
//create new material group
//delete existing material group
//update existing material group
