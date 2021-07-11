<?php
session_start();
require_once(ROOT_PATH .'controller/user_controller.php');
$top= new user_controller();
$rows = $top->Top_complete();
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>応募完了</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="/css/register.css">

</head>
<body>

    <div class="container">
        <header>
           <div class="row">
                  <h1>応募完了</h1>
            </div>
        </header>
    </div>
    <hr>

    <section>
      <div class="contact_box">

        <div class="complete_msg">
          <p>ご応募いただきありがとうございます。</p>

          <p>ご予約当日お待ちしております。</p>
          <a href="top.php" class="btn btn-primary btn-md" style="text-decoration:none;">イベントへ戻る<i class="fa fa-sing-in"></i></a>
          <a href="login.php" class="btn btn-danger btn-md" style="text-decoration:none;">ログインへ戻る<i class="fa fa-sing-in"></i></a>

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
