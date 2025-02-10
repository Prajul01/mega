<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\AppliedStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gauth_id',
        'gauth_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employer()
    {
        return $this->hasOne(Employer::class, 'user_id');
    }

    public function applied_jobs()
    {
        return $this->belongsToMany(Job::class, 'user_applies_jobs');
    }

    public function applied_job_status($job_id, $user_id)
    {
        $check = UserAppliesJob::where('user_id', $user_id)->where('job_id', $job_id)->first();

        if ($check == null) {
            return;
        }
        if (@$check->status) {
            return 'accept';
        }
        if (!@$check->status) {
            if ($check->status === 0) {
                return 'decline';
            }
            return 'N/A';
        }

        return;
    }
    public function applied_job_user_detail($job_id, $user_id)
    {
        $check = UserAppliesJob::where('user_id', $user_id)->where('job_id', $job_id)->first();
        return $check;
    }

    public function saved_jobs()
    {
        return $this->belongsToMany(Job::class, 'user_saves_jobs');
    }

    public function job_seeker()
    {
        return $this->hasOne(JobSeekerPersonalInformation::class, 'user_id');
    }

    public function job_seeker_education()
    {
        // dd($this->hasOne(JobSeekerEducation::class, 'user_id'));
        return $this->hasOne(JobSeekerEducation::class, 'user_id');
    }

    public function highest_education()
    {
        $education = $this->job_seeker_education;
        $degrees = json_decode($education->education_id);

        $allEducation = [];
        foreach ($degrees as $degree) {
            $education = Education::find($degree)->title;
            $refinedEducation = strtolower(
                str_replace(
                    array(
                        '\'',
                        '"',
                        ',',
                        ';',
                        '<',
                        '>',
                        '.',
                        '-',
                    ),
                    '',
                    $education
                )
            );

            array_push($allEducation, $refinedEducation);
        }

        if (in_array('phd', $allEducation)) {
            $key = array_search('phd', $allEducation);
        } elseif (in_array('masters', $allEducation)) {
            $key = array_search('masters', $allEducation);
        } elseif (in_array('master', $allEducation)) {
            $key = array_search('master', $allEducation);
        } elseif (in_array('bachelor', $allEducation)) {
            $key = array_search('bachelor', $allEducation);
        } elseif (in_array('bachelors', $allEducation)) {
            $key = array_search('bachelors', $allEducation);
        } else {
            return "Under Graduate";
        }
        return Education::find($degrees[$key])->title;

    }

    public function generateUsername($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        $allSlugs = $this->getRelatedUsername($title, $id = 0);

        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('username', $slug)) {
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 1000; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('username', $newSlug)) {
                return $newSlug;
            }
        }
        throw new Exception('Can not create a unique slug');
    }



    private function getRelatedUsername($slug, $id = 0)
    {
        return User::select('username')->where('username', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}