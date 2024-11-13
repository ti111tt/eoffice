<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;


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

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/home/index', [HomeController::class, 'index']);
    Route::get('/home/loginForm', [HomeController::class, 'loginForm']);
    Route::post('/media/upload', [HomeController::class, 'upload']);
  
    // Show login form
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
    
    // Handle login request
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    
    // Handle logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    // Home page (protected route)
    Route::get('/home/mediatampil', [HomeController::class, 'index'])->name('home.index');
 
    Route::get('/media', [HomeController::class, 'index']); // Untuk menampilkan media feed
   Route::post('/media/like/{media_id}', [HomeController::class, 'like'])->name('media.like'); // Untuk menambahkan like
    Route::post('/media/comment/{media_id}', [HomeController::class, 'comment'])->name('media.comment'); // Untuk menambahkan komentar





Route::get('/home/media', [HomeController::class, 'media'])->name('media.index');
Route::post('/media/upload', [HomeController::class, 'upload'])->name('media.upload');
Route::post('/home/edit-description/{id}', [HomeController::class, 'editDescription'])->name('media.edit.description');
Route::delete('/home/delete-media/{id}', [HomeController::class, 'deleteMedia'])->name('media.delete');
Route::post('/home/share/{id}', [HomeController::class, 'shareMedia'])->name('media.share');
// Route untuk menampilkan form edit data dengan metode GET
Route::get('/home/edit_data', [HomeController::class, 'editDataForm'])->name('editDataForm');

