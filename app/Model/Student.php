<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-08 21:27
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    /**
     * get Student Account
     */
    public function accounts() {
        return $this->hasMany('App\Model\StudentAccount');
    }

    /**
     * get plan
     */

    public function plans() {
        return $this->belongsToMany('App\Model\Plan', 'plan_student');
    }

    /**
     * get all problem accept time
     */

    public function acceptProblem() {
        return $this->hasMany('App\Model\StudentProblemAcceptTime');
    }


}