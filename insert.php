<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$lid  = $_POST["lid"];
$lpw    = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];


//2. DB接続します
//以下を関数化！
require_once('funcs.php');
$pdo = db_conn();



//３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO gs_user_table( id, name, lid, lpw, kanri_flg, life_flg)
  VALUES( NULL, :name, :lid, :lpw, :kanri_flg, 1)"
);

// 4. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg,PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
try {
  $status = $stmt->execute();
  echo "\nPDOStatement::errorInfo():\n";
$arr = $stmt->errorInfo();
print_r($arr);
} catch (Exception $e) {
    echo '捕捉した例外: ',  $e->getMessage(), "\n";
}
//6．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    //以下を関数化


  }else{
    //５．index.phpへリダイレクト
    //以下を関数化
    redirect('index.php');
  }