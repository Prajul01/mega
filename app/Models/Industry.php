<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
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
        for ($i = 1; $i <= 100; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Industry::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function departments()
    {
        return $this->hasMany(CompanyCategory::class,'industry_id')->where('status', 'active');

    }
     public function jobs()
    {
        return $this->hasManyThrough(Job::class, CompanyCategory::class)->where(['jobs.status'=> 'active','company_categories.status'=> 'active']);
    }
     public function employers()
    {
        return $this->hasManyThrough(Employer::class, CompanyCategory::class)->where(['employers.status'=> 'active','company_categories.status'=> 'active']);
    }

}
