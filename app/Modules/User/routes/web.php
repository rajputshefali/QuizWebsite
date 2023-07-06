<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Http\Controllers\UserController;


Route::get('user', 'UserController@welcome');

 Route::group(['middleware' => ['UserMiddleware','UserAuth']], function(){
    Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('/user/dashboard');
    Route::get('/resultView',[UserController::class, 'resultView']);


   //endquiz-page
Route::get('/user/endquiz', [UserController::class, 'endquiz'])->name('user-endquiz');

//answer-dashboard
Route::get('/user/answer', [UserController::class, 'answerDesk']);

//result store
Route::get('/storeResult', [UserController::class, 'storeResult'])->name('storeResult');
//quiz-submit
Route::post('/quiz-submit', [UserController::class, 'quizSubmit'])->name('quiz-submit');
//logout
Route::get('/user/logout', [UserController::class, 'logout']);
//edit-profile
Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit-profile');
//update profile
Route::put('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');

//graph result
Route::get('graphResult', [UserController::class, 'showGraph']);

});

//user-registration
Route::get('/user/register', [UserController::class, 'userReg'])->name('user/register')->middleware('UserLoggedIn');

//save-user
Route::post('/save-user', [UserController::class, 'saveUser'])->name('save-user');

//LOGINUSER
Route::get('/user/login', [UserController::class, 'userLogin'])->name('user/login')->middleware('UserLoggedIn');

//
Route::post('/user/auth', [UserController::class, 'authUser'])->name('auth-user');



//password-forget
Route::get('user/forget-password', [UserController::class, 'forgetPassword'])->name('forgetPaaword');
Route::post('user/forget', [UserController::class, 'resetPassword'])->name('password-forget');
Route::get('/password-reset/{token}', [UserController::class, 'passwordReset'])->name('password-reset');
Route::post('/resetpassword', [UserController::class, 'reset'])->name('reset-password');



//store result
// Route::get('storeresult', [UserController::class, 'storeResult'])->name('storeResult');

//googleLogin
Route::prefix('google')->name('google.')->group( function(){
   Route::get('login', [UserController::class, 'loginWithGoogle'])->name('login');
   Route::any('callback', [UserController::class, 'callbackFromGoogle'])->name('callback');
});

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
   Route::get('auth', [UserController::class, 'loginUsingFacebook'])->name('login');
   Route::get('callback', [UserController::class, 'callbackFromFacebook'])->name('callback');
});











