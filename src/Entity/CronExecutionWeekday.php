<?php

namespace Dbb\CrontabManager\Entity;

class CronExecutionWeekday extends CronExecution
{
    public function __construct()
    {
        parent::__construct(6);
    }
}
