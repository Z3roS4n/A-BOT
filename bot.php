<?php

require "settings.php";

$api = "https://api.telegram.org/bot".$settings["token"];

$update = json_decode(file_get_contents("php://input"), TRUE);

require "var.php";

if($settings["mysqli"])
    include "mysqli.php";
else
    echo "<b>WARNING: </b>MySQLi disabled! Enable it from \"settings.php\"<br>";

$bot = new telegram();

$admins = [402879945]; //ADD YOUR USER ID!

if($userID == "") {
    $ID = $queryUserId;
} else if($queryUserId == "") {
    $ID = $userID;
}

if(!$settings["dev_mode"] or in_array($ID,$admins)) {
    //INLINE KEYBOARDS

    $start_keyboard = '[{"text":"🗃 GitHub","url":"https://github.com/Z3roS4n/A-BOT"}]';
    $blacknote = '[{"text":"⛓ BlackNote","url":"https://t.me/BlackNoteRobot"}]';
    $example_keyboard = '[{"text":"Send Message","callback_data":"sendmessage"},{"text":"Edit Message","callback_data":"editmessage"}],[{"text":"Delete Message","callback_data":"deletemessage"}]';

    //COMMANDS

    if(stripos($text,"/start") === 0)
        $bot->sendMessage($chatId,"<b>Hi $username!</b>\n\n<i>This is a bot created with A-BOT, a totally free and customizable Framework.</i>",$start_keyboard);

    if(stripos($text,"/keyboard") === 0)
        $bot->sendMessage($chatId,"These are the Inline Keyboard you can use!",$example_keyboard);

    if(stripos($text,"/photo") === 0)
        $bot->sendPhoto($chatId,"https://www.antoniomurabito.com/img3.png","@BlackNoteRobot's Logo! ;D",$blacknote);

    if(stripos($text,"/dice") === 0)
        $bot->sendDice($chatId);

    if(stripos($text,"/leavechat") === 0)
        if($chatId < 0) 
            $bot->leaveChat($chatId);
        else
            $bot->sendMessage($chatId,"Groups only!");

    //QUERYDATA

    if($querydata == "sendmessage") {
        $bot->sendMessage($queryChatId,"Hello everybody!");
        exit();
    }

    if($querydata == "editmessage") {
        $bot->editMessageText($queryChatId,$querymsgid,"Illuminati!!! Ah no, it just changed the message...");
        exit();
    }

    if($querydata == "deletemessage") {
        $bot->deleteMessage($queryChatId,$querymsgid);
        exit();
    }
} else {
    echo "<b>WARNING:</b> Dev-Mode Enabled!<br>";
}




class telegram {

    public function sendMessage($chatId, $text, $keyboard = null) {

        if(isset($keyboard))
            $inline = '&reply_markup={"inline_keyboard":['.urlencode($keyboard).'],"resize_keyboard":true}';

        file_get_contents($GLOBALS["api"]."/sendMessage?chat_id=$chatId&disable_web_page_preview=".true."&parse_mode=HTML&text=".urlencode($text).$inline);
    }

    public function editMessageText($chatId, $message_id, $new, $keyboard = null) {

        if(isset($keyboard))
            $inline = '&reply_markup={"inline_keyboard":['.urlencode($keyboard).'],"resize_keyboard":true}';
        
        file_get_contents($GLOBALS["api"]."/editMessageText?chat_id=$chatId&message_id=$message_id&disable_web_page_preview=".true."&parse_mode=html&text=".urlencode($new).$inline);
    }

    public function sendPhoto($chatId, $photo, $cap, $keyboard = null) {

        if(isset($keyboard))
            $inline = '&reply_markup={"inline_keyboard":['.urlencode($keyboard).'],"resize_keyboard":true}';

        file_get_contents($GLOBALS["api"]."/sendPhoto?chat_id=$chatId&photo=$photo&parse_mode=".$GLOBALS["formatting"]."&caption=".urlencode($cap).$inline);
    }

    public function deleteMessage($chatId, $message_id) {
        file_get_contents($GLOBALS["api"]."/deleteMessage?chat_id=$chatId&message_id=$message_id");
    }

    public function leaveChat($chatId) {
        file_get_contents($GLOBALS["api"]."/leaveChat?chat_id=$chatId");
    }

    public function sendDice($chatId) {
        file_get_contents($GLOBALS["api"]."/sendDice?chat_id=$chatId");
    }
}

?>