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

Route::get('/', [App\Http\Controllers\HomeController::class,'index']);
Route::post('/contact', [App\Http\Controllers\ContactUsController::class, 'sendEmail'])->name('contact.send');



Route::get('admin-login', [App\Http\Controllers\Admin\DashboardController::class, 'admin_login'])->name('home');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home',[App\Http\Controllers\HomeController::class,'index']);
Route::get('contact-us',[App\Http\Controllers\ContactUsController::class,'index']);
Route::get('about-us',[App\Http\Controllers\AboutUsController::class,'index']);

Route::get('courses',[App\Http\Controllers\CourseController::class,'index']);
Route::get('courses/list',[App\Http\Controllers\CourseController::class,'list'])->name('courses.list');
Route::post('courses/search',[App\Http\Controllers\CourseController::class,'search']);
Route::get('courses/filter', [App\Http\Controllers\CourseController::class, 'filter'])->name('courses.filter');
Route::get('courses/sort', [App\Http\Controllers\CourseController::class, 'sort'])->name('courses.sort');
Route::get('course/details/{id}', [App\Http\Controllers\CourseController::class, 'details']);
Route::post('course/enrolled',[App\Http\Controllers\CourseController::class, 'enrolledCourse'])->name('course.enrolled');

Route::get('cart',[App\Http\Controllers\CartController::class,'index']);
Route::post('/cart/add',[App\Http\Controllers\CartController::class,'add'])->name('cart.add');
Route::post('/removefromcart', [App\Http\Controllers\CartController::class, 'removefromcart']);
Route::get('/cart/count', [App\Http\Controllers\CartController::class, 'getCartCount'])->name('cart.count');
Route::post('cart/product/check',[App\Http\Controllers\CartController::class,'existingCartItem'])->name('cart.product.check');
Route::post('enrolled/product/check',[App\Http\Controllers\CartController::class,'alreadyEnrolled'])->name('enrolled.product.check');


Route::get('checkout',[App\Http\Controllers\CheckoutController::class,'index']);
Route::post('/apply/coupon', [App\Http\Controllers\CheckoutController::class, 'applyCoupon'])->name('applyCoupon');
Route::post('remove/coupon', [App\Http\Controllers\CheckoutController::class, 'removeCoupon'])->name('removeCoupon');




Route::post('stripe/index',[App\Http\Controllers\StripePaymentController::class, 'index'])->name('stripe.form');
Route::get('stripe/handleresponse',[App\Http\Controllers\StripePaymentController::class, 'handleResponse'])->name('stripe.pay');


