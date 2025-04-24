<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;
use app\dto\NumbersRequest;
use app\dto\SumResponse;
use app\interfaces\SumEvenNumbersServiceInterface;
use app\services\SumEvenNumbersService;

/**
 * API controller for numeric operations
 */
class ApiController extends Controller
{
    /**
     * @var SumEvenNumbersServiceInterface Service for calculating sum of even numbers
     */
    private SumEvenNumbersServiceInterface $sumEvenNumbersService;
    
    /**
     * @inheritdoc
     */
    public function __construct($id, $module, SumEvenNumbersServiceInterface $sumEvenNumbersService = null, $config = [])
    {
        // Set default implementation if none provided
        $this->sumEvenNumbersService = $sumEvenNumbersService ?? new SumEvenNumbersService();
        parent::__construct($id, $module, $config);
    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        // Set the response format to JSON
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        
        return $behaviors;
    }
    
    /**
     * Calculate sum of even numbers
     * 
     * @return array Response data
     */
    public function actionSumEven()
    {
        // Set response format to JSON
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        try {
            // Get input data
            $inputData = Yii::$app->request->getBodyParam('numbers', []);
            
            // Make sure we have valid input before trying to assign to the DTO
            if (!is_array($inputData)) {
                Yii::$app->response->statusCode = 400;
                return ['errors' => ['numbers' => ['The input must be an array']]];
            }
            
            // Create and validate DTO from request
            $requestDto = new NumbersRequest();
            $requestDto->numbers = $inputData;
            
            if (!$requestDto->validate()) {
                Yii::$app->response->statusCode = 400;
                return ['errors' => $requestDto->getErrors()];
            }
            
            // Process data and create response DTO
            $sum = $this->sumEvenNumbersService->sumEvenNumbers($requestDto->numbers);
            $responseDto = new SumResponse($sum);
            
            return $responseDto->toArray();
        } catch (\Throwable $e) {
            // Log the error
            Yii::error('Error in sum-even endpoint: ' . $e->getMessage(), 'api');
            
            // Return error response
            Yii::$app->response->statusCode = 500;
            return [
                'error' => 'An error occurred while processing your request',
                'message' => YII_DEBUG ? $e->getMessage() : null
            ];
        }
    }
}