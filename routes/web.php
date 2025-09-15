<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\FrontendControler;
use App\Http\Controllers\MenuContrller;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorMembershipController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\admin\SubscriberController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AjaxCommentController;

use App\Http\Controllers\Admin\TestimonialController;
use App\Models\Page;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\FeatureCardController;
use App\Http\Controllers\ClubIntroController;
use App\Http\Controllers\PresidentMessageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PartnerController;



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




Route::get('/', [FrontendControler::class, 'frontend']);



Route::middleware('auth','verified')->group(function () {
    Route::get('/dashboard', [DashboardControler::class, 'dashboard'])->name('dashboard');

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// manage activity

Route::middleware('auth','verified','role:manager')->group(function () {
    Route::get('/managerdashbaord', [DashboardControler::class, 'managerdashbaord'])->name('managerdashbaord');

});


Route::middleware('auth','verified','role:agent')->group(function () {
    Route::get('/agentdashbaord', [DashboardControler::class, 'agentdashbaord'])->name('agentdashbaord');

});


Route::middleware('auth','verified','role:member')->group(function () {
    Route::get('/memberdashbaord', [DashboardControler::class, 'memberdashbaord'])->name('memberdashbaord');

});

Route::middleware('auth','verified','role:user')->group(function () {
    Route::get('/userdashbaord', [DashboardControler::class, 'userdashbaord'])->name('userdashbaord');

});

Route::middleware('auth')->group(function () {

  Route::get('menu/addform',[MenuContrller::class, 'addform'])->name('addform');
  Route::get('setting/form',[SettingController::class, 'settingform'])->name('settingform');

   Route::post('settingd/Update',[SettingController::class, 'SettingUpdate'])->name('settingUpdate');
    Route::resource('menus', MenuController::class);


Route::get('/doctor/register', [DoctorController::class, 'create'])->name('doctor.register');
Route::post('/doctor/register', [DoctorController::class, 'store'])->name('doctor.store');

Route::get('/doctor/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');
Route::put('/doctor/{doctor}/update', [DoctorController::class, 'update'])->name('doctor.update');

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctor.index');
Route::get('/listbyapproved/{status}', [DoctorController::class, 'listbyapproved'])->name('doctor.listbyapproved');
Route::get('/listbypending/{status}', [DoctorController::class, 'listbypending'])->name('doctor.listbypending');
Route::get('/listbycancelled/{status}', [DoctorController::class, 'listbycancelled'])->name('doctor.listbycancelled');


Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctor.show');

Route::post('/doctors/{id}/status/{status}', [DoctorController::class, 'updateStatus'])->name('doctor.status');
//




Route::get('/doctors/export/excel', [DoctorController::class, 'exportExcel'])->name('doctor.export.excel');
Route::get('/doctors/export/pdf', [DoctorController::class, 'exportPDF'])->name('doctor.export.pdf');





// রিপোর্ট

Route::get('/revenue-report', [ReportController::class, 'revenue'])->name('report.revenue');
Route::get('/revenue-by-level', [ReportController::class, 'revenueByLevel'])
     ->name('report.revenueByLevel');
Route::get('/report/{slug}', [ReportController::class, 'membershipReport'])->name('report.membership');


});
// ফ্রন্টএন্ডে মেনু দেখানোর জন্য (ঐচ্ছিক)
Route::get('/frontend-menu', [MenuController::class, 'frontendMenu']);

Route::middleware(['auth']) // প্রয়োজনে gate/policy যোগ করুন
    ->patch('/doctors/{doctor}/membership', [DoctorMembershipController::class,'update'])
    ->name('doctors.membership.update');




    // Contact Form Daynamic

    // Public (AJAX submit)
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

Route::middleware('auth','verified')->group(function () {
     Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact.index');
    Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('admin.contact.show');
    Route::patch('/contact-messages/{contactMessage}/read', [ContactMessageController::class, 'markRead'])->name('admin.contact.read');
    Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('admin.contact.destroy');

  });


Route::middleware('auth','verified')->group(function () {
  Route::resource('pages', PageController::class)->except(['show']);

  Route::post('pages/bulk', [PageController::class, 'bulk'])->name('pages.bulk'); // NEW

  });

  // Public single page view by slug (optional)
Route::get('/page/{slug}', function($slug){
    $page = Page::where('slug',$slug)->where('status','published')->firstOrFail();
    return view('pages.show', compact('page'));
})->name('page.public.show');

Route::post('/editor/image-upload', [PageController::class, 'image'])
     ->name('editor.image.upload');




Route::middleware('auth')->group(function () {
    Route::resource('herosections', HeroSectionController::class);
});


Route::middleware('auth')->group(function () {
    Route::resource('featurecards', FeatureCardController::class);
    Route::resource('clubintro', ClubIntroController::class)->except(['show']);
    Route::resource('president', PresidentMessageController::class)->except(['show']);
     Route::resource('faqs', FaqController::class)->except(['show']);
     Route::resource('partners', PartnerController::class)->except(['show']);
     Route::resource('doctor', DoctorController::class);

      // Subscribers
    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('/subscribers/{id}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');
    Route::post('/subscribers/{id}/verify', [SubscriberController::class, 'markVerified'])->name('subscribers.verify');
    Route::get('/subscribers/export', [SubscriberController::class, 'exportCsv'])->name('subscribers.export');

    //
    // Notices
    Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
    Route::get('/notices/create', [NoticeController::class, 'create'])->name('notices.create');
    Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store');
    Route::delete('/notices/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy');


    // post and category


Route::get('/posts', [PostAdminController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostAdminController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostAdminController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostAdminController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostAdminController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostAdminController::class, 'destroy'])->name('posts.destroy');


Route::get('/categories', [CategoryAdminController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryAdminController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryAdminController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryAdminController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryAdminController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryAdminController::class, 'destroy'])->name('categories.destroy');
 Route::resource('testimonials', TestimonialController::class)->except(['show']);

});




// NewsletterController
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/verify', [NewsletterController::class, 'verify'])->name('newsletter.verify');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');


// blog post






Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{category:slug}', [PostController::class, 'category'])->name('blog.category');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');



Route::get('/blog/{post:slug}/comments', [AjaxCommentController::class, 'index'])
    ->name('comments.index');

// Create comment (JSON)
Route::post('/blog/{post:slug}/comments', [AjaxCommentController::class, 'store'])
    ->middleware('throttle:10,1') // প্রতি মিনিটে ১০টা রিকোয়েস্ট
    ->name('comments.store');


require __DIR__.'/auth.php';
