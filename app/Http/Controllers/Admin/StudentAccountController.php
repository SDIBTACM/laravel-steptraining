<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-03 19:25
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Log;
use App\Model\Student;
use App\Model\StudentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentAccountController extends Controller
{

    protected $ojList;

    public function __construct()
    {
        $SUPPORT_PROBLEM_OJ = json_decode(env('SUPPORT_PROBLEM_OJ'), true);
        $SUPPORT_RANKING_OJ = json_decode(env('SUPPORT_RANKING_OJ'), true);
        $this->ojList = array_merge($SUPPORT_PROBLEM_OJ, $SUPPORT_RANKING_OJ);
    }

    public function index($student_id) {


        $accountList = StudentAccount::where('student_id', $student_id)->whereIn('origin_oj', $this->ojList)->get();

        $accountArray = array();

        foreach ($accountList as $item) $accountArray[$item->origin_oj] = $item->account_id;

        return view('admin.student.account', [
            'ojList' => $this->ojList,
            'accountList' => $accountArray,
            'student' => Student::find($student_id),
        ]);
    }

    public function update(Request $request, $student_id) {

        $accountList = StudentAccount::where('student_id', $student_id)->whereIn('origin_oj', $this->ojList)->get();

        $accounts = array();
        foreach ($accountList as $item) $accounts[$item->origin_oj] = $item;

        foreach ($this->ojList as $oj) {
            if ( isset($accounts[$oj]) ) {
                $newAccount = is_null($request->input($oj)) ? '' : $request->input($oj);
                if ($newAccount !== $accounts[$oj]->account_id) {
                    $accounts[$oj]->account_id = $newAccount;
                    $accounts[$oj]->save();
                    Log::info('user: {}, update student: {} account: {}', Auth::user()->username, $student_id, $accounts[$oj]);
                }
            } else {
                $accounts[$oj] = new StudentAccount;
                $accounts[$oj]->student_id = $student_id;
                $accounts[$oj]->account_id = is_null($request->input($oj)) ? '' : $request->input($oj);
                $accounts[$oj]->origin_oj = $oj;
                $accounts[$oj]->save();
                Log::info('user: {}, add student: {} account: {}', Auth::user()->username, $student_id, $accounts[$oj]);
            }
        }

        return redirect()->route('admin.student.account_form', ['student' => $student_id]);
    }
}