<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="">
            <div>
                ■仮想すぎる通貨：受注更新
            </div>
            <div>
                ここに購入日を表示
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">注文１：</label>
                <select name="product">
                    <option value="">ここを選択済みにする</option>
                    <option value="1">1万</option>
                    <option value="5">5万</option>
                    <option value="10">10万</option>
                    <option value="50">50万</option>
                </select>
		<div>
               	 <label style="width : 145px; display: inline-block; text-align: right;">数量：</label>
			<input type="text" name="product_num" value="ここに数量が入る" size="2">
		<div>
            </div>
            <div style="margin-top : 20px;">
                ■注文主の情報
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">ユーザー情報：</label>
		  <input type="text" name="user_code" value="ここにユーザーコードが入る" size="8">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">氏名：</label>
		  <input type="text" name="order_family_name" value="ここに氏が入る" size="8"><input type="text" name="order_personal_name" value="ここに名が入る" size="8">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">電話：</label>
		  <input type="text" name="order_tel" value="ここに電話番号が入る">
            </div>
            <div>
                <label style="width : 145px; display: inline-block; text-align: right;">メール：</label>
		  <input type="text" name="order_email" value="ここにメールアドレスが入る">
            </div>
            <div style="margin-top : 20px;">
                <input type="submit" name="update" value="いきなり更新する">
                <input type="submit" name="delete" value="いきなり削除する">
            </div>
        </form>
    </body>
</html>