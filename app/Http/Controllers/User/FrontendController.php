<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Blog;
use App\Models\Career;
use App\Models\City;
use App\Models\CompanyCategory;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Employer;
use App\Models\EventEnroll;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\Industry;
use App\Models\Job;
use App\Models\NewsAndAnnouncement as News;
use App\Models\Privacy;
use App\Models\SiteSetting;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\Tender;
use App\Models\TenderCategory;
use App\Models\TenderType;
use App\Models\Term;
use App\Models\IssuedReport as Report;
use App\Models\Trainning;
use App\Models\User;
use App\Rules\GoogleRecaptcha;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Storage;
use Carbon\Carbon;


class FrontendController extends Controller
{
    public function index()
    {
        $data = [
            'top_jobs' => \App\Helper\Helpers\Helper::topJobs(),
            'hot_jobs' => \App\Helper\Helpers\Helper::hotJobs(),
            'recent_jobs' => \App\Helper\Helpers\Helper::recentJobs(),
            'general_jobs' => \App\Helper\Helpers\Helper::generalJobs(),
            'newspaper_jobs' => \App\Helper\Helpers\Helper::newspaperJobs(),
            'categories' => CompanyCategory::with('jobs')->where('status', 'active')->orderBy('order_no')->get(),
            'employers' => Employer::with('jobs')->where('status', 'active')->orderBy('order_no')->get(),
            'locations' => City::with('jobs')->where('status', 'active')->orderBy('order_no')->get(),
            'skills' => Skill::with('jobs')->where('status', 'active')->orderBy('order_no')->get(),
            'educations' => Education::where('status', 'active')->with('job')->orderBy('order_no')->get(),
            'industries' => Industry::where('status', 'active')->orderBy('order_no')->with(['jobs', 'employers.jobs'])->get(),
            'training'=>Trainning::all(),
        ];

        return view('user.index', $data);
    }
    public function jobs(Request $request)
    {
        if (@$request->q) {
            $data['jobs'] = match ($request->q) {
                'megajobs' => \App\Helper\Helpers\Helper::topJobs(1, @$request->latest ? 'latest' : 'old'),
                'premium-jobs' =>\App\Helper\Helpers\Helper::hotJobs(1, @$request->latest ? 'latest' : 'old'),
                null => $this->getJobs($request),
                default => $this->getJobs($request)

            };
        } else {
            $data['jobs'] = $this->getJobs($request);
        }
        $data['locations'] = City::where('status', 'active')->orderBy('order_no')->get();
        $data['educations'] = Education::where('status', 'active')->orderBy('order_no')->get();
        $data['experiences'] = Experience::where('status', 'active')->orderBy('order_no')->get();
        $data['industries'] = Industry::where('status', 'active')->orderBy('order_no')->get();
        $data['departments'] = CompanyCategory::where('status', 'active')->orderBy('order_no')->get();

        return view('user.jobs', $data);
    }
    public function job_single($slug)
    {
        $data['job'] = Job::where('slug', $slug)->with('employer')->first();
        $data['company_jobs'] = Job::where(['status' => 'active', 'featured' => 1, 'employer_id' => $data['job']->employer_id])->with('employer')->whereNot('id', $data['job']->id)->orderBy('order_no')->limit(3)->get();

        $data['similer_jobs'] = Job::where(['status' => 'active', 'featured' => 1, 'company_category_id' => $data['job']->company_category_id])->with('employer')->whereNot('id', $data['job']->id)->orderBy('order_no')->limit(3)->get();
        $data['job']->view_count++;
        $data['job']->update();
        return view('user.job-single', $data);
    }

