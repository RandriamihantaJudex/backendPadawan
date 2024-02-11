<?php

use App\Http\Controllers\FormationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// route for everyone
Route::get('/', function(){
    return view('welcome');
})->name('accueil');

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);

// protected route, only for user authenticated
Route::group(['middleware'=> ['auth:sanctum']], function (){
    Route::post('logout', [LoginController::class, 'logout']);

    // user route
    Route::get('user/auth', [UserController::class, 'getAuthenticatedUser']);
        // asina parametre id ana user ande tadiavina ny URL am farany exemple user/other/3  
    Route::get('user/other/{id}', [UserController::class, 'getOtherUser']);
    Route::get('user/allmentor', [UserController::class, 'getAllMentor']);
    Route::get('user/alletudiant', [UserController::class, 'getAllEtudiant']);
    // asina parametre ana id an ilay user authentifier iany ny URL am farany
    Route::post('user/update/mentor/{id}', [UserController::class, 'updateUser']);
    Route::post('user/update/etudiant/{id}', [UserController::class, 'updateUserEtudiant']);
    Route::post('user/search', [UserController::class, 'searchUser']);
    
    // formation route
    Route::get('formation/getall', [FormationController::class, 'getAllFormation']);
    Route::get('formation/getone/{id}', [FormationController::class, 'getOneFormation']);
    Route::get('formation/getauth', [FormationController::class, 'getAuthFormation']);
    Route::post('formation/create', [FormationController::class, 'createFormation']);
    Route::post('formation/update/{id}', [FormationController::class, 'updateFormation']);
    Route::post('formation/addLike/{id}', [FormationController::class, 'addLike']);
    Route::post('formation/search', [FormationController::class, 'searchFormation']);
});
