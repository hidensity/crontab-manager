<?php

namespace Dbb\CrontabManager;

use Dbb\CrontabManager\Entity\CronJob;
use Dbb\CrontabManager\Exception\CronJobDuplicateIdException;

class CrontabManager
{
    /**
     * @var string
     */
    protected $fileName;

    protected $jobs = [];

    public function __construct($fileName = null)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            throw new \Exception('This application cannot be run on Microsoft Windows.');
        }

        if (!empty($fileName)) {
            $this->fileName = $fileName;
        }
    }

    public function add(CronJob $cronJob)
    {
        if (array_key_exists($cronJob->getId(), $this->jobs)) {
            throw new CronJobDuplicateIdException(sprintf('Cron job with Id "%s" already exists.', $cronJob->getId()));
        }
        $this->jobs[$cronJob->getId()] = $cronJob;
    }

    public function remove(string $jobId): bool
    {
        if (array_key_exists($jobId, $this->jobs)) {
            unset($this->jobs[$jobId]);
            return true;
        }

        return false;
    }

    public function getCronJobs(): array
    {
        return $this->jobs;
    }

    public function save()
    {
        $user = $this->getCurrentUsername();
        $currentCrontab = $this->getCurrentCrontab();
    }

    protected function getCurrentUsername(): string
    {
        if (!extension_loaded('posix')) {
            throw new \Exception('This application requires the PHP Posix extension to be installed and activated.');
        }

        $userInfo = posix_getpwuid(posix_geteuid());
        return $userInfo['name'];
    }

    protected function parseCronjobFile(): array
    {
        // TODO: implement
        return [];
    }

    protected function getCurrentCrontab(): array
    {
        exec('crontab -l', $output);

        return $output;
    }
}
