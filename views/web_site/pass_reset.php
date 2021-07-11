<?php
session_start();
if(isset($_POST['reset'])) {
  require_once(ROOT_PATH .'controller/user_controller.php');
  $login = new user_controller();
  $pass_reset= $login->pass_Reset();
  $pass_vari = $login->Pass_vari();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>パスワードリセット</title>
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
                    <h1>ユーザー確認</h1>
            </div>
        </header>
    </div>

    <hr>
    <p class="text-center">登録されている氏名とメールアドレスを入力してください。</p>

    <div class="container">
        <form action="pass_reset.php" method="post" class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                    <label for="name"><span class="badge bg-danger">必須</span> 氏名</label>

                    <input type="text" id="name" name="name" class="form-control" placeholder="例：山田太郎" autofocus required>
                </div>
                <div class="form-group">
                    <label for="email"><span class="badge bg-danger">必須</span> メールアドレス</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="例：soccer@example.com" required>
                </div>
                <a href="login.php" class="btn btn-danger btn-md" >戻る<i class="fa fa-sing-in"></i></a>
                <button type="submit" name="reset" class="btn btn-primary">確認</button>
            </div>
        </form>
    </div>
    <hr>

    <div class="container">
        <footer>
            <p>&copy; individual_reservation_site.</p>
        </footer>
    </div>
</body>
</html>
