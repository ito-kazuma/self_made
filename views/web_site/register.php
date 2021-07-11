<?php
session_start();
require_once(ROOT_PATH .'controller/user_controller.php');
$customer = new user_controller();
$error_msg = $customer->Regi_vari($_SESSION);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>ユーザー登録</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
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
                    <h1>ユーザー登録</h1>
            </div>
        </header>
    </div>

    <hr>

    <div class="container">
        <form action="register.php" method="post" class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                    <label for="name"><span class="badge bg-danger">必須</span>氏名
                      <?php if(!empty($error_msg['name'])){
                        echo '<div style="color:red;">';
                        echo $error_msg['name'];
                        echo '</div>';
                      } ?>
                  </label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="例：山田太郎" value="<?php echo htmlspecialchars($_SESSION['name'],ENT_QUOTES, 'UTF-8')?>" autofocus required>
                </div>
                <div class="form-group">
                    <label for="furigana"><span class="badge bg-danger">必須</span> フリガナ
                      <?php if(!empty($error_msg['furigana'])){
                        echo '<div style="color:red;">';
                        echo $error_msg['furigana'];
                        echo '</div>';
                      } ?>
                    </label>
                    <input type="text" id="furigana" name="furigana" class="form-control" placeholder="例：ヤマダタロウ" value="<?php echo htmlspecialchars($_SESSION['furigana'],ENT_QUOTES, 'UTF-8')?>"autofocus required>
                </div>
                <div class="form-group">
                    <label for="nickname"><span class="badge bg-success">任意</span> ニックネーム
                        <?php if(!empty($error_msg['nickname'])){
                        echo '<div style="color:red;">';
                        echo $error_msg['nickname'];
                        echo '</div>';
                        } ?>
                    </label>
                    <input type="text" id="nickname" name="nickname" class="form-control" placeholder="例：タロー" value="<?php echo htmlspecialchars($_SESSION['nickname'],ENT_QUOTES, 'UTF-8')?>"autofocus >
                </div>
                <!-- 年齢 -->
                <div class="form-group">
                    <label for="age"><span class="badge bg-success">任意</span> 年齢
                      <?php if(!empty($error_msg['age'])){
                        echo '<div style="color:red;">';
                        echo $error_msg['age'];
                        echo '</div>';
                      } ?>
                    </label>
                    <input type="number" id="age" name="age" class="form-control" placeholder="例：年齢" value="<?php echo htmlspecialchars($_SESSION['age'],ENT_QUOTES, 'UTF-8')?>">
                </div>
                <div class="form-group">
                    <label><span class="badge bg-success">任意</span> 性別</label>
                    <div>
                        <label class="radio-inline">
                          <!-- 同じクラスを与えることで選択肢が変えられる -->
                            <input type="radio" name="sex" value="男">男性
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="sex" value="女">女性
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tel"><span class="badge bg-danger">必須</span> 電話番号
                      <?php if(!empty($error_msg['tel'])){
                        echo '<div style="color:red;">';
                        echo $error_msg['tel'];
                        echo '</div>';
                      } ?>
                    </label>
                    <input type="tel" id="tel" name="tel" class="form-control" placeholder="例：08012345678" value="<?php echo htmlspecialchars($_SESSION['tel'],ENT_QUOTES, 'UTF-8')?>"required>
                </div>
                <div class="form-group">
                    <label for="email"><span class="badge bg-danger">必須</span> メールアドレス

                        <?php if(!empty($error_msg['email'])){
                          echo '<div style="color:red;">';
                          echo $error_msg['email'];
                          echo '</div>';
                        } ?>
                    </label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="例：soccer@example.com" value="<?php echo htmlspecialchars($_SESSION['email'],ENT_QUOTES, 'UTF-8')?>"required>
                </div>
                <!-- パスワード -->
                <div class="form-group">
                    <label for="password"><span class="badge bg-danger">必須</span> パスワード
                        <?php if(!empty($error_msg['input_pass'])){
                          echo '<div style="color:red;">';
                          echo $error_msg['input_pass'];
                          echo '</div>';
                        } ?>
                    </label>
                    <input type="password" id="input_pass" name="input_pass" class="form-control" placeholder="パスワード" value="<?php echo htmlspecialchars($_SESSION['input_pass'],ENT_QUOTES, 'UTF-8')?>"required>
                    <button id="btn_passview" class="btn btn-success btn-md">パスワード表示</button>
                </div>
                <a href="login.php" class="btn btn-danger btn-md" >戻る<i class="fa fa-sing-in"></i></a>

                <button type="submit" name="submit" class="btn btn-primary">送信する</button>
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
