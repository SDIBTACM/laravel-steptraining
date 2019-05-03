<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-03 11:48
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Log;
use App\Model\Category;
use App\Model\Plan;
use App\Model\Problem;
use App\Model\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PlanManagerController extends Controller
{
    public function student(Request $request, $plan) {
        $students = null;

        if ($request->get('name', null) != null) {
            $students === null ?
                $students = Student::where('name', 'like', '%' . $request->get('name') . '%') :
                $students = $students->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->get('class', null) != null) {
            $students === null ?
                $students = Student::where('class', 'like', '%' . $request->get('class') . '%') :
                $students = $students->where('class', 'like', '%' . $request->get('class') . '%');
        }

        $students === null ?
            $students = Student::where('is_show', 0)->paginate(15) :
            $students = $students->where('is_show', 0)->paginate(15);


        return view('admin.plan.student', [
            'title' => 'Plan Manager',
            'students' => $students,
            'plan' => Plan::find($plan),
            'studentsInPlan' => Plan::find($plan)->students()->pluck('student_id')
        ]);
    }

    public function problem(Request $request, $plan) {
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

        return view('admin.plan.problem', [
            'title' => 'Plan Manager',
            'problems' => $problems,
            'plan' => Plan::find($plan),
            'problemInPlan' => Plan::find($plan)->problems()->pluck('problem_id'),
            'categoryGroup' => Category::all(),
            'ojList' => json_decode(env('SUPPORT_PROBLEM_OJ'), true),
        ]);
    }

    public function addStudent(Request $request, $plan) {

    }

    public function addProblem(Request $request, $plan) {

    }

    public function deleteStudent(Request $request, $plan) {

    }

    public function deleteProblem(Request $request, $plan) {

    }
}