Route::group(['prefix' => 'admin', 'middleware' => ['admin_auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('ad_dashboard');
    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users');
    Route::get('/profile', [App\Http\Controllers\Admin\DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [App\Http\Controllers\Admin\DashboardController::class, 'profile'])->name('profile');
    
    /*
    services
    */
    Route::get('services', [App\Http\Controllers\Admin\ServiceController::class, 'index']);
    Route::get('services/edit/{id?}', [App\Http\Controllers\Admin\ServiceController::class, 'edit']);
    Route::post('services/edit/{id?}', [App\Http\Controllers\Admin\ServiceController::class, 'edit']);
    Route::get('services/create', [App\Http\Controllers\Admin\ServiceController::class, 'create']);
    Route::post('services/create', [App\Http\Controllers\Admin\ServiceController::class, 'create']);
    Route::get('services/delete/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'delete']);
    
    /*
    course categories
    */
    Route::get('course-categories', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'index']);
    Route::get('course-categories/edit/{id?}', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'edit']);
    Route::post('course-categories/edit/{id?}', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'edit']);
    Route::get('course-categories/create', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'create']);
    Route::post('course-categories/create', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'create']);
    Route::get('course-categories/delete/{id}', [App\Http\Controllers\Admin\CourseCategoriesController::class, 'delete']);
    
    /*
    Courses
    */
    Route::get('course', [App\Http\Controllers\Admin\CourseController::class, 'index']);
    Route::get('course/edit/{id?}', [App\Http\Controllers\Admin\CourseController::class, 'edit']);
    Route::post('course/edit/{id?}', [App\Http\Controllers\Admin\CourseController::class, 'edit']);
    Route::get('course/create', [App\Http\Controllers\Admin\CourseController::class, 'create']);
    Route::post('course/create', [App\Http\Controllers\Admin\CourseController::class, 'create']);
    Route::get('course/delete/{id}', [App\Http\Controllers\Admin\CourseController::class, 'delete']);
    
    /*
    Lessons
    */
    Route::get('lesson/{id?}', [App\Http\Controllers\Admin\LessonController::class, 'index']);
    Route::get('lesson/{course_id}/edit/{id?}', [App\Http\Controllers\Admin\LessonController::class, 'edit']);
    Route::post('lesson/{course_id}/edit/{id?}', [App\Http\Controllers\Admin\LessonController::class, 'edit']);
    Route::get('lesson/{id?}/create', [App\Http\Controllers\Admin\LessonController::class, 'create']);
    Route::post('lesson/{id?}/create', [App\Http\Controllers\Admin\LessonController::class, 'create']);
    Route::get('lesson/delete/{id}', [App\Http\Controllers\Admin\LessonController::class, 'delete']);
    
    /*
    Chapters
    */
    Route::get('chapter/{id?}/{lesson_id?}', [App\Http\Controllers\Admin\ChapterController::class, 'index']);
    Route::get('chapter/{course_id}/{lesson_id}/edit/{id?}', [App\Http\Controllers\Admin\ChapterController::class, 'edit']);
    Route::post('chapter/{course_id}/{lesson_id}/edit/{id?}', [App\Http\Controllers\Admin\ChapterController::class, 'edit']);
    Route::get('chapter/{id?}/{lesson_id?}/create', [App\Http\Controllers\Admin\ChapterController::class, 'create']);
    Route::post('chapter/{id?}/{lesson_id?}/create', [App\Http\Controllers\Admin\ChapterController::class, 'create']);
    Route::get('chapter/{course_id}/{lesson_id}/delete/{id}', [App\Http\Controllers\Admin\ChapterController::class, 'delete'])->name('chapter.delete');
    Route::get('upload-subtitle/{id}', [App\Http\Controllers\Admin\ChapterController::class, 'upload_subtitle']);
    Route::post('upload-subtitle/{id}', [App\Http\Controllers\Admin\ChapterController::class, 'upload_subtitle']);
    
    /*
    Assessment
    */
    Route::get('assessment', [App\Http\Controllers\Admin\AssessmentController::class, 'index']);
    Route::get('assessment/edit/{id?}', [App\Http\Controllers\Admin\AssessmentController::class, 'edit']);
    Route::post('assessment/edit/{id?}', [App\Http\Controllers\Admin\AssessmentController::class, 'edit']);
    Route::get('assessment/{course_id}/{lesson_id}/create/', [App\Http\Controllers\Admin\AssessmentController::class, 'create']);
    Route::post('assessment/create/{id?}', [App\Http\Controllers\Admin\AssessmentController::class, 'create']);
    Route::get('assessment/delete/{id}', [App\Http\Controllers\Admin\AssessmentController::class, 'delete']);
    // Route::get('assessment/fetch_chapters', [App\Http\Controllers\Admin\AssessmentController::class,'fetchChapters'])->name('fetch-chapters');
    
    
    /*
    Question
    */
    Route::get('question/{id?}', [App\Http\Controllers\Admin\QuestionController::class, 'index']);
    Route::get('question/{assessment_id}/edit/{id?}', [App\Http\Controllers\Admin\QuestionController::class, 'edit']);
    Route::post('question/{assessment_id}/edit/{id?}', [App\Http\Controllers\Admin\QuestionController::class, 'edit']);
    Route::get('question/{id?}/create', [App\Http\Controllers\Admin\QuestionController::class, 'create']);
    Route::post('question/{id?}/create', [App\Http\Controllers\Admin\QuestionController::class, 'create']);
    Route::get('question/delete/{id}', [App\Http\Controllers\Admin\QuestionController::class, 'delete']);
    
    /*
    Answers
    */
    Route::get('answer/{id?}', [App\Http\Controllers\Admin\AnswerController::class, 'index']);
    Route::get('answer/{question_id}/edit/{id?}', [App\Http\Controllers\Admin\AnswerController::class, 'edit']);
    Route::post('answer/{question_id}/edit/{id?}', [App\Http\Controllers\Admin\AnswerController::class, 'edit']);
    Route::get('answer/{id?}/create', [App\Http\Controllers\Admin\AnswerController::class, 'create']);
    Route::post('answer/{id?}/create', [App\Http\Controllers\Admin\AnswerController::class, 'create']);
    Route::get('answer/delete/{id}', [App\Http\Controllers\Admin\AnswerController::class, 'delete']);
    
    /*
    Users
    */
    Route::get('user', [App\Http\Controllers\Admin\UsersController::class, 'index']);
    Route::get('user/edit/{id?}', [App\Http\Controllers\Admin\UsersController::class, 'edit']);
    Route::post('user/edit/{id?}', [App\Http\Controllers\Admin\UsersController::class, 'edit']);
    Route::get('user/create', [App\Http\Controllers\Admin\UsersController::class, 'create']);
    Route::post('user/create', [App\Http\Controllers\Admin\UsersController::class, 'create']);
    Route::get('user/delete/{id}', [App\Http\Controllers\Admin\UsersController::class, 'delete']);
    
    /* Orders */
    Route::get('orders', [App\Http\Controllers\Admin\DashboardController::class, 'orders']);
    Route::get('orders/invoice/{id?}', [App\Http\Controllers\Admin\DashboardController::class, 'order_invoice']);
    
    
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'showSettings'])->name('admin.settings');
    Route::post('/settings',  [App\Http\Controllers\SettingController::class, 'updateSettings'])->name('admin.settings.update');
    
    /* Coupon */
    Route::get('coupon', [App\Http\Controllers\Admin\CouponController::class, 'index']);
    Route::get('coupon/edit/{id?}', [App\Http\Controllers\Admin\CouponController::class, 'edit']);
    Route::post('coupon/update', [App\Http\Controllers\Admin\CouponController::class, 'update']);
    Route::get('coupon/create', [App\Http\Controllers\Admin\CouponController::class, 'create']);
    Route::post('coupon/store', [App\Http\Controllers\Admin\CouponController::class, 'store']);
    Route::get('coupon/import', [App\Http\Controllers\Admin\CouponController::class, 'import']);
    Route::post('coupon/import-coupon', [App\Http\Controllers\Admin\CouponController::class, 'importCoupons']);
    Route::post('coupon/import', [App\Http\Controllers\Admin\CouponController::class, 'import']);
    Route::get('coupon/delete/{id}', [App\Http\Controllers\Admin\CouponController::class, 'delete']);
    Route::get('coupon/mails', [App\Http\Controllers\Admin\CouponController::class, 'mail']);
    
    
});

