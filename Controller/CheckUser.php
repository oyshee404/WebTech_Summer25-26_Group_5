<?php

include "../Model/db.php";

$username = trim($_POST["username"] ?? "");

if(empty($username))
{
    echo "Username Required";
}
else
{
    $database = new db();
    $connection = $database->connection();

    $result = $database->CheckUser($connection, "users", $username);

    if($result->num_rows > 0)
    {
        echo "User Name Already Taken";
    }
    else
    {
        echo "User Name Available";
    }
}

?>
