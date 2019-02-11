<?php

namespace App\Console\Commands;

use App\Crawler\Fetcher\Fetcher;
use App\Log;
use App\Model\Problem;
use App\Model\StudentAccount;
use App\Model\StudentProblemAcceptTime;
use Illuminate\Console\Command;

class UpdateStudentProblemStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stu_problem';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update student problem status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Problem::chunk(32, function ($problems) {
            $updateStudentId = Student::where('is_update', 0)->get();
            $supportOj = env('SUPPORT_PROBLEM_OJ', array());
            foreach ($problems as $problem) {
                if (!in_array($problem->origin_oj, $supportOj)) {
                    Log::warning('Not Support OJ: {}', $problem->origin_oj);
                }
                $fetcherName = "App\\Crawler\\Fetcher\\" . $problem->origin_oj . "Fetcher";
                $fetcher = new $fetcherName;
                $alreadyFinish = (array) StudentProblemAcceptTime::where('problem_id', $problem->id)->pluck('student_id');
                foreach (StudentAccount::where('origin_oj', $problem->origin_oj)
                             ->whereIn('student_id', $updateStudentId)->whereNotIn('student_id', $alreadyFinish)->cursor() as $account) {

                    $accept = new StudentProblemAcceptTime;
                    $finishDatetime = $fetcher->getStudentProblemStatus($problem, $account);

                    $accept->problem_id = $problem->id;
                    $accept->student_id = $account->student_id;
                    $accept->finish_date = date('Y-m-d', strtotime($finishDatetime));

                    $accept->save();
                }
            }
        });

        return 'success!';
    }
}
