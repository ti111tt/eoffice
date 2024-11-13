<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Logo;
use Illuminate\Support\Facades\Storage;

use App\Models\Mediaa;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Upload; 
use App\Models\Share; // A Share model if needed
use App\Models\Pengguna; // Menggunakan model Pengguna
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\EditData;
use Illuminate\Support\Facades\Validator; // Import the Validator facade
use App\Models\Item;
use App\Models\Cart;  // Pastikan ini diimpor
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Transaction;
use App\Models\ActivityLog;
use App\Models\Email;
use App\Models\Report;
use App\Models\Category;
use PDF; // Import DomPDF facade
use Carbon\Carbon;
use HasFactory;
use App\Models\Document;
use App\Models\IncomingMail;
use App\Models\OutgoingMail;
use App\Models\LeaveRequest;








class HomeController extends Controller
{
    // Fungsi untuk menampilkan form login
    // public function login() 
    // {
    //     echo view('header');
	// 	echo view('login');
    // }

    // // Fungsi untuk menambahkan pengguna
    // public function lock()
    // {
    //     User::create([
    //         'username' => 'elmo',
    //         'password' => '1',
    //     ]);

    //     return "User added successfully!";
    // }

    // Fungsi untuk mengupdate pengguna berdasarkan id
    public function lcok($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->username = 'julioelmo';
            $user->password = '2';
            $user->save();

            return "User updated successfully!";
        } else {
            return "User not found!";
        }
    }

        // Fungsi untuk menampilkan media feed
        public function index()
{
    $userId = session()->get('id');
    $mediaItems = Mediaa::with('comments')->orderBy('created_at', 'DESC')->get();
 
    // Get the logged-in user's ID from the session
    
    // Fetch media items with user information
    $mediaItems = Mediaa::getAllMediaWithUser($userId); // Use the method in your Mediaa model

    // For each media item, add like count and whether the user has liked it
    foreach ($mediaItems as $media) {
        $media->like_count = Mediaa::getLikeCount($media->id); // Get the like count for the media
        $media->user_has_liked = Mediaa::checkIfLiked($media->id, $userId); // Check if the user has liked the media
    }

    // Pass media items to the view
    $data['media'] = $mediaItems;

    $logo = Logo::where('logo_id', 1)->first();


    // Send the data to the view
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('media.tampil', $data);
    echo view('footer');
}

     public function mediaTampil()
     {
        
         // Ambil data media dan user yang berkaitan
         $mediaItems = Mediaa::with('user')->orderBy('created_at', 'DESC')->get();
 
         // Tambahkan jumlah like dan pengecekan apakah user telah memberikan like
         $userId = session('id'); // Ambil ID user dari sesi
 
         foreach ($mediaItems as $media) {
             $media->like_count = $media->likes()->count();
             $media->user_has_liked = $media->likes()->where('id_user', $userId)->exists();
         }
 
         return view('media.tampil', ['media' => $mediaItems]);
        // dd($mediaItems);
     }
 
     public function like($mediaId)
     {
         $userId = session('id');
 
         // Cek apakah user sudah like
         $hasLiked = Like::where('media_id', $mediaId)
                         ->where('id_user', $userId)
                         ->exists();
 
         if (!$hasLiked) {
             // Menambahkan like ke database
             Like::create([
                 'media_id' => $mediaId,
                 'id_user' => $userId,
                 'created_at' => now()
             ]);
         }
 
         return response()->json(['success' => true]);
     }
 
     public function comment(Request $request, $mediaId)
     {
         $commentText = $request->input('comment');
         $userId = session('id');
 
         // Tambahkan komentar
         Comment::create([
             'media_id' => $mediaId,
             'id_user' => $userId,
             'comment_text' => $commentText,
             'created_at' => now()
         ]);
 
         // Redirect kembali ke halaman media dengan anchor
         return redirect()->to('home/mediaTampil#media-' . $mediaId);
     }
  // Display the media page with all media
  public function media()
  {
    // Get the logo data
		// $where = array('logo_id' => '0');
		// $logo['menu'] = $model->getwhere('logo', $where);
      // Fetch all media records
      $media = Mediaa::all();

      // Pass data to the views
      echo view('header');
      echo view('menu');
      echo view('media', [
        'media' => $media
    ]);
      echo view('footer');

  }

  // Handle the file upload and media save process
  
  
    public function upload(Request $request)
    {
        $file = $request->file('media_file');
        $mimeType = $file->getMimeType();
        $description = $request->input('description');

        if ($file) {
            $upload = new Upload(); // Create an instance of the Upload model
            $fileName = $upload->uploadFile($file); // Upload file and get the file name

            // Determine the media type based on the file's MIME type
            if (strpos($mimeType, 'image/') === 0) {
                $type = 'photo';
            } elseif (strpos($mimeType, 'video/') === 0) {
                $type = 'video';
            } else {
                $type = 'unknown'; // Handle other file types if needed
            }
            
            

            // Save media data to the database
            $upload->saveMedia([
                'id_user' => Auth::id(),  // Assuming you're using authentication
                'media_type' => $type,
                'media_path' => $fileName,
                'description' => $description,
            ]);
            

            return redirect()->back()->with('success', 'Media uploaded successfully!');
        }

        return redirect()->back()->with('error', 'Failed to upload media.');
        
        // The view rendering logic will not be reached after a redirect
        // echo view('header');
        // echo view('menu');
        // echo view('media', $data);
        // echo view('footer');
    }
    // Edit media description
    public function editDescription(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255'
        ]);

        $media = Upload::findOrFail($id);
        $media->description = $request->input('description');
        $media->save();

        return redirect()->back()->with('success', 'Description updated successfully!');
    }

    // Delete media
    public function deleteMedia($id)
    {
        $media = Upload::findOrFail($id);

        // Delete media file from the public directory
        $mediaPath = public_path('images/' . $media->media_path);
        if (file_exists($mediaPath)) {
            unlink($mediaPath);
        }

        // Delete from database
        $media->delete();

        return redirect()->back()->with('success', 'Media deleted successfully!');
    }
    public function shareMedia($id)
    {
        // Mengambil media berdasarkan ID
        $media = Upload::findOrFail($id);
        
        // Contoh logika untuk "membagikan" media, misal menambahkan status share
        // atau mungkin menghubungkannya ke media sosial (tapi di sini contoh sederhana)
        
        // Redirect kembali ke halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Media telah dibagikan!');
    }
    public function edit_Data()
    {
        // Cek level pengguna dari session
        if (session('level') > 1) {
            // Ambil data logo dari tabel 'logo' berdasarkan logo_id = 1
            $logo = Logo::where('logo_id', 1)->first();

            // Tampilkan view dengan data logo
            echo view('header');
           echo view('menu', ['logo' => $logo]);
            echo view('edit_data', [
             'menu' => $logo,
          ]);
            echo view('footer');
                  
      
     
        }

}
public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Ambil data user berdasarkan username
    $users = Pengguna::where('username', $request->username)->first();

    // Cek apakah user ada dan passwordnya cocok
    if ($users && $users->password === md5($request->password)) {
        // Login berhasil
        Auth::login($users); // Login user
        return redirect()->intended('home/documents'); // Ganti dengan route yang sesuai
    }

    // Jika login gagal
    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
}


