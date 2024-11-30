<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Get query parameters
$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? 'countries';

if ($lookup === 'cities') {
    // Query for cities
    $stmt = $conn->prepare("
        SELECT cities.name AS city_name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");
    $stmt->execute(['country' => "%$country%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the cities in an HTML table
    echo "<table border='1' cellpadding='5' cellspacing='0'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($results as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['city_name']) . "</td>
                <td>" . htmlspecialchars($row['district']) . "</td>
                <td>" . htmlspecialchars($row['population']) . "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    // Query for countries
    $stmt = $conn->prepare("
        SELECT * FROM countries WHERE name LIKE :country
    ");
    $stmt->execute(['country' => "%$country%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the countries in an HTML table
    echo "<table border='1' cellpadding='5' cellspacing='0'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>";
    foreach ($results as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['continent']) . "</td>
                <td>" . htmlspecialchars($row['independence_year'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($row['head_of_state'] ?? 'N/A') . "</td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>
