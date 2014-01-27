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


   // $str = $string. '%';
    $sql = $db->prepare("SELECT * FROM `customers` WHERE `ContactName` = ? ");

    $sql->bindValue(1, $info, PDO::PARAM_STR);

    $sql->execute();

    $query = $sql->fetchAll(PDO::FETCH_ASSOC);
  
    return $query;
}

$result1 = ReturnInfo($db, $info);

if ($result1) {
    //      foreach($result1 as $key=>$val)
    // {
    //     echo "<div><h4>contact name : ". $val['ContactName']."<h4><h5>contact title : ".$val['ContactTitle']."</h5><h5>company name  : " . $val['CompanyName'] ."</h5><p>Address : " . $val['Address'] . "</p><p>City : " . $val['City'] . "</p><p>Region : ".$val['Region'] . "</p><p>PostalCode : " .$val['PostalCode'] ."</p><p>Country : " .$val['Country'] ."</p><p>Phone : " .$val['Phone'] ."</p><p>contact title : " . $val['Fax'] . "</p></div><br><hr><br>";
    // }
    echo json_encode($result1);
} else {
    die("error");
}

}

if (isset($_POST['name'])) {


function beforeReturnResult($db, $string)
{


   // $str = $string. '%';
    $sql = $db->prepare("SELECT ContactName FROM `customers` WHERE `ContactName` LIKE ? ");

    $sql->bindValue(1, $string . "%", PDO::PARAM_STR);

    $sql->execute();

    $query = $sql->fetchAll(PDO::FETCH_ASSOC);
  
    return $query;
}


$string = $_POST['name'];


$result = beforeReturnResult($db, $string);

if ($result) {
    //     foreach($result as $key=>$val)
    // {
    //     echo '<a href="#" class="returnedNames">'.$val['ContactName'].'</a><br />';
    // }
    echo json_encode($result);
} else {
    die("error");
}



}
