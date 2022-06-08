<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CareerApplication;
use Illuminate\Http\Request;

class CareerApplicationController extends Controller
{
    public function index(Request $request )
    {
        $applications = CareerApplication::all();
        return $applications;
    }

    public function show(Request $request )
    {
        $application = CareerApplication::where('id',$request->id)->first();
        return $application;
    }

    public function delete(Request $request )
    {
        $application = CareerApplication::where('id',$request->id)->delete();
        return $application;
    }
    
    public function apply(Request $request)
    {
        $reqData = $request->all();
        $reqData['education1']=json_encode($reqData['education1']) ;
        $reqData['education2']=json_encode($reqData['education2']) ;
        $reqData['education3']=json_encode($reqData['education3']) ;
        $reqData['exp1']=json_encode($reqData['exp1']) ;
        $reqData['exp2']=json_encode($reqData['exp2']) ;
        $reqData['exp3']=json_encode($reqData['exp3']) ;
        $application = CareerApplication::create($reqData);
        return $application;
    }
}
