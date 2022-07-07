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
                <div>購入日検索：<input type="text" name="order_date_start" value="" size="6"> ～ <input type="text" name="order_date_end" value="" size="6"></div>
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
                    <tr>
                        <td>ここに購入日が入る</td>
                        <td>ここに商品名が入る</td>
                        <td>ここに購入金額が入る</td>
                        <td>ここに購入数量が入る</td>
                        <td>ここに合計が入る</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div>■ユーザー情報</div>
            <div>ユーザー情報：<?= $user_code; ?></div>
            <div>氏名：ここに氏名を表示する</div>
            <div>電話：<?= $user_tel; ?></div>
            <div>メール：<?= $user_email; ?></div>
        </div>
    </body>
</html>