<?php

namespace spec\Dbb\CrontabManager\Entity;

use Dbb\CrontabManager\Entity\CronJob;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CronJob
 */
class CronJobSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dbb\CrontabManager\Entity\CronJob');
    }
}
