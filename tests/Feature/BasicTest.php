<?php

namespace Tests\Feature;

use App\Box;
use Tests\TestCase;

class BasicTest extends TestCase
{
    // Test function for Box class
    public function testBoxContents()
    {
        $box = new Box(['toy']);
        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }

    public function testTakeOneFromTheBox()
    {
        $box = new Box(['torch']);
        $this->assertEquals('torch', $box->takeOne());

        // Null, now the box is empty
        $this->assertNull($box->takeOne());
    }
}
