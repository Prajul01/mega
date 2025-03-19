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

Route::
        namespace('App\Http\Controllers\Admin')->middleware('auth')->group(function () {
            Route::get('/test', function () {
                $user = App\Models\User::find(1);
                $role = Spatie\Permission\Models\Role::find(1);

                $permissions = Spatie\Permission\Models\Permission::pluck('id', 'id')->all();

                $role->syncPermissions($permissions);
                $user->assignRole($role->id);
                return redirect()->route('admin.das');
            });

            Route::name('admin.')->prefix('admin')->middleware(['web', 'admin'])->group(function () {
                Route::get('/', 'DashboardController@index')->name('dashboard');

                Route::resource('/admin-management', 'AdminController');
                Route::post('/admin-management/suspended/{id}', 'AdminController@suspend')->name('admin-management.suspend');

                // admin users
                Route::name('adminUsers.')->prefix('user-management')->controller('AdminUserController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                    Route::delete('/delete/{id}', 'destroy')->name('destroy');
                    Route::post('/suspended/{id}', 'suspended')->name('suspend');
                });

                // job seekers
                Route::name('users.')->prefix('job-seekers')->group(function () {
                    Route::get('/', 'UserController@index')->name('admins.index');
                    Route::get('/create', 'UserController@create')->name('create');
                    Route::get('/@{username}', 'UserController@show')->name('show');
                    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
                    Route::post('/', 'UserController@store')->name('store');
                    Route::post('/update/{id}', 'UserController@update')->name('update');
                    Route::delete('/delete/{id}', 'UserController@destroy')->name('destroy');
                    Route::post('/suspended/{username}', 'UserController@suspended')->name('suspend');
                });

                Route::name('jobPosting.')->prefix('job-posting-management')->controller('JobPostingController')->group(function () {
                    Route::get('/{type?}', 'index')->name('index');
                    Route::post('/post-jobs/{type}', 'postJobs')->name('postJobs');

                });

                // employers
                Route::name('employers.')->prefix('employers')->group(function () {
                    Route::get('/', 'EmployerUserController@index')->name('index');
                    Route::get('/create', 'EmployerUserController@create')->name('create');
                    Route::post('/store', 'EmployerUserController@store')->name('store');
                    Route::get('/edit/{username}', 'EmployerUserController@edit')->name('edit');
                    Route::put('/update/{username}', 'EmployerUserController@update')->name('update');
                    Route::delete('/delete/{id}', 'EmployerUserController@destroy')->name('delete');
                    Route::post('/suspended/{username}', 'EmployerUserController@suspended')->name('suspended');
                    Route::get('/suspended-users', 'EmployerUserController@susList')->name('susList');
                    Route::post('/ValidateUsername', 'EmployerUserController@usernameValidate')->name('validateUsername');
                });

                //roles
                Route::name('roles.')->prefix('role-management')->group(function () {
                    Route::get('/', 'RoleController@index')->name('index');
                    Route::get('/create', 'RoleController@create')->name('create');
                    Route::get('/show/{id}', 'RoleController@show')->name('show');
                    Route::post('/store', 'RoleController@store')->name('store');
                    Route::get('/edit/{id}', 'RoleController@edit')->name('edit');
                    Route::put('/update/{id}', 'RoleController@update')->name('update');
                    Route::delete('/delete/{id}', 'RoleController@destroy')->name('destroy');
                });

                Route::name('setting.')->prefix('setting')->group(function () {
                    Route::get('/', 'SettingController@index')->name('index');
                    Route::post('/', 'SettingController@update')->name('update');
                });

                Route::name('sliders.')->prefix('slider-managemnet')->group(function () {
                    Route::get('/', 'SliderController@index')->name('index');
                    Route::get('/edit/{id}', 'SliderController@edit')->name('edit');
                    Route::post('/store', 'SliderController@store')->name('store');
                    Route::post('/update/{id}', 'SliderController@update')->name('update');
                    Route::post('/delete', 'SliderController@destroy')->name('destroy');
                    Route::post('/order_no', 'SliderController@set_order')->name('order');
                    Route::post('/status', 'SliderController@status')->name('status');
                });
                Route::name('showrooms.')->prefix('showrooms-managemnet')->group(function () {
                    Route::get('/', 'ShowroomController@index')->name('index');
                    Route::get('/edit/{id}', 'ShowroomController@edit')->name('edit');
                    Route::post('/store', 'ShowroomController@store')->name('store');
                    Route::post('/update/{id}', 'ShowroomController@update')->name('update');
                    Route::post('/delete', 'ShowroomController@destroy')->name('destroy');
                    Route::post('/order_no', 'ShowroomController@set_order')->name('order');
                });

                //blog
                Route::name('blog.')->prefix('blog-management')->group(function () {
                    Route::get('/', 'BlogController@index')->name('index');
                    Route::get('/edit/{id}', 'BlogController@edit')->name('edit');
                    Route::post('/store', 'BlogController@store')->name('store');
                    Route::post('/update/{id}', 'BlogController@update')->name('update');
                    Route::post('/delete', 'BlogController@destroy')->name('destroy');
                    Route::post('/order_no', 'BlogController@set_order')->name('order');
                });
                //faq
                Route::name('faq.')->prefix('faq-management')->group(function () {
                    Route::get('/', 'FaqController@index')->name('index');
                    Route::get('/edit/{id}', 'FaqController@edit')->name('edit');
                    Route::post('/store', 'FaqController@store')->name('store');
                    Route::post('/update/{id}', 'FaqController@update')->name('update');
                    Route::post('/delete', 'FaqController@destroy')->name('destroy');
                    Route::post('/order_no', 'FaqController@set_order')->name('order');
                    Route::get('/faq/{key}/{id}', 'FaqController@delete_data')->name('delete_data');
                });
                //terms and conditions
                Route::name('terms.')->prefix('terms')->group(function () {
                    Route::get('/', 'TermsController@index')->name('index');
                    Route::post('/', 'TermsController@update')->name('update');
                });
                // Privacy Policies
                Route::name('privacy.')->prefix('privacy')->group(function () {
                    Route::get('/', 'PrivacyController@index')->name('index');
                    Route::post('/', 'PrivacyController@update')->name('update');
                });
                //notice
                Route::name('notice.')->prefix('notice-management')->group(function () {
                    Route::get('/', 'NoticeController@index')->name('index');
                    Route::get('/edit/{id}', 'NoticeController@edit')->name('edit');
                    Route::post('/store', 'NoticeController@store')->name('store');
                    Route::post('/update/{id}', 'NoticeController@update')->name('update');
                    Route::post('/delete', 'NoticeController@destroy')->name('destroy');
                    Route::post('/order_no', 'NoticeController@set_order')->name('order');
                });

                //about
                Route::name('about.')->prefix('about-management')->group(function () {
                    Route::get('/', 'AboutController@index')->name('index');
                    Route::get('/first_form', 'AboutController@first_form')->name('first_form');
                    Route::get('/second_form', 'AboutController@second_form')->name('second_form');
                    Route::get('/third_form', 'AboutController@third_form')->name('third_form');
                    Route::post('/update', 'AboutController@update')->name('update');
                    Route::post('/delete', 'AboutController@destroy')->name('destroy');
                    Route::post('/order_no', 'AboutController@set_order')->name('order');
                    Route::get('/expertise/{key}', 'AboutController@deleteExpertise')->name('expertise_delete');
                });

                //skill
                Route::name('skill.')->prefix('skill-management')->group(function () {
                    Route::get('/', 'SkillController@index')->name('index');
                    Route::get('/edit/{id}', 'SkillController@edit')->name('edit');
                    Route::post('/store', 'SkillController@store')->name('store');
                    Route::post('/update/{id}', 'SkillController@update')->name('update');
                    Route::post('/delete', 'SkillController@destroy')->name('destroy');
                    Route::post('/order_no', 'SkillController@set_order')->name('order');
                });

                //Employee Type
                Route::name('employee_type.')->prefix('employee-type-management')->group(function () {
                    Route::get('/', 'EmployeeTypeController@index')->name('index');
                    Route::get('/edit/{id}', 'EmployeeTypeController@edit')->name('edit');
                    Route::post('/store', 'EmployeeTypeController@store')->name('store');
                    Route::post('/update/{id}', 'EmployeeTypeController@update')->name('update');
                    Route::post('/delete', 'EmployeeTypeController@destroy')->name('destroy');
                    Route::post('/order_no', 'EmployeeTypeController@set_order')->name('order');
                });
                //INdustry
                Route::name('industry.')->prefix('industry-management')->group(function () {
                    Route::get('/', 'IndustryController@index')->name('index');
                    Route::get('/edit/{id}', 'IndustryController@edit')->name('edit');
                    Route::post('/store', 'IndustryController@store')->name('store');
                    Route::post('/update/{id}', 'IndustryController@update')->name('update');
                    Route::post('/delete', 'IndustryController@destroy')->name('destroy');
                    Route::post('/order_no', 'IndustryController@set_order')->name('order');
                });

                //education
                Route::name('education.')->prefix('education-management')->group(function () {
                    Route::get('/', 'EducationController@index')->name('index');
                    Route::get('/edit/{id}', 'EducationController@edit')->name('edit');
                    Route::post('/store', 'EducationController@store')->name('store');
                    Route::post('/update/{id}', 'EducationController@update')->name('update');
                    Route::post('/delete', 'EducationController@destroy')->name('destroy');
                    Route::post('/order_no', 'EducationController@set_order')->name('order');
                });

                //job level
                Route::name('JobLevel.')->prefix('job-level-management')->group(function () {
                    Route::get('/', 'JobLevelController@index')->name('index');
                    Route::get('/edit/{id}', 'JobLevelController@edit')->name('edit');
                    Route::post('/store', 'JobLevelController@store')->name('store');
                    Route::post('/update/{id}', 'JobLevelController@update')->name('update');
                    Route::post('/delete', 'JobLevelController@destroy')->name('destroy');
                    Route::post('/order_no', 'JobLevelController@set_order')->name('order');
                });
                //experience
                Route::name('experience.')->prefix('experience-management')->group(function () {
                    Route::get('/', 'ExperienceController@index')->name('index');
                    Route::get('/edit/{id}', 'ExperienceController@edit')->name('edit');
                    Route::post('/store', 'ExperienceController@store')->name('store');
                    Route::post('/update/{id}', 'ExperienceController@update')->name('update');
                    Route::post('/delete', 'ExperienceController@destroy')->name('destroy');
                    Route::post('/order_no', 'ExperienceController@set_order')->name('order');
                });

                //city
                Route::name('city.')->prefix('city-management')->group(function () {
                    Route::get('/', 'CityController@index')->name('index');
                    Route::get('/edit/{id}', 'CityController@edit')->name('edit');
                    Route::post('/store', 'CityController@store')->name('store');
                    Route::post('/update/{id}', 'CityController@update')->name('update');
                    Route::post('/delete', 'CityController@destroy')->name('destroy');
                    Route::post('/order_no', 'CityController@set_order')->name('order');
                });
                //District
                Route::name('district.')->prefix('district-management')->group(function () {
                    Route::get('/', 'DistrictController@index')->name('index');
                    Route::get('/edit/{id}', 'DistrictController@edit')->name('edit');
                    Route::post('/store', 'DistrictController@store')->name('store');
                    Route::post('/update/{id}', 'DistrictController@update')->name('update');
                    Route::post('/delete', 'DistrictController@destroy')->name('destroy');
                    Route::post('/order_no', 'DistrictController@set_order')->name('order');
                });

                //Company Category
                Route::name('company_category.')->prefix('company-category-management')->group(function () {
                    Route::get('/', 'CompanyCategoryController@index')->name('index');
                    Route::get('/edit/{id}', 'CompanyCategoryController@edit')->name('edit');
                    Route::post('/store', 'CompanyCategoryController@store')->name('store');
                    Route::post('/update/{id}', 'CompanyCategoryController@update')->name('update');
                    Route::post('/delete', 'CompanyCategoryController@destroy')->name('destroy');
                    Route::post('/order_no', 'CompanyCategoryController@set_order')->name('order');
                });
                //Company OwnerShip
                Route::name('company_ownership.')->prefix('company-ownership-management')->group(function () {
                    Route::get('/', 'CompanyOwnerShipController@index')->name('index');
                    Route::get('/edit/{id}', 'CompanyOwnerShipController@edit')->name('edit');
                    Route::post('/store', 'CompanyOwnerShipController@store')->name('store');
                    Route::post('/update/{id}', 'CompanyOwnerShipController@update')->name('update');
                    Route::post('/delete', 'CompanyOwnerShipController@destroy')->name('destroy');
                    Route::post('/order_no', 'CompanyOwnerShipController@set_order')->name('order');
                });
                //Company Size
                Route::name('company_size.')->prefix('company-size-management')->group(function () {
                    Route::get('/', 'CompanySizeController@index')->name('index');
                    Route::get('/edit/{id}', 'CompanySizeController@edit')->name('edit');
                    Route::post('/store', 'CompanySizeController@store')->name('store');
                    Route::post('/update/{id}', 'CompanySizeController@update')->name('update');
                    Route::post('/delete', 'CompanySizeController@destroy')->name('destroy');
                    Route::post('/order_no', 'CompanySizeController@set_order')->name('order');
                });
                //vehicle
                Route::name('vehicle.')->prefix('vehicle-management')->group(function () {
                    Route::get('/', 'VehicleController@index')->name('index');
                    Route::get('/edit/{id}', 'VehicleController@edit')->name('edit');
                    Route::post('/store', 'VehicleController@store')->name('store');
                    Route::post('/update/{id}', 'VehicleController@update')->name('update');
                    Route::post('/delete', 'VehicleController@destroy')->name('destroy');
                    Route::post('/order_no', 'VehicleController@set_order')->name('order');
                });

                //Employer
                Route::name('employer.')->prefix('employer-management')->group(function () {
                    Route::get('/', 'EmployerController@index')->name('index');
                    Route::get('/edit/{id}', 'EmployerController@edit')->name('edit');
                    Route::post('/store', 'EmployerController@store')->name('store');
                    Route::post('/update/{id}', 'EmployerController@update')->name('update');
                    Route::post('/delete', 'EmployerController@destroy')->name('destroy');
                    Route::post('/order_no', 'EmployerController@set_order')->name('order');
                    Route::get('provincelist/{country_id}', 'EmployerController@provincelist');
                    Route::get('districtlist/{province_id}', 'EmployerController@districtlist');
                    Route::get('citylist/{district_id}', 'EmployerController@citylist');
                });

                //tender category
                Route::name('tender_category.')->prefix('tender-category-management')->group(function () {
                    Route::get('/', 'TenderCategoriesController@index')->name('index');
                    Route::get('/edit/{id}', 'TenderCategoriesController@edit')->name('edit');
                    Route::post('/store', 'TenderCategoriesController@store')->name('store');
                    Route::post('/update/{id}', 'TenderCategoriesController@update')->name('update');
                    Route::post('/delete', 'TenderCategoriesController@destroy')->name('destroy');
                    Route::post('/order_no', 'TenderCategoriesController@set_order')->name('order');
                });
                //tender type
                Route::name('tender_type.')->prefix('tender-type-management')->group(function () {
                    Route::get('/', 'TenderTypeController@index')->name('index');
                    Route::get('/edit/{id}', 'TenderTypeController@edit')->name('edit');
                    Route::post('/store', 'TenderTypeController@store')->name('store');
                    Route::post('/update/{id}', 'TenderTypeController@update')->name('update');
                    Route::post('/delete', 'TenderTypeController@destroy')->name('destroy');
                    Route::post('/order_no', 'TenderTypeController@set_order')->name('order');
                });
                //tender
                Route::name('tender.')->prefix('tender-management')->group(function () {
                    Route::get('/', 'TenderController@index')->name('index');
                    Route::get('/edit/{id}', 'TenderController@edit')->name('edit');
                    Route::post('/store', 'TenderController@store')->name('store');
                    Route::post('/update/{id}', 'TenderController@update')->name('update');
                    Route::post('/delete', 'TenderController@destroy')->name('destroy');
                    Route::post('/order_no', 'TenderController@set_order')->name('order');
                });
                //tag
                Route::name('tag.')->prefix('tag-management')->group(function () {
                    Route::get('/', 'TagController@index')->name('index');
                    Route::get('/edit/{id}', 'TagController@edit')->name('edit');
                    Route::post('/store', 'TagController@store')->name('store');
                    Route::post('/update/{id}', 'TagController@update')->name('update');
                    Route::post('/delete', 'TagController@destroy')->name('destroy');
                    Route::post('/order_no', 'TagController@set_order')->name('order');
                });
                //Job
                Route::name('job.')->prefix('job-management')->group(function () {
                    Route::get('/', 'JobController@index')->name('index');
                    Route::get('/edit/{id}', 'JobController@edit')->name('edit');
                    Route::post('/store', 'JobController@store')->name('store');
                    Route::post('/update/{id}', 'JobController@update')->name('update');
                    Route::post('/delete', 'JobController@destroy')->name('destroy');
                    Route::post('/order_no', 'JobController@set_order')->name('order');
                    Route::get('provincelist/{country_id}', 'EmployerController@provincelist');
                    Route::get('districtlist/{province_id}', 'EmployerController@districtlist');
                    Route::get('citylist/{district_id}', 'EmployerController@citylist');

                    //applied users
                    Route::name('appliedUsers.')->prefix('{slug}/applied-users')->group(function () {
                        Route::get('/', 'JobController@appliedUsersIndex')->name('index');
                    });
                });

                Route::name('jobRequest.')->prefix('job-requests')->controller('JobRequestController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{slug}', 'show')->name('show');
                    Route::delete('/delete/{slug}', 'destroy')->name('destroy');



                    Route::post('/change-status/{slug}', 'changeStatus')->name('changeStatus');
                });

                //career
                Route::name('career.')->prefix('career-management')->group(function () {
                    Route::get('/', 'CareerController@index')->name('index');
                    Route::get('/edit/{id}', 'CareerController@edit')->name('edit');
                    Route::post('/store', 'CareerController@store')->name('store');
                    Route::post('/update/{id}', 'CareerController@update')->name('update');
                    Route::post('/delete', 'CareerController@destroy')->name('destroy');
                    Route::post('/order_no', 'CareerController@set_order')->name('order');
                });

                //language
                Route::name('language.')->prefix('language-management')->group(function () {
                    Route::get('/', 'LanguageController@index')->name('index');
                    Route::get('/edit/{id}', 'LanguageController@edit')->name('edit');
                    Route::post('/store', 'LanguageController@store')->name('store');
                    Route::post('/update/{id}', 'LanguageController@update')->name('update');
                    Route::post('/delete', 'LanguageController@destroy')->name('destroy');
                    Route::post('/order_no', 'LanguageController@set_order')->name('order');
                });

                //study-fields
                Route::name('studyfield.')->prefix('study-field-management')->group(function () {
                    Route::get('/', 'StudyFieldController@index')->name('index');
                    Route::get('/edit/{id}', 'StudyFieldController@edit')->name('edit');
                    Route::post('/store', 'StudyFieldController@store')->name('store');
                    Route::post('/update/{id}', 'StudyFieldController@update')->name('update');
                    Route::post('/delete', 'StudyFieldController@destroy')->name('destroy');
                    Route::post('/order_no', 'StudyFieldController@set_order')->name('order');
                });
                //study-subject
                Route::name('studysubject.')->prefix('study-subject-management')->group(function () {
                    Route::get('/', 'StudySubjectController@index')->name('index');
                    Route::get('/edit/{id}', 'StudySubjectController@edit')->name('edit');
                    Route::post('/store', 'StudySubjectController@store')->name('store');
                    Route::post('/update/{id}', 'StudySubjectController@update')->name('update');
                    Route::post('/delete', 'StudySubjectController@destroy')->name('destroy');
                    Route::post('/order_no', 'StudySubjectController@set_order')->name('order');
                });
                // News And Annoucement
                Route::name('news.')->prefix('news-and-announcement')->group(function () {
                    Route::get('/', 'NewsAndAnnouncementController@index')->name('index');
                    Route::get('/edit/{id}', 'NewsAndAnnouncementController@edit')->name('edit');
                    Route::post('/store', 'NewsAndAnnouncementController@store')->name('store');
                    Route::post('/update/{id}', 'NewsAndAnnouncementController@update')->name('update');
                    Route::post('/delete', 'NewsAndAnnouncementController@destroy')->name('destroy');
                    Route::post('/order_no', 'NewsAndAnnouncementController@set_order')->name('order');
                });
                // Area of Concern
                Route::name('concern.')->prefix('area-of-concern')->group(function () {
                    Route::get('/', 'ConcernController@index')->name('index');
                    Route::get('/edit/{id}', 'ConcernController@edit')->name('edit');
                    Route::post('/store', 'ConcernController@store')->name('store');
                    Route::post('/update/{id}', 'ConcernController@update')->name('update');
                    Route::post('/delete', 'ConcernController@destroy')->name('destroy');
                    Route::post('/order_no', 'ConcernController@set_order')->name('order');
                });

                // Issued Report Management
                Route::name('reports.')->prefix('issued-reports')->group(function () {
                    Route::get('/', 'ReportController@index')->name('index');
                    Route::get('/{id}', 'ReportController@show')->name('show');
                });

                //Company Individual FAQ
                Route::name('companyFAQ.')->prefix('company-faqs')->controller('CompanyFaqController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update/{id}', 'update')->name('update');
                    Route::post('/delete', 'destroy')->name('destroy');
                    Route::post('/order_no', 'set_order')->name('order');
                });

                /**************************** Advertisement ***************************************/
                Route::name('dayPackages.')->prefix('day-package-management')->controller('DayPackageController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                    Route::post('/delete', 'destroy')->name('destroy');
                    Route::post('/order', 'set_order')->name('order');
                });

                Route::name('steps.')->prefix('step-procedures')->controller('StepProcedureController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/edit/{id}/{steps}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                    Route::get('/{id}', 'subIndex')->name('subIndex');
                });

                Route::name('adBanner.')->prefix('banner-settings')->controller('AdBannerController')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/update/{id}', 'update')->name('update');
                });

                Route::name('pricing.')->prefix('advetisement-pricing')->controller('PricingController')->group(function () {
                    Route::get('/', 'mainIndex')->name('mainIndex');
                    Route::prefix('/{ad_type}')->group(function () {
                        Route::get('/', 'index')->name('index');
                        Route::get('/add', 'create')->name('create');
                        Route::post('/store', 'store')->name('store');
                        Route::get('/edit', 'create')->name('edit');
                        Route::delete('/delete/{id}', 'destroy')->name('destroy');
                    });
                });
                Route::name('staffs.')->prefix('support-support-management')->controller('SupportStaffController')->group(function(){
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create' )->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::put('/update/{id}', 'update')->name('update');
                    Route::post('/delete', 'destroy')->name('destroy');
                    Route::post('/order', 'set_order')->name('order');
                });
                Route::name('adContent.')->prefix('advertisement-content-management')->controller('AdContentController')->group(function(){
                    Route::get('/', 'index')->name('index');
                    Route::post('/update', 'update')->name('update');
                });
                 Route::name('advertisement.')
                ->prefix('advertisement-management')
                ->group(function () {
                    Route::get('/', 'AdvertisementController@index')->name('index');
                    Route::get('/edit/{id}', 'AdvertisementController@edit')->name('edit');
                    Route::post('/store', 'AdvertisementController@store')->name('store');
                    Route::post('/update/{id}', 'AdvertisementController@update')->name('update');
                    Route::post('/delete', 'AdvertisementController@destroy')->name('destroy');
                    Route::post('/order_no', 'AdvertisementController@set_order')->name('order');
                });
            });
        });
