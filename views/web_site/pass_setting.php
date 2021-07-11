<?php
session_start();
if(isset($_POST['btn'])){
  require_once(ROOT_PATH .'controller/user_controller.php');
  $login = new user_controller();
  $pass_set= $login->pass_Update();
  var_dump($pass_set);
  // header('Location:pass_complete.php');
}
if(empty($_SESSION)) {
  header('Location:login.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>パスワード再設定</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>
  window.addEventListener('DOMContentLoaded', function(){

    // (1)パスワード入力欄とボタンのHTMLを取得
    let btn_passview = document.getElementById("btn_passview");
    let input_pass = document.getElementById("input_pass");

    // (2)ボタンのイベントリスナーを設定
    btn_passview.addEventListener("click", (e)=>{

      // (3)ボタンの通常の動作をキャンセル（フォーム送信をキャンセル）
      e.preventDefault();

      // (4)パスワード入力欄のtype属性を確認
      if( input_pass.type === 'password' ) {

        // (5)パスワードを表示する
        input_pass.type = 'text';
        btn_passview.textContent = 'パスワード非表示';

      } else {

        // (6)パスワードを非表示にする
        input_pass.type = 'password';
        btn_passview.textContent = 'パスワード表示';
      }
    });

  });
  </script>
  <link rel="stylesheet" href="/css/register.css">

</head>
<body>


    <div class="container">
        <header>
           <div class="row">
                    <h1>パスワード再設定</h1>
            </div>
        </header>
    </div>

    <hr>
  <p class="text-center">設定したいパスワードを入力してください。</p>
    <div class="container">
        <form action="pass_setting.php" method="post" class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="form-group">
                  <label for="password"><span class="badge bg-danger">必須</span> パスワード</label>
                  <?php if(isset($_POST['input_pass'])):?>
                  <?php if(mb_strlen($_POST['input_pass']) <= 7):?>
                    <?='<div style="color:red;">'?>
                    <?='パスワードは8桁(文字)以上で登録してください。'; ?>
                    <?='</div>'?>
                  <?php endif ?>
                  <?php endif ?>
                  <input type="password" id="input_pass" name="input_pass" class="form-control" placeholder="パスワード" required>
                  <button id="btn_passview" class="btn btn-success btn-md">パスワード表示</button>

                  <span class="field-icon">
                    <i toggle="password-field" class="mdi mdi-eye toggle-password"></i>
                  </span>
              </div>
              <a href="login.php" class="btn btn-danger btn-md" >戻る<i class="fa fa-sing-in"></i></a>
              <button type="submit" name="btn" class="btn submit btn-primary">確認</button>

            </div>
        </form>

    </div>
    <hr>

    <div class="container">
        <footer>
            <p>&copy; individual_reservation_site.</p>
        </footer>
    </div>
    <script>
    $(function(){
      $(".submit").click(function(){
        if(confirm("更新しますか？")){
          return true;
        }else{
          return false;
        }
      })
    });
    </script>
</body>
</html>
