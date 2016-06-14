<?php

namespace spec\Dbb\CrontabManager\Execution;

use Dbb\CrontabManager\Exception\CronJobExecutionException;
use Dbb\CrontabManager\Execution\CronExecution;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin CronExecution
 */
class CronExecutionSpec extends ObjectBehavior
{
    const MAXIMUM = 59;

    function let()
    {
        $this->beConstructedWith(self::MAXIMUM);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Dbb\CrontabManager\Execution\CronExecution');
    }

    function it_should_throw_an_exception_when_passing_a_double_asterisk_as_execution_rule()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd('**');
    }

    function it_should_throw_an_exception_when_specifying_an_empty_string_for_execution()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd('');
    }

    function it_should_throw_an_exception_when_specifying_a_non_numeric_value_for_execution()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd('foo');
    }

    function it_should_throw_an_exception_when_the_basic_execution_exceeds_the_maximum()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd(self::MAXIMUM + 1);
    }

    function it_should_throw_an_exception_when_specifying_a_value_with_more_than_one_dash_for_execution()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd('2--4');
    }

    function it_should_throw_an_exception_when_specified_timespan_for_execution_is_invalid()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd('2-1');
    }

    function it_should_throw_an_exception_when_specified_timespan_contains_a_non_numeric_characters_for_execution()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringAdd('a-2');
    }

    function it_should_return_an_asterisk_when_specifying_no_execution_rule()
    {
        $this->__toString()->shouldBe('*');
    }

    function it_should_return_an_asterisk_when_specifying_an_asterisk_as_execution_rule()
    {
        $this->add('*')->__toString()->shouldBe('*');
    }

    function it_should_return_an_asterisk_slash_5_when_specifying_an_asterisk_execution_rule_with_a_5_step()
    {
        $this->add('*')->step('5')->__toString()->shouldBe('*/5');
    }

    function it_should_return_an_asterisk_slash_3_when_specifying_only_a_3_step()
    {
        $this->step('3')->__toString()->shouldBe('*/3');
    }

    function it_should_throw_an_exception_when_the_execution_step_exceeds_the_maximum_defined_one()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringStep(self::MAXIMUM + 1);
    }

    function it_should_throw_an_exception_when_the_execution_step_is_not_numeric()
    {
        $this->shouldThrow(get_class(new CronJobExecutionException()))->duringStep('foo');
    }

    function it_should_accept_more_than_one_execution_definition_without_steps()
    {
        $this->add('5')->add('10')->__toString()->shouldBe('5,10');
    }

    function it_should_accept_more_than_one_execution_definition_with_one_step_definition()
    {
        $this->add('5')->step('2')->add('10')->__toString()->shouldBe('5/2,10');
    }

    function it_should_accept_more_than_one_execution_definition_with_two_step_definition()
    {
        $this->add('5')->step('2')->add('10')->step('3')->__toString()->shouldBe('5/2,10/3');
    }

    function it_should_accept_more_than_one_execution_definition_and_overwrite_a_step_definition()
    {
        $this->add('5')->step('2')->step('7')->add('10')->__toString()->shouldBe('5/7,10');
    }
}
