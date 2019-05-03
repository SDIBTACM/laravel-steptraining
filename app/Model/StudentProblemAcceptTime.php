<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-17 18:15
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class StudentProblemAcceptTime extends Model
{
    protected $table = 'student_problem_accept_time';

    public function problem() {
        return $this->belongsTo('App\Model\Problem');
    }

    public function student() {
        return $this->belongsTo('App\Model\Student');
    }
}