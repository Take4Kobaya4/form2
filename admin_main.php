<?php
$DBSERVER = "localhost";

$DBUSER = "root";

$DBPASSWORD = "";

$DBNAME = "assignment_form";

$db = new PDO("mysql:host=$DBSERVER;dbname=$DBNAME;charset=utf8", $DBUSER, $DBPASSWORD);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


// 上が在庫総額、下が売上総額を表示するためのクエリ
$sql = $db->prepare('SELECT SUM(product_price * stock_qty) AS stock_price 
    FROM m_product AS A 
    JOIN t_stock AS B 
    ON A.product_code = B.product_code');

$sql1 = $db->prepare('SELECT SUM(product_price * product_qty) AS sell_price
    FROM m_product AS A 
    JOIN t_order AS C 
    ON A.product_code = C.product_code');


$sql->execute();
$sql1->execute();

$row = $sql->fetch(PDO::FETCH_ASSOC);
$row1 = $sql1->fetch(PDO::FETCH_ASSOC);

$stock_price = $row['stock_price'];
$sell_price = $row1['sell_price'];

// 受注一覧表示を以下に記載
$stmt = $db->prepare('SELECT order_date, CONCAT(user_name1, user_name2) AS full_name, 
product_name, (product_price * product_qty) AS purchase_price 
FROM m_user AS A 
JOIN t_order AS B 
ON A.user_code = B.user_code 
JOIN m_product AS C 
ON B.product_code = C.product_code 
ORDER BY B.order_date');

$stmt->execute();
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);

// 在庫一覧表示を以下に記載
$stmt1 = $db->prepare('SELECT product_name, order_date, stock_qty, COUNT(B.order_id) AS trade_count
FROM t_order AS B
JOIN m_product AS C
ON B.product_code = C.product_code
JOIN t_stock AS D
ON C.product_code = D.product_code
ORDER BY B.order_date
');
$stmt1->execute();
$row3 = $stmt1->fetch(PDO::FETCH_ASSOC);
?>

<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <div>
            ■仮想すぎる通貨：一覧
        </div>
        
        <div>
            【全体通貨在庫】<?php echo $row['stock_price'] . "円"; ?>【全体販売金額】<?php echo $row1['sell_price'] . "円"; ?>
        </div>
       
        <div>
            ■受注一覧
        </div>
        <div>
            <table>
                <thead bgcolor="#AAA">
                    <tr>
                        <td>購入日</td>
                        <td>購入者</td>
                        <td>商品名</td>
                        <td>購入金額</td>
                        <td>詳細</td>
                    </tr>
                </thead>
                <tbody bgcolor="#DDD">
                    <?php while($row2 = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row2['order_date']; ?></td>
                        <td><?php echo $row2['full_name']; ?></td>
                        <td><?php echo $row2['product_name']; ?></td>
                        <td><?php echo $row2['purchase_price']; ?></td>
                        <td><a href="admin_sub.php?user_code=" . $user_code >詳細</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div>
            ■在庫一覧
        </div>
        <div>
            <table>
                <thead bgcolor="#AAA">
                    <tr>
                        <td>商品名</td>
                        <td>最新販売日</td>
                        <td>在庫数</td>
                        <td>取引回数</td>
                        <td>詳細</td>
                    </tr>
                </thead>
                <tbody bgcolor="#DDD">
                    <?php while($row3 = $stmt1->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row3['product_name']; ?></td>
                        <td><?php echo $row3['order_date']; ?></td>
                        <td><?php echo $row3['stock_qty']; ?></td>
                        <td><?php echo $row3['trade_count']; ?></td>
                        <td><a href="admin_sub.php?user_code=" . $user_code>詳細</a></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>