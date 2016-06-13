<?php

namespace Dbb\CrontabManager\Entity;

class CronExecution
{
    /**
     * @var int
     */
    protected $maxStepValue = 1;
    
    /**
     * @var array
     */
    protected $execDefinitions = [];

    public function __construct($maxStepValue = 1)
    {
        $this->maxStepValue = $maxStepValue;
    }

    public function add(string $execDefinition): self
    {
        if ($this->parseExecDefinition($execDefinition)) {
            $this->execDefinitions[] = $execDefinition;
        }
        return $this;
    }

    public function step(string $step): self
    {
        $lastExecDef = array_pop($this->execDefinitions);
        if (strpos($lastExecDef, '/')) {
            $lastExecDef = substr($lastExecDef, 0, strpos($lastExecDef, '/'));
        }
        if ($this->parseStepDefinition($step)) {
            $lastExecDef = sprintf('%s/%d', $lastExecDef ?? '*', $step);
        }
        $this->execDefinitions[] = $lastExecDef;

        return $this;
    }

    public function __toString(): string
    {
        if (count($this->execDefinitions) == 0) {
            return '*';
        } else {
            return implode(',', $this->execDefinitions);
        }
    }

    protected function parseExecDefinition(string $execDefinition): bool
    {
        if (!is_numeric($execDefinition) &&
            !preg_match('/^(\*)/', $execDefinition) &&
            !preg_match('/^(\d+-\d+)?$/', $execDefinition)) {
            throw new \InvalidArgumentException('Provided execution definition does not match any valid pattern.');
        }

        if (is_numeric($execDefinition) && $execDefinition > $this->maxStepValue) {
            throw new \InvalidArgumentException('Execution interval exceeds settings maximum.');
        }

        if (preg_match('/^(\d+-\d+)?$/', $execDefinition, $matches)) {
            $matches = explode('-', $matches[0]);
            if ($matches[0] > $matches[1]) {
                throw new \InvalidArgumentException('Invalid execution time span specified.');
            }
        }

        return true;
    }

    protected function parseStepDefinition(string $step): bool
    {
        if (!is_numeric($step)) {
            throw new \InvalidArgumentException('Step definition must contain a numeric value.');
        }
        if ($step < 0 || $step > $this->maxStepValue) {
            throw new \InvalidArgumentException('Specified step value is exceeds the valid values for this parameter');
        }

        return true;
    }
}
