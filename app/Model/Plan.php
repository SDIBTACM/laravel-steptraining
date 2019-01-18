<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-09 22:34
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'plan';

    /**
     * get Plan student
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function students() {
        return $this->belongsToMany('App\Model\Student', 'plan_student');
    }

    /**
     * get plan problems
     */

    public function problems() {
        return $this->belongsToMany('App\Model\Problem', 'plan_student');
    }

}