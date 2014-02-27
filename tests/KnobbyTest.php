<?php

class KnobbyTest extends PHPUnit_Framework_TestCase
{
    public function testLoadConfigArray(){
        $config = array(
            array(
                'name' => 'testKnob',
                'type' => 'knob',
                'min' => 10,
                'max' => 50,
                'value' => 15,    
            ),
            array(
                'name' => 'testLever',
                'on' => false,
                'type' => 'lever',
            ),
        );
        $knobby = new \DDM\Knobby\Knobby();
        $knobby->loadConfigArray($config);
        $expected = true;
        $this->assertEquals($expected, $knobby->flagExists('testKnob'), 'testKnob should exist');
        $this->assertEquals($expected, $knobby->flagExists('testLever'), 'testLever should exist');
    }

    public function testLoadConfigJson(){
       $config = json_encode(array(
            array(
                'name' => 'testKnob',
                'type' => 'knob',
                'min' => 10,
                'max' => 50,
                'value' => 15,    
            ),
            array(
                'name' => 'testLever',
                'on' => false,
                'type' => 'lever',
            ),
        ));

        $knobby = new \DDM\Knobby\Knobby();
        $knobby->loadConfigJson($config);
        $expected = true;
        $this->assertEquals($expected, $knobby->flagExists('testKnob'), 'testKnob should exist');
        $this->assertEquals($expected, $knobby->flagExists('testLever'), 'testLever should exist');
    }

    public function testToArray(){
        $config = array(
            array(
                'name' => 'testKnob',
                'type' => 'knob',
                'min' => 10,
                'max' => 50,
                'value' => 15,    
            ),
            array(
                'name' => 'testLever',
                'on' => false,
                'type' => 'lever',
            ),
        );
        $knobby = new \DDM\Knobby\Knobby();
        $knobby->loadConfigArray($config);
        $expected = $config;
        $this->assertEquals($expected, $knobby->toArray(), 'array should match config');
    }

    public function testToJson(){
        $config = json_encode(array(
            array(
                'name' => 'testKnob',
                'type' => 'knob',
                'min' => 10,
                'max' => 50,
                'value' => 15,    
            ),
            array(
                'name' => 'testLever',
                'on' => false,
                'type' => 'lever',
            ),
        ));
        $knobby = new \DDM\Knobby\Knobby();
        $knobby->loadConfigJson($config);
        $expected = json_decode($config);
        $actual = json_decode($knobby->toJson());
        $this->assertEquals($expected, $actual, 'json should match config');
    }

    public function testUndefinedFlag(){
        $knobby = new \DDM\Knobby\Knobby();
        $expected = false;
        $actual = $knobby->test('undefined');
        $this->assertEquals($expected, $actual, 'Undefined flags should return false');
    }

    public function testTestKnob(){
        $config = array(
            array(
                'name' => 'testKnob',
                'type' => 'knob',
                'min' => 10,
                'max' => 50,
                'value' => 15,    
            ),
        );
        $knobby = new \DDM\Knobby\Knobby();
        $knobby->loadConfigArray($config);

        $actual = $knobby->test('testKnob', 13);
        $expected = true;
        $this->assertEquals($expected, $actual, 'knob should work');
    }
}