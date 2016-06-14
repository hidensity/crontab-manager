<?php

namespace Dbb\CrontabManager\Entity;

use Dbb\CrontabManager\Execution\CronExecutionDay;
use Dbb\CrontabManager\Execution\CronExecutionHour;
use Dbb\CrontabManager\Execution\CronExecutionMinute;
use Dbb\CrontabManager\Execution\CronExecutionMonth;
use Dbb\CrontabManager\Execution\CronExecutionWeekday;

class CronJob
{
    /**
     * @var string
     */
    protected $id;
    
    /**
     * @var CronExecutionMinute
     */
    protected $minutes;

    /**
     * @var CronExecutionHour
     */
    protected $hours;

    /**
     * @var CronExecutionDay
     */
    protected $days;

    /**
     * @var CronExecutionMonth
     */
    protected $months;

    /**
     * @var CronExecutionWeekday
     */
    protected $daysOfWeek;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var string
     */
    protected $command = '';

    /**
     * @var array
     */
    protected $parameters = [];

    public function __construct(string $id)
    {
        $this->id = $id;
        $this->minutes = new CronExecutionMinute();
        $this->hours = new CronExecutionHour();
        $this->days = new CronExecutionDay();
        $this->months = new CronExecutionMonth();
        $this->daysOfWeek = new CronExecutionWeekday();
    }

    public function __toString(): string
    {
        return trim(sprintf(
            '%s %s %s\t# %s',
            $this->getExecutionDefinition(),
            $this->getCommand(),
            $this->getParamString(),
            $this->getId()
        ));
    }

    public function minutes(): CronExecutionMinute
    {
        return $this->minutes;
    }

    public function hours(): CronExecutionHour
    {
        return $this->hours;
    }

    public function days(): CronExecutionDay
    {
        return $this->days;
    }

    public function months(): CronExecutionMonth
    {
        return $this->months;
    }

    public function daysOfWeek(): CronExecutionWeekday
    {
        return $this->daysOfWeek;
    }

    public function setEnabled(bool $enable)
    {
        $this->enabled = $enable;
    }

    public function setCommand(string $command)
    {
        $this->command = $command;
    }

    public function addParameter(string $parameter)
    {
        $this->parameters[] = $parameter;
    }

    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getExecutionDefinition(): string
    {
        return sprintf(
            '%s %s %s %s %s',
            $this->minutes,
            $this->hours,
            $this->days,
            $this->months,
            $this->daysOfWeek
        );
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getParamString(): string
    {
        return implode(' ', $this->parameters);
    }
}
