<?php
// データベース接続
$DBSERVER = "localhost";

$DBUSER = "root";

$DBPASSWORD = "";

$DBNAME = "assignment_form";

$db = new PDO("mysql:host=$DBSERVER;dbname=$DBNAME;charset=utf8", $DBUSER, $DBPASSWORD);

$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


 // プルダウンメニューの値をDBから取得の挙動
    $sql1 = $db->query('SELECT * FROM m_product');
    $sql1->execute();

// formのmethodがPOSTであり、データを挿入する場合の挙動
if($_SERVER['REQUEST_METHOD'] === "POST") {
    // form内にあるPOSTを受け取ったときの値
    $product = $_POST['product'];
    $product_num = $_POST['product_num'];
    $user_code = $_POST['user_code'];
    $order_family_name = $_POST['order_family_name'];
    $order_personal_name = $_POST['order_personal_name'];
    $order_tel = $_POST['order_tel'];
    $order_email = $_POST['order_email'];
    $new_user_code = $_POST['new_user_code'];
    

    if(!empty($new_user_code)){
        $stmt = $db->prepare('SELECT * FROM m_user WHERE user_code = :user_code');
        $stmt->bindValue(':user_code', $new_user_code);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result > 0) {
            // エラーコードを表示
            echo "既にそのユーザーコードは使用されています。再入力お願いします。";
            
        } else {
            $stmt1 = $db->prepare('INSERT INTO 
                t_order(user_code, order_date,product_code, product_qty, created_at) 
                VALUES (:user_code, now(), :product_code, :product_qty, now())');
    
            $stmt2 = $db->prepare('INSERT INTO  
                m_user(user_code, user_name1, user_name2, user_tel, user_email, created_at)  
                VALUES (:user_code, :user_name1, :user_name2, :user_tel, :user_email, now())');
    
            $stmt1->bindValue(':user_code', $new_user_code);
            $stmt1->bindValue(':product_code', $product);
            $stmt1->bindValue(':product_qty', $product_num);
    
            $stmt2->bindValue(':user_code', $new_user_code);
            $stmt2->bindValue(':user_name1', $order_family_name);
            $stmt2->bindValue(':user_name2', $order_personal_name);
            $stmt2->bindValue(':user_tel', $order_tel);
            $stmt2->bindValue(':user_email', $order_email);
                // 実行
            $stmt1->execute();
            $stmt2->execute();
    
                  // thanks.phpへ移動する
            header('location:  http://localhost/assignment_form/thanks.php?user_code=' . $user_code);
        }
    }
    

    //  ユーザーコードに値があり、新規ユーザーコードが空であるとき
        // 既存のユーザーが購入したときの挙動
        if(isset($_POST['user_code']) && empty($_POST['new_user_code']) && $user_code !== "") {   
            $stmt3 = $db->prepare('INSERT INTO 
            t_order(user_code, order_date,product_code, product_qty, created_at) 
            VALUES (:user_code, now(), :product_code, :product_qty, now())');
    
              // $stmt1のbindValueで以下のデータをDBに挿入するために使用
            $stmt3->bindValue(':user_code', $user_code);
            $stmt3->bindValue(':product_code', $product);
            $stmt3->bindValue(':product_qty', $product_num);


              // 実行
            $stmt3->execute();
            //thanks.phpに画面遷移する挙動   
            header('location: http://localhost/assignment_form/thanks.php?user_code=' . $user_code);
        }            
        
        exit;
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
                ■仮想すぎる通貨：注文登録
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">注文１：</label>
                <select name="product">
                    <!-- プルダウンの処理 -->
                    <?php while($row = $sql1->fetch(PDO::FETCH_ASSOC)):?>
                    <option value="<?php echo $row['product_code']; ?>">
                        <?php echo htmlspecialchars($row['product_name'], ENT_QUOTES); ?>
                    </option>
                    <?php  endwhile;?>
                </select>
		 <div>
			  <label style="width : 145px; display: inline-block; text-align: right;">数量：</label>
	                <input type="text" name="product_num" value="" size="2">
		 <div>
            </div>
            <div style="margin-top : 20px;">
                ■注文主の情報
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">ユーザー情報：</label>
		        <input type="text" name="user_code" value="" size="8">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">氏名：</label>
		        <input type="text" name="order_family_name" value="" size="8"><input type="text" name="order_personal_name" value="" size="8">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">電話：</label>
	            <input type="text" name="order_tel" value="">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">メール：</label>
		        <input type="text" name="order_email" value="">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">新規ユーザー情報：</label>
		        <input type="text" name="new_user_code" value="">
            </div>
            <div style="margin-top : 20px;">
                <ul>
                    <li>一度に購入出来る数量の最大は10です。</li>
                    <li>ユーザー情報にユーザーコードを入力した場合、氏名以下の注文主の情報は入力不要です。</li>
                    <li>ユーザー情報にユーザーコードを入力した場合、注文された情報はユーザーコードに紐づけて管理されます。</li>
                    <li>新規ユーザー情報にユーザーコードを入力した場合、新規注文者として処理されます。</li>
                </ul>
            </div>
            <div>
                <input type="submit" name="submit" value="いきなり購入する">
            </div>
            
        </form>
    </body>
</html>