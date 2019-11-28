<?php

$dsn = "mysql:host=localhost;charser=utf8;dbname=db111";
$pdo = new PDO($dsn, "root", "123");
session_start();

// 查詢及取得特定條件的全部資料
// select * from table where id=xxx or aaa=xxx $$ bbb=yyy
function find($table,...$arg){
    global $pdo;

    $sql = "select * from $table where ";
    if( is_array($arg[0])){
        // ["acc"=>"mack","pw"=>"1234"]
        foreach($arg[0] as $key => $value){
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }

        // tmp=["acc"="mack","pw"="1234"]

        $sql = $sql . implode(" && ", $tmp);
        // select * from table where `acc`='mack' && `pw`='123'      有加空白
        // select * from table where `acc`='mack'&&`pw`='123'        沒加空白

    }else{
        // 不是陣列的話預設是 id
        $sql = $sql . "id='" . $arg[0] . "'";
    }

    echo $sql . "<br>";
    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

print_r(find( "admin", 2));
echo "<br>";
print_r(find( "admin", ["acc"=>"root", "pw"=>"root"]));

function all( $table, ...$arg){
    global $pdo;

    $sql = "select * from $table";
    
    if( !empty( $arg[0])){
        foreach($arg[0] as $key => $value){
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql . " where " . implode(" && ",$tmp);
    }

    if(!empty( $arg[1])){
        $sql = $sql . $arg[1];
    }

    echo $sql . "<br>";
    return $pdo->query($sql)->fetchAll();
}

$rows =  all("admin");
print_r($rows);
echo "<br>";

$limit =  all("admin",[]," limit 2");
print_r($limit);

echo "<br>條件<br>";

$limit =  all("admin",['pw'=>'1234']);
print_r($limit);

echo "<br>限制筆數<br>";

$limit =  all("admin",['pw'=>'1234']," limit 1");
print_r($limit);



function nums($table, ...$arg){
    global $pdo;

    $sql = "select count(*) from $table";
    
    if( !empty( $arg[0])){
        foreach($arg[0] as $key => $value){
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }
        $sql = $sql . " where " . implode(" && ",$tmp);
    }

    if(!empty( $arg[1])){
        $sql = $sql . $arg[1];
    }

    echo $sql . "<br>";
    // fetchColumn() 選取欄，預設為第一欄
    return $pdo->query($sql)->fetchColumn();
}

echo "<br>資料表筆數<br>";
echo nums("admin");
echo "<br>資料表筆數加條件<br>";
echo nums("admin",["pw"=>"1234"]);
?>