<?php
session_start();
$err="";
$_SESSION=array();
require_once(ROOT_PATH .'controller/user_controller.php');
if(isset($_POST['log_in'])) {

  $result = new user_controller();
  $result1 =$result->login();
  $del_date = $result->del();
  $err = $result->login_varidate($result1);
}
 ?>
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="/css/login.css?=v2" rel="stylesheet" id="style">

    <title>ログインページ</title>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v11.0" nonce="beXWeEqH"></script>
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAGr1OWLaILbTGYqeNq1tXAu7NLLAk8cMk&language=ja"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="495315229122-bpud393l4rlnj8fab8qctujkkmfgmggv.apps.googleusercontent.com">

    <style>
    #map { height: 10%; width: 10%}
    </style>
  </head>
  <body>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <script>
  window.addEventListener('DOMContentLoaded', function(){//pass表示・非表示

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
<!-- Page Content -->

<div class="container">

  <div class="row">
    <div class="col-md-offset-5 col-md-5 text-center">
        <div class="form-login"></br>
          <div class="omb_login">
            	<h3 class="omb_authTitle">ログイン<span style="font-size:16px;">または</span><a href="register.php">新規登録</a></h3>

          <!-- <h4>ログイン</h4> -->
        </br>

        <form action="login.php" method="post">
        <p><input type="email" name="email" id="userName" class="form-control input-sm chat-input" placeholder="例：soccer@example.com" autofocus required></p>
        </br>

        <?php foreach($err as $error): ?>
          <?php echo $error ?>
        <?php endforeach ?>
      </br>
        <p>
          <input type="password" name="input_pass" id="input_pass" value="" class="form-control input-sm chat-input" placeholder="パスワード" autofocus required>
          <button id="btn_passview" class="btn btn-success btn-md">パスワード表示</button>
        </p>

        </br></br>
        <div class="wrapper">
          <span class="group-btn">

              <a href="register.php" class="btn btn-primary btn-md">新規登録<i class="fa fa-sing-in"></i></a>
              <button type="submit" name="log_in" class="btn btn-danger btn-md">ログイン<i class="fa fa-sing-in"></i></button>

        </form>
          </span>
        </div>
          </br>
          </br>
            <p>パスワードをお忘れの方は<a href="pass_reset.php">こちら</a></p>
          </br>
          <p>Googleアカウントをお持ちの方はこちらから</p>
            <div class="g-signin2" data-onsuccess="onSignIn"style="display:inline-block;"></div>
            <script>
              function onSignIn(googleUser) {
                  var id_token = googleUser.getAuthResponse().id_token;
                  var xhr = new XMLHttpRequest();
                  xhr.open('POST', 'test.php');
                  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                  xhr.onload = function() {
                      console.log('Signed in as: ' + xhr.responseText);
                  };
                  xhr.send('id_token=' + id_token);
                  // window.location.href = 'top.php';
              }
          </script>
          </br>
          </br>

          <div id="map_wrapper">
            <div id="gmap"></div>
          </div>

          <script>
          var MyLatLng = new google.maps.LatLng(35.0840750, 136.6605841);
          var Options = {
           zoom: 16,      //地図の縮尺値
           center: MyLatLng,    //地図の中心座標
           mapTypeId: 'roadmap'   //地図の種類
          };
          var map = new google.maps.Map(document.getElementById('map_wrapper'), Options);
          </script>

        </div>
      </div>

    </div>
  </div>
  </div>

</div>
<div id="fb-root"></div>

</body>


</html>
