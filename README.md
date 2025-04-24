# Yii2 Basic API Application

This is a basic Yii2 application with a REST API endpoint to calculate the sum of even numbers in an array.

## Requirements

* PHP 8.3+
* Composer

## Installation

1. Clone the repository
2. Run `composer install`
3. Make the `yii` file executable: `chmod +x ./yii`
4. Start the development server: `php -S 0.0.0.0:5000 -t web`

## Project Structure

```
├── assets/                  # Asset bundles
├── config/                  # Application configurations
├── controllers/             # Controller classes
│   ├── ApiController.php    # API endpoint controller
│   └── SiteController.php   # Web UI controller
├── dto/                     # Data Transfer Objects
│   ├── NumbersRequest.php   # DTO for API request
│   └── SumResponse.php      # DTO for API response
├── interfaces/              # Interfaces
│   └── SumEvenNumbersServiceInterface.php
├── models/                  # Model classes
├── runtime/                 # Runtime data
├── services/                # Service classes
│   └── SumEvenNumbersService.php
├── tests/                   # Tests
│   └── unit/                # Unit tests
│       ├── controllers/     # Controller tests
│       ├── dto/             # DTO tests
│       └── services/        # Service tests
├── views/                   # View templates
│   ├── layouts/             # Layout templates
│   └── site/                # View templates for SiteController
├── web/                     # Web accessible files
│   ├── assets/              # Published asset bundles
│   ├── css/                 # CSS files
│   └── index.php            # Entry script
└── widgets/                 # Widget classes
    └── Alert.php            # Alert widget
```

## API Documentation

### Calculate the Sum of Even Numbers

**Endpoint:** `POST /api/sum-even`

**Content-Type:** `application/json`

**Request Body:**
```json
{
  "numbers": [1, 2, 3, 4, 5, 6]
}
```

**Successful Response (200 OK):**
```json
{
  "sum": 12
}
```

**Error Response (400 Bad Request):**
```json
{
  "errors": {
    "numbers": ["The input must be an array"]
  }
}
```

## Usage Examples

### Using the test script

A convenient test script is included to test the API:

```bash
# Test with default values [1,2,3,4,5,6]
php test-api.php

# Test with custom values
php test-api.php 2,4,6,8,10
```

### Using curl

```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"numbers": [1, 2, 3, 4, 5, 6]}' \
  http://localhost:5000/api/sum-even
```

### Using PHP

```php
$data = json_encode(['numbers' => [1, 2, 3, 4, 5, 6]]);

$ch = curl_init('http://localhost:5000/api/sum-even');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data)
]);

$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);
echo "Sum of even numbers: " . $response['sum'];
```

### Using JavaScript

```javascript
fetch('http://localhost:5000/api/sum-even', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    numbers: [1, 2, 3, 4, 5, 6]
  })
})
.then(response => response.json())
.then(data => {
  console.log('Sum of even numbers:', data.sum);
})
.catch(error => {
  console.error('Error:', error);
});
```

## Running Tests

Run all PHPUnit tests:

```bash
./vendor/bin/phpunit
```

Or run specific test suites:

```bash
# Test DTO classes
./vendor/bin/phpunit tests/unit/dto/

# Test controllers
./vendor/bin/phpunit tests/unit/controllers/

# Test services
./vendor/bin/phpunit tests/unit/services/

# Test individual files
./vendor/bin/phpunit tests/unit/services/SumEvenNumbersServiceTest.php
```

The tests are organized as follows:

- **DTO Tests**: Validate the data transfer objects work correctly
- **Service Tests**: Verify the business logic for calculating even number sums
- **Controller Tests**: Ensure the API endpoints handle requests/responses properly