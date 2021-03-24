<a href="../index.php"><- Back</a><br>
<?php
function connectDB()
{
    return new mysqli('localhost', 'root', '1234', 'amastytest');
}

function getNameAndSum($id)
{
    $mysqli = connectDB();
    $query = "SELECT
                persons.fullname,
                ROUND(100 - IFNULL((SELECT
                    SUM(transactions.amount)
                FROM transactions
                WHERE from_person_id = $id), 0) + IFNULL((SELECT
                    SUM(transactions.amount)
                FROM transactions
                WHERE to_person_id = $id), 0), 4) AS amount
            FROM persons
            WHERE persons.id = $id;";
    $result = $mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    echo 'Full name: ' . $result[0]['fullname'] . '<br>Amount: ' . $result[0]['amount'];
}

getNameAndSum(4);

echo '<br><br>';

function getUsersWithMaxTrans()
{
    $mysqli = connectDB();
    $query = "SELECT
                p.fullname,
                qty
                FROM persons p
                INNER JOIN (SELECT
                    from_person_id AS id,
                    COUNT(from_person_id) AS qty
                FROM (SELECT
                    from_person_id
                    FROM transactions
                    UNION ALL
                    SELECT
                    to_person_id
                    FROM transactions) AS t1
                GROUP BY t1.from_person_id
                HAVING qty = (SELECT
                    COUNT(from_person_id) AS qty
                    FROM (SELECT from_person_id FROM transactions
                          UNION ALL
                          SELECT to_person_id FROM transactions) AS t2
                    GROUP BY t2.from_person_id
                    ORDER BY qty DESC LIMIT 1)) AS t3
                ON p.id = t3.id
                WHERE p.id = t3.id";
    $result = $mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    if (count($result) > 1) {
        echo 'Persons with the maximum transactions ('. $result[0]['qty'] . '): <br>';
        foreach ($result as $row) {
            echo '- ' . $row['fullname'] . '<br>';
        }
    } else echo 'Person with the maximum transactions ('. $result[0]['qty'] . '): ' . $result[0]['fullname'];
}

getUsersWithMaxTrans();

echo '<br><br>';

function transWithSimilarCities() {
    $mysqli = connectDB();
    $query = "SELECT
                transactions.transaction_id,
                transactions.from_person_id,
                transactions.to_person_id,
                transactions.amount
            FROM transactions
                INNER JOIN persons persons_1
                ON persons_1.id = transactions.to_person_id
                INNER JOIN cities cities_1
                ON persons_1.city_id = cities_1.id
                INNER JOIN persons
                ON transactions.from_person_id = persons.id
                INNER JOIN cities
                ON persons.city_id = cities.id
            WHERE cities.id = cities_1.id";
    $result = $mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    foreach($result as $row) {
        echo 'Transaction ID: ' . $row['transaction_id'] . ' From: ' .  
        $row['from_person_id'] . ' To: ' . $row['to_person_id'] . ' Amount: ' . $row['amount'] . '<br>';
    }
}

transWithSimilarCities();