Route::group(['prefix' => 'instructor', 'middleware' => ['instructor_auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\Instructor\DashboardController::class, 'index']);
});


Route::group(['prefix' => 'student', 'middleware' => ['student_auth']], function () {
    /* dashboard urls */
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index']);
    
    /* enrolled courses urls */
    Route::get('/courses',[App\Http\Controllers\Student\CourseController::class, 'index']);
    Route::get('/course/watch/{id}',[App\Http\Controllers\Student\CourseController::class, 'watch']);
    Route::post('/course/chapter',[App\Http\Controllers\Student\CourseController::class, 'chapter'])->name('course.chapter');
    Route::post('/course/progress',[App\Http\Controllers\Student\CourseController::class, 'progress'])->name('course.progress');
    
    /* enrolled courses urls */
    Route::get('start-assessment/{course}/{lesson}',[App\Http\Controllers\Student\StudentAssessmentController::class, 'index']);
    Route::get('/view_assessment/{id}',[App\Http\Controllers\Student\StudentAssessmentController::class, 'view_assessment']);
    Route::get('/assessment/{id?}', [App\Http\Controllers\Student\StudentAssessmentController::class, 'assessment'])->name('st_assessment');
    Route::post('/assessment/{id?}', [App\Http\Controllers\Student\StudentAssessmentController::class, 'assessment'])->name('st_assessment');
    // Route::get('/assessment-result/{id?}', [App\Http\Controllers\Student\StudentAssessmentController::class, 'assessment_result'])->name('st_assessment_result');
    Route::post('/assessment/question',[App\Http\Controllers\Student\StudentAssessmentController::class, 'question'])->name('assessment.question');
    Route::get('/download-certificate/{id?}', [App\Http\Controllers\Student\StudentAssessmentController::class, 'download_certificate'])->name('st_download_certificate');
    Route::get('/assessment-result/{id}', [App\Http\Controllers\Student\StudentAssessmentController::class, 'showAssessmentResult'])->name('show_assessment_result');

    

    
    Route::get('rating/create', [App\Http\Controllers\Student\StudentAssessmentController::class, 'createreviews']);
    Route::post('rating/create', [App\Http\Controllers\Student\StudentAssessmentController::class, 'createreviews']);
    
    /* profile urls */
    Route::get('/profile',[App\Http\Controllers\Student\ProfileController::class, 'index']);
    Route::post('/profile',[App\Http\Controllers\Student\ProfileController::class, 'index']);
    
    /* wishlist urls */
    Route::get('/wishlist',[App\Http\Controllers\Student\WishlistController::class, 'index']);
    Route::post('/wishlist/add',[App\Http\Controllers\Student\WishlistController::class, 'add'])->name('wishlist.add');
    Route::get('/wishlist/remove/{id}',[App\Http\Controllers\Student\WishlistController::class, 'remove'])->name('wishlist.remove');
    
});
