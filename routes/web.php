<?php


use Illuminate\Support\Facades\Route;

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

// Dashboard
/* Route::prefix('dashboard')->middleware(['auth' , 'verified' , 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Dashboard\IndexController::class , 'index'])->name('dashboard');
    Route::resource('users', \App\Http\Controllers\Dashboard\UserController::class)->only(['edit' , 'update' , 'destroy']);
    Route::get('users/login/{user}', [\App\Http\Controllers\Dashboard\UserController::class , 'login'])->name('users.login');
    Route::resource('categories', \App\Http\Controllers\Dashboard\CategoryController::class)->except('show');
    Route::resource('article-categories', \App\Http\Controllers\Dashboard\ArticleCategoryController::class)->except('show');
    Route::resource('tags', \App\Http\Controllers\Dashboard\TagController::class)->except('show');
    Route::resource('products', \App\Http\Controllers\Dashboard\ProductController::class)->except('index', 'show', 'destroy');
    Route::resource('courses', \App\Http\Controllers\Dashboard\CourseController::class)->except('index', 'show', 'destroy');
    Route::resource('chapters', \App\Http\Controllers\Dashboard\ChapterController::class)->except('index', 'show', 'destroy');
    Route::resource('bundles', \App\Http\Controllers\Dashboard\BundleController::class)->except('index', 'show', 'destroy');
    Route::resource('articles', \App\Http\Controllers\Dashboard\ArticleController::class)->except('index', 'show');
    Route::resource('details', \App\Http\Controllers\Dashboard\DetailController::class)->only('edit', 'update', 'destroy');
    Route::resource('versions', \App\Http\Controllers\Dashboard\VersionController::class)->only('edit', 'update', 'destroy');
    Route::resource('menus', \App\Http\Controllers\Dashboard\MenuController::class)->except('show');
    Route::resource('subscribe', \App\Http\Controllers\Dashboard\SubscribeController::class)->except('show');
    Route::resource('wallet-gifts', \App\Http\Controllers\Dashboard\WalletGiftController::class)->except('show');
    Route::resource('discounts', \App\Http\Controllers\Dashboard\DiscountController::class, ['as' => 'dashboard'])->except('show');
    Route::resource('fakeproducts', \App\Http\Controllers\Dashboard\FakeController::class)->except('show');
    Route::resource('sellers', \App\Http\Controllers\Dashboard\SellerController::class);
    Route::resource('discussions', \App\Http\Controllers\Dashboard\DiscussionController::class)->except('show', 'index', 'create');
    Route::resource('comments', \App\Http\Controllers\Dashboard\CommentController::class)->only('edit', 'update', 'destroy');
    Route::resource('withdraws', \App\Http\Controllers\Dashboard\WithdrawController::class)->only('edit', 'update', 'destroy');
    Route::resource('contacts', \App\Http\Controllers\Dashboard\ContactController::class)->only('edit', 'update', 'destroy');

    // Livewire
    Route::get('users', \App\Http\Livewire\Dashboard\User\Index::class)->name('users.index');
    Route::get('users/statics', [\App\Http\Livewire\Dashboard\User\Index::class , 'statics'])->name('users.statics');
    Route::get('factors', \App\Http\Livewire\Dashboard\Factor\Index::class)->name('factors.index');
    Route::get('factors/{factor}', \App\Http\Livewire\Dashboard\Factor\Show::class)->name('factors.show');
    Route::get('incomes', \App\Http\Livewire\Dashboard\Income\Index::class)->name('incomes.index');
    Route::get('commissions', \App\Http\Livewire\Dashboard\Commission\Index::class)->name('commissions.index');
    Route::get('licences', \App\Http\Livewire\Dashboard\Licence\Index::class)->name('licences.index');
    Route::get('licences/{licence}', \App\Http\Livewire\Dashboard\Licence\Show::class)->name('licences.show');
    Route::get('transactions', \App\Http\Livewire\Dashboard\Transaction\Index::class)->name('transactions.index');
    Route::get('discussions', \App\Http\Livewire\Dashboard\Discussion\Index::class)->name('discussions.index');
    Route::get('comments', \App\Http\Livewire\Dashboard\Comment\Index::class)->name('comments.index');
    Route::get('withdraws', \App\Http\Livewire\Dashboard\Withdraw\Index::class)->name('withdraws.index');
    Route::get('bundles', \App\Http\Livewire\Dashboard\Bundle\Index::class)->name('bundles.index');
    Route::get('products', \App\Http\Livewire\Dashboard\Product\Index::class)->name('products.index');
    Route::get('courses', \App\Http\Livewire\Dashboard\Course\Index::class)->name('courses.index');
    Route::get('chapters', \App\Http\Livewire\Dashboard\Chapter\Index::class)->name('chapters.index');
    Route::get('articles', \App\Http\Livewire\Dashboard\Article\Index::class)->name('articles.index');
    Route::get('details', \App\Http\Livewire\Dashboard\Detail\Index::class)->name('details.index');
    Route::get('versions', \App\Http\Livewire\Dashboard\Version\Index::class)->name('versions.index');
    Route::get('refunds', \App\Http\Livewire\Dashboard\Refund\Index::class)->name('refunds.index');
    Route::get('refunds/{refund}', \App\Http\Livewire\Dashboard\Refund\Show::class)->name('refunds.show');
    Route::get('installs', \App\Http\Livewire\Dashboard\Install\Index::class)->name('installs.index');
    Route::get('contacts', \App\Http\Livewire\Dashboard\Contact\Index::class)->name('contacts.index');

    // vue
    Route::post('products-search-vue', [\App\Http\Controllers\Dashboard\IndexController::class , 'products_search_vue']);
    Route::get('/products/{product}/amazing', [\App\Http\Controllers\Dashboard\ProductController::class , 'amazing'])->name('products.amazing');
    Route::patch('/products/{product}/amazing', [\App\Http\Controllers\Dashboard\ProductController::class , 'amazing_store'])->name('products.amazing.store');
    Route::get('/courses/{course}/amazing', [\App\Http\Controllers\Dashboard\CourseController::class , 'amazing'])->name('courses.amazing');
    Route::patch('/courses/{course}/amazing', [\App\Http\Controllers\Dashboard\CourseController::class , 'amazing_store'])->name('courses.amazing.store');
    Route::get('/bundles/{bundle}/product', [\App\Http\Controllers\Dashboard\BundleController::class , 'bundle'])->name('bundles.product');

    Route::post('update-bundle', [\App\Http\Controllers\Dashboard\IndexController::class, 'updateBundle']);
    Route::post('delete-bundle', [\App\Http\Controllers\Dashboard\IndexController::class, 'deleteBundle']);
});*/
Route::prefix('dashboard')->middleware(['auth' , 'verified'])->group(function () {
    // Ajax
    Route::get('products-search', [\App\Http\Controllers\Dashboard\IndexController::class , 'products_search']);
    Route::get('users-search', [\App\Http\Controllers\Dashboard\IndexController::class , 'users_search']);
}); 


