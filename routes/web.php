    <?php

    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\ProductController;
    use Illuminate\Support\Facades\Route;

    //when logined
    Route::group(['middleware'=>'auth'],function(){
        Route::get('/', function () {
        // return view('client.home');
        });
        Route::group(['middleware'=> 'auth.admin'],function(){
            Route::get('/dashboard', function () {
            return view('admin.dashboard');});
            Route::get('/dashboard/product',[ProductController::class,'showListProduct'])->name('products.list');
            Route::get('/dashboard/product/create', function () {
                return view('.products.create');})->name('product.create');
            Route::post('/dashboard/product/submit',[ProductController::class,'submit'])->name('product.submit');
            Route::get('/dashboard/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
            Route::post('/dashboard/product/update/{id}',[ProductController::class,'update'])->name('product.update');
            Route::delete('dashboard/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        });
    });
    Route::get('/a',[ProductController::class,'showlistproduct'])->name('');

//Logins
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login',[LoginController::class,'login']);
//Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//Main
    Route::get('/', function () {
        return view('welcome');})->name('home');
;