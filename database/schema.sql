-- Schema for populations table
CREATE TABLE populations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    year INT NOT NULL,
    country VARCHAR(100) NOT NULL,
    population BIGINT NOT NULL
);

-- Schema for mortality_data table
CREATE TABLE mortality_data (
    id INT PRIMARY KEY AUTO_INCREMENT,
    year INT NOT NULL,
    country VARCHAR(100) NOT NULL,
    total_deaths INT NOT NULL,
    infant_mortality_rate FLOAT NOT NULL
);

-- Schema for health_statistics table
CREATE TABLE health_statistics (
    id INT PRIMARY KEY AUTO_INCREMENT,
    year INT NOT NULL,
    country VARCHAR(100) NOT NULL,
    life_expectancy FLOAT NOT NULL,
    hale FLOAT NOT NULL,
    yll INT NOT NULL
);

-- Schema for reports table
CREATE TABLE reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    report_date DATETIME NOT NULL,
    content TEXT NOT NULL
);
