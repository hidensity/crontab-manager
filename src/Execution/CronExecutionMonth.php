<?php

namespace Dbb\CrontabManager\Execution;

class CronExecutionMonth extends CronExecution
{
    public function __construct()
    {
        parent::__construct(12);
    }
}