// Route untuk menangani aksi edit data dengan metode POST
Route::post('/home/edit_data', [HomeController::class, 'aksi_edit_data'])->name('aksi_edit_data');
Route::post('/home/data/update', [HomeController::class, 'updateData'])->name('data.update');
Route::get('/login', [HomeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [HomeController::class, 'login']);

Route::get('/register', [HomeController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [HomeController::class, 'register']);

Route::get('/dashboard', function () {
    return 'Anda telah berhasil login!';
})->middleware('auth')->name('dashboard');

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');


Route::get('/home/viewallitems', [HomeController::class, 'viewAllItems'])->name('kasir.viewAllItems');
Route::post('/home/inputbarang', [HomeController::class, 'inputBarang'])->name('kasir.inputBarang');
Route::get('/home/input_kode_barang', [HomeController::class, 'inputKodeBarang'])->name('kasir.inputKodeBarang');
Route::post('/home/calculate-change', [HomeController::class, 'calculateChange'])->name('kasir.calculateChange');
// routes/web.php



// Route untuk menambah barang ke keranjang
Route::post('/home/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');

// Route lainnya
Route::delete('/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/home/input_kode_barang', [HomeController::class, 'inputKodeBarang'])->name('input_kode_barang');

Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');

Route::delete('/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/home/input_kode_barang', [HomeController::class, 'inputKodeBarang'])->name('input_kode_barang');
Route::post('/home/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::delete('/home/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/home/payment/process', [HomeController::class, 'processPayment'])->name('payment.process');
Route::get('/home/input_kode_barang', [HomeController::class, 'input_kode_barang'])->name('input_kode_barang');
Route::get('/home/input_kode_barang', [HomeController::class, 'inputKodeBarang'])->name('input_kode_barang');
Route::get('/home/barcode', [HomeController::class, 'showBarcode'])->name('items.barcode');
Route::post('/home/cart/add', [HomeController::class, 'addToCart'])->name('cart.add');
Route::delete('/home/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');
// Rute untuk menampilkan barcode
Route::get('/home/barcode', [HomeController::class, 'showBarcode'])->name('barcode');
Route::post('/home/barcode/generate', [HomeController::class, ' generateBarcode'])->name('generate_barcode');
Route::post('/home/cart/payment', [HomeController::class, 'processPayment'])->name('cart.payment');
Route::delete('/home/cart/clear', [HomeController::class, 'clearCart'])->name('cart.clear');
Route::post('/home/cart/generate-pdf', [HomeController::class, 'generateStruk'])->name('cart.generate_pdf');
Route::post('/home/cart/generate-pdf', [HomeController::class, 'generatePDF'])->name('cart.generate_pdf');
Route::put('/home/cart/update/{id}', [HomeController::class, 'updateCart'])->name('cart.update');
// routes/web.php


Route::get('/home/soft-deleted-items', [HomeController::class, 'showDeletedItems'])->name('cart.sofdelet');
Route::put('/home/cart/restore/{id}', [HomeController::class, 'restoreItem'])->name('cart.restore');
Route::delete('/home/softdelete/permanent/{id}', [HomeController::class, 'forceDelete'])->name('kasir.forceDelete');
Route::delete('/home/softdelete/permanent/{id}', [HomeController::class, 'forceDelete'])->name('kasir.forceDelete');
Route::put('/home/softdelete/restore/{id}', [HomeController::class, 'restore'])->name('kasir.restore');


Route::get('/', [HomeController::class, 'showItems'])->name('home'); // Replace index with showItems
Route::post('/home/add-item', [HomeController::class, 'storeItem'])->name('store_item'); // Add item
Route::post('/home/generate-barcode', [HomeController::class, 'generateItemBarcode'])->name('generate_barcode'); // Generate barcode

Route::post('home/generate-barcode', [HomeController::class, 'generateBarcode'])->name('generate_barcode');
Route::post('/home/update-item', [HomeController::class, 'updateItem'])->name('update_item');
Route::post('/home/save-transaction', [HomeController::class, 'storeTransaction'])->name('save_transaction');
// Route to display the activity log page
Route::get('/home/activity-log', [HomeController::class, 'activityLogs']);

// Example route to save an activity log (optional, for testing purposes)
Route::post('/home/activity-log/save', [HomeController::class, 'saveActivityLog']);

Route::get('/home/activity-log', [HomeController::class, 'activityLogs']);

Route::get('home/report', [HomeController::class, 'report']);
Route::get('home/report-pdf', [HomeController::class, 'generatePdfReport']);

Route::get('home/reports', [HomeController::class, 'showReports'])->name('home.reports');
Route::post('home/reports/store', [HomeController::class, 'storeReport'])->name('home.reports.store');

Route::get('home/emails', [HomeController::class, 'showEmails'])->name('home.emails');
Route::post('home/emails/store', [HomeController::class, 'storeEmail'])->name('home.emails.store');


    // Routes for Documents
    Route::get('home/documents', [HomeController::class, 'documents'])->name('eoffice.documents');
Route::post('home/documents', [HomeController::class, 'storeDocument'])->name('eoffice.documents.store');

    // Routes for Incoming Mails
    Route::get('home/incoming-mails', [HomeController::class, 'incomingMails'])->name('eoffice.incoming-mails');
    Route::post('home/incoming-mails', [HomeController::class, 'storeIncomingMail'])->name('eoffice.incoming-mails.store');

    // Routes for Outgoing Mails
    Route::get('home/outgoing-mails', [HomeController::class, 'outgoingMails'])->name('eoffice.outgoing-mails');
    Route::post('home/outgoing-mails', [HomeController::class, 'storeOutgoingMail'])->name('eoffice.outgoing-mails.store');

    // Routes for Leave Requests
    Route::get('home/leave-requests', [HomeController::class, 'leaveRequests'])->name('eoffice.leave-requests');
    Route::post('home/leave-requests', [HomeController::class, 'storeLeaveRequest'])->name('eoffice.leave-requests.store');
    Route::get('home/documents/category/{category}', [HomeController::class, 'documentsByCategory'])->name('eoffice.documents.category');


Route::get('home/eoffice/leave-form', [HomeController::class, 'showLeaveForm'])->name('eoffice.leave_form');
Route::post('home/eoffice/leave-form', [HomeController::class, 'submitLeaveForm']);

Route::get('home/eoffice/lateness-form', [HomeController::class, 'showLatenessForm'])->name('eoffice.lateness_form');
Route::post('home/eoffice/lateness-form', [HomeController::class, 'submitLatenessForm']);