// tiny upload
Route::post('tiny/upload', [\App\Http\Controllers\Site\UploadController::class, 'tiny_upload']);
// uppy upload
Route::post('uppy/upload', [\App\Http\Controllers\Site\UploadController::class, 'uppy_upload']);
Route::post('uppy/upload/s3', [\App\Http\Controllers\Site\UploadController::class, 'uppy_upload_s3']);
Route::get('download/s3/{folder}/{sub_folder}', [\App\Http\Controllers\Site\UploadController::class, 'download_s3'])->name('download_s3');

Route::post('update-faqs', [\App\Http\Controllers\Site\profile\FaqController::class, 'update']);



// Profile Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/ddd', function (\Codedge\Updater\UpdaterManager $updater) {

        // Check if new version is available
        if($updater->source()->isNewVersionAvailable()) {
    
            // Get the current installed version
            echo $updater->source()->getVersionInstalled();
    
            // Get the new version available
            $versionAvailable = $updater->source()->getVersionAvailable();
    
            // Create a release
            $release = $updater->source()->fetch($versionAvailable);
    
            // Run the update process
            $updater->source()->update($release);
    
        } else {
            echo "No new version available.";
        }
    
    });

    Route::get('/', [\App\Http\Controllers\Site\Profile\IndexController::class, 'index'])->name('index');
    Route::get('/notifications', \App\Http\Livewire\Site\Profile\Notifications::class)->name('notifications');
    Route::get('/notifications/{id}', [\App\Http\Controllers\Site\Profile\IndexController::class, 'notification'])->name('notification');

    Route::get('/settings/edit-profile', \App\Http\Livewire\Site\Profile\Edit::class)->name('edit');
    Route::get('/tickets', \App\Http\Livewire\Site\Profile\Tickets::class)->name('tickets');
    Route::get('/tickets/admin', \App\Http\Livewire\Site\Profile\AdminTickets::class)->name('admin.tickets');
    Route::get('/tickets/create', \App\Http\Livewire\Site\Profile\TicketCreate::class)->name('tickets.create');
    Route::get('/tickets/create/admin', \App\Http\Livewire\Site\Profile\AdminTicketCreate::class)->name('admin.tickets.create');
    Route::get('/tickets/{ticket}', \App\Http\Livewire\Site\Profile\Ticket::class)->name('ticket');

    Route::get('/affiliate', \App\Http\Livewire\Site\Profile\Affiliate::class)->name('affiliate');
    Route::get('/projects', \App\Http\Livewire\Site\Profile\Projects::class)->name('projects');
    Route::get('/projects/{project}', \App\Http\Livewire\Site\Profile\Project::class)->name('project');
    Route::post('/avatar', [\App\Http\Controllers\Site\Profile\IndexController::class, 'avatar'])->name('avatar');

    Route::resource('discounts', \App\Http\Controllers\Site\Profile\DiscountController::class)->except('index', 'show', 'destroy');
    Route::get('/discounts', \App\Http\Livewire\Site\Profile\Discounts::class)->name('profile.discounts');

    Route::get('/invoices', \App\Http\Livewire\Site\Profile\Invoice::class)->name('invoices');

    Route::get('/order', \App\Http\Livewire\Site\Profile\Order::class)->name('order');
    Route::get('/payments/verify', [App\Http\Controllers\Site\Profile\PaymentController::class , 'verify'])->name('verify');

    // Cart and Discount
    Route::get('cart', \App\Http\Livewire\Site\Cart::class)->name('cart');
    Route::post('cart/add', [\App\Http\Controllers\Site\CartController::class, 'add'])->name('cart.add');
    Route::get('factor/callback/{factor}/{status}/{type}', [\App\Http\Controllers\Site\FactorController::class, 'callback']);
});


Route::get('/invoices/{factor}', \App\Http\Livewire\Site\Profile\Factor::class)->name('invoice');

// Auth
require __DIR__ . '/auth.php';

Route::get('/login', \App\Http\Livewire\Site\Auth\Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('/register', \App\Http\Livewire\Site\Auth\Register::class)
    ->middleware('guest')
    ->name('register');

Route::get('/reset-password/{token}', \App\Http\Livewire\Site\Auth\ResetPassword::class)
    ->middleware('guest')
    ->name('password.reset');

Route::get('login/google', [\App\Http\Controllers\Site\GoogleController::class, 'request'])->name('login.google');
Route::get('login/google/callback', [\App\Http\Controllers\Site\GoogleController::class, 'callback']);
