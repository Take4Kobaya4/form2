<?php
$DBSERVER = "localhost";

$DBUSER = "root";

$DBPASSWORD = "";

$DBNAME = "assignment_form";

$db = new PDO("mysql:host=$DBSERVER;dbname=$DBNAME;charset=utf8", $DBUSER, $DBPASSWORD);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if(isset($_GET['order_date_start']) && isset($_GET['order_date_end'])){
    // GETでの値を表示
    $order_date_start = date("Y/m/d", strtotime($_GET['order_date_start']));
    $order_date_end = date("Y/m/d", strtotime($_GET['order_date_end']));

    $stmt = $db->query("SELECT A.order_date, B.product_name, B.product_price, A.product_qty, 
    (B.product_price * A.product_qty) AS purchase_price, A.user_code 
    FROM t_order AS A
    JOIN m_product AS B
    ON A.product_code = B.product_code
    WHERE A.user_code = :user_code, 
    order_date BETWEEN '$order_date_start' AND '$order_date_end'
    ORDER BY A.order_id");
    $stmt->bindValue(':order_date_start', $order_date_start);
    $stmt->bindValue(':order_date_end', $order_date_end);
    $stmt->bindValue(':user_code', $user_code);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
}



//購入履歴一覧をクエリで実行（ユーザー毎） 


?>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <div>
            ■仮想すぎる通貨：ユーザー詳細
        </div>
        <div>
            <form action="" method="GET">
                <div>購入日検索：<input type="text" name="order_date_start" value="<?php if(isset($_GET['order_date_start'])){{ echo $_GET['order_date_start']; }} ?>" size="6"> ～ <input type="text" name="order_date_end" value="<?php if(isset($_GET['order_date_end'])){{ echo $_GET['order_date_end']; }} ?>" size="6"></div>
                <div><input type="submit" name="search" value=" 検索 "></div>
            </form>
        </div>
        <div>
            ■購入履歴一覧（ユーザー毎）
        </div>
        <div>
            <table>
                <thead bgcolor="#AAA">
                    <tr>
                        <td>購入日</td>
                        <td>商品名</td>
                        <td>商品単価</td>
                        <td>購入数量</td>
                        <td>合計</td>
                    </tr>
                </thead>
                <tbody bgcolor="#DDD">
                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><a href="http://localhost/assignment_form/update.php?order_date=" . $order_date><?php echo $row['order_date']; ?></a></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_price']; ?></td>
                        <td><?php echo $row['product_qty']; ?></td>
                        <td><?php echo $row['purchase_price']; ?></td>
                        <input type="hidden" name="user_code" value="<?php  ?>">
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div>
            <div>■ユーザー情報</div>
            <div>ユーザー情報：<?= $user_code; ?></div>
            <div>氏名：<?=$full_name;  ?></div>
            <div>電話：<?= $user_tel; ?></div>
            <div>メール：<?= $user_email; ?></div>
        </div>
    </body>
</html>