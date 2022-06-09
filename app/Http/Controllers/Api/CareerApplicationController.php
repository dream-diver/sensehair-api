<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = CareerApplication::all();
        return $applications;
    }

    public function show(Request $request)
    {
        $application = CareerApplication::where('id', $request->id)->first();
        return $application;
    }

    public function delete(Request $request)
    {
        $application = CareerApplication::where('id', $request->id)->delete();
        return $application;
    }

    public function apply(Request $request)
    {
        $reqData = $request->all();

        $application = CareerApplication::create($reqData);

        if (isset($request['resume'])) {
            $file = $request->file('resume');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('resumes'), $fileName);
            $application->resume = $fileName;
            $application->save();
        }

        return $application;
    }
}
