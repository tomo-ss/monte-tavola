<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>業務管理システムログイン</title>
</head>
<body>
    <h1>業務管理システムログイン</h1>

    <form method="POST" action="/login">
        @csrf
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email">
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" name="password">
        </div>

        <button type="submit">ログイン</button>
    </form>
</body>
</html>
