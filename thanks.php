<?php

$DBSERVER = "localhost";

$DBUSER = "root";

$DBPASSWORD = "";

$DBNAME = "assignment_form";

$db = new PDO("mysql:host=$DBSERVER;dbname=$DBNAME;charset=utf8", $DBUSER, $DBPASSWORD);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


if($_SERVER["REQUEST_METHOD"] === "GET"){
    $user_code = $_GET['user_code'];
}



?>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
                ■仮想すぎる通貨
            </div>
            <div>
                <div>ご注文ありがとうございます。</div>
                <div>登録されたユーザー情報：<?php echo $user_code; ?></div>
                
            </div>
    
    </body> 
</html>