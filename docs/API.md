# 🔌 API Documentation

REST API Endpoints สำหรับ Life Expectancy Statistics System

---

## Base URL
```
http://localhost/life-expectancy-app/public/api/
```

---

## Authentication (Future Feature)

ปัจจุบัน API ยังไม่มีการยืนยันตัวตน แต่จะเพิ่มในเวอร์ชันถัดไป

---

## Response Format

### Success Response (200 OK)
```json
{
    "success": true,
    "data": { ... },
    "message": "Operation successful"
}
```

### Error Response
```json
{
    "success": false,
    "error": "Error message",
    "code": 400
}
```

---

## Endpoints

### 1️⃣ Get Life Expectancy (LE)

**GET** `/metrics/le`

**Parameters:**
- `country` (required) - Country code (e.g., TH, US, JP)
- `year` (required) - Year (e.g., 2024)

**Example Request:**
```
GET /api/metrics/le?country=TH&year=2024
```

**Response:**
```json
{
    "success": true,
    "data": {
        "country": "Thailand",
        "year": 2024,
        "life_expectancy": 77.5,
        "unit": "years"
    }
}
```

---

### 2️⃣ Get HALE (Health Adjusted Life Expectancy)

**GET** `/metrics/hale`

**Parameters:**
- `country` (required)
- `year` (required)

**Example Request:**
```
GET /api/metrics/hale?country=TH&year=2024
```

**Response:**
```json
{
    "success": true,
    "data": {
        "country": "Thailand",
        "year": 2024,
        "hale": 67.3,
        "disability_adjusted": 10.2,
        "unit": "years"
    }
}
```

---

### 3️⃣ Get Years Lost (YLL)

**GET** `/metrics/yll`

**Parameters:**
- `country` (required)
- `year` (required)

**Example Request:**
```
GET /api/metrics/yll?country=TH&year=2024
```

**Response:**
```json
{
    "success": true,
    "data": {
        "country": "Thailand",
        "year": 2024,
        "years_lost": 2500,
        "unit": "years"
    }
}
```

---

### 4️⃣ Get All Metrics

**GET** `/metrics/all`

**Parameters:**
- `country` (required)
- `year` (required)

**Example Request:**
```
GET /api/metrics/all?country=TH&year=2024
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "country": "Thailand",
        "year": 2024,
        "life_expectancy": 77.5,
        "hale": 67.3,
        "years_lost": 2500,
        "disability_rate": 5.2,
        "created_at": "2024-04-07T10:30:00Z"
    }
}
```

---

### 5️⃣ Compare Countries

**GET** `/metrics/compare`

**Parameters:**
- `countries` (required) - Comma-separated list (e.g., TH,US,JP)
- `year` (required)

**Example Request:**
```
GET /api/metrics/compare?countries=TH,US,JP&year=2024
```

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "country": "Japan",
            "year": 2024,
            "life_expectancy": 84.3,
            "hale": 74.9,
            "rank": 1
        },
        {
            "country": "USA",
            "year": 2024,
            "life_expectancy": 78.2,
            "hale": 68.1,
            "rank": 2
        },
        {
            "country": "Thailand",
            "year": 2024,
            "life_expectancy": 77.5,
            "hale": 67.3,
            "rank": 3
        }
    ]
}
```

---

### 6️⃣ Get Trend Data

**GET** `/metrics/trend`

**Parameters:**
- `country` (required)
- `metric` (optional) - le, hale, yll (default: le)
- `years` (optional) - Number of years to retrieve (default: 10)

**Example Request:**
```
GET /api/metrics/trend?country=TH&metric=life_expectancy&years=10
```

**Response:**
```json
{
    "success": true,
    "data": [
        {"year": 2015, "value": 74.2},
        {"year": 2016, "value": 74.5},
        {"year": 2017, "value": 74.8},
        {"year": 2024, "value": 77.5}
    ]
}
```

---

### 7️⃣ Generate Report

**POST** `/reports/generate`

**Request Body:**
```json
{
    "report_type": "LE",
    "country": "Thailand",
    "year": 2024,
    "generated_by": "admin@example.com"
}
```

**Valid report_type values:**
- `LE` - Life Expectancy Report
- `HALE` - HALE Report
- `YLL` - Years Lost Report
- `COMPARISON` - Comparison Report

**Response (201 Created):**
```json
{
    "success": true,
    "message": "Report generated successfully",
    "data": {
        "report_id": 1,
        "title": "Life Expectancy Report - Thailand (2024)",
        "generated_at": "2024-04-07T10:30:00Z"
    }
}
```

---

### 8️⃣ Get Report by ID

**GET** `/reports/{id}`

**Example Request:**
```
GET /api/reports/1
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "Life Expectancy Report - Thailand (2024)",
        "report_type": "LE",
        "country": "Thailand",
        "year": 2024,
        "generated_at": "2024-04-07T10:30:00Z",
        "generated_by": "admin",
        "data": { ... }
    }
}
```

---

### 9️⃣ Get All Reports

**GET** `/reports`

**Parameters:**
- `limit` (optional) - Results per page (default: 20)
- `page` (optional) - Page number (default: 1)

**Example Request:**
```
GET /api/reports?limit=10&page=1
```

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Life Expectancy Report - Thailand (2024)",
            "report_type": "LE",
            "generated_at": "2024-04-07T10:30:00Z"
        }
    ],
    "pagination": {
        "total": 50,
        "limit": 10,
        "page": 1,
        "pages": 5
    }
}
```

---

### 🔟 Delete Report

**DELETE** `/reports/{id}`

**Example Request:**
```
DELETE /api/reports/1
```

**Response:**
```json
{
    "success": true,
    "message": "Report deleted successfully"
}
```

---

## Error Codes

| Code | Description |
|------|-------------|
| 200 | OK - Request successful |
| 201 | Created - Resource created |
| 400 | Bad Request - Invalid parameters |
| 404 | Not Found - Resource not found |
| 500 | Internal Server Error |

---

## Rate Limiting (Future)

```
Limit: 100 requests per hour per IP
```

---

## Example Usage (JavaScript)

```javascript
// Get LE for Thailand 2024
fetch('/api/metrics/le?country=TH&year=2024')
    .then(response => response.json())
    .then(data => console.log(data));

// Compare countries
fetch('/api/metrics/compare?countries=TH,US,JP&year=2024')
    .then(response => response.json())
    .then(data => console.log(data));

// Get trend data
fetch('/api/metrics/trend?country=TH&years=10')
    .then(response => response.json())
    .then(data => console.log(data));

// Generate report
fetch('/api/reports/generate', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        report_type: 'LE',
        country: 'Thailand',
        year: 2024
    })
})
.then(response => response.json())
.then(data => console.log(data));
```

---

## Example Usage (PHP)

```php
// Get LE
$url = 'http://localhost/life-expectancy-app/public/api/metrics/le?country=TH&year=2024';
$response = file_get_contents($url);
$data = json_decode($response, true);

echo $data['data']['life_expectancy']; // 77.5

// Generate report
$ch = curl_init('http://localhost/life-expectancy-app/public/api/reports/generate');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'report_type' => 'LE',
    'country' => 'Thailand',
    'year' => 2024
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($ch);
$data = json_decode($response, true);
```

---

## CORS Configuration

สำหรับใช้ API จากโดเมนอื่น:

```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
```

---

**Last Updated:** 2024-04-07 15:40:34 UTC  
**API Version:** 1.0.0 (Beta)