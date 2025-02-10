<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdPricing;
use Illuminate\Http\Request;
use App\Models\StepProcedure as Step;
use App\Models\DayPackage;

class PricingController extends Controller
{
    public function mainIndex()
    {
        $steps = Step::all();
        return view('admin.pricing.mainIndex', compact('steps'));
    }

    public function index($ad_type)
    {
        $step = Step::where('id', base64_decode($ad_type))->with('prices')->first();
        if (is_null($step) || empty($step)) {
            return back()->with('error', 'Something went wrong');
        }
        $daysCount = DayPackage::orderBy('order_no')->whereHas('prices', fn($q) => $q->where('ad_id', $step->id))->get();
        $days = DayPackage::orderBy('order_no')->get();
        $pricing = $step->prices()
            ->with('package')
            ->orderBy('no_of_days')
            ->get()->groupBy('no_of_days')
            ->map(function ($group) {
                return $group->sortBy(function ($price) {
                    return $price->package->order_no;
                });
            });

        // dd($pricing);


        return view('admin.pricing.index', compact('step', 'days', 'pricing', 'daysCount'));
    }

    public function create($ad_type)
    {
        $step = Step::find(base64_decode($ad_type));
        if (is_null($step) || empty($step)) {
            return back()->with('error', 'Something went wrong');
        }
        $days = DayPackage::orderBy('order_no')->get();

        return view('admin.pricing.create', compact('step', 'days'));
    }

    public function store($ad_type, Request $request)
    {
        $request->validate([
            'no_of_days' => 'required|numeric',
            'day_package' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($this->exists($request, base64_decode($ad_type))) {
            $pricing = AdPricing::where([
                'no_of_days' => $request->no_of_days,
                'ad_id' => base64_decode($ad_type),
                'day_package_id' => base64_decode($request->day_package),
            ])->first();

            $pricing->price = $request->price;
            $pricing->update();

            return to_route('admin.pricing.index', $ad_type)->with('status', 'Pricing has been updated');
        } else {
            $pricing = new AdPricing;
            $pricing->day_package_id = base64_decode($request->day_package);
            $pricing->ad_id = base64_decode($ad_type);
            $pricing->no_of_days = $request->no_of_days;
            $pricing->price = $request->price;
            $pricing->save();

            return to_route('admin.pricing.index', $ad_type)->with('status', 'Pricing has been added');
        }
    }

    public function destroy($ad_type, $id){

        AdPricing::destroy(base64_decode($id));

        return back()->with('status', 'Price has been removed');

    }

    private function exists($request, $ad_type)
    {
        return AdPricing::where([
            'no_of_days' => $request->no_of_days,
            'ad_id' => $ad_type,
            'day_package_id' => base64_decode($request->day_package),
        ])->exists();
    }
}