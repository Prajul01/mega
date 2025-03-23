<?php

namespace App\Http\Controllers;

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

Route::get('/', [User\FrontendController::class, 'index'])->name('index');
Route::get('/jobs', [User\FrontendController::class, 'jobs'])->name('jobs');
Route::post('/job-filter', [User\FrontendController::class, 'filterData'])->name('jobFilter');
Route::get('/job/{slug}', [User\FrontendController::class, 'job_single'])->name('job_single');
//forget password routes
Route::
        namespace('App\Http\Controllers\Auth')->group(function () {
            Route::get('/forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('forget.password.get');
            Route::post('/forget-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('/reset-password/{token}', 'ForgotPasswordController@showResetForm')->name('password.reset');
            Route::post('/reset-password', 'ForgotPasswordController@changePassword')->name('password.update');
        });
Route::get('/about', [User\FrontendController::class, 'about'])->name('about');
Route::get('/contact', [User\FrontendController::class, 'contact'])->name('contact');
Route::get('/training', [User\FrontendController::class, 'training'])->name('training');
Route::get('/blogs', [User\FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [User\FrontendController::class, 'blog_single'])->name('blog_single');
Route::get('/news-and-announcements', [User\FrontendController::class, 'newsAndAnnouncement'])->name('newsAndAnnouncement');
Route::get('/news-and-announcements/{slug}', [User\FrontendController::class, 'newsAndAnnouncement_single'])->name('newsAndAnnouncement.single');
Route::post('/contact', [User\FrontendController::class, 'contact_store'])->name('contact.store');
Route::get('/faq/{faq?}', [User\FrontendController::class, 'faq'])->name('faq');
Route::get('/employer/detail/{slug}', [User\FrontendController::class, 'employer_detail'])->name('employer_detail');
Route::get('tender', [User\FrontendController::class, 'tender'])->name('tender');
Route::get('tender/{tender}', [User\FrontendController::class, 'tender_details'])->name('tender_details');
Route::get('career-tips', [User\FrontendController::class, 'career'])->name('career-tips');
Route::get('career-tips/{career}', [User\FrontendController::class, 'career_details'])->name('career-details');
Route::get('privacy-policies', [User\FrontendController::class, 'privacy'])->name('privacy');
Route::get('terms-and-conditions', [User\FrontendController::class, 'terms'])->name('terms');
Route::name('advertise.')->prefix('advertise')->group(function () {
    Route::get('/', [User\FrontendController::class, 'advertisement'])->name('index');
    Route::get('advertisement', [User\FrontendController::class, 'banner_job'])->name('banner-job');
    Route::get('premium-job', [User\FrontendController::class, 'hot_job'])->name('hot-job');
    Route::get('megajob', [User\FrontendController::class, 'megajobPosting'])->name('top-job');
    Route::get('prime-job', [User\FrontendController::class, 'prime_jobs'])->name('feature-job');
});

Route::view('/report-issues', 'user.report-issue')->name('reportIssue');
Route::post('/issue-reported', [User\FrontendController::class, 'reportIssue'])->name('issueReported');

// admin auth
Route::get('/admin/login', [Auth\LoginController::class, 'loginForm'])->name('login');
Route::post('/securelogin', [Auth\LoginController::class, 'login'])->name('securelogin');
Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout');

//job seeker auth
Route::post('/login', [Auth\LoginController::class, 'employerLogin'])->name('users.login');
Route::post('/validateUser', [User\AuthController::class, 'usernameValidate'])->name('users.validate');
Route::post('/sign-up', [User\AuthController::class, 'register'])->name('users.signUp');

// Social Auth
Route::get('/oauth/auth/google', [Auth\GoogleController::class, 'signInwithGoogle'])->name('googleLogin');
Route::get('/callback/google', [Auth\GoogleController::class, 'callbackToGoogle']);

//apply job
Route::post('/apply-job/{s}', [User\FrontendController::class, 'applyJob'])->name('applyJob');
// //withdraw from a    job
Route::post('/withdraw-job', [User\FrontendController::class, 'withdrawJob'])->name('withdrawJob');
//save jobs
Route::post('/save-jobs', [User\FrontendController::class, 'saveJob'])->name('saveJob');
