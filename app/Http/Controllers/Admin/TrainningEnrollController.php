<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventEnroll;
use Illuminate\Http\Request;

class TrainningEnrollController extends Controller
{
    public function index()
    {
        $trainingEnroll = EventEnroll::with('events')->get();
        $status = 'index';
        return view('admin.training_enroll.index', compact('trainingEnroll', 'status'));
    }
    //
}
