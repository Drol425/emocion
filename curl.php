<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
header('Content-Type: text/html; charset=utf-8');
include_once 'FppClient.php';
include_once 'dbcron.php';

use Fpp\FppClient;

$host = 'https://api-us.faceplusplus.com';
$apiKey = '';
$apiSecret = '';
$api_key_flickr = '';
$client = new FppClient($apiKey, $apiSecret, $host);

$url_album = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='.$api_key_flickr.'&user_id=144522605%40N06&format=json&nojsoncallback=1';

  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url_album); 
  curl_setopt($ch, CURLOPT_HEADER, false); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // Нужно явно указать, что будет POST запрос 
  //curl_setopt($ch, CURLOPT_POST, true); 
  // Здесь передаются значения переменных 
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
  $data1 = curl_exec($ch); 
  $data1 = json_decode($data1);
  curl_close($ch); 
  $page_count = $data1->photos->pages;


for($p=0; $p < $page_count; $p++){

  $url_album = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='.$api_key_flickr.'&user_id=144522605%40N06&format=json&nojsoncallback=1&page='.$p;
//$url_tag = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=90140cc133aa24fd8303c4a8f1f0885b&tags=%23int20&format=json&nojsoncallback=1';
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url_album); 
  curl_setopt($ch, CURLOPT_HEADER, false); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
  // Нужно явно указать, что будет POST запрос 
  //curl_setopt($ch, CURLOPT_POST, true); 
  // Здесь передаются значения переменных 
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
  $data = curl_exec($ch); 
  $data = json_decode($data);
  curl_close($ch); 

  foreach ($data->photos->photo as &$value) {
    $img = "https://farm".$value->farm.".staticflickr.com/".$value->server."/".$value->id."_".$value->secret.".jpg";
            $cou_set = $DB->query("SELECT COUNT(*) FROM `images` WHERE url_img=?", array($img));

                    $cou = $cou_set[0]['COUNT(*)'];

                      if($cou == 0){
                                      //echo "<img src='".$img."'><br />";


                                                  $data = array(
                                                        'image_url' => $img,
                                                        'return_landmark' => '2',
                                                        'return_attributes' => 'age,headpose,emotion'
                                                  );

                                                                $resp = $client->detectFace($data);
                                                                $count = count($resp->body['faces']);
//print_r($resp->body['faces']);
if(isset($resp->body['faces'])){
                        $DB->query("INSERT INTO `images` (`id`, `url_img`) VALUES (?, ?);", array(null,$img));
                        $id_img = $DB->lastInsertId();
                                                                          for($i=0; $i < $count; $i++){
                                                                            if(isset($resp->body['faces'][$i]['attributes']['emotion'])){
                                                                                    $value = max($resp->body['faces'][$i]['attributes']['emotion']);
                                                                                    $key = array_search($value, $resp->body['faces'][$i]['attributes']['emotion']);

                                                                                              $DB->query("INSERT INTO `emo` (`id`, `id_img`, `emocion`) VALUES (?,?,?)", array(null,$id_img,$key));
                                                                            }
                                                                               
                                                                          }
                      }
  }}}
?>