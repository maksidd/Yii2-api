<?php

namespace tests\unit\dto;

use app\dto\SumResponse;
use Yii;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for SumResponse DTO 
 */
class SumResponseTest extends TestCase
{
    public function testConstruction()
    {
        $response = new SumResponse(10);
        $this->assertEquals(10, $response->sum, "Sum value should be set in constructor");
    }
    
    public function testToArray()
    {
        $response = new SumResponse(42);
        $array = $response->toArray();
        
        $this->assertIsArray($array, "toArray should return an array");
        $this->assertArrayHasKey('sum', $array, "Array should have 'sum' key");
        $this->assertEquals(42, $array['sum'], "Sum value should be preserved");
    }
}