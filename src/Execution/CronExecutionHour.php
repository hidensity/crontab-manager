<?php

namespace Dbb\CrontabManager\Execution;

class CronExecutionHour extends CronExecution
{
    public function __construct()
    {
        parent::__construct(23);
    }
}
