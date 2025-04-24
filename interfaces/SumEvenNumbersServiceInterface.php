<?php

namespace app\interfaces;

/**
 * Interface for a service that calculates the sum of even numbers in an array
 */
interface SumEvenNumbersServiceInterface
{
    /**
     * Calculate the sum of even numbers in the given array
     * 
     * @param array $numbers The array of numbers to process
     * @return int The sum of all even numbers in the array
     */
    public function sumEvenNumbers(array $numbers): int;
}