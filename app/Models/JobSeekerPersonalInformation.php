<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerPersonalInformation extends Model
{
    use HasFactory;
    public $table="job_seeker_personal_informations";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company_category()
    {
        return $this->belongsTo(CompanyCategory::class);
    }
    
    public function employee_type($id){
        return EmployeeType::find($id);
    }

    public function preferedJobs(){
        return $this->belongsToMany(CompanyCategory::class, 'job_prefered_users', 'job_seeker_id','company_category_id');
    }

    public function preferedIndustry(){
        return $this->belongsToMany(Industry::class, 'industry_prefered_users', 'job_seeker_id', 'industry_id');
    }
}
