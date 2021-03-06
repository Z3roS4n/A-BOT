<?php

$message = $update["message"];
$chatId = $message['chat']['id'];
$name = $message['from']['first_name'];
$surname = $message['from']['last_name'];
$text = $message['text'];
$userID = $message['from']['id'];
$username = $message['from']['username'];

$msgid = $message["message_id"];
$replyId = $message["reply_to_message"]["from"]["id"];
$replyIdus = $message["reply_to_message"]["from"]["id"];
$replyUsername = $message["reply_to_message"]["from"]["username"];
$replyName = $message["reply_to_message"]["from"]["first_name"];
$replySurname = $message["reply_to_message"]["from"]["last_name"];
$replyIsbot = $message["reply_to_message"]["from"]["is_bot"];
$replymsgid = $message["reply_to_message"]["message_id"];

$newmember = $message["new_chat_member"];
$newmemberid = $message["new_chat_member"]["id"];
$leftmember = $message["left_chat_member"];
$leftmemberid = $message["left_chat_member"]["id"];
$newtitle = $message["new_chat_title"];
$pinned = $message["pinned_message"];
$replyText = $message["reply_to_message"]["text"];

$query = $update['callback_query'];
  
$queryid = $query['id'];
$queryUserId = $query['from']['id'];
$queryChatId = $query["message"]["chat"]["id"];
$queryusername = $query['from']['username'];
$queryName = $query['from']['first_name'];
$querydata = $query['data'];
$querymsgid = $query['message']['message_id'];

if(!$username)
    $username = "<i>NO USERNAME</i>";
else
    $username = "@$username";
  
if(!$name)
    $name = $queryName;
else
    $name = $name;
