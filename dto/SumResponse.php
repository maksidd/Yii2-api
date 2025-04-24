<?php

namespace app\dto;

/**
 * DTO for sum response
 */
class SumResponse
{
    /**
     * @var int The sum of processed numbers
     */
    public int $sum;
    
    /**
     * SumResponse constructor
     * 
     * @param int $sum The calculated sum
     */
    public function __construct(int $sum)
    {
        $this->sum = $sum;
    }
    
    /**
     * Convert DTO to array representation
     * 
     * @return array
     */
    public function toArray(): array
    {
        return [
            'sum' => $this->sum
        ];
    }
}