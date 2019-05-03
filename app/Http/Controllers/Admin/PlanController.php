<?php

/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-09 20:05
 */


namespace App\Http\Controllers\Admin;

use App\Log;
use App\Model\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.plan.index', ['title' => 'plan manager']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plan = new Plan;
        $plan->name = $request->input('name');
        $plan->save();

        Log::info('User: {} add a plan, name: {}', Auth::user()->username, $plan->name);
        return date('Y-m-d H:m:s');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::find($id);
        $plan->name = $request->input('name');
        $plan->save();

        Log::info('User: {} update category: {} to {} ', Auth::user()->username, $plan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldCategory = Plan::find($id);
        Log::info('User: {} delete category: {}', Auth::user()->username, $oldCategory);
        Plan::destroy($id);
    }
}