// Menampilkan halaman register
public function showRegisterForm()
{
    return view('auth.register');
}

// Menangani pendaftaran
public function register(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users',
        'password' => 'required|min:2',
        'nama_lengkap' => 'required',
        'jenis_kelamin' => 'required',
    ]);

    // Cek validasi
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Hash password menggunakan MD5
    $hashedPassword = md5($request->password); // Hash the password here

    // Membuat pengguna baru
    Pengguna::create([
        'username' => $request->username,
        'password' => $hashedPassword, // Use the hashed password
        'nama_lengkap' => $request->nama_lengkap,
        'jenis_kelamin' => $request->jenis_kelamin,
    ]);

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
}

// Logout pengguna
public function logout()
{
    Auth::logout();
    return redirect()->route('login');
}


   // Menampilkan halaman form edit data (GET)
   public function editDataForm()
   {
    
        // Ambil data logo dari tabel 'logo' berdasarkan logo_id = 1
        $logo = Logo::find(1);

        // Tampilkan view dengan data logo
        echo view('header');
        echo view('menu', ['logo' => $logo]);
        echo view('edit_data');
        echo view('footer');
    
   }

   // Menangani aksi edit data (POST)
   public function aksi_edit_data(Request $request)
{
    $nama = $request->input('nama');
    $icon = $request->file('icon');
    $logo = $request->file('logo');

    $model = new EditData();

    // Proses file icon jika ada
    if ($icon) {
        $model->delete_icon();
        $model->upload_icon($icon);
    }

    // Proses file logo jika ada
    if ($logo) {
        $model->delete_logo();
        $model->upload_logo($logo);
    }

    // Update nama_web jika ada
    if (!empty($nama)) {
        $model->where('logo_id', 1)->update(['nama_web' => $nama]);
    }

    return redirect()->to('home/edit_data')->with('success', 'Data berhasil diupdate');
}
  // Menampilkan semua barang
  public function viewAllItems()
  {
      $items = Item::all();
      return view('kasir.view_all_items', compact('items'));
  }

  // Input kode barang dan menambahkan ke keranjang
  public function inputBarang(Request $request)
  {
      $item_id = $request->input('kode_barang');
      $quantity = $request->input('quantity', 1); // Default jumlah 1

      $item = Item::find($item_id);

      if ($item) {
          $subtotal = $item->harga * $quantity;

          // Masukkan barang ke session
          $cart = session()->get('cart', []);
          $cart[] = [
              'id' => $item->id,
              'nama' => $item->nama_barang,
              'harga' => $item->harga,
              'quantity' => $quantity,
              'subtotal' => $subtotal
          ];
          session()->put('cart', $cart);
      }

      return redirect()->route('kasir.inputKodeBarang');
  }

 
    // Menampilkan halaman input kode barang dan keranjang
     // Menampilkan halaman input kode barang
     public function inputKodeBarang()
{
    $cartItems = Cart::with('item')->get();
    $logo = Logo::find(1);

    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('kasir.input_kode_barang', compact('cartItems'));
    echo view('footer');
}

