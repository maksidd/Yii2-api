<?php

namespace tests\unit\dto;

use app\dto\NumbersRequest;
use Yii;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for NumbersRequest DTO
 */
class NumbersRequestTest extends TestCase
{
    public function testValidation()
    {
        // Valid input
        $dto = new NumbersRequest();
        $dto->numbers = [1, 2, 3, 4];
        $this->assertTrue($dto->validate(), "Valid array should pass validation");
        $this->assertEmpty($dto->getErrors(), "There should be no validation errors");
        
        // Empty array
        $dto = new NumbersRequest();
        $dto->numbers = [];
        $this->assertFalse($dto->validate(), "Empty array should fail validation because it's required");
        $this->assertArrayHasKey('numbers', $dto->getErrors(), "The numbers field should have errors");
        
        // Non-numeric values
        $dto = new NumbersRequest();
        $dto->numbers = [1, 'a', 3];
        $this->assertFalse($dto->validate(), "Array with non-numeric values should fail validation");
        $this->assertNotEmpty($dto->getErrors(), "There should be validation errors");
        $this->assertArrayHasKey('numbers', $dto->getErrors(), "The numbers field should have errors");
        
        // Null input - we know this will actually throw a TypeError in PHP 8.3 
        // since we declared numbers as an array, so we'll skip this test
        // and rely on our API controller to catch the error
    }
}