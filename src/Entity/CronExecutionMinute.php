<?php

namespace Dbb\CrontabManager\Entity;

class CronExecutionMinute extends CronExecution
{
    public function __construct()
    {
        parent::__construct(59);
    }
}