public function showBarcode()
{
    $items = Item::all();
    $logo = Logo::find(1);

    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('kasir.barcode', compact('items'));
    echo view('footer');
}

public function generateBarcode(Request $request)
{
    // Validasi input
    $request->validate([
        'item_id' => 'required|exists:items,id',
    ]);

    // Ambil item berdasarkan ID
    $barcode = Item::find($request->item_id);
    $logo = Logo::find(1);
    // Ambil semua item untuk dropdown
    $items = Item::all(); 
    
    
    // Kirim barcode dan items ke view
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('kasir.barcode', compact('barcode', 'items'));
    echo view('footer');

}


    public function addToCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'kode_barang' => 'required|exists:items,id', // Pastikan kode barang ada di tabel items
        ]);

        // Cari barang berdasarkan kode_barang
        $item = Item::find($request->kode_barang);

        // Hitung subtotal (harga * jumlah)
        $quantity = 1; // jumlah default
        $subtotal = $item->harga * $quantity;

        // Masukkan barang ke keranjang
        Cart::create([
            'item_id' => $item->id,
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ]);

        return redirect()->route('input_kode_barang')->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();
        return redirect()->route('input_kode_barang')->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
    // Fungsi untuk proses pembayaran
   // Fungsi untuk proses pembayaran
   public function processPayment(Request $request)
   {
       // Validasi input pembayaran
       $request->validate([
           'bayar' => 'required|numeric|min:0',
       ]);
   
       // Ambil cartItems dari database
       $cartItems = Cart::all(); // Mengambil semua item dari tabel Cart
   
       // Hitung total harga barang di keranjang
       $total = $cartItems->sum('subtotal'); // Menjumlahkan subtotal dari semua item
   
       // Ambil jumlah uang yang dibayar dari input
       $bayar = $request->input('bayar');
   
       // Hitung kembalian
       $kembalian = $bayar - $total;
   
       // Jika uang yang dibayar kurang dari total, berikan pesan error
       if ($bayar < $total) {
           return redirect()->back()->with('error', 'Uang yang diberikan kurang dari total harga!');
       }
       $logo = Logo::find(1);
       // Data yang akan dikirim ke view
       $data = [
           'cartItems' => $cartItems,
           'total' => $total,
           'bayar' => $bayar,
           'kembalian' => $kembalian
       ];
   
       // Struktur echo view sesuai permintaan
       echo view('header');
       echo view('menu', ['logo' => $logo]);
       echo view('kasir.struk', $data);
       echo view('footer');
   }
   
    // Di controller kamu, setelah memproses pembayaran
