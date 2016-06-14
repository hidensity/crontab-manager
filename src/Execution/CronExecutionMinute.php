<?php

namespace Dbb\CrontabManager\Execution;

class CronExecutionMinute extends CronExecution
{
    public function __construct()
    {
        parent::__construct(59);
    }
}
