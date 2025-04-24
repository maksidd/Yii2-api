# Yii2 Basic API Application

This is a basic Yii2 application with a REST API endpoint to calculate the sum of even numbers in an array.

## Requirements

* PHP 8.3+
* Composer
* Docker

## Installation

1. Build the Docker image using the Dockerfile in the project's root directory. Run `sudo make up`
2. Access the application Open your browser and navigate to: http://localhost:8000

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

### Using curl

```bash
curl -X POST \
  -H "Content-Type: application/json" \
  -d '{"numbers": [1, 2, 3, 4, 5, 6]}' \
  http://localhost:8000/api/sum-even
```

## Running Tests

Inside the Docker container:

```bash
sudo docker exec -it yii2-api4 bash
```

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
