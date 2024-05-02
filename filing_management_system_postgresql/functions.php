<?php
date_default_timezone_set('Asia/Jakarta');

$conn = pg_connect("host=localhost dbname=filing_management_system user=root password=");

function query($query)
{
    global $conn;
    $result = pg_query($conn, $query);
    $rows = [];
    while ($row = pg_fetch_assoc($result)) {
        $rows[] = $row;
    };
    return $rows;
};
?>