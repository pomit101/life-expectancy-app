# Database Schema Documentation

## Overview
This document provides an overview of the database schema used for storing data related to Life Expectancy, HALE (Health Adjusted Life Expectancy), and YLL (Years of Life Lost).

## Tables

### 1. life_expectancy
- **Description**: Contains data on life expectancy per country and year.
- **Columns**:
  - `id`: INT PRIMARY KEY - Unique identifier for each record.
  - `country`: VARCHAR(100) - The name of the country.
  - `year`: INT - The year the data corresponds to.
  - `life_expectancy`: DECIMAL(5,2) - Average life expectancy in years.

#### Example Query:
```sql
SELECT * FROM life_expectancy WHERE country = 'Japan' AND year = 2023;
```

### 2. hale
- **Description**: Stores data on Health Adjusted Life Expectancy.
- **Columns**:
  - `id`: INT PRIMARY KEY - Unique identifier for each record.
  - `country`: VARCHAR(100) - The name of the country.
  - `year`: INT - The year the data corresponds to.
  - `hale`: DECIMAL(5,2) - Average healthy years lived.

#### Example Query:
```sql
SELECT * FROM hale WHERE country = 'Sweden' AND year = 2022;
```

### 3. yll
- **Description**: Contains data on Years of Life Lost due to premature death.
- **Columns**:
  - `id`: INT PRIMARY KEY - Unique identifier for each record.
  - `country`: VARCHAR(100) - The name of the country.
  - `year`: INT - The year the data corresponds to.
  - `yll`: DECIMAL(10,2) - Total years of life lost.

#### Example Query:
```sql
SELECT * FROM yll WHERE country = 'USA' AND year = 2021;
``` 

## Conclusion
This schema provides a structured way to store and retrieve data related to life expectancy, HALE, and YLL metrics, facilitating analysis and reporting.