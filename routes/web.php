<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
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
Route::get('/userList', [UserController::class, 'getUserList']);
Route::get('/doctor/{idUser}', [DoctorController::class, 'getDoctor']);
//Medicine
Route::get('/commentMedicine/{idMedicine}', [CommentController::class, 'getTop3CommentMedicine']);
Route::get("/ratingCommentMedicine/{idMedicine}", [RatingController::class, 'getTop3RatingCommentMedicine']);
Route::get('/medicine/{idMedicine}', [MedicineController::class, 'getMedicine']);
Route::post('/addCommentMedicine', [CommentController::class, 'createCommentMedicine']);
Route::post("/addRatingMedicine", [RatingController::class, 'addRatingMedicine']);
Route::get('/numAllCommentMedicine/{idMedicine}', [CommentController::class, 'getNumAllCommentMedicine']);
Route::get("/isCommentMedicine/{idMedicine}/{idUser}", [CommentController::class, 'getIsCommentMedicine']);
Route::get("/medicineList", [MedicineController::class, 'getListMedicine']);
//User
Route::get("getUser/{email}", [UserController::class, 'getUser']);
Route::post("/addUser", [UserController::class, 'addUser']);
//Post
Route::get("/numPostUser/{idUser}", [PostController::class, 'getNumPost']);
Route::get("/listNumPostDoctor", [PostController::class, 'getListNumPostDoctor']);
Route::get("/listPost", [PostController::class, 'getListPost']);
//Like
Route::get("/likeMedicine/{idMedicine}/{email}", [LikeController::class, 'getLikeMedicine']);
Route::post("/addLike", [LikeController::class, 'addLike']);
Route::post("/deleteLike", [LikeController::class, 'deleteLike']);
//Notification
Route::get("/listCommentNotification/{idUser}", [CommentController::class, 'getListCommentNotification']);
//Doctor
Route::get("/listDoctor", [DoctorController::class, 'getListDoctor']);
//Work
Route::get("listWorkByDate/{date}", [WorkController::class, 'getListWorkByDate']);
Route::get("listWorkToday", [WorkController::class, 'getListWorkToday']);
Route::post("updateIsCheckWork", [WorkController::class, 'updateIsCheckWork']);
