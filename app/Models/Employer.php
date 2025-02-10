<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(CompanyCategory::class, 'company_category_id');
    }
    
    public function ower_ship()
    {
        return $this->belongsTo(CompanyOwnerShip::class, 'company_owner_ship_id');
    }
     public function country()
    {
        return $this->belongsTo(Country::class);
    }
     public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function company_size(){
        return $this->belongsTo(CompanySize::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

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
        return Employer::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id')->where(['status' => 'active']);
    }

    public function emails(){
        return $this->hasMany(EmployerEmail::class);
    }

    public function settings(){
        return $this->hasOne(EmployerAccountSetting::class);
    }

}
