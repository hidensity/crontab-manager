<?php

namespace Dbb\CrontabManager\Execution;

class CronExecutionWeekday extends CronExecution
{
    public function __construct()
    {
        parent::__construct(6);
    }
}
