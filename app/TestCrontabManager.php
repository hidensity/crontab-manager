<?php

namespace Dbb;

use Dbb\CrontabManager\Entity\CronJob;
use Dbb\CrontabManager\CrontabManager;

class TestCrontabManager
{
    /**
     * @var CrontabManager
     */
    protected $cronTabManager;

    /**
     * @var CronJob
     */
    protected $cronJob;

    public function __construct()
    {
        $this->cronTabManager = new CrontabManager();

        $this->cronJob = new CronJob();
        $this->cronJob->minutes()->step('45');

        $this->cronTabManager->add('sample', $this->cronJob);

        $this->cronTabManager->save();
    }

    public function run()
    {
        /** @var CronJob $cronJob */
        foreach ($this->cronTabManager->getCronJobs() as $jobId => $cronJob) {
            echo $jobId . PHP_EOL;
            echo $cronJob->getExecutionDefinition() . PHP_EOL;
        }
        //echo $this->cronJob->getExecutionDefinition();
    }
}
