<?php
session_start();
if(!isset($_POST['info']) && !isset($_GET['info'])){
  header("Location:login.php");
  exit();
}
require_once(ROOT_PATH .'controller/user_controller.php');
$info= new user_controller();
$rows = $info->view();

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

  <link rel="stylesheet" href="/css/register.css">

</head>
<body>


    <div class="container">
        <header>
           <div class="row">
                    <h1>応募情報</h1>
            </div>
        </header>
    </div>
    <hr>

    <h1>現在の応募情報が閲覧できます。</h1>
    <div class="table-responsive">
      <table class="table table-striped text-nowrap">
        <thead>
          <tr>
            <th>開催日</th><th>名前</th><th>詳細</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($rows as $row): ?>
          <tr>
            <input type="hidden" name="id" value="<?=$row['user_id']?>">
            <td><?=$row['date']?></td>
            <td><?=$row['user_name']?></td>
            <form action="information_list_detail.php" method="post" class="row">
              <input type="hidden" name="id" value="<?=$row['user_id']?>">
              <input type="hidden" name="event_id" value="<?= $event_id ?>">
              <td><button type="submit" name="information" class="btn btn-info">詳細</button></td>
            </form>
          </tr>
        <?php endforeach ?>
    　　・・・
        </tbody>
      </table>
      <a href="top.php"><button class="btn btn-primary btn-md">トップページへ</button></a>

    </div>
    <hr>


    <div class="container">
        <footer>
            <p>&copy; individual_reservation_site.</p>
        </footer>
    </div>
</body>
</html>