    public function filterData(Request $request)
    {
        $query = new \stdClass();
        $query->search = $request->search;
        $query->department = $request->department;
        $query->industry = $request->industry;
        $job = $this->getJobs($query);

        $temp = explode('&', $request->data);
        $city = [];
        $education = [];
        $experience = [];
        $industry = [];
        $department = [];
        foreach ($temp as $v) {
            if (str_contains($v, 'city')) {
                array_push($city, str_replace('city=', '', $v));
            } elseif (str_contains($v, 'education')) {
                array_push($education, str_replace('education=', '', $v));
            } elseif (str_contains($v, 'experience')) {
                array_push($experience, str_replace('experience=', '', $v));
            } else if (str_contains($v, 'industry')) {
                array_push($industry, str_replace('industry=', '', $v));
            } elseif (str_contains($v, 'department')) {
                array_push($department, str_replace('department=', '', $v));
            }
        }

        // dd($industry, $department);

        if (count($city) > 0 || count($education) > 0 || count($experience) > 0 || count($department) > 0 || count($industry) > 0) {

            $temp = $job->filter(
                fn($job) =>
                (in_array($job->city_id, $city) ||
                    in_array($job->education_id, $education) ||
                    in_array($job->experience_id, $experience) ||
                    in_array($job->company_category_id, $department) ||
                    in_array($job->categories->industry_id, $industry))
            )->pluck('id')->toArray();

            $data['jobs'] = Job::whereIn('id', $temp)->paginate(6);
        } else {
            $data['jobs'] = $job;
        }

        $html = view('user.layout.job-content')->with('jobs', $data['jobs'])->render();

        return response()->json([
            'html' => $html,
        ], 200);
    }

