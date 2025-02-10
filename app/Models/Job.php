<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 1000; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Job::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function vehicles()
    {
        return $this->hasMany('App\Models\License');
    }

    // public static function job_skills($id)
// {
//     return JobSkill::where('job_id', $id)->with('skill')->get();
// }
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id',);
    }
    public function employee_type()
    {
        return $this->belongsTo(EmployeeType::class, 'employee_type_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function job_level()
    {
        return $this->belongsTo(JobLevel::class);
    }
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
    public function categories()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }

    public function applied_users()
    {
        return $this->belongsToMany(User::class, 'user_applies_jobs')->withPivot('status');
    }

    public function save_users()
    {
        return $this->belongsToMany(Users::class, 'user_saves_jobs');
    }

    public function accepted_applicants()
    {
        return $this->belongsToMany(User::class, 'user_applies_jobs')->where('status', 1);
    }

    public function declined_applicants()
    {
        return $this->belongsToMany(User::class, 'user_applies_jobs')->where('status', 0);
    }

    public function pending_applicants()
    {
        return $this->belongsToMany(User::class, 'user_applies_jobs')->where('status', null);
    }

}
