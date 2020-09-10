<?php


    $messageText = $_POST['texts'];
    date_default_timezone_set("Asia/Dhaka");
    $filename = "group_".date("Y-m-d_h-i-s_a_").time().".txt";
    $file = fopen("posttxt/".$filename, "w") or die("Unable to open lastmsg.txt file!");
    fwrite($file, "<b id='datetime'>".date('d/m/Y h:i:s a')."</b>\n\n".$messageText);
    
    $fileArr = fopen("gList.txt", "a+") or die("Unable to open gList.txt file!");
    fwrite($fileArr, $filename."\n");
    
    
    

$telegram_webhook = 'chat-id';
$discord_webhook = "discord_webhook_url";



    function TelecurlPost($chatId, $textData){
        $botToken="";
        $website="https://api.telegram.org/bot".$botToken;

        $params=[
            'chat_id'=>$chatId,
            'text'=> $textData,
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);

    }

                    
                    
    function DisccurlPost($url, $msg){
        $curl = curl_init($url);
        

        
        
        $hookObject = json_encode(array("content" => $msg, "username" => "IST27thNotifierBOT"));
        
		curl_setopt_array( $curl, [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $hookObject,
			CURLOPT_HTTPHEADER => [
				"Length" => strlen( $hookObject ),
				"Content-Type" => "application/json"
			],
			CURLOPT_HTTPHEADER => [
				"Content-Type: application/json"
			]
		]);
		
		
		$response = curl_exec($curl);

		return $response;
	}
    
    function onesignalNotification($msg){
        $heading = array(
            "en" => 'ফেসবুক গ্রুপে নতুন পোস্ট!'
            
            );
        $content      = array(
            
            "en" => $msg
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "show-button",
            "text" => "দেখাও",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://ist27thbatch.tk/notice/group"
        ));
        
        $fields = array(
            'app_id' => "onesignal-app-token",
            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'headings' => $heading,
            'contents' => $content,
            'web_buttons' => $hashes_array
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic onesignal-auth-token'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
        

        
    }    


    $feed_page_dir = "https://ist27thbatch.tk/groupposts/?file=";
    
    if(strlen($messageText) > 1800){
        $mainText = substr($messageText, 0, 1800);
        TelecurlPost($telegram_webhook, "There is a new post on Facebook Group:\n\n".$mainText."\n\nFull post available at ".$feed_page_dir.$filename);
        DisccurlPost($discord_webhook, "There is a new post on Facebook Group:\n\n".$mainText."\n\nFull post available at ".$feed_page_dir.$filename);
        onesignalNotification($mainText);
        
    }
    else{
        TelecurlPost($telegram_webhook, "There is a new post on Facebook Group:\n\n".$messageText);
        DisccurlPost($discord_webhook, "There is a new post on Facebook Group:\n\n".$messageText);
        onesignalNotification($messageText);
    }
    
    
    sleep(5);
    
?>