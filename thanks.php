<?php

$DBSERVER = "localhost";

$DBUSER = "root";

$DBPASSWORD = "";

$DBNAME = "assignment_form";

$db = new PDO("mysql:host=$DBSERVER;dbname=$DBNAME;charset=utf8", $DBUSER, $DBPASSWORD);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// データを挿入してから、データを抽出する時の挙動（POSTで渡す）
if($_SERVER["REQUEST_METHOD"] === "POST"){
    
}


?>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="">
            <div>
                ■仮想すぎる通貨
            </div>
            <div>
                <div>ご注文ありがとうございます。</div>
                <div>登録されたユーザー情報：<?php echo htmlspecialchars($user_code, ENT_QUOTES, 'UTF-8'); ?></div>
                
            </div>
        </form>
    </body> 
</html>