public function payment(Request $request)
{
    // Ambil data dari keranjang
    $cartItems = session()->get('cart'); // atau cara lain yang kamu gunakan untuk menyimpan keranjang
    $total = $this->calculateTotal($cartItems); // Hitung total
    $bayar = $request->input('bayar');
    $kembalian = $bayar - $total;

    return view('path.to.struk', compact('cartItems', 'total', 'bayar', 'kembalian'));
}
public function clearCart()
{
    // Menghapus semua item menggunakan soft delete
    Cart::query()->delete(); // Ini akan menggunakan soft delete

    // Redirect ke halaman input barang dengan pesan sukses
    return redirect()->route('input_kode_barang')->with('success', 'Semua item berhasil dihapus dari keranjang!');
}

public function generateStruk(Request $request)
{
    // Data keranjang dan pembayaran
    $cartItems = $request->input('cartItems');
    $total = $request->input('total');
    $bayar = $request->input('bayar');
    $kembalian = $request->input('kembalian');

    // Memuat view 'struk' dan passing data
    $pdf = PDF::loadView('struk', [
        'cartItems' => $cartItems,
        'total' => $total,
        'bayar' => $bayar,
        'kembalian' => $kembalian
    ]);

    // Menghasilkan file PDF
    return $pdf->download('struk_pembayaran.pdf');
}
public function generatePDF(Request $request)
{
    // Mengambil data dari request
    $cartItems = json_decode($request->cartItems);
    $total = $request->total;
    $bayar = $request->bayar;
    $kembalian = $request->kembalian;

    // Inisialisasi Dompdf dengan opsi
    $options = new Options();
    $options->set('defaultFont', 'Courier');
    $pdf = new Dompdf($options);

    // Set ukuran kertas sedikit diperbesar (80mm x 90mm dalam satuan points)
    $pdf->setPaper([0, 0, 226, 255], 'portrait'); // 80mm = 226pt, 90mm = 255pt

    // Memuat tampilan ke PDF
    $pdf->loadHtml(view('kasir.struk_pdf', compact('cartItems', 'total', 'bayar', 'kembalian'))->render());

    // Render PDF
    $pdf->render();

    // Mengalirkan PDF ke browser
    return $pdf->stream('struk_pembayaran.pdf');
}

