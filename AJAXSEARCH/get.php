<?php


try {
    $db = new PDO("mysql:host=localhost; dbname=northwind; charset=utf8", "root", "123");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}


if (isset($_POST['info'])) {


    $info = $_POST['info'];

    function ReturnInfo($db, $info)
    {


       
        $sql = $db->prepare("SELECT * FROM `customers` WHERE `ContactName` = ? ");

        $sql->bindValue(1, $info, PDO::PARAM_STR);

        $sql->execute();

        $query = $sql->fetchAll(PDO::FETCH_ASSOC);
      
        return $query;
    }

    $result1 = ReturnInfo($db, $info);

    if ($result1) {

        echo json_encode($result1);
    } else {
        die("error");
    }

}

if (isset($_POST['name'])) {


    function beforeReturnResult($db, $string)
    {


        $sql = $db->prepare("SELECT ContactName FROM `customers` WHERE `ContactName` LIKE ? ");

        $sql->bindValue(1, $string . "%", PDO::PARAM_STR);

        $sql->execute();

        $query = $sql->fetchAll(PDO::FETCH_ASSOC);
      
        return $query;
    }


    $string = $_POST['name'];


    $result = beforeReturnResult($db, $string);

    if ($result) {
 
        echo json_encode($result);
    } else {
        die("error");
    }



}
