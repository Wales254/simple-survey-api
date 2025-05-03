# Simple Survey API

## Overview
This is the backend for the Simple Survey Application built using PHP and MySQL.

## Requirements
- PHP >= 7.4
- MySQL
- Apache Server (e.g., XAMPP/WAMP)
- Postman (for testing)

## Setup Instructions
1. Clone the repo:
   git clone https://github.com/yourusername/simple-survey-api.git

2. Import `database.sql` into your MySQL server.

3. Update DB credentials in the config file (`db.php` or similar).

4. Start Apache and MySQL via XAMPP.

5. Place the project in your `htdocs` directory and access it via:
   http://localhost/simple-survey-api/submit_response.php

## Postman Collection
- Use the attached collection `postman_collection.json` to test the endpoints.

## ERD
- Located in `/docs/survey_erd.png`

## Endpoints
- `POST /submit_response.php` - Submits survey response
- `GET /responses.php` - Lists all responses (with filters)

## Deployment (Optional)
The backend is hosted at: [https://yourapi.example.com](https://yourapi.example.com)
