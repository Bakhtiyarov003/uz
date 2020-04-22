<?php

define('API_KEY','1115509704:AAFUaQAD4YV8ql4_UhXNhrTUrtXUUTg2ZRM');
//----######------
function makereq($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//#######@Uz_Koderlar#######//
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
  $url = "https://api.telegram.org/bot".API_KEY."/".$method.'?'.http_build_query($parameters);
  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  return exec_curl_request($handle);
}
//#######@Uz_Koderlar#######//
//---------
$xvest = json_decode(file_get_contents('php://input'));
var_dump($xvest);
//=========
$chat_id = $xvest->message->chat->id;
$boolean = file_get_contents('booleans.txt');
  $booleans= explode("\n",$boolean);
// metodlarga tegmaslikni maslaxat beraman agar tegib buzsangiz admin ga ishlamayapti deb nola qilmang
$message_id = $xvest->message->message_id;
$from_id = $xvest->message->from->id;
$name = $xvest->message->from->first_name;
$first_name = $message->from->first_name;
$username = $xvest->message->from->username;
$textmessage = isset($xvest->message->text)?$xvest->message->text:'';
$rpto = $xvest->message->reply_to_message->forward_from->id;
$stickerid = $xvest->message->reply_to_message->sticker->file_id;
$photo = $xvest->message->photo;
$video = $xvest->message->video;
$sticker = $xvest->message->sticker;
$file = $xvest->message->document;
$music = $xvest->message->audio;
$voice = $xvest->message->voice;
$forward = $xvest->message->forward_from;
$admin = "1013695005";
//#######@Uz_Koderlar#######//
function SendMessage($ChatId, $TextMsg)
{
 makereq('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendSticker($ChatId, $sticker_ID)
{
 makereq('sendSticker',[
'chat_id'=>$ChatId,
'sticker'=>$sticker_ID
]);
}
function Forward($KojaShe,$AzKoja,$KodomMSG)
{
makereq('ForwardMessage',[
'chat_id'=>$KojaShe,
'from_chat_id'=>$AzKoja,
'message_id'=>$KodomMSG
]);
}
function save($filename,$TXTdata)
  {
  $myfile = fopen($filename, "w") or die("Unable to open file!");
  fwrite($myfile, "$TXTdata");
  fclose($myfile);
  }

//------------

if($textmessage == '/start')
 if ($from_id == $admin) {
var_dump(makereq('sendMessage',[
        'chat_id'=>$xvest->message->chat->id,
        'text'=>"*Salom, Administrator*",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              
        
        
            ]
        ])
    ]));
 }
 else{
 
var_dump(makereq('sendMessage',[
        'chat_id'=>$xvest->message->chat->id,
        'text'=>"*Assalomu alaykum qadrli foydalanuvchi. @FantasticFilmsHD telegram kanalining qo'llab-quvvatlash markazi aloqa roboti orqali siz kanal administratsiyasiga murojaat yo'llashingiz mumkin. Xabaringizni yozing va botni o'chirmasdan javob kelishini kuting. Administratsiya tomonidan 24 soat ichida sizga javob yo'llanadi!*",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'keyboard'=>[
              [
                ['text'=>"Nomer",'request_contact' => true],['text'=>"Manzil",'request_location' => true]
              ],
        
        //#######@Uz_Koderlar#######//
              
            ]
        ])
    ]));  
    $txxt = file_get_contents('member.txt');
$pmembersid= explode("\n",$txxt);
  if (!in_array($chat_id,$pmembersid)) {
    $aaddd = file_get_contents('member.txt');
    $aaddd .= $chat_id."
";
      file_put_contents('member.txt',$aaddd);
}
 }

  elseif(strpos($textmessage , '/setprofile')!== false && $chat_id == $admin)
  {
    $javab = str_replace('/setprofile',"",$textmessage);
    if ($javab != "")
  {
  save("profile.txt","$javab");
  SendMessage($chat_id,"Sizning javobingiz yetkazildi");
  }
  }


 
 





elseif ($chat_id != $admin) {


      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);
$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Xabaringiz yetkazildi. Tez orada javob olasiz!");
}else{

Sendmessage($chat_id,"Siz bloklandingiz!");

    }
    }
      elseif (isset($message['contact'])) {

      if ( $chat_id != $admin) {

      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);

$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Yetkazildi!");
}else{

Sendmessage($chat_id,"Yetkazildi!");

}
    }
      }

     elseif (isset($message['sticker'])) {

      if ( $chat_id != $admin) {

      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);

$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {   
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Yetkazildi!");
}else{

Sendmessage($chat_id,"Siz bloklangansiz!");

}
    }
      }
