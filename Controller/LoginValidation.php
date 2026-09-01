<?php

include "../Model/db.php";

session_start();

$name = "";
$password = "";
$message = "";
$remember = false;

if(isset($_COOKIE["remember_user"]))
{
    $name = $_COOKIE["remember_user"];
    $remember = true;
}

$valid = true;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST["name"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $remember = isset($_POST["remember"]) && $_POST["remember"] === "1";

    if(empty($name) || strlen($name) < 5)
    {
        $message = "User Name Must be at least 5 Char";
        $valid = false;
    }

    if(empty($password) || strlen($password) < 5)
    {
        $message = "Password Must be at least 5 Char";
        $valid = false;
    }

    if($valid)
    {
        $database = new db();
        $connection = $database->connection();

        $result = $database->login($connection, "users", $name);

        if($result->num_rows > 0)
        {
            $user = $result->fetch_assoc();

            if(password_verify($password, $user["password"]))
            {
                $_SESSION["logged_in"] = true;
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["user_id"] = $user["id"];

                if($remember)
                {
                    setcookie("remember_user", $name, time() + 86400 * 30, "/");
                }
                else
                {
                    setcookie("remember_user", "", time() - 3600, "/");
                }

                if($user["role"] == "Member")
                {
                    Header("Location:../View/User1/dashboard.php");
                    exit();
                }
                else if($user["role"] == "Trainer")
                {
                    Header("Location:../View/User2/dashboard.php");
                    exit();
                }
                else if($user["role"] == "Admin")
                {
                    Header("Location:../View/User3/dashboard.php");
                    exit();
                }
            }
            else
            {
                $message = "Invalid Password";
            }
        }
        else
        {
            $message = "User Name Not Found";
        }
    }
}

?>
