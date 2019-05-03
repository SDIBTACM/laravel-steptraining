<?php

/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-09 22:14
 */

namespace App\Http\Controllers\Admin;

use App\Log;
use App\Model\Category;
use App\Model\PlanProblem;
use App\Model\Problem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $problems = null;
        if ($request->get('category', null) != null) {
            $problems === null ?
                $problems = Problem::where('category_id',  $request->get('category')) :
                $problems = $problems->where('category_id',  $request->get('category'));
        }

        if ($request->get('oj', null) != null) {
            $problems === null ?
                $problems = Problem::where('origin_oj', $request->get('oj')) :
                $problems = $problems->where('origin_oj', $request->get('oj'));
        }

        $problems === null ?
            $problems = Problem::paginate(15) :
            $problems = $problems->paginate(15);


        return view('admin.problem.index', [
            'title' => 'problem manager',
            'problems' => $problems,
            'categoryGroup' => Category::all(),
            'ojList' => json_decode(env('SUPPORT_PROBLEM_OJ'), true),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $problem = new Problem;

        $ojList = json_decode(env('SUPPORT_PROBLEM_OJ'), true);

        if (in_array($request->input('origin_oj', null), $ojList) ) {

            $problem->category_id = $request->input('category_id', 1);
            $problem->origin_oj = $request->input('origin_oj', null);
            $problem->origin_problem_id = $request->input('origin_problem_id', null);
            $problem->save();

            Log::info('User: {} add a problem, info: {}', Auth::user()->username, $problem);

            return array(
                'date' => date('Y-m-d H:m:s'),
                'id' => $problem->id,
            );

        } else {
            Log::warning('user: {}, try to add a Problem from a not support OJ [{}]', Auth::user()->username, $request->input('origin_oj'));
            abort(400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $problem = Problem::find($id);
        $problem->category_id = $request->input('category_id');
        $problem->save();
        Log::info('User: {} update a problem info: {}', Auth::user()->username, $problem);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldProblem = Problem::find($id);
        PlanProblem::where('problem_id', $id)->delete();
        Problem::destroy($id);
        Log::info('User: {} delete problem: {}', Auth::user()->username, $oldProblem);
    }
}