//#######@Uz_Koderlar#######//

   elseif (isset($message['photo'])) {

      if ( $chat_id != $admin) {

      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);

$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Yetkazildi!");
}else{

Sendmessage($chat_id,"Yetkazildi!");

}
    }
      }

         elseif (isset($message['voice'])) {

      if ( $chat_id != $admin) {

      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);

$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Yetkazildi!");
}else{

Sendmessage($chat_id,"Yetkazildi!");

}
    }
      }
               elseif (isset($message['video'])) {

      if ( $chat_id != $admin) {

      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);

$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Yetkazildi!");
}else{

Sendmessage($chat_id,"Yetkazildi!");
//#######@Uz_Koderlar#######//
}
    }
      }



  elseif($textmessage == '/stat' && $chat_id == $admin)
  {
    $txtt = file_get_contents('member.txt');
    $membersidd= explode("\n",$txtt);
    $mmemcount = count($membersidd) -1;
{
sendmessage($chat_id,"$mmemcount");
}
}

  elseif($textmessage == '/banlist' && $chat_id == $admin){
    $txtt = file_get_contents('banlist.txt');
    $membersidd= explode("\n",$txtt);
    $mmemcount = count($membersidd) -1;
{
sendmessage($chat_id,"$mmemcount");
}
}




                  elseif (isset($message['location'])) {

      if ( $chat_id != $admin) {

      $txt = file_get_contents('banlist.txt');
$membersid= explode("\n",$txt);

$substr = substr($text, 0, 28);
  if (!in_array($chat_id,$membersid)) {
Forward($admin,$chat_id,$message_id);
Sendmessage($chat_id,"Yetkazildi!");
}else{

Sendmessage($chat_id,"Yetkazildi!");

}
    }
      }
            elseif($rpto != "" && $chat_id == $admin){
      if($textmessage != "/ban" && $textmessage != "banlash")
      {
sendmessage($rpto,"$textmessage");
sendmessage($chat_id,"Yetkazildi!!!" );
      }
      else
      {
        if($textmessage == "/ban"){
      $txtt = file_get_contents('banlist.txt');
    $banid= explode("\n",$txtt);
  if (!in_array($rpto,$banid)) {
    $addd = file_get_contents('banlist.txt');
    $addd = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $addd);
    $addd .= $rpto."
";

      file_put_contents('banlist.txt',$addd);
      {
sendmessage($rpto,"Siz robot administratorlari tomonidan bloklangansiz!");
sendmessage($chat_id,"Foydalanuvchu bloklandi!");
        }
        }
}
      if($textmessage == "/unban"){
      $txttt = file_get_contents('banlist.txt');
    $banidd= explode("\n",$txttt);
  if (in_array($rpto,$banidd)) {
    $adddd = file_get_contents('banlist.txt');
    $adddd = str_replace($rpto,"",$adddd);
    $adddd = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $adddd);
    $adddd .="
";


    $banid= explode("\n",$adddd);
    if($banid[1]=="")
      $adddd = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $adddd);

      file_put_contents('banlist.txt',$adddd);
}
sendmessage($rpto,"Siz robot administratorlari tomonidan bloklangansiz!");
sendmessage($chat_id,"Siz robot administratorlari tomonidan bloklangansiz!");
        }
      }
  }


        elseif ($textmessage =="/send"  && $chat_id == $admin | $booleans[0]=="false") {
  {
          sendmessage($chat_id,"Xabar matnini kiriting");
  }
      $boolean = file_get_contents('booleans.txt');
      $booleans= explode("\n",$boolean);
      $addd = file_get_contents('banlist.txt');
      $addd = "true";
      file_put_contents('booleans.txt',$addd);

    }
      elseif($chat_id == $admin && $booleans[0] == "true") {
    $texttoall = $textmessage;
    $ttxtt = file_get_contents('member.txt');
    $membersidd= explode("\n",$ttxtt);
    for($y=0;$y<count($membersidd);$y++){
      sendmessage($membersidd[$y],"$texttoall
");

    }
    $memcout = count($membersidd)-1;
    {
    Sendmessage($chat_id,"Yetkazildi!");
    }
         $addd = "false";
      file_put_contents('booleans.txt',$addd);
      }
 elseif($textmessage == 'Yetkazilmadi!')
 if($chat_id == $admin){
 {
 file_put_contents('banlist.txt',$chat_id);
 Sendmessage($chat_id,"Yetkazilmadi!");
 }
}
?>
//#######@Uz_Koderlar#######//
