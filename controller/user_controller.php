<?php
require_once(ROOT_PATH.'/models/Football.php');

class user_controller {
  private $Football;

  public function __construct() {
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    $this->Football = new Football();
  }
  public function login(){
    $result = $this->Football->accept();
    return $result;
  }
  public function del(){//過去日付削除
    $this->Football->delete_date();
  }
  public function login_varidate($result1){
    $errors = $this->Football->varidate($result1,$this->request['post']);
    return $errors;
  }
  public function top_All(){//topページ
    $events = $this->Football->findAll();

    $rows =[
      'events' => $events
    ];
    return $rows;
  }
  public function Frame($event_id){//応募者数
    $frame = $this->Football->frame($event_id);
    return $frame;
  }
  public function Is_reserve($event_id){//同じ人が予約しないための
    $is_reserve = $this->Football->is_reserve($event_id);
    return $is_reserve;
  }
 public function Top_complete(){
   $rows=$this->Football->top_complete();
   return $rows;
 }
  public function Regi_vari(){//登録バリデーション
    $error_msg = $this->Football->regi_vari($this->request['post']);
    return $error_msg;
  }

  public function Customer(){//顧客登録
    $insert = $this->Football->customer($_SESSION);
    return $insert;
  }
  public function Insert(){//イベント追加
    $insert = $this->Football->event_insert($this->request['post']);
    return $insert;
  }

  public function Event_del(){//イベント削除
   $delete = $this->Football->event_delete($this->request['post']);
   return $delete;
  }

  public function pass_Reset(){//パスワード認証
    $result = $this->Football->pass_reset($this->request['post']);
    $errors = $this->Football->pass_vari($this->request['post'],$result);

  }

  public function pass_Update(){//パスワード更新
    if(mb_strlen($this->request['post']['input_pass'])<=7){
      return;
    }
    $this->Football->pass_set();

  }

  public function Edit(){//イベント編集
    $edit = $this->Football->edit($this->request['post']);
    return $edit;
  }
  public function Edit_update(){
    $this->Football->edit_update($this->request['post']);
  }
  public function view(){//イベント応募情報
    $info = $this->Football->info($this->request['post'],$this->request['get']);
    return $info;
  }
  public function Individual(){//個人情報
    $info_list = $this->Football->info_list($this->requset['post']);
    return $info_list;
  }
}
?>
