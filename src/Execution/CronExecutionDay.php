<?php

namespace Dbb\CrontabManager\Execution;

class CronExecutionDay extends CronExecution
{
    public function __construct()
    {
        parent::__construct(31);
    }
}
