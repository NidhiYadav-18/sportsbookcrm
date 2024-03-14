<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAgentController;
use App\Http\Controllers\MasterAgentController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;

use Illuminate\Support\Facades\Hash;
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

// clear application cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Application cache flushed";
});

// clear route cache
Route::get('/clear-route-cache', function () {
    Artisan::call('route:clear');
    return "Route cache file removed";
});

// clear view compiled files
Route::get('/clear-view-compiled-cache', function () {
    Artisan::call('view:clear');
    return "View compiled files removed";
});

// clear config files
Route::get('/clear-config-cache', function () {
    Artisan::call('config:clear');
    return "Configuration cache file removed";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', function () {
    return redirect('/');
});

// ********** Athu verfication *********

Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ********** Admin Routes *********
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('Dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('AdminUsers');

    Route::get('/manage-role', [AdminController::class, 'manageRole'])->name('manageRole');
    Route::post('/update-role', [AdminController::class, 'updateRole'])->name('updateRole');

    //super agent list
    Route::get('/manage-super-agent', [AdminController::class, 'manageSuperAgent'])->name('manageSuperAgent');
    Route::get('/add-super-agent', [AdminController::class, 'addSuperAgent'])->name('addSuperAgent');
    Route::post('/post-super-agent', [AdminController::class, 'postSuperAgent'])->name('postSuperAgent');
    Route::get('/edit-super-agent/{id}', [AdminController::class, 'editSuperAgent'])->name('editSuperAgent');
    Route::post('/update-super-agent/{id}', [AdminController::class, 'updateSuperAgent'])->name('updateSuperAgent');
    Route::get('/delete-super-agent/{id}', [AdminController::class, 'deleteSuperAgent'])->name('deleteSuperAgent');
    Route::get('/view-super-agent/{id}', [AdminController::class, 'viewSuperAgent'])->name('viewSuperAgent');


    //master agent list
    Route::get('/manage-master-agent/{agentId?}', [AdminController::class, 'manageMasterAgent'])->name('manageMasterAgent');
    Route::get('/add-master-agent', [AdminController::class, 'addMasterAgent'])->name('addMasterAgent');
    Route::post('/post-master-agent', [AdminController::class, 'postMasterAgent'])->name('postMasterAgent');
    Route::get('/edit-master-agent/{id}', [AdminController::class, 'editMasterAgent'])->name('editMasterAgent');
    Route::post('/update-master-agent/{id}', [AdminController::class, 'updateMasterAgent'])->name('updateMasterAgent');
    Route::get('/delete-master-agent/{id}', [AdminController::class, 'deleteMasterAgent'])->name('deleteMasterAgent');
    Route::get('/view-master-agent/{id}', [AdminController::class, 'viewMasterAgent'])->name('viewMasterAgent');


    //agent list
    Route::get('/manage-agent/{agentId?}', [AdminController::class, 'manageAgent'])->name('manageAgent');
    Route::get('/add-agent', [AdminController::class, 'AddAgent'])->name('AddAgent');
    Route::post('/post-agent', [AdminController::class, 'postAgent'])->name('postAgent');
    Route::get('/edit-agent/{id}', [AdminController::class, 'editAgent'])->name('editAgent');
    Route::post('/update-agent/{id}', [AdminController::class, 'updateAgent'])->name('updateAgent');
    Route::get('/delete-agent/{id}', [AdminController::class, 'deleteAgent'])->name('deleteAgent');
    Route::get('/view-agent/{id}', [AdminController::class, 'viewAgent'])->name('viewAgent');


    //player routes
    Route::get('/manage-players', [AdminController::class, 'managePlayers'])->name('managePlayers');
    Route::get('/add-players', [AdminController::class, 'addPlayers'])->name('addPlayers');
    Route::post('/post-add-player', [AdminController::class, 'postaddPlayer'])->name('postaddPlayer');
    Route::get('/edit-player/{id}', [AdminController::class, 'editviewPlayer'])->name('editplayer');
    Route::post('/edit-player/{id}', [AdminController::class, 'UpdatePlayer'])->name('posteditplayer');
    Route::get('/delete-player/{id}', [AdminController::class, 'DeletePlayer'])->name('deleteplayer');
    Route::get('/view-player/{id}', [AdminController::class, 'ViewPlayer'])->name('viewplayer');

    //Transaction routes
    Route::get('/transaction-list', [TransactionController::class, 'transactoin'])->name('transactionlist');
    Route::get('/add-transaction', [TransactionController::class, 'Addtransactoin'])->name('addtransaction');
    Route::post('/post-add-transaction', [TransactionController::class, 'PostAddtransactoin'])->name('postaddtransaction');
    Route::get('/view-transaction/{id}', [TransactionController::class, 'Viewtransactoin'])->name('viewtransaction');
});

// ********** Super Agent Routes *********
Route::group(['prefix' => 'super-agent', 'middleware' => ['web', 'isSuperAgent']], function () {
    Route::get('/dashboard', [SuperAgentController::class, 'dashboard']);
});

// ********** Master Agent Routes *********
Route::group(['prefix' => 'master-agent', 'middleware' => ['web', 'isMasterAgent']], function () {
    Route::get('/dashboard', [MasterAgentController::class, 'dashboard']);
});

// ********** Agent Routes *********
Route::group(['prefix' => 'agent', 'middleware' => ['web', 'isAgent']], function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard']);
});

// ********** User Routes *********
Route::group(['middleware' => ['web', 'isUser']], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
});
