<?php

namespace Dbb\CrontabManager\Entity;

class CronExecutionDay extends CronExecution
{
    public function __construct()
    {
        parent::__construct(31);
    }
}
