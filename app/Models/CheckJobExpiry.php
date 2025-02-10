<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CheckJobExpiry extends Model
{
    use HasFactory;

    public function check()
    {
        $this->activeIfAvailable();
        $this->expireIfAvaliable();
    }

    private function expireIfAvaliable()
    {
        $jobs = Job::whereDate('expiry_date', '<=', today())->get()->chunk(50);

        foreach ($jobs as $chunked) {
            foreach ($chunked as $job) {
                $job->status = 'expired';
                $job->update();
            }
        }
    }

    private function activeIfAvailable(){
        $jobs = Job::whereDate('start_date', '>=', today())->get()->chunk(50);

        foreach($jobs as $chunked){
            foreach($chunked as $job){
                $job->status = 'active';
                $job->update();
            }
        }
    }
}