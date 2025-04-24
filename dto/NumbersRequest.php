<?php

namespace app\dto;

use yii\base\Model;

/**
 * DTO for numbers request
 */
class NumbersRequest extends Model
{
    /**
     * @var array Array of numbers to process
     */
    public array $numbers = [];
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['numbers', 'required', 'message' => 'Numbers array is required'],
            ['numbers', 'isArrayOfNumbers'],
        ];
    }
    
    /**
     * Validate that the input is an array of numbers
     * 
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function isArrayOfNumbers($attribute, $params)
    {
        if (!is_array($this->$attribute)) {
            $this->addError($attribute, 'The input must be an array');
            return;
        }
        
        foreach ($this->$attribute as $key => $value) {
            if (!is_numeric($value)) {
                $this->addError($attribute, "The element at index $key must be a number");
            }
        }
    }
}