public function generateReceipt()
{
    $cartItems = Cart::all(); // Fetch cart items from cart model
    $total = $cartItems->sum('subtotal');
    $bayar = 400000; // Example amount paid
    $kembalian = $bayar - $total;

    // Load the view with the data
    $pdf = PDF::loadView('your_view_file', compact('cartItems', 'total', 'bayar', 'kembalian'));

    // Force 76mm x 60mm page size in millimeters using array (width and height)
    $pdf->setPaper([0, 0, 216, 170], 'portrait'); // 76mm = 216pt, 60mm = 170pt

    // Return the generated PDF for download
    return $pdf->download('struk_.pdf');
}

    // Method untuk menampilkan form tambah produk
    public function showAddProductForm()
    {
        return view('add_product'); // Tampilkan view untuk form tambah produk
    }

    // Method untuk menambah produk baru ke database
    public function addProduct(Request $request)
    {
        // Validasi data produk
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        // Simpan produk ke database
        $product = new Product();
        $product->nama_barang = $request->nama_barang;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('home')->with('success', 'Produk berhasil ditambahkan!');
    }
    public function updateCart(Request $request, $id)
    {
        // Validasi jumlah yang dikirim
        $request->validate([
            'quantity' => 'required|integer|min:1' // Harus minimal 1 agar tidak bisa menjadi 0 atau negatif
        ]);
    
        // Temukan item dalam keranjang berdasarkan id
        $cartItem = Cart::findOrFail($id);
    
        // Update jumlah barang langsung dari input yang dikirim oleh form
        $cartItem->quantity = $request->input('quantity');  // Mengupdate langsung dengan jumlah baru
    
        // Hitung ulang subtotal untuk item ini
        $cartItem->subtotal = $cartItem->item->harga * $cartItem->quantity;
    
        // Simpan perubahan
        $cartItem->save();
    
        // Hitung total keseluruhan keranjang
        $cartItems = Cart::all();
        $total = $cartItems->sum(function($item) {
            return $item->subtotal;
        });
    
        // Redirect dengan pesan sukses dan total keranjang
        return redirect()->back()->with('success', 'Jumlah barang berhasil diubah')->with('total', $total);
    }
    
// Method untuk menyimpan transaksi dan menghapus isi keranjang

