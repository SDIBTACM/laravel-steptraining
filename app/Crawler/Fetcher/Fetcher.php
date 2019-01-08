<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-08 21:40
 */

namespace App\Crawler\Fetcher;


use App\Crawler\Client\SimpleClient;
use App\Model\Problem;
use App\Model\StudentAccount;

abstract class Fetcher implements IFetcherOJ
{

    /**
     * 获取某个学生某个oj上的解决题数
     * @param StudentAccount $account
     * @return mixed
     */
    public function getStudentStatus(StudentAccount $account)
    {
        $url = $this->getStudentStatusUrl($account);
        $pattern = $this->filterStudentStatusPattern($account);

        if (is_null($url) || is_null($pattern)) return 0;

        $html = SimpleClient::get($url);

        if (is_null($html)) return 0;

        $flag = preg_match($pattern, $html, $solved);
        return $flag  ? intval($solved[1]) : 0;
    }

    /**
     * 获取某个学生某个oj上某道题的结果
     * @param StudentAccount $account
     * @param Problem $problem
     * @return mixed
     */
    public function getStudentProblemStatus(StudentAccount $account, Problem $problem)
    {
        $url = $this->getStudentProblemStatusUrl($account, $problem);

        $pattern = $this->filterProblemStatusPattern($account, $problem);

        if (is_null($url) || is_null($pattern)) return 0;

        $html = SimpleClient::get($url);

        if (is_null($html)) return 0;

        $flag = preg_match($pattern, $html, $status);
        return $flag ? date('Y-m-d', strtotime($status[1])) : false;

    }


    /**
     * 获取某个学生某题状态页面的html信息
     * [目前只有部分oj需要这么做, 如果其他oj也需要, 直接实现即可]
     * @param StudentAccount $account
     * @param Problem $problem
     * @return mixed
     */
    abstract protected function getStudentProblemStatusUrl(StudentAccount $account, Problem $problem);

    /**
     * 从html中过滤出题目的解决结果
     * @param StudentAccount $account
     * @param Problem $problem
     * @return mixed
     */
    abstract protected function filterProblemStatusPattern(StudentAccount $account, Problem $problem);

    /**
     * 获取某个学生解决题数页面的html信息
     * @param StudentAccount $account
     * @return mixed
     */
    abstract protected function getStudentStatusUrl(StudentAccount $account);

    /**
     * 获取从html中过滤出解决的题数的正则
     * @param StudentAccount $account
     * @return mixed
     */
    abstract protected function filterStudentStatusPattern(StudentAccount $account);

}