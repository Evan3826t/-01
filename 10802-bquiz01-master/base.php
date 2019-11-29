<?php

$dsn = "mysql:host=localhost;charset=utf8;dbname=db111";
$pdo = new PDO($dsn, "root", "123");

// 啟用 session
session_start();

if(empty($_SESSION['total'])){
    $total = find("total",1);
    $total['total']++;
    $_SESSION['total'] = $total['total'];
    save("total", $total);
}

// 資料表要開空值，如果沒開給空值會錯誤
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

    return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

// print_r(find( "admin", 2));
// echo "<br>";
// print_r(find( "admin", ["acc"=>"aaa", "pw"=>"123"]));

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

    // echo "<br>" .$sql . "<br>";
    return $pdo->query($sql)->fetchAll();
}

// $rows =  all("admin");
// print_r($rows);
// echo "<br>";

// $limit =  all("admin",[]," limit 2");
// print_r($limit);

// echo "<br>條件<br>";

// $limit =  all("admin",[ 'acc'=>'aaa','pw'=>'123']);
// print_r($limit);

// echo "<br>限制筆數<br>";

// $limit =  all("admin",['pw'=>'1234']," limit 1");
// print_r($limit);



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

    // echo $sql . "<br>";
    // fetchColumn() 選取欄，預設為第一欄
    return $pdo->query($sql)->fetchColumn();
}

// echo "<br><br>資料表筆數<br>";
// echo nums("admin");
// echo "<br><br>資料表筆數加條件<br>";
// echo nums("admin",["pw"=>"1234"]);


// 簡化 $pdo->query($sql)->fetchAll(); 
function q($sql){
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}

// 刪除特定 id 或符合條件的資料
function del($table, ...$arg){
    global $pdo;
    $sql = "DELETE FROM $table WHERE ";
    if(is_array($arg[0])){
        foreach($arg[0] as $key => $value){
            $tmp[] = sprintf("`%s`='%s'", $key, $value);
        }

        $sql = $sql . implode(" && ", $tmp); 
    }else{
        $sql = $sql . "`id`=$arg[0]";
    }
    // echo $sql."<br>";
    return $pdo->exec($sql);
}

// echo "<br><br>刪除資料指定id<br>";
// del("admin", 5);
// echo "<br><br>刪除資料指定元素<br><br>";
// del("admin", ["acc"=>"bbb"]);
// echo "<br>";

function to( $path){
    header("location:".$path);

}

// to("https://google.com.tw");


function save($table, $data){
    global $pdo;
    
    if(!empty($data['id'])){
        // update
        foreach($data as $key => $value){
            if( $key != "id"){
                $tmp[] = sprintf("`%s`='%s'", $key, $value);
            }
        }
        $sql = " UPDATE $table SET " . implode(",", $tmp) . "  WHERE  `id`=" . $data['id'];
    }else{
        // insert
        $key="`" . implode("`,`",array_keys($data)) . "`";
        $value="'" . implode("','",$data) . "'";
        $sql = " INSERT INTO $table ($key) VALUES ($value)";
    }
    // echo $sql;
    return $pdo->exec($sql);
}

// echo "Save update<br>";
// save("admin",find( "admin", 2));
// echo "<br><br>";
// echo "Save insert<br>";
// $data=[ "acc" => "zxc", "pw" => "456"];
// save("admin", $data);
?>