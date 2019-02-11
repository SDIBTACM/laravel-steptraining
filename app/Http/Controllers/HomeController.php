<?php

namespace App\Http\Controllers;

use App\Model\Student;

class HomeController extends Controller
{
    /**
     * 展示学生在各个OJ的排名或者做题数
     */

    public function index() {
        $students = Student::where('is_show', 0)->get();

        return view('home',[
            'choose' => 'statistics',
            'students' => compact($students)
        ]);
    }
}
