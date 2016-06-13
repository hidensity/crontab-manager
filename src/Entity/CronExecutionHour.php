<?php

namespace Dbb\CrontabManager\Entity;

class CronExecutionHour extends CronExecution
{
    public function __construct()
    {
        parent::__construct(23);
    }
}
