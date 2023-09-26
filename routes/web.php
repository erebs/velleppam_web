<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\adm\AdminController;
use App\Http\Controllers\adm\AdminPlanController;
use App\Http\Controllers\inventory\InventoryController;
use App\Http\Controllers\inventory\PurchaseController;


Route::get('/' , [AdminController::class, 'login']);


Route::get('/administrator', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin_login', [AdminController::class, 'admin_login']);

Route::get('/teacher', [TeacherController::class, 'login'])->name('teacher.login');
Route::post('/teacher_login', [TeacherController::class, 'teacher_login']);

Route::middleware(['AdminLoginCheck','PreventBack'])->group(function () {


Route::get('/administrator/dashboard' , [AdminController::class, 'dashboard']);
Route::get('/administrator/logout' , [AdminController::class, 'logout']);
Route::get('/administrator/change-password', [AdminController::class, 'change_password']);
Route::post('/administrator/password-update', [AdminController::class, 'password_update']);
Route::get('/administrator/edit-profile', [AdminController::class, 'edit_admin_profile']);
Route::post('/administrator/profile-update', [AdminController::class, 'admin_profile_update']);



Route::get('/administrator/inventory-dashboard' , [InventoryController::class, 'inventory_dashboard']);

Route::get('/administrator/inventory/active-categories', [InventoryController::class, 'active_categories']);
Route::post('/administrator/inventory/category-add', [InventoryController::class, 'category_add']);
Route::post('/administrator/inventory/category-edit', [InventoryController::class, 'category_edit']);
Route::get('/administrator/inventory/blocked-categories', [InventoryController::class, 'blocked_categories']);

Route::get('/administrator/inventory/add-supplier', [InventoryController::class, 'add_supplier']);
Route::post('/administrator/inventory/supplier-add', [InventoryController::class, 'supplier_add']);
Route::get('/administrator/inventory/active-suppliers', [InventoryController::class, 'active_suppliers']);
Route::get('/administrator/inventory/edit-supplier/{sid}', [InventoryController::class, 'edit_supplier']);
Route::post('/administrator/inventory/supplier-edit', [InventoryController::class, 'supplier_edit']);
Route::get('/administrator/inventory/blocked-suppliers', [InventoryController::class, 'blocked_suppliers']);

Route::get('/administrator/inventory/add-product', [InventoryController::class, 'add_product']);
Route::post('/administrator/inventory/product-add', [InventoryController::class, 'product_add']);
Route::get('/administrator/inventory/stockin-products', [InventoryController::class, 'stockin_products']);
Route::get('/administrator/inventory/stockout-products', [InventoryController::class, 'stockout_products']);
Route::get('/administrator/inventory/edit-product/{pid}', [InventoryController::class, 'edit_product']);
Route::post('/administrator/inventory/product-edit', [InventoryController::class, 'product_edit']);
Route::get('/administrator/inventory/blocked-products', [InventoryController::class, 'blocked_products']);

Route::get('/administrator/inventory/add-purchase', [PurchaseController::class, 'add_purchase']);
Route::post('/administrator/inventory/get-product', [PurchaseController::class, 'get_product']);
Route::post('/administrator/inventory/get-unit', [PurchaseController::class, 'get_unit']);






   
});


Route::middleware(['TeacherLoginCheck','PreventBack'])->group(function () {




});





