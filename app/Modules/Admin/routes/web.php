<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Http\Controllers\AdminController;
use App\Modules\Admin\Http\Controllers\QuestionController;

Route::get('admin', 'AdminController@welcome');
Route::group(['middleware' => 'customAuth'], function(){
    Route::get('/admin/dashboard',[AdminController::class, 'AdminDash'])->name('admin-dashboard');
    // //logout
    // Route::get('/logout-user', [AdminController::class, 'logout']);
    //logout
Route::get('/admin/logout', [AdminController::class, 'logout']);
//user-management
Route::get('/usermanagement', [AdminController::class, 'userManage']);
//trash-USER
Route::get('deleteuser/{id}', [AdminController::class, 'userDelete']);
//restore-user
Route::get('restoreuser/{id}', [AdminController::class, 'restore']);
//permanent-delete user
Route::get('forcedeleteuser/{id}', [AdminController::class, 'forceDelete']);
//trash-user-view
Route::get('trash', [AdminController::class, 'trash']);
//edit-user
Route::get('edituser/{id}', [AdminController::class, 'edituser']);
//QUESTIONS AND ANSWERS MANAGE
Route::get('/quemanage', [QuestionController::class, 'qnaManage']);
//edit
Route::get('/editques/{id}', [QuestionController::class, 'editQues']);

//RESULTMANAGEMENT
Route::get('/quizResult',[QuestionController::class, 'quizResult']);

//delete-result
Route::get('/deleteResult/{id}', [QuestionController::class, 'deleteResult']);

//QUESTION & ANSWERS ADD
Route::get('/queadd', [QuestionController::class, 'queManage']);

//delete
Route::get('/deleteques/{id}', [QuestionController::class, 'deleteQues']);

//edit-profile
Route::get('/edit-admin-profile', [AdminController::class, 'editProfileAdmin'])->name('edit-admin-profile');
//update profile
// Route::put('/update-admin-profile', [AdminController::class, 'updateProfileAdmin'])->name('update-admin-profile');

Route::get('import-question', [QuestionController::class, 'importQue'])->name('import-question');

   Route::post('uploadQue', [QuestionController::class, 'uploadQue'])->name('uploadQue');


   //
   Route::get('/graph', [AdminController::class, 'showStatics']);

   //profile-edit
   Route::get('/profile', [AdminController::class, 'profile']);

   //update Profile
   Route::put('/adminupdate/{id}', [AdminController::class, 'updateProfile'])->name('adminupdate');


});

//register-admin
Route::get('/admin/register', [AdminController::class, 'adminRegister']);
//save-admin
Route::post('/save-admin', [AdminController::class, 'saveAdmin'])->name('save-admin');

//login-admin
Route::get('/admin/login', [AdminController::class, 'adminlogin'])->name('admin/login')->middleware('AdminAuth');

//admin-auth
Route::post('/admin/auth', [AdminController::class, 'adminAuth'])->name('admin-auth');

//adminDashboard
// Route::get('/admin/dashboard',[AdminController::class, 'AdminDash'])->name('admin-dashboard');




//edit-user
// Route::get('/edit{id}', [AdminController::class, 'userEdit']);



//update-user-information
Route::post('updateuser/{id}', [AdminController::class, 'updateUser'])->name('update-user');
//ban-unban 
//ban/unabn edit
Route::get('/edit/{id}', [AdminController::class, 'editRole']);
Route::put('/role-update/{id}', [AdminController::class, 'updateRole']);



Route::post('/addQna', [QuestionController::class, 'addQna'])->name('addQna');

//add-time
Route::post('/addTime', [QuestionController::class, 'addTime'])->name('addTime');




//update
Route::post('/updateques/{id}', [QuestionController::class, 'updateQues']);





//front
Route::get('/',[AdminController::class, 'front']);


   //add-questions


   //forget-password
Route::get('/pwforget', [AdminController::class, 'pwforget'])->name('pwforget');

Route::post('/showform', [AdminController::class, 'showform'])->name('showform');

Route::get('/reset/{token}', [AdminController::class, 'reseting'])->name('reset');

Route::post('/resetpw', [AdminController::class, 'resetpw'])->name('resetpw');
   



