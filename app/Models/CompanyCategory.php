<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
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
        return CompanyCategory::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function job_seeker()
    {
        return $this->hasOne(JobSeekerPersonalInformation::class);
    }

    public function employer()
    {
        return $this->hasMany(Employer::class);
    }
    public function jobs()
    {
        return $this->hasMany('App\Models\Job','company_category_id')->where(['status' => 'active']);
    }
    public function job()
    {
        return $this->belongsTo(Job::class,);
    }
     public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
