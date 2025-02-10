<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('employers.')->prefix('employer')->group(function () {
        //employer auth
        Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'employerLoginForm'])->name('login');
        Route::post('/secureLogin', [App\Http\Controllers\Auth\LoginController::class, 'employerLogin'])->name('securelogin');
        Route::view('/sign-up', 'employer.auth.register')->name('signup');
        Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'employerSignup'])->name('register');
        Route::post('/username-validation', [App\Http\Controllers\Admin\EmployerUserController::class, 'usernameValidate'])->name('userNameValidate');
        Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
        
        //forget password routes
        Route::namespace('App\Http\Controllers\Auth')->group(function () {
            Route::get('/forget-password', 'ForgotPasswordController@showLinkRequestForm')->name('forget.password.get');
            Route::post('/forget-password', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('/reset-password/{token}', 'ForgotPasswordController@showResetForm')->name('password.reset');
            Route::post('/reset-password', 'ForgotPasswordController@changePassword')->name('password.update');
        });

        Route::namespace('App\Http\Controllers\Employer')
            ->middleware(['auth', 'employer', 'role:employer'])->group(function () {
                //Profile Overview
                Route::view('/overview', 'employer.overview-jobs.overview')->name('overview');
        
                Route::middleware(['employerDetails'])->group(function () {
                    Route::get('/dashboard', 'DashboardController@index')->name('index');
                    Route::view('/test', 'employer.edit-profile.basic-information');

                    Route::name('editProfile.')->prefix('edit-profile')->controller('EditProfileController')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/contact-person', 'contactPerson')->name('contact-person');
                        Route::get('/social-links', 'socialLink')->name('social-links');

                        //Post handlers
                        Route::post('/updating-details', 'updateProfile')->name('profileDetails');
                        Route::post('/contact-person', 'updateContact')->name('addContact');
                        Route::post('/social-links', 'postSocialLinks')->name('saveSocialLinks');
                    });

                    Route::name('settings.')->prefix('account-settings')->controller('EmployerSettingController')->group(function () {
                        Route::get('/{page?}', 'pages')->name('accountSettings');

                        //post for Company Page Settings
                        Route::post('/', 'updatePageSettings')->name('savesPageSettings');

                        // change email portion
                        //route for making primary and removing
                        Route::post('/change-email', 'editDeleteEmail')->name('editEmails');
                        Route::post('add-email', 'addEmail')->name('addEmails');

                        //change password
                        Route::post('/change-password', 'changePasswordPost')->name('change-password');

                        //post handler for deactivation of account
                        Route::post('/deactivate-account', 'postDeactivate')->name('deactivate-account');
                    });

                    Route::name('jobs.')->prefix('manage-jobs')->controller('ManageJobController')->group(function () {
                        Route::get('/', 'index')->name('index');
                        //edit posted Jobs
                        Route::get('/edit/{slug}', 'JobPostController@edit')->name('edit');
                        //view job
                        Route::get('/{slug}/applied', 'JobPostController@viewApplied')->name('viewApplied');
                        Route::get('job/{slug}', 'viewJob')->name('view');
                        Route::post('/delete', 'JobPostController@destroy')->name('delete');
                    });
                    Route::post('/changing-password', 'DashboardController@changePassword')->name('changePassword');
                    Route::post('/adding-social-links', 'DashboardController@addSocialLinks')->name('addSocialLink');
                    Route::post('/updating-contact', 'DashboardController@updateContact')->name('updateContact');
                    Route::get('/post-a-job', 'DashboardController@postAJob')->name('postAJob');
                    Route::get('/post-an-newspaper-article', 'DashboardController@newspaper')->name('postANewspaper');
                    Route::post('/posting-job', 'JobPostController@store')->name('post-a-job');
                    Route::post('/posting-an-article', 'JobPostController@articleStore')->name('post-a-newspaper');
                    Route::post('/editing-job/{slug}', 'JobPostController@update')->name('edit-a-post');
                    Route::post('/editing-newspaper/{slug}', 'JobPostController@articleUpdate')->name('edit-a-newspaper');
                    Route::post('/job-status', 'DashboardController@changeStatus')->name('changeJobStatus');
                    Route::get('/{status?}', 'DashboardController@filterIndex')->name('filterSearch');
                    Route::get('{slug}/user/{username}', 'DashboardController@viewUser')->name('viewUser');
                    Route::get('/download-cv/{username}/{slug}', 'DashboardController@downloadPdf')->name('downloadCV');

                    //post a job ajax routes
                    Route::post('/fetch_districts', 'DashboardController@fetchDistrict')->name('provinceSelect');
                    Route::post('/fetch-cities', 'DashboardController@fetchCity')->name('citySelect');

                    //Routes for sending emails to the applicants
                    Route::post('/send-email', 'SendEmailController@sendEmail')->name('sendEmail');
                    Route::post('/send-bulk-emails/{slug}', 'SendEmailController@sendBulkEmail')->name('sendBulkEmail');
                });
            });
    });