<?php
//書き込み
if(isset($_POST['send']) === true){
  $name = $_POST['name'];
  $message = $_POST['message'];
  $fp = fopen('bord.txt','a');
  fwrite($fp,$name . "\t" . $message . "\n");
  fclose($fp);
}
//取り出し
$bord_array = [];
if(file_exists('bord.txt')){
  $fp = fopen('bord.txt','r');
  while($line = fgets($fp)){
    $temp = explode("\t",$line);
    $temp_array = [
      'name' => $temp[0],
      'message' => $temp[1]
    ];
    $bord_array[] = $temp_array;
  }
}else{
  $fp = fopen('bord.txt','w');
}
fclose($fp);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>簡単掲示板</title>
  <meta name="discription" content="久しぶりの練習。簡単な掲示板を作ります（プッシュの練習）">
</head>
<body>
<div id="wrapper">
  <header>
    <h1>簡単掲示板</h1>
  </header>
  <main>
    <form method="post" action="bord.php">
    <table>
      <tr>
        <th><label for="name">名前</label></th>
        <td><input type="text" id="name" name="name" size="10" required></td>
      </tr>
      <tr>
        <th><label for="message">内容</label></th>
        <td><input type="text" id="message" name="message" size="140" required></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" id="send" name="send" value="送信">
        </td>
      </tr>
    </table>
    </form>
    <div id="list">
      <ul>
        <?php foreach($bord_array as $date):?>
        <li><?php echo $date['name'].'：'.$date['message']; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </main>
  <footer>
    <p>copyright <?php echo date("Y"); ?>- Miyashita</p>
  </footer>
</div>
</body>
</html>