<?php

/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-09 22:14
 */

namespace App\Http\Controllers\Admin;

use App\Log;
use App\Model\PlanStudent;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students = null;

        if ($request->get('isUpdate', -1) != -1) {
            $students === null ?
                $students = Student::where('is_update', $request->get('isUpdate')) :
                $students = $students->where('is_update', $request->get('isUpdate'));
        }

        if ($request->get('isShow', -1) != -1) {
            $students === null ?
                $students = Student::where('is_update', $request->get('isShow')) :
                $students = $students->where('is_update', $request->get('isShow'));
        }

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
            $students = Student::paginate(15) :
            $students = $students->paginate(15);



        return view('admin.student.index', [
            'title' => 'student manager',
            'students' => $students,
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
        $student = new Student;
        $student->name = $request->input('name');
        $student->class = $request->input('class');
        $student->is_show = $request->has('isShowSwitch') ? 0 : 1;
        $student->is_update = $request->has('isUpdateSwitch') ? 0 : 1;

        $student->save();
        Log::info('User: {} add a student, info: {}', Auth::user()->username, $student);
        return array(
            'date' => date('Y-m-d H:m:s'),
            'id' => $student->id,
        );
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
        $student = Student::find($id);

        $student->class = $request->input('class');
        $student->is_show = $request->input('is_show') % 2;
        $student->is_update = $request->input('is_update') % 2;

        $student->save();
        Log::info('User: {} update a student, info: {}', Auth::user()->username, $student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oldStudent = Student::find($id);
        PlanStudent::where('student_id', $id)->delete();
        Log::info('User: {} delete student: {}', Auth::user()->username, $oldStudent);
        Student::destroy($id);
    }
}
