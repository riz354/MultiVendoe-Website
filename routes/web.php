<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LiveHomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('live.pages.index');

// });

// $urls = Category::select('url')->get();
// foreach($urls as $url){
//     Route::get('/'.$url,[ProductsListingController::class,'productListing']);
// }




Route::get('product/{id}',[ProductsListingController::class,'productDetail'])->name('product');

Route::post('add_to_cart',[ProductController::class,'addToCart'])->name('add_to_cart');
Route::get('cart',[ProductController::class,'Cart'])->name('cart');


// Simple test route with dump and die

Route::get('/',[LiveHomePageController::class,'index'])->name('home');

Route::get('/{category_url}',[ProductsListingController::class,'productListing'])->name('category.url');
Route::post('/{category_url}',[ProductsListingController::class,'productListing'])->name('ajax-category.url');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';












Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
    Route::get('login', [VendorController::class, 'loginPage'])->name('login');
    Route::post('login', [VendorController::class, 'login'])->name('login.post');
    Route::get('register', [VendorController::class, 'registerPage'])->name('register');
    Route::post('register', [VendorController::class, 'register'])->name('register.post');

});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('login', [UserController::class, 'loginPage'])->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login.post');
    Route::get('register', [UserController::class, 'registerPage'])->name('register');
    Route::post('register', [UserController::class, 'register'])->name('register.post');

});




Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminController::class, 'login'])->name('login');
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');
    Route::post('login', [AdminController::class, 'login'])->name('login.post');
    Route::middleware([Admin::class])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('update-password', [AdminController::class, 'updatePassword'])->name('update-password');
        Route::post('update-password-post', [AdminController::class, 'updatePasswordPOst'])->name('update-password-post');
        Route::post('check-admin-passsword', [AdminController::class, 'checkAdminPassword'])->name('check-admin-passsword');
        Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'updateAdminDetails'])->name('update-admin-details');
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', [AdminController::class, 'updateVendorDetails'])->name('update-vendor-details');

        Route::group(['prefix'=>'catelogue','as'=>'catelogue.'],function(){
            Route::group(['prefix'=>'section','as'=>'section.'],function(){
                Route::get('index',[SectionController::class,'index'])->name('index');
                Route::get('create',[SectionController::class,'create'])->name('create');
                Route::post('store',[SectionController::class,'store'])->name('store');
                Route::get('edit/{id}',[SectionController::class,'edit'])->name('edit');
                Route::post('update/{id}',[SectionController::class,'update'])->name('update');
                Route::get('delete/{id}',[SectionController::class,'delete'])->name('delete');

            });

            Route::group(['prefix'=>'categories','as'=>'categories.'],function(){
                Route::get('index',[CategoryController::class,'index'])->name('index');
                Route::get('create',[CategoryController::class,'create'])->name('create');
                Route::post('store',[CategoryController::class,'store'])->name('store');
                Route::get('edit/{id}',[CategoryController::class,'edit'])->name('edit');
                Route::post('update/{id}',[CategoryController::class,'update'])->name('update');
                Route::get('delete/{id}',[CategoryController::class,'delete'])->name('delete');

                Route::post('append-categories',[CategoryController::class,'appendCategories'])->name('append-categories');


            });

            Route::group(['prefix'=>'brand','as'=>'brand.'],function(){
                Route::get('index',[BrandController::class,'index'])->name('index');
                Route::get('create',[BrandController::class,'create'])->name('create');
                Route::post('store',[BrandController::class,'store'])->name('store');
                Route::get('edit/{id}',[BrandController::class,'edit'])->name('edit');
                Route::post('update/{id}',[BrandController::class,'update'])->name('update');
                Route::get('delete/{id}',[BrandController::class,'delete'])->name('delete');


            });

            Route::group(['prefix'=>'product','as'=>'product.'],function(){
                Route::get('index',[ProductController::class,'index'])->name('index');
                Route::get('create',[ProductController::class,'create'])->name('create');
                Route::post('store',[ProductController::class,'store'])->name('store');
                Route::get('edit/{id}',[ProductController::class,'edit'])->name('edit');
                Route::post('update/{id}',[ProductController::class,'update'])->name('update');
                Route::get('delete/{id}',[ProductController::class,'delete'])->name('delete');
                Route::post('append-categories',[ProductController::class,'appendCategories'])->name('append-categories');

                Route::group(['prefix'=>'attribute','as'=>'attribute.'],function(){
                    Route::get('index/{id?}',[AttributeController::class,'index'])->name('index');
                    Route::get('add/{id}',[AttributeController::class,'create'])->name('add');
                    // Route::get('create/',[AttributeController::class,'create'])->name('create');

                    Route::post('store',[AttributeController::class,'store'])->name('store');
                    Route::get('edit/{id}',[AttributeController::class,'edit'])->name('edit');
                    Route::post('update/{id}',[AttributeController::class,'update'])->name('update');
                    Route::get('delete/{id}',[AttributeController::class,'delete'])->name('delete');


                });

            });
        });
    });
});

Route::post('/upload-temp', function (Request $request) {
    if ($request->hasFile('file')) {
        $files = $request->file('file');
        $uploadedFiles = [];
        foreach ($files as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $tempPath = $file->storeAs('temp', $filename); // Storing in 'storage/app/temp'
            $uploadedFiles[] = [
                'filename' => $filename,
                'filepath' => $tempPath
            ];
        }
        return response()->json($uploadedFiles);
    }
    return response()->json(['error' => 'No file uploaded'], 400);
});



Route::delete('/revert-temp', function (Request $request) {
    $filename = $request->getContent();
    if (empty($filename)) {
        return response()->json(['success' => false, 'message' => 'Filename is empty'], 400);
    }
    $filePath = 'temp/' . $filename;
    $permanenPath = 'public/admin/' . $filename;
    if (Storage::exists($filePath)) {
        Storage::delete($filePath);
        return response()->json(['success' => true]);
    } else if (Storage::exists($permanenPath)) {
        Storage::delete($filePath);
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false, 'message' => 'File not found'], 404);
});

Route::post('/files/getUploadId', function () {
    return getFileUploadId();
});
Route::patch('/files/uploadfileChunk', [function (Request $request) {
    return uploadFilePatch($request);
}]);

Route::delete('/files/revertFile', [function (Request $request) {
    return revertFileUpload($request);
}]);

Route::post('ajax-get-cities/{stateId}', [CityController::class, 'getCities'])->name('ajax-get-cities');
Route::post('ajax-get-states/{countryId}', [StateController::class, 'getStates'])->name('ajax-get-states');
