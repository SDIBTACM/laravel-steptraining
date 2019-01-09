<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-09 19:28
 */

namespace App\Crawler\Fetcher;

use App\Model\Problem;
use App\Model\StudentAccount;

class HDUFetcher extends Fetcher
{

    protected function getStudentProblemStatusUrl(StudentAccount $account, Problem $problem)
    {
        // TODO: Implement getStudentProblemStatusUrl() method.
    }

    protected function filterProblemStatusPattern(StudentAccount $account, Problem $problem)
    {
        // TODO: Implement filterProblemStatusPattern() method.
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