public function saveAndClear(Request $request)
{
    // Simpan setiap item di cart ke dalam tabel 'cart'
    foreach (json_decode($request->cartItems, true) as $item) {
        DB::table('cart')->insert([
            'item_id' => $item['item']['id'],   // id barang dari tabel item
            'quantity' => $item['quantity'],    // jumlah barang
            'subtotal' => $item['subtotal'],    // subtotal harga
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Kosongkan cart setelah transaksi disimpan
    // Contoh, jika cart disimpan di session, bisa dihapus dari session
    // $request->session()->forget('cart');

    // Redirect ke halaman input barang dengan pesan sukses
    return redirect()->route('input_kode_barang')->with('success', 'Transaksi berhasil disimpan dan cart telah dikosongkan.');
}

public function deletedItems()
{
    // Mengambil hanya item yang dihapus (soft-deleted)
    $deletedItems = Cart::onlyTrashed()->get();

    return view('cart.deleted', compact('deletedItems'));
}
public function clear()
{
    Cart::whereNull('deleted_at')->delete(); // Soft delete semua item

    return redirect()->back()->with('success', 'Semua item berhasil dihapus.');
}
public function remove($id)
{
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete(); // Soft delete item

    return redirect()->back()->with('success', 'Item berhasil dihapus.');
}
public function showDeletedItems()
{
    $deletedItems = Cart::onlyTrashed()->get(); // Mengambil item yang sudah dihapus

    $logo = Logo::find(1); // Mengambil logo (jika ada)

    // Menggunakan echo untuk menampilkan beberapa view
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('kasir.sofdelet', ['deletedItems' => $deletedItems]);
    echo view('footer');
}
public function restoreItem($id)
{
    // Memulihkan barang yang dihapus
    $item = Cart::withTrashed()->findOrFail($id);
    $item->restore();

    return redirect()->route('cart.sofdelet')->with('success', 'Barang berhasil dipulihkan!');
}


public function forceDelete($id)
{
    // Mengambil item yang di-soft delete berdasarkan ID
    $item = Cart::onlyTrashed()->findOrFail($id);

    // Hapus permanen item
    $item->forceDelete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('cart.sofdelet')->with('success', 'Item berhasil dihapus secara permanen.');
}

public function restore($id)
{
    // Mengambil item yang di-soft delete berdasarkan ID
    $item = Cart::onlyTrashed()->findOrFail($id);

    // Restore item
    $item->restore();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('cart.sofdelet')->with('success', 'Item berhasil dikembalikan.');
}
// Method to show the form and list of items (can be reused)
public function showItems()
{
    // Fetch all items from the database to pass to the view
    $items = DB::table('items')->get();
    
    return view('media.feed', compact('items'));
}

// Method to handle adding a new item (renamed to `storeItem`)
public function storeItem(Request $request)
{
    // Validate the form inputs
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    // Insert the new item into the database
    DB::table('items')->insert([
        'nama_barang' => $request->input('nama_barang'),
        'harga' => $request->input('harga'),
        'stok' => $request->input('stok'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
}

public function updateItem(Request $request)
{
    // Validasi input
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
    ]);

    // Temukan item berdasarkan ID
    $item = Item::find($request->item_id);

    // Simpan data harga dan stok yang lama untuk log aktivitas
    $hargaLama = $item->harga;
    $stokLama = $item->stok;

    // Perbarui harga dan stok
    $item->harga = $request->harga;
    $item->stok = $request->stok;
    $item->save();

    // Catat log aktivitas (misalnya, siapa yang melakukan perubahan)
    $message = session()->get('nama') . ' memperbarui item: ' . $item->nama . 
               ' (Harga lama: ' . $hargaLama . ', Harga baru: ' . $request->harga . 
               ', Stok lama: ' . $stokLama . ', Stok baru: ' . $request->stok . ')';
    $this->saveActivityLog($message); // Panggil fungsi untuk mencatat aktivitas

    // Redirect ke halaman sebelumnya atau tampilkan pesan sukses
    return redirect()->back()->with('success', 'Barang berhasil diperbarui dan aktivitas dicatat.');
}

public function storeTransaction(Request $request)
    {
        // Simpan data transaksi ke database
        Transaction::create([
            'total_harga' => $request->total,
            'bayar' => $request->bayar,
            'kembalian' => $request->kembalian,
            'created_at' => now(),
        ]);

        // Redirect ke halaman dashboard
        return redirect()->route('input_kode_barang');
    }

public function showForm()
{
    // Mengambil semua data dari tabel items
    $items = DB::table('items')->get();
    return view('form', compact('items'));
}

    // Method to save an activity log
    public function saveActivityLog($message)
    {
        ActivityLog::create([
            'activity' => $message,
            'timestamp' => now(), // Laravel's helper for the current timestamp
        ]);
    }

    // Method to display the latest activity logs
    public function activityLogs()
    {
        // Retrieve the latest 25 activity logs
        $activities = ActivityLog::orderBy('timestamp', 'desc')
                                ->limit(25)
                                ->get();

        // Get the logo (if it exists)
        $logo = Logo::find(1); 

        // Echo views for header, menu with logo, activity log, and footer
        echo view('header');
        echo view('menu', ['logo' => $logo]);
        echo view('media.activity', ['activities' => $activities]); // Show activity logs in media/activity.blade.php
        echo view('footer');
    }
    public function report()
    {
        // Get the current month and last month
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;
    
        // Query to get total for the current month
        $totalCurrentMonth = DB::table('transactions')
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_harga');
    
        // Query to get total for the last month
        $totalLastMonth = DB::table('transactions')
            ->whereMonth('created_at', $lastMonth)
            ->sum('total_harga');
    
        // Get all transactions
        $transactions = DB::table('transactions')->get();
    
        // Fetch the logo
        $logo = Logo::where('logo_id', 1)->first();
    
        // Prepare data for the view
        $data = compact('totalCurrentMonth', 'totalLastMonth', 'transactions', 'logo');
    
        // Send the data to the view
        echo view('header');
        echo view('menu', ['logo' => $logo]);
        echo view('kasir.laporan', $data);
        echo view('footer');
    }
    
    public function generatePdfReport()
    {
        // Get the current month and last month
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;
    
        // Query to get total for the current month
        $totalCurrentMonth = DB::table('transactions')
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_harga');
    
        // Query to get total for the last month
        $totalLastMonth = DB::table('transactions')
            ->whereMonth('created_at', $lastMonth)
            ->sum('total_harga');
    
        // Get all transactions
        $transactions = DB::table('transactions')->get();
    
        // Fetch the logo
        $logo = Logo::where('logo_id', 1)->first();
    
        // Prepare data for the PDF
        $data = compact('totalCurrentMonth', 'totalLastMonth', 'transactions', 'logo');
    
        // Load the PDF view with data
        $pdf = PDF::loadView('kasir.report-pdf', $data);
    
        // Generate and download the PDF file
        return $pdf->download('financial-report.pdf');
    }
    // Menampilkan halaman laporan dengan kategori
    public function showReports()
    {
        $categories = Category::all();
        $reports = Report::with('category')->get();
        return view('home.reports', compact('categories', 'reports'));
    }

    public function storeReport(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'file' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png|max:2048', // Validasi file
    ]);

    // Menyimpan laporan
    $reportData = $request->only('title', 'content', 'category_id');

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('reports', 'public'); // Menyimpan file di storage/app/public/reports
        $reportData['file_path'] = $path; // Menyimpan path file ke database
    }

    Report::create($reportData);

    return redirect()->route('home.reports')->with('success', 'Laporan berhasil ditambahkan.');
 }// Menampilkan halaman email
    public function showEmails()
    {
        $emails = Email::all();
        return view('home.emails', compact('emails'));
    }

    public function storeEmail(Request $request)
    {
        $request->validate([
            'sender' => 'required|email',
            'receiver' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'type' => 'required|in:inbox,outbox',
            'file' => 'nullable|file|mimes:pdf,docx,doc,jpeg,png|max:2048', // Validasi file
        ]);
    
        // Menyimpan surat
        $emailData = $request->only('sender', 'receiver', 'subject', 'message', 'type');
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('emails', 'public'); // Menyimpan file di storage/app/public/emails
            $emailData['file_path'] = $path; // Menyimpan path file ke database
        }
    
        Email::create($emailData);
    
        return redirect()->route('home.emails')->with('success', 'Surat berhasil ditambahkan.');
    }
    

   
    protected $fillable = ['title', 'content', 'category_id', 'file_path'];
    // Relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
        public function dashboard()
        {
            return view('eoffice.dashboard');
        }
    
       // Documents
       public function storeDocument(Request $request)
       {
           $request->validate([
               'title' => 'required',
               'category' => 'required',
               'file' => 'required|file|mimes:pdf,doc,docx',
           ]);
       
           // Menyimpan file berdasarkan kategori yang dipilih
           $categoryFolder = $request->category;  // Mengambil kategori dari form input
           $filePath = $request->file('file')->store('documents/' . $categoryFolder);
       
           Document::create([
               'title' => $request->title,
               'category' => $request->category,
               'file_path' => $filePath,
               'created_by' => auth()->user()->id_user
           ]);
       
           return redirect()->route('eoffice.documents')->with('success', 'Document uploaded successfully!');
       }
       
       public function documentsByCategory($category)
       {
           $logo = Logo::where('logo_id', 1)->first();
           $documents = Document::where('category', $category)->get();
           
           echo view('header');
           echo view('menu', ['logo' => $logo]);
           echo view('eoffice.documents', ['documents' => $documents]);
           echo view('footer');
       }
       
       public function documents()
       {
           $logo = Logo::where('logo_id', 1)->first();
           $documents = Document::all();
           
           echo view('header');
           echo view('menu', ['logo' => $logo]);
           echo view('eoffice.documents', ['documents' => $documents]);
           echo view('footer');
       }
                     
       


