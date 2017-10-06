<?php
$pdo = new PDO("mysql:host=localhost;dbname=work", 'root', '111111');
//$pdo->exec("set names utf8");
if ($pdo) {
    echo 'ok<br>';
}

//$sql = "SELECT f.col4 FROM mytable f LEFT JOIN database000 d ON f.col4 = d.email WHERE f.col4 = d.email";
//
//$stmt = $pdo->prepare($sql);
//$stmt->execute();
//$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($res);
//
//foreach ($res as $row) {
//    $stmt = $pdo->prepare("DELETE FROM mytable WHERE col4 = ?");
//    $stmt->execute([$row['email']]);
//}
//
//
//$sql = "SELECT * FROM mytable";
//$sql2 = "SELECT col4 FROM mytable GROUP BY col4";
//$stmt = $pdo->prepare($sql);
//$stmt->execute();
//$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($res);

//foreach ($res as $row) {
//    $stmt2 = $pdo->prepare("SELECT * FROM mytable WHERE col4 = ?");
//    $stmt2->execute([$row['col4']]);
//    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
//    foreach ($result as $mail) {
//        $stmt = $pdo->prepare("INSERT INTO filter (name, surname, email) VALUES (?, ?, ?)");
//        $stmt->execute([
//            $row['col2'],
//            $row['col3'],
//            $row['col4']
//        ]);

//        $stmt3 = $pdo->prepare("DELETE FROM mytable WHERE col4 = ?");
//        $stmt3->execute($mail['col4']);
//    }
//}

//2844

//$stmt = $pdo->prepare("SELECT * FROM filter");
//$stmt->execute();
//$res2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($res);

//foreach ($res2 as $row2) {
//    foreach ($res as $row) {
//        if ($row2['email'] == $row['col4']) {
//            $stmt = $pdo->prepare("UPDATE filter SET name = :name, surname = :surname WHERE email = :email");
//            $rrr = $stmt->execute([
//                ':email' => $row2['email'],
//                ':name' => $row['col2'],
//                ':surname' => $row['col3']
//            ]);
//            var_dump($rrr);
//            break ;
//        }
//    }
//}