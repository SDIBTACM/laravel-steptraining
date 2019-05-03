<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-18 18:43
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    public function problems() {
        $this->belongsToMany('App\Model\Problem', 'problem_tag');
    }
}