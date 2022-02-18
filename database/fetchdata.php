<?php
include '../database/connect.php';

function fetchResultAssoc($sql)
{
    global $conn;
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
    return $result;
}

function fetchResultArray($sql)
{
    global $conn;
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    return $result;
}
?>
