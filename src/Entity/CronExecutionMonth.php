<?php

namespace Dbb\CrontabManager\Entity;

class CronExecutionMonth extends CronExecution
{
    public function __construct()
    {
        parent::__construct(12);
    }
}
