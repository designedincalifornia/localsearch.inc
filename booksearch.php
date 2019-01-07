<?php
$errors = array();
$user = 'root';
$password = 'root';
$db = 'localsearch';
$host = 'localhost';
$port = 8889;
$link = mysql_connect("$host:$port", $user, $password);

if(empty($_POST)) {
	header("Location: index.html");
	exit();
}

if(isset($_POST['word1']) === TRUE){
    $word1 = $_POST['word1'];
}

if($link !== FALSE){
    mysqli_set_charset($link, 'utf8');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = array();
        if ($word1 ==""){
            $query = 'SELECT * FROM books ';
        }else{
            $query = "SELECT * FROM books WHERE SUMMERY LIKE '%".$word1."%' OR NAME LIKE '%".$word1."%'";
        }
        $result = mysqli_query($link,$query);
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
            
        }
    }
}
?>
 
 
<html lang="ja">
    <head>
        <meta charset = "utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Local Search</title>
        <link rel = "stylesheet" href = "show.css">
        <link rel="stylesheet" href="#">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="header-left">
                    <img class="logo" src="picture/LCLogo.png">
                </div>
                <nav class="header-right">
                    <ul class="gnav_menu">
                    <li class="gnav_item"><a href="http://j-zinsights.oops.jp/index.html">運営者情報</a></li>
                    <li class="gnav_item"><a href="https://twitter.com/joe_inc9?lang=ja">Twitter</a></li>
                    <li class="gnav_item"><a href="https://www.facebook.com/jyo.ihata">Facebook</a></li>
                    </ul> 
                </nav>
            </div>
        </header>
        <div class="top-wrapper">
            <h1>地域創生系の本を探しました。</h1>
        </div>
        <div class="result">
            <div class="container">
                <div class="heading"> 
                    <?php if (count($errors) === 0): ?>
                      <h2>「<?php echo htmlspecialchars($word1, ENT_QUOTES, 'UTF-8')?>」で検索した結果</h2>
                      <h2><?php echo count($data) ?>冊見つかりました！</h2>
                </div>
                <div class ="table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>画像</th>
                                <th>本の名前</th>
                                <th>値段</th>
                                <th>著者</th>
                                <th>概要</th>
                                <th>タグ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $value): ?>
                            <tr>
                                    <td><?php echo htmlspecialchars($value['image']) ?></td>
                                    <td><?php echo htmlspecialchars($value['name']) ?></td>
                                    <td><?php echo htmlspecialchars($value['price']) ?></td>
                                    <td><?php echo htmlspecialchars($value['author']) ?></td>
                                    <td><?php echo htmlspecialchars($value['summery']) ?></td>
                                    <td><?php echo htmlspecialchars($value['tag']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                    <?php elseif(count($errors) > 0): ?>
                      <?php foreach($errors as $value): ?>
                        <p><?php $value ?></p>
                      <?php endforeach; ?>
                    <?php endif; ?>
            </div>
        </div>
        <footer>
            <div class="container">
                <img src="picture/LCLogo.png">
                <p>Be a partner with local, start life in local<br>
                    © 2019 Joe Ihata Inc.</p>
            </div>
        </footer>
    </body>
</html>