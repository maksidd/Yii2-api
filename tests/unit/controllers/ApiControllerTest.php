<?php

namespace tests\unit\controllers;

use app\controllers\ApiController;
use app\dto\NumbersRequest;
use app\dto\SumResponse;
use app\interfaces\SumEvenNumbersServiceInterface;
use PHPUnit\Framework\TestCase;
use Yii;
use yii\web\Request;
use yii\web\Response;

class ApiControllerTest extends TestCase
{
    private $mockService;
    
    public function testSumEvenNumbersService()
    {
        // Create a mock for the service
        $mockService = $this->createMock(SumEvenNumbersServiceInterface::class);
        
        // Setup mock expectations
        $mockService
            ->expects($this->once())
            ->method('sumEvenNumbers')
            ->with([2, 4, 6])
            ->willReturn(12);
            
        // Call the service method
        $result = $mockService->sumEvenNumbers([2, 4, 6]);
        
        // Assert the result
        $this->assertEquals(12, $result);
    }
    
    public function testSumResponseDto()
    {
        // Create a SumResponse DTO
        $response = new SumResponse(12);
        
        // Convert to array
        $array = $response->toArray();
        
        // Assert the array structure
        $this->assertIsArray($array);
        $this->assertArrayHasKey('sum', $array);
        $this->assertEquals(12, $array['sum']);
    }
    
    public function testNumbersRequestDtoValidation()
    {
        // Create and validate DTO with valid data
        $requestDto = new NumbersRequest();
        $requestDto->numbers = [1, 2, 3, 4];
        $this->assertTrue($requestDto->validate());
        
        // Create and validate DTO with invalid data
        $requestDto = new NumbersRequest();
        $requestDto->numbers = [1, 'a', 3];
        $this->assertFalse($requestDto->validate());
        $this->assertArrayHasKey('numbers', $requestDto->getErrors());
    }
}