    private function getJobs($request)
    {
        // dd($request);
        if (@$request) {
            if (!@$request->search && @$request->department && !@$request->industry) {
                $data['jobs'] = CompanyCategory::where('slug', $request->department)->first()->jobs();
            }
            if (!@$request->search && !@$request->department && @$request->industry) {
                $data['jobs'] = Industry::where('slug', $request->industry)->first()->jobs();
            }
            if (@$request->company) {

                $data['jobs'] = Employer::where('slug', $request->company)->first()->jobs();

            }
            if (@$request->location) {
                 $data['jobs'] = City::where('slug', $request->location)->first()->jobs();
            }
            if (@$request->skill) {

                $data['jobs'] = (Skill::where('slug', request()->skill)->first())->jobs();

            }
            if (@$request->search && !@$request->department && !@$request->industry) {
                $data['jobs'] = Job::where('status','active')->where('title', 'like', '%' . $request->search . '%')
                    ->where('job_description', 'like', '%' . $request->search . '%')
                    ->with('skill')->with('employer')->with('city')
                    ->orWhere('job_specification', 'like', '%' . $request->search . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

            }
            if (@$request->search || @$request->department || @$request->industry) {
                if (@$request->search && !@$request->department && !@$request->industry) {
                    $data['jobs'] = Job::where('status','active')->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('job_description', 'like', '%' . $request->search . '%')
                        ->orWhere('job_specification', 'like', '%' . $request->search . '%')
                        ->orderBy('created_at', 'desc');

                } else {
                    $category = CompanyCategory::where('slug', $request->department)->pluck('id')->first();
                    $industry = Industry::where('slug', $request->industry)->pluck('id')->first();
                    $temp = Job::where('status','active')->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('job_description', 'like', '%' . $request->search . '%')
                        ->orWhere('job_specification', 'like', '%' . $request->search . '%')
                        ->orderBy('created_at', 'desc')->with('categories');

                    if (@$category) {
                        $temp = $temp->orWhere('company_category_id', '=', $category);
                    }

                    if (@$industry) {
                        $temp = $temp->get()->filter(
                            fn($temp) => $temp->categories->industry_id == $industry
                        )->pluck('id')->toArray();
                    }

                    if (@$industry) {
                        $data['jobs'] = Job::whereIn('id', $temp);
                    } else {
                        $data['jobs'] = $temp;
                    }
                }
            }
            if (@$request->education) {
                $education = Education::where('slug', $request->education)->first();
                if (is_null($education) || empty($education)) {
                    $data['jobs'] = Job::where(['status' => 'active', 'featured' => 1]);
                } else {
                    $data['jobs'] = $education->job();

                }

            }
        }
        if (@$data['jobs']) {
            $data['jobs'] = $data['jobs']->with('skill')->with('employer')->with('city')->with('categories')->paginate(6);
        } else {
            $data['jobs'] = Job::where(['status' => 'active', 'featured' => 1])->with('skill')->with('employer')->with('city')->with('categories')->orderBy('order_no')->paginate(6);
        }
        // dd($data);

        return $data['jobs'];
    }
    public function employer_detail($slug)
    {
        $employee = Employer::with(['jobs', 'jobs.employer'])->where('slug', $slug)->first();
        $careers = Career::where('status', 'active')->orderBy('order_no')->limit(6)->get();
        $urgent_jobs = Job::where(['status' => 'active', 'featured' => 1, 'employer_id' => $employee->id])->with('employer')->orderBy('expiry_date', 'desc')->limit(12)->get();
        if (!isset($urgent_jobs)) {
            $urgent_jobs = Job::where(['status' => 'active', 'featured' => 1, 'company_category_id' => $employee->company_category_id])->orderBy('expiry_date', 'desc')->with('employer')->limit(12)->get();
        }

        return view('user.employer-detail', compact('employee', 'careers', 'urgent_jobs'));
    }
    public function about()
    {
        $about = About::first();
        return view('user.about', ['about' => $about]);
    }
    public function contact()
    {
        return view('user.contact');
    }
//    public function training()
//    {
//        $training=Trainning::all();
//        return view('user.training',compact('training'));
//    }

    public function training()
    {
        $training = Trainning::where('date', '>=', Carbon::today())->get();
        return view('user.training', compact('training'));
    }

    public function enroll_training(Request $request)
    {
        $evenntEnroll=EventEnroll::create([
            "name" => $request->name,
  "email" => $request->email,
  "mobile" => $request->mobile,
  "event_id" => $request->event_id
]);
        if (isset($evenntEnroll)) {
            return redirect()
                ->back()
                ->with('status', 'Enrolled Successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went Wrong!');
        }

        dd('$id',$evenntEnroll);

    }


    public function contact_store(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'full_name' => 'bail|required|regex:/[a-zA-Z]/',
            'subject' => 'bail|required|max:255',
            'message' => 'bail|required|max:500',
            'phone_number' => 'bail|required|min:9|max:14|regex:/[0-9]/',
            'g-recaptcha-response' => new GoogleRecaptcha,
        ]);
        $contact = new Contact();
        $contact->full_name = $request->full_name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->phone_number = $request->phone_number;
        $contact->save();
        if (isset($contact)) {
            Mail::to(SiteSetting::where('id', 1)->first()->site_email)->send(new ContactMail($contact));
            return redirect()->back()->with("status", "We have successfully received your Message and will get back to you as soon as possible.");
        } else {
            return redirect()->back()->with("error", "Something Went wrong. Please try again!!!");
        }
    }

    public function blog()
    {
        $blog = Blog::where('status', 'active')->orderBy('created_at', 'desc')->get();
        $tender = Tender::where('status', 'active')->orderBy('order_no')->limit(6)->get();
        $career = Career::where('status', 'active')->orderBy('order_no')->limit(6)->get();
        $employeer = Employer::where('status', 'active')->orderBy('order_no')->limit(6)->get();
        return view('user.blog', ['blogs' => $blog, 'tenders' => $tender, 'careers' => $career, 'employees' => $employeer]);
    }
    public function blog_single($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->view_count++;
        $blog->update();
        $related_blog = Blog::where('id', '!=', $blog->id)->get();
        $career = Career::where('status', 'active')->orderBy('order_no')->limit(6)->get();
        return view('user.blog-single', ['blog' => $blog, 'related_blogs' => $related_blog, 'careers' => $career]);
    }

    public function faq($faq = null)
    {
        if (is_null($faq) || empty($faq)) {
            $faqs = \App\Models\CompanyFaq::where('display', 1)->orderBy('order_no')->get();
            return view('user.companyFaq', compact('faqs'));
        } else {
            $faq = Faq::where('faq_type', $faq)->where('status', 'active')->orderBy('order_no')->get();
            return view('user.faq', ['faqs' => $faq]);
        }
    }

    public function tender(Request $request)
    {
        if ($request->tender) {
            $tender = Tender::where('status', 'active')->orderBy('order_no')->with('tender_categories')->get();
        } elseif ($request->category) {
            $tender_categories = TenderCategory::where('slug', $request->category)->with('tenders')->get();
            foreach ($tender_categories as $tc) {
                $tender = Tender::where('status', 'active')->where('tender_category_id', $tc->id)->orderBy('order_no')->with('tender_categories')->get();
            }
        } elseif ($request->type) {
            $tender_categories = TenderType::where('slug', $request->type)->with('tenders')->get();
            foreach ($tender_categories as $tt) {
                $tender = Tender::where('status', 'active')->where('tender_type_id', $tt->id)->orderBy('order_no')->with('tender_categories')->get();
            }
        } else {
            $tender = Tender::where('status', 'active')->where('feature', '1')->orderBy('order_no')->with('tender_categories')->limit(4)->get();
        }
        $tender_category = TenderCategory::where('status', 'active')->orderBy('order_no')->with('tenders')->get();
        $tender_type = TenderType::where('status', 'active')->orderBy('order_no')->with('tenders')->get();
        $recent_tenders = Tender::where('status', 'active')->orderBy('created_at', 'desc')->with('tender_categories')->get();
        return view('user.tender', ['tenders' => $tender, 'tender_categories' => $tender_category, 'tender_types' => $tender_type, 'recent_tenders' => $recent_tenders]);
    }

    public function tender_details($tender)
    {
        $tender = Tender::where('slug', $tender)->firstOrFail();
        $similar_tender = Tender::where('id', '!=', $tender->id)->orderBy('order_no')->with('tender_categories')->limit(6)->get();
        $tender_type = TenderType::where('status', 'active')->orderBy('order_no')->limit(6)->get();
        return view('user.tender_single', ['tender' => $tender, 'similar_tenders' => $similar_tender, 'tender_types' => $tender_type]);
    }

    public function career(Request $request)
    {
        if ($request->tags) {
            $career = Career::where('title', 'like', '%' . $request->tag . '%')->orderBy('order_no')->get();
        } else {
            $career = Career::where('status', 'active')->orderBy('order_no')->get();
        }

        return view('user.career_tips', ['careers' => $career]);
    }
    public function career_details($career)
    {
        $tag = Tag::where('status', 'active')->orderBy('order_no')->get();
        $career = Career::where('slug', $career)->firstOrFail();
        $realted_career = Career::where('id', '!=', $career->id)->orderBy('order_no')->limit(6)->get();
        return view('user.career-single', ['career' => $career, 'tags' => $tag, 'related_careers' => $realted_career]);
    }

    /**
     * job is applied by a user
     * where,
     * data duplication is checked,
     * if the user user exists or not
     *
     * @param Request $request
     * @return json response
     */
    public function applyJob($slug, Request $request)
    {


        $job = Job::where('slug', $slug)->first();

        if (is_null($job) || empty($job)) {
            if (request()->ajax()) {
                 return response()->json([
                    'status'=>'404',
                    'messageJob Not Found.'
                ], 200);
            }

            return back()->with('error', 'Job Not Found');
        }

        if ($job->cover_letter) {
            $request->validate([
                'cover_letter' => 'bail|required|file|mimes:docx,pdf',
            ]);
        }

        $user = auth()->user();
        if ($this->checkDetails()) {

            if (request()->ajax()) {
                return response()->json([
                    'status'=>'403',
                    'route' => route('user.basic_info', auth()->user()->username),
                    'message' => 'Please complete your details to continue'
                ], 200);
            }
            // return to_route('user.editProfile', auth()->user()->username)->with('warning', 'Please complete your details to continue');

        }

        if ($request->hasFile('cover_letter')) {
            $path = public_path() . '/storage/job-seeker/cover_letters';
            $folderPath = 'public/job-seeker/cover_letters';

            if (!file_exists($path)) {
                Storage::makeDirectory($folderPath, 0755, true, true);
                chmod($path, 0755);
            }

            $file = $request->file('cover_letter');
            $fileName = $user->username . '.' . $file->extension();
            Storage::putFileAs($folderPath, $file, $fileName);
        }
        $user->applied_jobs()->sync($job->id, false);
        if ($job->cover_letter):
            $user->applied_jobs()->updateExistingPivot($job, ['cover_letter' => $fileName]);
        endif;

        if (request()->ajax()) {
            return response()->json([
                'status' => 200,
                'message' => 'You have applied for this job'
            ]);
        }
        return back()->with('status', 'You have applied for this job');
    }

    /**
     * checks if the user has completed all the details
     */
    private function checkDetails()
    {
        if (is_null(auth()->user()->job_seeker) || is_null(auth()->user()->job_seeker_education)) {
            return true;
        }

        return false;
    }

    /**
     * job is saved by a user
     * where,
     * data duplication is checked,
     * if the user user exists or not
     *
     * @param Request $request
     * @return json response
     */
    public function saveJob(Request $request)
    {
        $user = auth()->user();

        if (is_null($user->job_seeker) || empty($user->job_seeker)) {
            return response()->json([
                'route' => route('user.basic_info', auth()->user()->username),
                'status' => 403,
                'message' => 'Please complete your details to continue',
            ]);
        }

        $user->saved_jobs()->attach(base64_decode($request->job_id));

        return response()
            ->json(
                array(
                    'status' => 200,
                    'message' => 'Job Has Been Saved',
                )
            );
    }

    /**
     * job is removed by a user from their save list
     * where,
     * data duplication is checked,
     * if the user user exists or not
     *
     * @param Request $request
     * @return json response
     */
    public function removeSavedjob(Request $request)
    {
        $user = auth()->user();
        $user->saved_jobs()->detach();

        return response()
            ->json([

                'status' => 200,
                'message' => 'Job removed'
            ]);
    }

    public function newsAndAnnouncement()
    {
        $news = News::where('status', 'active')->orderBy('order_no')->get();

        return view('user.news-and-announcement', compact($news));
    }

    public function newsAndAnnouncement_single($slug)
    {
        $data = News::where('slug', $slug)->where('status', 'active')->firstOrFail();

        $related_news = News::where('status', 'active')->whereNot('id', $data->id)->orderBy('order_no')->get();
        return view('user.news-and-announcement_single', compact('data', 'related_news'));
    }

    public function reportIssue(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'bail|required|email',
            'phone_no' => 'bail|required',
            'subject' => 'bail|required|max:255',
            'area_of_concern' => [
                'bail',
                'required',
                function ($attribute, $value, $fail) {
                    $concern = \App\Models\AreaOfConcern::find(base64_decode($value));

                    if (is_null($concern) || empty($concern)) {
                        $fail('Area of Concern is invalid');
                    }
                }
            ],
            'details' => 'required'

        ]);

        $report = new Report;
        $report->name = $request->name;
        $report->email = $request->email;
        $report->phone_no = $request->phone_no;
        $report->subject = $request->subject;
        $report->details = $request->details;
        $report->area_of_concern_id = base64_decode($request->area_of_concern);
        $report->save();

        return back()->with('status', 'Report has been issued');

    }

    public function terms()
    {
        $terms = Term::firstOrFail();
        return view('user.terms', ['terms' => $terms]);
    }
    public function privacy()
    {
        $privacy = Privacy::firstOrFail();
        return view('user.privacy', ['privacy' => $privacy]);
    }

    public function advertisement()
    {
        $content = \App\Models\AdverisementContent::first();

        return view('user.banner-job', compact('content'));
    }
    public function banner_job()
    {
        $data['step'] = \App\Models\StepProcedure::where('posting_type', 'advertisement')->first();
        $data['daysCount'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->get();
        $data['days'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->with('prices')->get();
        $data['pricing'] = $data['step']->prices()
            ->with('package')
            ->orderBy('no_of_days')
            ->get()->groupBy('no_of_days')
            ->map(function ($group) {
                return $group->sortBy(function ($price) {
                    return $price->package->order_no;
                });
            });
        return view('user.posting-job', $data);
        // return view('user.banner-job');
    }
    public function hot_job()
    {
        $data['step'] = \App\Models\StepProcedure::where('posting_type', 'premium-jobs')->first();
        $data['daysCount'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->get();
        $data['days'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->with('prices')->get();
        $data['pricing'] = $data['step']->prices()
            ->with('package')
            ->orderBy('no_of_days')
            ->get()->groupBy('no_of_days')
            ->map(function ($group) {
                return $group->sortBy(function ($price) {
                    return $price->package->order_no;
                });
            });
        return view('user.posting-job', $data);
        // return view('user.hot-job');
    }
    public function prime_jobs()
    {
        $data['step'] = \App\Models\StepProcedure::where('posting_type', 'prime-jobs')->first();
        $data['daysCount'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->get();
        $data['days'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->with('prices')->get();
        $data['pricing'] = $data['step']->prices()
            ->with('package')
            ->orderBy('no_of_days')
            ->get()->groupBy('no_of_days')
            ->map(function ($group) {
                return $group->sortBy(function ($price) {
                    return $price->package->order_no;
                });
            });
        return view('user.posting-job', $data);

        // return view('user.feature-job');
    }
    public function megajobPosting()
    {
        $data['step'] = \App\Models\StepProcedure::where('posting_type', 'megajobs')->first();
        $data['daysCount'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->get();
        $data['days'] = \App\Models\DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $data['step']->id))->with('prices')->get();
        $data['pricing'] = $data['step']->prices()
            ->with('package')
            ->orderBy('no_of_days')
            ->get()->groupBy('no_of_days')
            ->map(function ($group) {
                return $group->sortBy(function ($price) {
                    return $price->package->order_no;
                });
            });
        return view('user.posting-job', $data);
    }
}
