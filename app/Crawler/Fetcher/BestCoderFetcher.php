<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-09 22:20
 */

namespace App\Crawler\Fetcher;


use App\Model\Problem;
use App\Model\StudentAccount;

class BestCoderFetcher extends Fetcher
{

    protected function getStudentProblemStatusUrl(StudentAccount $account, Problem $problem)
    {
        return null;
    }

    protected function filterProblemStatusPattern(StudentAccount $account, Problem $problem)
    {
        return null;
    }

    protected function getStudentStatusUrl(StudentAccount $account)
    {
        // TODO: Implement getStudentStatusUrl() method.
    }

    protected function filterStudentStatusPattern(StudentAccount $account)
    {
        // TODO: Implement filterStudentStatusPattern() method.
    }
}