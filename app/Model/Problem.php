<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-08 21:29
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $table = 'problem';

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function plan() {
        return $this->belongsToMany('App\Model\Plan', 'plan_problem');
    }

    public function tags() {
        return $this->belongsToMany('App\Model\Tag', 'problem_tag');
    }

    public function accepts() {
        return $this->hasMany('App\Model\StudentProblemAcceptTime');
    }
}