// Incoming Mails
public function incomingMails()
{
    $logo = Logo::where('logo_id', 1)->first();
    $incomingMails = IncomingMail::all();
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('eoffice.incoming-mails', compact('incomingMails'));
    echo view('footer');
}

public function storeIncomingMail(Request $request)
{
    $request->validate([
        'subject' => 'required',
        'sender' => 'required',
        'file' => 'required|file|mimes:pdf,doc,docx',
    ]);

    $filePath = $request->file('file')->store('incoming-mails');

    IncomingMail::create([
        'subject' => $request->subject,
        'sender' => $request->sender,
        'file_path' => $filePath,
        'received_by' => auth()->user()->id_user
    ]);

    return redirect()->route('eoffice.incoming-mails')->with('success', 'Incoming mail uploaded successfully!');
}

// Outgoing Mails
public function outgoingMails()
{ $logo = Logo::where('logo_id', 1)->first();
    $outgoingMails = OutgoingMail::all();
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('eoffice.outgoing-mails', compact('outgoingMails'));
    echo view('footer');
}

public function storeOutgoingMail(Request $request)
{
    $request->validate([
        'subject' => 'required',
        'recipient' => 'required',
        'file' => 'required|file|mimes:pdf,doc,docx',
    ]);

    $filePath = $request->file('file')->store('outgoing-mails');

    OutgoingMail::create([
        'subject' => $request->subject,
        'recipient' => $request->recipient,
        'file_path' => $filePath,
        'sent_by' => auth()->user()->id_user
    ]);

    return redirect()->route('eoffice.outgoing-mails')->with('success', 'Outgoing mail uploaded successfully!');
}

