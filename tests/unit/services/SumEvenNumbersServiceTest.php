<?php

namespace tests\unit\services;

use app\services\SumEvenNumbersService;
use PHPUnit\Framework\TestCase;

class SumEvenNumbersServiceTest extends TestCase
{
    private SumEvenNumbersService $service;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SumEvenNumbersService();
    }
    
    public function testSumEvenNumbers()
    {
        // Test with example from the requirements
        $numbers = [1, 2, 3, 4, 5, 6];
        $result = $this->service->sumEvenNumbers($numbers);
        $this->assertEquals(12, $result, "Sum of even numbers should be 12");
        
        // Test with only even numbers
        $numbers = [2, 4, 6, 8];
        $result = $this->service->sumEvenNumbers($numbers);
        $this->assertEquals(20, $result, "Sum of even numbers should be 20");
        
        // Test with only odd numbers
        $numbers = [1, 3, 5, 7];
        $result = $this->service->sumEvenNumbers($numbers);
        $this->assertEquals(0, $result, "Sum of even numbers should be 0");
        
        // Test with empty array
        $numbers = [];
        $result = $this->service->sumEvenNumbers($numbers);
        $this->assertEquals(0, $result, "Sum of even numbers for empty array should be 0");
        
        // Test with negative numbers
        $numbers = [-2, -4, 1, 3];
        $result = $this->service->sumEvenNumbers($numbers);
        $this->assertEquals(-6, $result, "Sum of even numbers should be -6");
    }
}