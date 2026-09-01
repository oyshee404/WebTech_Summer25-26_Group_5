<?php

class db
{
    function connection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "gymmanagement";

        $connection = new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_name
        );

        if($connection->connect_error)
        {
            die("Please connect the Database");
        }

        return $connection;
    }

    function signup($connection, $tablename, $name, $email, $gender, $phone, $dob, $membership, $address, $username, $password, $role)
    {
        $sql = "INSERT INTO ".$tablename."
        (name, email, gender, phone, dob, membership, address, username, password, role)
        VALUES
        ('".$name."', '".$email."', '".$gender."', '".$phone."', '".$dob."',
        '".$membership."', '".$address."', '".$username."', '".$password."', '".$role."')";

        return $connection->query($sql);
    }

    function login($connection, $tablename, $username)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE username='".$username."'";
        return $connection->query($sql);
    }

    function CheckUser($connection, $tablename, $username)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE username='".$username."'";
        return $connection->query($sql);
    }

    function getUser($connection, $tablename, $username)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE username='".$username."'";
        $result = $connection->query($sql);

        if($result && $result->num_rows > 0)
        {
            return $result->fetch_assoc();
        }

        return false;
    }

    function updateProfile($connection, $tablename, $username, $name, $email, $phone, $address, $specialty)
    {
        $sql = "UPDATE ".$tablename."
        SET name='".$name."', email='".$email."', phone='".$phone."',
        address='".$address."', specialty='".$specialty."'
        WHERE username='".$username."'";

        return $connection->query($sql);
    }

    function updatePassword($connection, $tablename, $username, $password)
    {
        $sql = "UPDATE ".$tablename."
        SET password='".$password."'
        WHERE username='".$username."'";

        return $connection->query($sql);
    }

    function deleteUser($connection, $tablename, $username)
    {
        $sql = "DELETE FROM ".$tablename." WHERE username='".$username."'";
        return $connection->query($sql);
    }

    function getMembers($connection, $tablename)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE role='Member'";
        return $connection->query($sql);
    }

    function getTrainers($connection, $tablename)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE role='Trainer'";
        return $connection->query($sql);
    }

    function getPlans($connection, $tablename)
    {
        $sql = "SELECT * FROM ".$tablename." ORDER BY id";
        return $connection->query($sql);
    }

    function getPlan($connection, $tablename, $plan)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE name='".$plan."'";
        $result = $connection->query($sql);

        if($result && $result->num_rows > 0)
        {
            return $result->fetch_assoc();
        }

        return false;
    }

    function getSchedule($connection, $tablename, $trainer_id)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE trainer_id='".$trainer_id."' ORDER BY schedule_date, time";
        return $connection->query($sql);
    }

    function getMemberSchedules($connection, $tablename, $member_id)
    {
        $sql = "SELECT schedules.*, users.name AS trainer_name
        FROM ".$tablename." schedules
        INNER JOIN users ON schedules.trainer_id=users.id
        WHERE schedules.member_id='".$member_id."'
        ORDER BY schedules.schedule_date, schedules.time";

        return $connection->query($sql);
    }

    function getScheduleCount($connection, $tablename, $trainer_id)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE trainer_id='".$trainer_id."'";
        $result = $connection->query($sql);

        if($result)
        {
            return $result->num_rows;
        }

        return 0;
    }

    function getCompletedSessionCount($connection, $tablename, $trainer_id)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE trainer_id='".$trainer_id."' AND status='Completed'";
        $result = $connection->query($sql);

        if($result)
        {
            return $result->num_rows;
        }

        return 0;
    }

    function getMemberCompletedSessionCount($connection, $tablename, $member_id)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE member_id='".$member_id."' AND status='Completed'";
        $result = $connection->query($sql);

        if($result)
        {
            return $result->num_rows;
        }

        return 0;
    }

    function getAssignedMembers($connection, $memberTable, $assignmentTable, $trainer_id)
    {
        $sql = "SELECT users.* FROM ".$memberTable." users
        INNER JOIN ".$assignmentTable." assignments
        ON users.id=assignments.member_id
        WHERE assignments.trainer_id='".$trainer_id."'";

        return $connection->query($sql);
    }

    function assignTrainer($connection, $tablename, $member_id, $trainer_id)
    {
        $check = "SELECT * FROM ".$tablename." WHERE member_id='".$member_id."'";
        $result = $connection->query($check);

        if($result && $result->num_rows > 0)
        {
            $sql = "UPDATE ".$tablename." SET trainer_id='".$trainer_id."' WHERE member_id='".$member_id."'";
        }
        else
        {
            $sql = "INSERT INTO ".$tablename." (member_id, trainer_id)
            VALUES ('".$member_id."', '".$trainer_id."')";
        }

        return $connection->query($sql);
    }

    function getAssignedTrainer($connection, $tablename, $member_id)
    {
        $sql = "SELECT users.* FROM users
        INNER JOIN ".$tablename." assignments
        ON users.id=assignments.trainer_id
        WHERE assignments.member_id='".$member_id."'";

        $result = $connection->query($sql);

        if($result && $result->num_rows > 0)
        {
            return $result->fetch_assoc();
        }

        return false;
    }

    function addPlan($connection, $tablename, $name, $duration, $facilities, $price)
    {
        $sql = "INSERT INTO ".$tablename."
        (name, duration, facilities, price)
        VALUES
        ('".$name."', '".$duration."', '".$facilities."', '".$price."')";

        return $connection->query($sql);
    }

    function deletePlan($connection, $tablename, $id)
    {
        $sql = "DELETE FROM ".$tablename." WHERE id='".$id."'";
        return $connection->query($sql);
    }

    function addSchedule($connection, $tablename, $trainer_id, $member_id, $schedule_date, $time, $activity)
    {
        $sql = "INSERT INTO ".$tablename."
        (trainer_id, member_id, schedule_date, time, activity, status)
        VALUES
        ('".$trainer_id."', '".$member_id."', '".$schedule_date."', '".$time."', '".$activity."', 'Scheduled')";

        return $connection->query($sql);
    }

    function completeSchedule($connection, $tablename, $schedule_id, $member_id)
    {
        $sql = "UPDATE ".$tablename."
        SET status='Completed'
        WHERE id='".$schedule_id."' AND member_id='".$member_id."'";

        return $connection->query($sql);
    }

    function deleteSchedule($connection, $tablename, $id)
    {
        $sql = "DELETE FROM ".$tablename." WHERE id='".$id."'";
        return $connection->query($sql);
    }

    function countRole($connection, $tablename, $role)
    {
        $sql = "SELECT * FROM ".$tablename." WHERE role='".$role."'";
        $result = $connection->query($sql);

        if($result)
        {
            return $result->num_rows;
        }

        return 0;
    }
}

?>