// Leave Requests
public function leaveRequests()
{
    $logo = Logo::where('logo_id', 1)->first();
    $leaveRequests = LeaveRequest::all();
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('eoffice.leave-requests', compact('leaveRequests'));
    echo view('footer');
}

public function storeLeaveRequest(Request $request)
{
    $request->validate([
        'reason' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    LeaveRequest::create([
        'reason' => $request->reason,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'requested_by' => auth()->user()->id_user
    ]);

    return redirect()->route('eoffice.leave-requests')->with('success', 'Leave request submitted successfully!');
}

public function showLeaveForm()
{
  
    $logo = Logo::where('logo_id', 1)->first();
    
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('eoffice.leave_form');
    echo view('footer');
}




public function showLatenessForm()
{
    $logo = Logo::where('logo_id', 1)->first();
    
    echo view('header');
    echo view('menu', ['logo' => $logo]);
    echo view('eoffice.lateness_form');
    echo view('footer');
    
}

public function submitLatenessForm(Request $request)
{
    $request->validate([
        'name' => 'required',
        'employee_id' => 'required',
        'department' => 'required',
        'date' => 'required|date',
        'arrival_time' => 'required|date_format:H:i',
        'lateness_duration' => 'required|date_format:H:i',
        'reason' => 'required',
    ]);

    LatenessRequest::create($request->all());
    return redirect()->route('eoffice.lateness_form')->with('success', 'Lateness request submitted successfully.');
}
public function submitLeaveForm(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'employee_id' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'branch' => 'required|string|max:255',
        'application_date' => 'required|date',
        'leave_type' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'total_days' => 'required|integer',
        'contact_address' => 'required|string|max:255',
        'reason' => 'required|string',
    ]);

    LeaveRequest::create($validatedData);

    return redirect()->back()->with('success', 'Leave request submitted successfully!');
}

}

