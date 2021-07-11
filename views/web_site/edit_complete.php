<?php
session_start();
if(!isset($_POST['update'])){
  header("Location:login.php");
  exit();
}
require_once(ROOT_PATH .'controller/user_controller.php');
$edit= new user_controller();
$edit_comp = $edit->Edit_update();
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>イベント編集完了</title>
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
                    <h1>イベント編集完了</h1>
            </div>
        </header>
    </div>
    <hr>

    <section>
      <div class="contact_box">

        <div class="complete_msg">
          <p>イベントを更新しました。</p>
          <button type="submit" class="btn btn-secondary"><a href="login.php">ログインへ戻る</a></button>
          <button type="submit" class="btn btn-secondary"><a href="top.php">イベント一覧へ戻る</a></button>
        </div>
      </div>
    </section>
    <hr>


    <div class="container">
        <footer>
            <p>&copy; individual_reservation_site.</p>
        </footer>
    </div>
</body>
</html>
