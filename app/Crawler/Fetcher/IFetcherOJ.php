<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-08 21:19
 */

namespace App\Crawler\Fetcher;


use App\Model\Problem;
use App\Model\StudentAccount;

interface IFetcherOJ
{
    /**
     * 获取某个学生某个oj上的解决题数
     * @param StudentAccount $account
     * @return mixed
     */
    public function getStudentStatus(StudentAccount $account);

    /**
     * 获取某个学生某个oj上某道题的结果
     * @param StudentAccount $account
     * @param Problem $problem
     * @return mixed
     */
    public function getStudentProblemStatus(StudentAccount $account, Problem $problem);
}