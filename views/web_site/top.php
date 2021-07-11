<?php
session_start();
// if(!$_SESSION['login']){
//     header('Location: login.php');
// }
require_once(ROOT_PATH .'controller/user_controller.php');
$login = new user_controller();
$rows = $login->top_All();

$frame = $login->Frame($rows);
$Is_reserve= $login->Is_reserve($rows);

 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>イベント応募画面</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <link rel="stylesheet" href="/css/register.css">

</head>
<body>


    <div class="container">
        <header>
           <div class="row">
                    <h1>開催予定の個サル一覧</h1>
            </div>
        </header>
    </div>
    <hr>

    <h1>こちらからご予約していただけます。</h1>
    <div class="table-responsive">
      <table class="table table-striped text-nowrap">
        <thead>
          <tr>
            <th>開催日</th><th>開始時間(２時間制)</th><th>締め切り</th><th>募集人数</th><th>料金</th><th>備考</th><th>応募</th><th>残り枠</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach($rows['events'] as $row):?>
          <tr>
            <td><?php echo $row['event_date']?></td>
            <td><?php echo $row['open_time']."~".$row['close_time']?></td>
            <td>開始<?php echo $row['recruiting']?>時間前まで</td>
            <td><?php echo $row['count']?>人</td>
            <td><?php echo $row['price'] ?>円</td>
            <td><?php echo $row['note']?></td>
          <form action="top_complete.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'],ENT_QUOTES, 'UTF-8')?>">
            <?php if($row['count']-$login->Frame($row['id']) >=1 && $login->Is_reserve($row['id'])==false && $_SESSION['user_id']!== 1): ?>
              <td><button type="submit" class="btn app btn-danger">応募</button></td>
            <?php elseif($_SESSION['user_id']===1): ?>
              <td><button type="submit" class="btn app btn-danger" disabled>応募</button></td>
            <?php elseif($login->Is_reserve($row['id']) == true):?>
              <td><a href="cansel.php?user_id=<?=$_SESSION['user_id']?>&id=<?=$row['id']?>" class="btn cxl btn-danger">キャンセル</a></td>
            <?php else: ?>
              <td><?php echo '満員'?></td>
            <?php endif ?>
          </form>
            <td>
            <?php if($row['count']-$login->Frame($row['id']) >=1): ?>
              <?php echo $row['count']-$login->Frame($row['id'])?></td>
            <?php else: ?>
              <?php echo 'キャンセル待ち'?>
            <?php endif ?>
            <?php if($_SESSION['user_id']===1):?>
            <form action="edit.php" method="post" class="row">
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <td><button type="submit"  name="edit" class="btn btn-info">編集</button></td>
            </form>
            <form action="delete.php" method="post" class="row">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <td><button type="submit" name="delete" class="btn delete btn-warning">削除</button></td>
            </form>
            <form action="information.php" method="post" >
              <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'],ENT_QUOTES, 'UTF-8')?>">
              <td><button type="submit"  name="info" class="btn btn-success">応募情報</button></td>
            </form>
            <?php endif ?>
          </tr>
        <?php endforeach ?>

    　　・・・
        </tbody>
      </table>

      <?php if($_SESSION['user_id'] ===1):?>
      <div>
        <form action="event_addition.php" method="post" >
          <button type="submit" name="insert" class="btn btn-primary">イベント追加</button>
          <a href="login.php" class="btn btn-info btn-md" style="text-decoration:none;">ログインへ戻る<i class="fa fa-sing-in"></i></a>
        <?php else: ?>
          <a href="login.php" class="btn btn-info btn-md" style="text-decoration:none;">ログインへ戻る<i class="fa fa-sing-in"></i></a>
        </form>
      </div>
    <?php endif ?>

    </div>
    <hr>


    <div class="container">
        <footer>
            <p>&copy; individual_reservation_site.</p>
        </footer>
    </div>
    <script>
    $(function(){
      $('.app').click(function(){
        if ($(this).text() === '応募') {
          if(window.confirm("応募しますか？")){
            $(this).text('キャンセル');
            return true;
          }else{
            return false;
          }
        } else {
          $(this).text('キャンセル');
        }
      })
      $(".delete").click(function(){
        if(confirm("削除しますか？")){
          return true;
        }else{
          return false;
        }
      })
      $(".cxl").click(function(){
        if(confirm("キャンセルしますか？")){
          return true;
        }else{
          return false;
        }
      })
    });
    </script>
</body>
</html>
