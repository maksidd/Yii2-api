<?php

namespace app\services;

use app\interfaces\SumEvenNumbersServiceInterface;

/**
 * Service to calculate the sum of even numbers
 */
class SumEvenNumbersService implements SumEvenNumbersServiceInterface
{
    /**
     * Calculate the sum of even numbers in the given array
     * 
     * @param array $numbers The array of numbers to process
     * @return int The sum of all even numbers in the array
     */
    public function sumEvenNumbers(array $numbers): int
    {
        $sum = 0;
        
        foreach ($numbers as $number) {
            // Check if the number is even (divisible by 2)
            if ($number % 2 === 0) {
                $sum += $number;
            }
        }
        
        return $sum;
    }
}