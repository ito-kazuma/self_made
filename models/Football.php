<?php
require_once(ROOT_PATH.'/models/db.php');

class Football extends Db{
  public function __construct($dbh = null){
    parent::__construct($dbh);
  }
  public function accept(){//acceptは認める
    try {
        $email = $_POST['email'];
        $sql = "SELECT id,email,password FROM user WHERE email= ? UNION ALL SELECT id AS admin_id,email,password FROM admin WHERE email=?";//emailだけじゃないとパスワードはハッシュ化されたものを入力しないとログインできなくなる
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(1,$email, PDO::PARAM_STR);
        $sth->bindValue(2,$email, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);//ferchAllでなくてfetchのみにすることで行のみを取り出してくれる
      } catch (PDOException $e) {
        echo '接続できませんでした。理由：'.$e->getMessage();
      }
      return $result;
  }
  public function delete_date(){//過去日付削除
    try{
      $date = date("Y-m-d");
      $sql = "DELETE FROM event WHERE event_date <= :date ";
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':date',$date,PDO::PARAM_STR);
      $sth->execute();
    }catch (PDOException $e) {
      echo '接続できませんでした。理由：'.$e->getMessage();
    }//model
  }
  public function varidate($result){//ログインバリデーション
    $errors=[];

      $email = $_POST['email'];
      $password = $_POST['input_pass'];
      if(empty($email)){//メールアドレスが空のとき
        $errors['email_empty'] = 'メールアドレスが空です。';
      }else if(empty($result)){//データベースにメールアドレスがないとき
        $errors['email'] = 'このメールアドレスは登録がありません。';
        //このif文にパスワードのバリデーションを入れるのはメールアドレスを確認してからパスワード認証するため
      }else if(!password_verify($password, $result['password'])){//パスワードが一致しなかったとき
        $errors['password']= '登録されたパスワードと違います。';
      }
      if(mb_strlen($password) <= 7){
        $errors['password_str'] = 'パスワードは8桁(文字)以上で入力してください。';
      }
      if(empty($password)){//パスワードが空のとき
        $errors['password_empty']='パスワードが空です。';
      }
      if(empty($errors)) {
        if(isset($result['admin_id'])){
          $_SESSION['admin_id'] = $result['admin_id'];
        }else{
          $_SESSION['user_id'] = $result['id'];
        }
        header('Location:top.php');
        exit();
      }
      return $errors;

  }

  public function findAll(){//イベント表示
    try {
      // SQL文を作成
      $sql = 'SELECT * FROM event';
      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      // レコードの取得
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $rows;

    } catch (PDOException $e) {
      echo '接続できませんでした。理由：'.$e->getMessage();
    }

  }

    public function frame($event_id){//応募人数
      $sql1 = 'SELECT count(*) FROM reserve WHERE event_id = :event_id';
      $sth1 = $this->dbh->prepare($sql1);
      $sth1->execute(array("event_id"=>$event_id));
      $frame = $sth1->fetchColumn();
      return $frame;
    }

    public function is_reserve($event_id){//残り枠
      $sql = "SELECT reserve.id FROM reserve WHERE user_id = :user_id AND event_id = :event_id";
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array("event_id"=>$event_id,"user_id"=>$_SESSION['user_id']));
      $result = $sth->fetchColumn();
      if(empty($result)){
        return false;
      }else{
        return true;
      }
      return $result;
    }

    public function top_complete(){
      $sql = 'INSERT INTO reserve (event_id,user_id)
              VALUES (?,?)';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(1,htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
      $sth->bindValue(2,htmlspecialchars($_SESSION['user_id'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
      $sth->execute();
    }

    public function regi_vari($post){//登録バリデーション
      if($_SERVER["REQUEST_METHOD"] === "GET") {
        $_SESSION = '';
      }
      $error_msg = [];
      if($_SERVER["REQUEST_METHOD"] === "POST") {
        $_SESSION = $_POST;
        if(mb_strlen($_SESSION['name']) > 30) {//文字制限
          $error_msg['name']='氏名は、30文字以内で入力してください。';
        }
        if(mb_strlen($_SESSION['furigana']) > 30) {//文字制限
          $error_msg['furigana']='フリガナは、30文字以内で入力してください。';
        }
        if(mb_strlen($_SESSION['nickname']) > 30) {//文字制限
          $error_msg['nickname']='ニックネームは、30文字以内で入力してください。';
        }
        if(mb_strlen($_SESSION['age']) > 2) {//文字制限
          $error_msg['age']='年齢は2桁まででご入力ください。';
        }
        if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$|^[0-9]{11}$/",$_SESSION['tel'])) {//数字のみ
          $error_msg['tel']='電話番号は0-9の11桁の数字のみでご入力ください。';
        }else if(!preg_match('/^[0-9]+$/',$_SESSION['tel'])) {
          $err_msg['tel']='電話番号は0-9の数字のみでご入力ください。';
        }
        if(mb_strlen($_SESSION['input_pass']) <= 8) {//文字制限
          $error_msg['input_pass']='パスワードは、8文字以上で入力してください。';
        }

        $email=$_SESSION['email'];
        $sql="SELECT email FROM user WHERE email=:email";
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':email',$email,PDO::PARAM_STR);
        $sth->execute();
        $row = $sth->fetchColumn();
        if($row === $email){
          $error_msg['email']='このメールアドレスはすでに登録されています';
        }

        if(empty($error_msg)){//エラーメッセージがなければ登録
          $_SESSION['input_pass']=password_hash($post['input_pass'], PASSWORD_DEFAULT);
          header("Location:registered.php");
          exit();
          }
          return $error_msg;
        }
      }

    public function customer(){//顧客登録
      try {
        // SQL文を作成
        $sql = "INSERT INTO user (name,furigana,nickname,age,sex,tel,email,password)
                VALUES(?,?,?,?,?,?,?,?)";
        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1,htmlspecialchars($_SESSION['name'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(2,htmlspecialchars($_SESSION['furigana'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(3,htmlspecialchars($_SESSION['nickname'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(4,htmlspecialchars($_SESSION['age'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(5,htmlspecialchars($_SESSION['sex'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(6,htmlspecialchars($_SESSION['tel'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(7,htmlspecialchars($_SESSION['email'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(8,htmlspecialchars($_SESSION['input_pass'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        // SQLを実行
        $stmt->execute();
      } catch (PDOException $e) {
        echo '接続できませんでした。理由：'.$e->getMessage();
      }
    }

    public function pass_reset($post){//パスワードリセット

        $name=$post['name'];
        $email=$post['email'];
        $sql= 'SELECT * FROM user WHERE name = :name AND email = :email';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':name',$name,PDO::PARAM_STR);
        $sth->bindValue(':email',$email,PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function pass_vari($post,$result){//パスワードバリデーション
      $errors=[];
      $name=$post['name'];
      $email=$post['email'];
      if(empty($name)){
        $errors['name_empty']='名前が空白です。';
      }else if(empty($result)){
        $errors['name'] ='この名前はありません';
      }
      if(empty($email)) {
        $errors['email'] = 'メールアドレスが空です';
      }else if(empty($result)){
        $errors['email_empty'] = 'このメールアドレスは登録ありません。';
      }
      if(empty($errors)) {
        $_SESSION['user_id'] = $result['id'];//セッションに値をもたせてページ遷移
        header('Location:pass_setting.php');
        exit();
      }else{
        $_SESSION = array();
        header('Location:data_none.php');
        exit();
      }
      return $errors;
    }

    public function pass_set(){//パスワード再設定

        $pass = $_POST['input_pass'];
        $sql='UPDATE user SET password = :password WHERE id = :id';
        $sth=$this->dbh->prepare($sql);
        $sth->bindValue(':password',password_hash($pass,PASSWORD_DEFAULT),PDO::PARAM_STR);
        $sth->bindValue(':id',$_SESSION['user_id'],PDO::PARAM_INT);
        $sth->execute();
        header('Location:pass_complete.php');
        exit();
    }

    public function event_insert($post){//イベント追加
      try {
        // SQL文を作成
        $sql = 'INSERT INTO event (event_date,open_time,close_time,recruiting,count,price,note)
        VALUES(?,?,?,?,?,?,?)';
        // SQL文を実行する準備
        $stmt = $this->dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1,htmlspecialchars($_POST['event_date'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(2,htmlspecialchars($_POST['open_time'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(3,htmlspecialchars($_POST['close_time'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(4,htmlspecialchars($_POST['recruiting'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
        $stmt->bindValue(5,htmlspecialchars($_POST['count'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
        $stmt->bindValue(6,htmlspecialchars($_POST['price'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
        $stmt->bindValue(7,htmlspecialchars($_POST['note'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
        $stmt->bindValue(8,htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
        // レコードの取得
      } catch (PDOException $e) {
        echo '接続できませんでした。理由：'.$e->getMessage();
      }
    }

  public function event_delete($post){//イベント削除
    //削除のため
      $sql = "DELETE FROM event WHERE id = :id";//reserveも消すには？
      $stmt = $this->dbh->prepare($sql);
      $stmt->bindValue(':id',$_POST['id'],PDO::PARAM_INT);
      $stmt->execute();
      header('Location:top.php');
      exit();
  }

  public function edit(){//編集
      // SQL文を作成
      $sql = 'SELECT * FROM event WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id',$_POST['id'],PDO::PARAM_INT);
      $sth->execute();
      // レコードの取得
      $rows = $sth->fetch(PDO::FETCH_ASSOC);
      return $rows;
  }

  public function edit_update(){//編集更新
      // SQL文を作成
      $sql = 'UPDATE event SET event_date=?,open_time=?,close_time=?,recruiting=?,count=?,price=?,note=? WHERE id =?';
      // SQL文を実行する準備
      $stmt = $this->dbh->prepare($sql);
      // SQL文のプレースホルダに値をバインド
      $stmt->bindValue(1,htmlspecialchars($_POST['event_date'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
      $stmt->bindValue(2,htmlspecialchars($_POST['open_time'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
      $stmt->bindValue(3,htmlspecialchars($_POST['close_time'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
      $stmt->bindValue(4,htmlspecialchars($_POST['recruiting'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
      $stmt->bindValue(5,htmlspecialchars($_POST['count'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
      $stmt->bindValue(6,htmlspecialchars($_POST['price'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
      $stmt->bindValue(7,htmlspecialchars($_POST['note'],ENT_QUOTES,'UTF-8'), PDO::PARAM_STR);
      $stmt->bindValue(8,htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8'), PDO::PARAM_INT);
      // SQLを実行
      $stmt->execute();
  }

  public function info($post,$get){//応募者人数
      $event_id=$post['id'] ??$get['info'];
      $sql = 'SELECT event.event_date as date,user.id as user_id,user.name as user_name FROM event JOIN reserve ON event.id=reserve.event_id JOIN user ON user.id=reserve.user_id
              WHERE event.id=:event_id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':event_id',$event_id,PDO::PARAM_INT);
      $sth->execute();
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  }

  public function info_list($post){//顧客個人情報　　前やったはずやけど戻ると消えてしまう
      // SQL文を作成
      $sql = 'SELECT * FROM user WHERE id=:id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id',$_POST['id'],PDO::PARAM_INT);
      $sth->execute();
      // レコードの取得
      $rows = $sth->fetch(PDO::FETCH_ASSOC);
      return $rows;
  }
}
 ?>
