<?php

 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <title>イベント追加フォーム</title>
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
                    <h1>イベント追加フォーム</h1>
            </div>
        </header>
    </div>

    <hr>

    <div class="container">
        <form action="event_complete.php" method="post" class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="form-group">
                  <label for="event"><span class="badge bg-danger">必須</span> 開催日</label>
                  <input type="date" id="event_date" name="event_date" class="form-control" required>
              </div>
                <div class="form-group">
                    <label for="open_time"><span class="badge bg-danger">必須</span> 開始時間</label>
                    <input type="time" id="open_time" name="open_time" class="form-control"  autofocus required>
                </div>
                <div class="form-group">
                    <label for="close_time"><span class="badge bg-danger">必須</span> 終了時間</label>
                    <input type="time" id="close_time" name="close_time" class="form-control"  autofocus required>
                </div>
                <div class="form-group">
                    <label for="recruiting"><span class="badge bg-danger">必須</span> 締め切り</label>
                    <input type="number" id="recruiting" name="recruiting" class="form-control" placeholder="例：開始◯時間前まで（数字で）" autofocus required>
                </div>

                <!-- 年齢 -->
                <div class="form-group">
                    <label for="count"><span class="badge bg-danger">必須</span> 募集人数</label>
                    <input type="number" id="count" name="count" class="form-control" placeholder="例：20（人）" required>
                </div>
                <div class="form-group">
                    <label for="price"><span class="badge bg-danger">必須</span> 料金</label>
                    <input type="number" id="price" name="price" class="form-control" placeholder="例：1000（円）" required>
                </div>

                <div class="form-group">
                    <label for="note"><span class="badge bg-success">任意</span>備考欄</label>
                    <input type="text" id="note" name="note" class="form-control" placeholder="例：キャンセルは電話のみ" value="お支払いは受付です。キャンセルは電話のみ" autofocus >
                </div>
                <a href="top.php" class="btn btn-danger btn-md" >戻る<i class="fa fa-sing-in"></i></a>
                <button type="submit" name="insert2" class="btn insert btn-primary">追加</button>
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
      $(".insert").click(function(){
        if(confirm("追加しますか？")){
          return true;
        }else{
          return false;
        }
      })
    });
    </script>
</body>
</html>
