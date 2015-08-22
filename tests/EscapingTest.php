<?php

class EscapingTest extends PHPUnit_Framework_TestCase
{

    protected $escaping;

    public function setUp()
    {
        $this->escaping = $this->getObjectForTrait('Gloudemans\Notify\Escaping');
    }

    /** @test */
    public function it_can_escape_the_message()
    {
        $message = "This isn't a title";

        $escaped = $this->escaping->escapeMessage($message);

        $this->assertEquals("This isn\\'t a title", $escaped);
        $this->assertNotEquals("This isn't a title", $escaped);
    }

    /** @test */
    public function it_can_escape_the_title()
    {
        $title = "This isn't a message";

        $escaped = $this->escaping->escapeMessage($title);

        $this->assertEquals("This isn\\'t a message", $escaped);
        $this->assertNotEquals("This isn't a message", $escaped);
    }
}