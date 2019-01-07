<?php
$errors = array();
$host = 'localhost'; 
$username = 'codecamp24105';  
$passwd   = 'DUQHGYEC';    
$dbname   = 'codecamp24105';    
$link = mysqli_connect($host, $username, $passwd, $dbname);

if(empty($_POST)) {
	header("Location: index.html");
	exit();
}

if(isset($_POST['word2']) === TRUE){
    $word2 = $_POST['word2'];
}

if($link !== FALSE){
    mysqli_set_charset($link, 'utf8');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = array();
        if ($word2 ==""){
            $query = 'SELECT * FROM books ';
        }else{
            $query = "SELECT * FROM books WHERE SUMMERY LIKE '%".$word2."%' OR NAME LIKE '%".$word2."%'";
        }
        $result = mysqli_query($link,$query);
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
            
        }
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
<title>Local Search</title>
<meta charset="utf-8">
</head>
<body>
 
<?php if (count($errors) === 0): ?>
 <p>「<?php echo htmlspecialchars($word2, ENT_QUOTES, 'UTF-8')?>」で検索した結果</p>
 <p><?php echo count($data) ?>件見つかりました！</p>
  <table calss="table" border='1'>
      <thead>
          <tr>
              <th>事例名</th>
              <th>概要</th>
              <th>HP</th>
              <th>タグ①</th>
              <th>タグ②</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach($data as $value): ?>
          <tr>
              <td><?php echo htmlspecialchars($value['name']) ?></td>
              <td><?php echo htmlspecialchars($value['summery']) ?></td>
              <td><?php echo htmlspecialchars($value['url']) ?></td>
              <td><?php echo htmlspecialchars($value['tag1']) ?></td>
              <td><?php echo htmlspecialchars($value['tag2']) ?></td>
          </tr>
          <?php endforeach; ?>
      </tbody>

<?php elseif(count($errors) > 0): ?>
<?php foreach($errors as $value): ?>
	<p><?php $value ?></p>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>