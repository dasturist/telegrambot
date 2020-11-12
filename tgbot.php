<?php
    //error_reporting(E_ALL);
    
    define("API_KEY", "****************************");
    function bot($method, $data=[]){
        $url ="https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        if(curl_error($ch))
        {
            var_dump(curl_error($ch));
        }
        else
        {
            return json_decode($res);
        }
        
    }
    
    function type($chat){
        return bot('sendChatAction',[
                'chat_id' => $chat,
                'action' => 'typing',
            ]);
    }
    
    $update = file_get_contents('php://input');
    $update = json_decode($update, true);
    
    $message = $update['message'];
    $chat_id = $message['chat']['id'];
    $text = $message['text'];
    
    if(isset($text)){
        type($chat_id);
    }
    if($text == 'salom'){
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => 'qalesiz? yaxshimisiz?',
            'parse_mode' => 'markdown'
            ]);
    }
    
    if($text == 'yordam')
    {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => '<b>Sizga qanday yordam kerak? Batafsil yozing. Iltimos!</b>',
            'parse_mode' => 'html',
            ]);
    }
    
    
?>