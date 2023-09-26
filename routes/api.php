<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\UserRegController;
use App\Http\Controllers\api\UserApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/branches', [UserRegController::class, 'branches']);

Route::post('/check', [UserRegController::class, 'check']);
Route::post('/register', [UserRegController::class, 'register']);
Route::post('/login', [UserRegController::class, 'login']);
Route::post('/send-otp', [UserRegController::class, 'send_otp']);
Route::post('/reset-password', [UserRegController::class, 'reset_password']);

// Route::post('/online-slotes', [UserRegController::class, 'online_slotes']);
// Route::post('/offline-slotes', [UserRegController::class, 'offline_slotes']);

// Route::get('/online-plans', [UserRegController::class, 'online_plans']);
// Route::get('/offline-plans', [UserRegController::class, 'offline_plans']);

Route::middleware(['auth:sanctum'])->group(function () {

Route::get('/get-blogs', [UserApiController::class, 'get_blogs']);
Route::get('/blog-details/{bid}', [UserApiController::class, 'blog_details']);	
Route::get('/get-videos', [UserApiController::class, 'get_videos']);

Route::get('/get-plans', [UserRegController::class, 'get_plans']);
Route::get('/deposit-amount', [UserRegController::class, 'deposit_amount']);
Route::post('/get-slotes', [UserRegController::class, 'get_slotes']);
Route::post('/fee-details', [UserRegController::class, 'fee_details']);
Route::post('/book-slote', [UserRegController::class, 'book_slote']);

Route::get('/profile-details', [UserApiController::class, 'profile_details']);
Route::get('/all-chat', [UserApiController::class, 'all_chat']);
Route::post('/send-msg', [UserApiController::class, 'send_msg']);
Route::post('/delete-msg', [UserApiController::class, 'delete_msg']);

Route::get('/paid-installments', [UserApiController::class, 'paid_installments']);
Route::get('/pending-installments', [UserApiController::class, 'pending_installments']);

Route::post('/pay-installment', [UserApiController::class, 'pay_installment']);

Route::get('/refund-requests', [UserApiController::class, 'refund_requests']);
Route::get('/send-refund-request', [UserApiController::class, 'send_refund_request']);
Route::post('/delete-refund-request', [UserApiController::class, 'delete_refund_request']);

Route::get('/upcoming-classes', [UserApiController::class, 'upcoming_classes']);
Route::post('/cancel-class', [UserApiController::class, 'cancel_class']);
Route::get('/completed-classes', [UserApiController::class, 'completed_classes']);
Route::get('/cancelled-classes', [UserApiController::class, 'cancelled_classes']);
Route::get('/class-note/{aid}', [UserApiController::class, 'class_note']);

Route::post('/cancel-classes', [UserApiController::class, 'cancel_classes']);

Route::get('/credit-classes', [UserApiController::class, 'credit_class']);
Route::post('/cancel-credit-class', [UserApiController::class, 'cancel_credit_class']);
Route::post('/credit-class-slotes', [UserApiController::class, 'credit_class_slotes']);
Route::post('/book-credit-class', [UserApiController::class, 'book_credit_class']);
Route::get('/credit-class-note/{aid}', [UserApiController::class, 'credit_class_note']);

Route::get('/paid-classes', [UserApiController::class, 'paid_class']);
Route::post('/paid-class-slotes', [UserApiController::class, 'paid_class_slotes']);
Route::post('/book-paid-class', [UserApiController::class, 'book_paid_class']);
Route::get('/paid-class-note/{aid}', [UserApiController::class, 'paid_class_note']);
Route::post('/cancel-paid-class', [UserApiController::class, 'cancel_paid_class']);

});