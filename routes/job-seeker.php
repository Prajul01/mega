<?php

use Illuminate\Support\Facades\Route;

Route::
        namespace('App\Http\Controllers\User\Dashboard')->middleware(['auth', 'job_seeker_username', 'role:job-seeker'])->name('user.')->prefix('@{username}')->group(function () {

            Route::get('/district/{id}', 'DashboardController@district')->name('district');
            Route::get('/city/{id}', 'DashboardController@city')->name('city');
            Route::middleware('jobseekerDetails')->group(function () {
                Route::get('/', 'DashboardController@dashboard')->name('dashboard');
                Route::get('/profile-status', 'DashboardController@profileStatus')->name('profileStatus');
                Route::get('/saved-job', 'DashboardController@savejob')->name('save_job');
                Route::get('/applied-job', 'DashboardController@applyjob')->name('apply_job');
                Route::get('/similar-job', 'DashboardController@similarjob')->name('similar_job');
                Route::get('/apply-job-profile-visit', 'DashboardController@applyJobProfileVisit')->name('profile_visit');
                Route::get('/apply-job-download-cv', 'DashboardController@applyDownloadCv')->name('download_cv');
            });
            Route::get('/setting', 'DashboardController@setting')->name('setting');
            Route::get('/profile', 'SeekerProfileController@profile')->name('profile');
            Route::get('/basic-info', 'SeekerProfileController@basicInfo')->name('basic_info');
            Route::get('/education', 'SeekerProfileController@education')->name('education');
            Route::get('/training', 'SeekerProfileController@training')->name('training');
            Route::get('/experience', 'SeekerProfileController@experience')->name('experience');
            Route::get('/language', 'SeekerProfileController@language')->name('language');
            Route::get('/reference', 'SeekerProfileController@reference')->name('reference');
            Route::get('/social-account', 'SeekerProfileController@socialAccount')->name('socialAccount');
            Route::get('/otherInf-info', 'SeekerProfileController@otherInfo')->name('otherInfo');
            Route::post('/store-training', 'SeekerProfileController@storeTraining')->name('store_training');
            Route::put('/update-training', 'SeekerProfileController@updateTraining')->name('update_training');
            Route::post('/store-experiance', 'SeekerProfileController@storeExperience')->name('store_experiance');
            Route::put('/update-experiance', 'SeekerProfileController@updateExperience')->name('update_experiance');
            Route::post('/store-referance', 'SeekerProfileController@storeReferance')->name('store_referance');
            Route::put('/update-referance', 'SeekerProfileController@updateReferance')->name('update_referance');
            Route::post('/store-social-account', 'SeekerProfileController@storeSocial')->name('store_social');
            Route::put('/update-social-account', 'SeekerProfileController@updateSocial')->name('update_social');
            Route::post('/store-language', 'SeekerProfileController@storeLanguage')->name('store_language');
            Route::put('/update-language', 'SeekerProfileController@updateLanguage')->name('update_language');
            Route::post('/store-education', 'SeekerProfileController@storeEducation')->name('store_education');
            Route::put('/update-education', 'SeekerProfileController@updateEducation')->name('update_education');
            Route::post('/store-preference', 'SeekerProfileController@storePreference')->name('store_preference');
            Route::put('/update-preference', 'SeekerProfileController@updatePreference')->name('update_preference');
            Route::post('/store-basicinfo', 'SeekerProfileController@storeBasicinfo')->name('store_basicinfo');
            Route::put('/update-basicinfo', 'SeekerProfileController@updateBasicinfo')->name('update_basicinfo');
            Route::get('/download', 'DashboardController@create_pdf')->name('download');
            Route::get('/view-profile', 'DashboardController@viewprofile')->name('view_profile');
            Route::post('/change-password', 'SeekerProfileController@changePassword')->name('change_password');
            Route::post('/account-deactivated', 'SeekerProfileController@account_Deactivated')->name('account_deactivated');
            Route::get('/change-setting', 'SeekerProfileController@changeSetting')->name('change_setting');

            // Route::middleware('jobseekerDetails')->group(function () {
            //     Route::get('/', 'DashboardController@index')->name('dashboard');
            //     Route::get('/saved-job', 'DashboardController@savejob')->name('save_job');
            //     Route::get('/applied-job', 'DashboardController@applyjob')->name('apply_job');
            //     Route::get('/similar-job', 'DashboardController@similarjob')->name('similar_job');
            //     Route::get('/view-profile', 'DashboardController@viewprofile')->name('view_profile');
            //     Route::get('download', 'DashboardController@create_pdf')->name('create_pdf');
            // });
        });