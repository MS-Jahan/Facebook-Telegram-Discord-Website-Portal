<?php

$verify_token = ""; // Verify token
$token = ""; // Page token

if (file_exists(__DIR__ . '/config.php')) {
    $config = include __DIR__ . '/config.php';
    $verify_token = $config['verify_token'];
    $token = $config['token'];
}

require_once(dirname(__FILE__) . '/vendor/autoload.php');

use pimax\FbBotApp;
use pimax\Menu\MenuItem;
use pimax\Menu\LocalizedMenu;
use pimax\Messages\Message;
use pimax\Messages\MessageButton;
use pimax\Messages\StructuredMessage;
use pimax\Messages\MessageElement;
use pimax\Messages\MessageReceiptElement;
use pimax\Messages\Address;
use pimax\Messages\Summary;
use pimax\Messages\Adjustment;
use pimax\Messages\AccountLink;
use pimax\Messages\ImageMessage;
use pimax\Messages\QuickReply;
use pimax\Messages\QuickReplyButton;
use pimax\Messages\SenderAction;


//Test
//$telegram_webhook = "https://mrchat.tk/mysites_visitor_tracking_bot/run.php";
$test_telegram_webhook = 'personal-chat-id'; //for personal testing
$test_discord_webhook = "discord webhook url for personal testing";

//Actual
//$telegram_webhook = "https://ist27thbatch.tk/ISTtelegram/run.php";
$telegram_webhook = 'group chat id';
$discord_webhook = "discord group webhook url";



// Make Bot Instance
$bot = new FbBotApp($token);

/*function sendMsg($msg){
    global $bot;
	$bot->send(new Message($message['sender']['id'], $msg));
}*/

$percent = 0.0;

if (!empty($_REQUEST['local'])) {

    $message = new ImageMessage(1585388421775947, dirname(__FILE__).'/fb4d_logo-2x.png'); //example line

    $message_data = $message->getData();
    $message_data['message']['attachment']['payload']['url'] = 'fb4d_logo-2x.png';

    echo '<pre>', print_r($message->getData()), '</pre>';

    $res = $bot->send($message);

    echo '<pre>', print_r($res), '</pre>';
}

// Receive something
if (!empty($_REQUEST['hub_mode']) && $_REQUEST['hub_mode'] == 'subscribe' && $_REQUEST['hub_verify_token'] == $verify_token) {

	// Webhook setup request
	echo $_REQUEST['hub_challenge'];
} 
else {

    // Other event
    $data = json_decode(file_get_contents("php://input"), true, 512, JSON_BIGINT_AS_STRING);
    if (!empty($data['entry'][0]['messaging'])) {

        foreach ($data['entry'][0]['messaging'] as $message) {

            // Skipping delivery messages
            if (!empty($message['delivery'])) {
                continue;
            }

            // skip the echo of my own messages
            if (($message['message']['is_echo'] == "true")) {
                continue;
            }

            $command = "";
            
            
            if (!empty($message['message'])) { 
                    
                if(isset($message['message']['text'])){ 
                    $messageText = $message['message']['text']; 
                    //$command = 'text';
                    $command = $messageText;
                    
                }
				
				else if(isset($message['message']['attachments'])){ 
                    $command = $message['message']['attachments'][0]['payload']['url'];
                    
                }
                
            } 
            else if (!empty($message['postback'])) { 
                $command = $message['postback']['payload'];
                if($command == "help_p"){
                    $command = "help";
                }
                else if($command == "addition_p"){
                    $command = "Additional info";
                }
                else if($command == "yeah_p"){
                    $command = 'yeah';
                }
                else if($command == "need_help_p"){
                    $command = 'need help';
                }
            }
            
            
            
            
//11111111111111111111111111111111111111111111111111111111111111111111111111111111111111
            // When bot receive message from user
            /*if (!empty($message['message'])) {
                $command = trim($message['message']['text']);

            // When bot receive button click from user
            } else if (!empty($message['postback'])) {
                $text = "Postback received: ".trim($message['postback']['payload']);
                $bot->send(new Message($message['sender']['id'], $text));
                continue;
            }
            else if (!empty($message['message']['attachment'])) {
                $bot->send(new Message($message['sender']['id'], "Image received!"));
                $text = "Image received: ".trim($message['message']['attachment']['payload']['url']);
                $bot->send(new Message($message['sender']['id'], $text));
                continue;
            }*/
            
            
            /*$age = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

            foreach($age as $x => $val) {
              if($x == "Joe"){
              	echo $val;
              }
            }*/



            $MembersID_array = array("3290406887658408" => "Md. Sarwar Jahan Sabit",
                            "3863579487046348" => "Kita kow mia tumi", //Sarwar's Fake Account!
                			"3045390258879803" => "Hasibul Rahman Hisam",
                			"3966137043461561" => "Sharmin Akter Maria",
                			"4029411147133477" => "Aroosa Afsa",
                			"2804468139659044" => "Jahid Hassan Amit",
                			"4218543481521711" => "Abu Sufian",
                			"2951683418287626" => "Shakil Mahmud Sumon",
                			"2237856069673049" => "Muntasir Munir Khan",
                			"2910141699111827" => "MD Shahadot Hosen",
                			"2746155568821950" => "Imran HOssain RaZz",
                			"2299900830134825" => "Tasin Mahmud",
                			"4319750564733930" => "Rakib Md Osman Faruque",
                			"3311672798889032" => "Robiul Islam Sagor",
                			"3259626384151092" => "Muhammad Imran",
                			"3252501204816209" => "Prince Rock Hossain",
                			"4735294046488418" => "Towfiq Hassan",
                			"3200803696655139" => "Rafshedul Amin Antor",
                			"4731330063607723" => "Mostak Al Mehidi Rakik",
                			"2927961443980181" => "Mzi Jibon",
                			"3724683767560587" => "Jahid Ibna Sinha",
                			"4947194938639475" => "Mahmudul Hasan Sarkar",
                			"3323375344397753" => "Sajib Raihan",
                			"4717609148279467" => "Nusrat Jahan Nowrin"
                			
			);
			
			$Authorization = True;

            $user = $bot->userProfile($message['sender']['id']);
			$username = $user->getFirstName()." ".$user->getLastName();
			
			if (array_key_exists($message['sender']['id'], $MembersID_array)) {
                $username = $MembersID_array[$message['sender']['id']];
            }

			if($username == " "){
			    $username = "friend";
			}
			
			// Handle command
            switch ($command) {

                // When bot receive "text"
                case 'hi':
                case 'hello':
                case 'Hi':
                case 'Hello':
                case 'hi/hello':
                case 'Hi/hello':
                case 'Hi/Hello':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], "Hi, ".$username."! Type help to get started! :-D\n\nSender ID: ".$message['sender']['id'], 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Help', 'help_p')

                            ]
                    ));
                    
                    //$bot->send(new Message($message['sender']['id'], "Sender ID: ".$message['sender']['id']));
                    
                    break;

                    
                case 'help':
                case 'Help':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], $username.", you have to copy important messages related to our batch or college and then paste it to 'IST 27th Batch Cross-Platform Notifier Bot' page inbox. Image uploading or forwarding is supported too, only image url will be sent. These things can be done from Messenger easily. :-D\n\nKeep in mind that when you forward a message (not bot commands), friends from other platforms will know your name. It's just for record who is sending what.\n\nIf the page conversation goes down in the conversation list, you can always message the bot saying 'hi' or 'help' in small letter without quotes to keep the page conversation up in the conversation list.\n\nType 'additional info' to get some extra tips before getting started. Type 'commands' to get a list of available bot commands.\n\nREMEMBER, YOU HAVE TO GET AUTHORIZATION FROM ADMIN TO SEND MESSAGES TO OTHER SOCIAL PLATFORM!\n\nThanks <3.\n\nWatch the video to understand more: \nhttps://www.facebook.com/mdsarwarjahan.sabit/videos/1460945047423452/ \n\nSender ID: ".$message['sender']['id'], 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Additional info', 'addition_p'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Commands', 'commands_p'),

                            ]
                    ));
                    break;
                    
                case 'Additional info':
                case 'additional info':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], $username.", when you post a notice, try to make it in one message. Don't create multiple messages for one notice. For example, if you want to share Mr Mazid's zoom meeting link, just write 'Mr Mazid's zoom link' (in English or Bengali or Banglish), paste the link and send. It's that simple!\n\n If you mistakenly send a message which requires correction, just add an asterisk sign (*) as the first character of the message and then just mention the correction. DON'T SEND THE WHOLE MESSAGE AGAIN! \nIf you try to send a previous message fully with some correction, bot will ignore message and mark as similar.\n\nGot it?", 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Yeah', 'yeah_p'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Need Help', 'need_help_p'),

                            ]
                    ));
                    break;
                    
                case 'commands':
                case 'Commands':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], $username.", use the commands below for bot operation:\n\nhelp -> Get help.\ncommands -> Get bot commands.\nhi/hello -> Just greet the bot!\nadditional info -> Get additional info before forwarding messages.\n\nAdditional use cases:\n----------------------\n\n1. Use an asterisk before your message if the bot doesn't send any message.\nExample: * here is an important short message.\nDon't put asterisk without any need.\n\n2. Use an @ sign if you want to send a message to admin.\nExample: @ here is a message to admin, thanks.\nNote: Messages sent to admin will not be sent to friends on other platforms.\n\n\nYou got it, right?",
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Yeah', 'yeah_p'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Need Help', 'need_help_p'),

                            ]
                    ));
                    break;

                
                case 'yeah':
                case 'Yeah':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new Message($message['sender']['id'], "Very good. Glad to hear that! :-D (y)"));
                    break;
                
                
                case 'Need Help':
                case 'need help':
                case 'Need help':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new Message($message['sender']['id'], "Leave a message for admin. Make sure you send your query in one message. Queries in more than one message will be sent to friends in other platforms by default and they'll also know your name. ;-p \n\nType '@' as the first character of yor message so that bot can recognize that you're seeking help."));
                    break;
                    
                    
                case 'how are you':
                case 'How are you':
                    $bot->send(new Message($message['sender']['id'], "I'm fine! Glad you asked! :-D (y)"));
                    break;
                case 'how are you?':
                case 'How are you?':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new Message($message['sender']['id'], "I'm good! Thanks for asking. :-D (y)"));
                    break;
                case 'get routine':
                case 'Get routine':
                case 'Get Routine':
                    //$user = $bot->userProfile($message['sender']['id']);
                    
                    $bot->send(new ImageMessage($message['sender']['id'], 'https://prodipto27.github.io/prodipto27-routine.png'));
                    $bot->send(new Message($message['sender']['id'], "Here is your routine! :-D (y)\n\nSender ID: ".$message['sender']['id']));
                    break;
     
                default:
                    
                    
                    function TelecurlPost($chatId, $textData){
                        $botToken="bot-token";
                        $website="https://api.telegram.org/bot".$botToken;
                        //$chatId=1234567;  //Receiver Chat Id 
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
                        //curl_close($ch);
                    }

                    
                    
                    function DisccurlPost($url, $msg){
                        $curl = curl_init($url);
                        
                        /*curl_setopt($curl, CURLOPT_POST, 1);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array("content" => $msg, "username" => "IST27thNotifierBOT")));*/
                        
                        
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
						//curl_close($curl);
						/*$error = curl_error($curl);
						if ($error !== '') {
							throw new \Exception($error);
						}
						*/
						return $response;
					}
                    
                    
                    
                    function onesignalNotification($msg){
                        $heading = array(
                            "en" => "মেসেঞ্জার গ্রুপ থেকে নোটিশ!"
                            
                            );
                        $content      = array(
                            
                            "en" => $msg
                        );
                        $hashes_array = array();
                        array_push($hashes_array, array(
                            "id" => "show-button",
                            "text" => "দেখাও",
                            "icon" => "http://i.imgur.com/N8SN8ZS.png",
                            "url" => "https://ist27thbatch.tk/notice/message/"
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
                        
                        //return $response;
                        
                    }
                    
                    
                    function routineSaveToGit(){
                        
                        $fileContent = file_get_contents("../routine/routine.txt");

                        //echo(gettype($fileContent));
                        //echo(sha1($fileContent));
                        
                        $sha = file_get_contents("../routine/sha_ttt.txt");
                                                
                        $data = '{
                          "message": "routine add",
                          "sha" : "'.$sha.'",
                          "committer": {
                            "name": "Prodipto27FromApi",
                            "email": "ist27thbatch@gmail.com"
                          },
                          "content": "'.base64_encode($fileContent).'"
                        }';
                        
                        $token = "github-token";
                        
                        $url = "https://api.github.com/repos/prodipto27/prodipto27.github.io/contents/routine.txt";
                        
                        $username = "prodipto27";
                        
                        $curl_url = $url;
                        $curl_token_auth = 'Authorization: token ' . $token;
                        $ch = curl_init($curl_url);
                        
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'User-Agent: $username', $curl_token_auth ));
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        
                        $response = curl_exec($ch);
                        $arr = json_decode($response);
                        file_put_contents("../routine/sha_ttt.txt", $arr->content->sha);
                        //return $response;
                        
                        //echo($response);
                        
                    }
                    
                    
                    
                    
					
					function sendToOthers($msg){
					    global $telegram_webhook, $discord_webhook;
						TelecurlPost($telegram_webhook, $msg);
						DisccurlPost($discord_webhook, $msg);
						onesignalNotification($msg);

					}
					
					function sendToTest($msg){
					    global $test_telegram_webhook, $test_discord_webhook;
						TelecurlPost($test_telegram_webhook, $msg);
						DisccurlPost($test_discord_webhook, $msg);
						onesignalNotification($msg);

					}
					
					
					function writeFeed(){
					    global $command, $username;
						$filename = date("Y-m-d_h-i-s_a_").time().".txt";
						$filedir = "../feed/feedtxt/".$filename;
						$feedfile = fopen($filedir, "w");
						fwrite($feedfile, "<b id='datetime'>".date('d/m/Y h:i:s a')."</b>\n\n".$command."\n\n<em>Forwarded By:\n".$username."</em>");
						
						$file = fopen("lastmsg.txt", "w") or die("Unable to open lastmsg.txt file!");
						fwrite($file, $command);
						
						$fileArr = fopen("../feed/mList.txt", "a+") or die("Unable to open gList.txt file!");
						fwrite($fileArr, $filename."\n");
						
						
						return $filename;
					}
					
					
					
					
					function isSimilarMsg($command){
					    global $command, $percent;
						$file = fopen("lastmsg.txt", "r") or die("Unable to open lastmsg.txt file!");
						$lastmsg = fread($file,filesize("lastmsg.txt"));
						if($lastmsg == ""){
						    $lastmsg = "TTT";
						}
						$temp = similar_text($command, $lastmsg, $percent);
						
						/*if($lastmsg == $command){
							$bot->send(new Message($message['sender']['id'], $username. ", I have already got the message. Thanks for forwarding though. :-D"));
						}*/
						
						
						/*if(strlen($command) == $temp || strlen($lastmsg) == $temp){
							return True;
						}*/
						
						
						if($percent >= 65){
						    return True;
						}
						else{
						    return False;
						}
					}
					
					
				    function isMember($userID, $MembersID_array){
				        if (array_key_exists($userID, $MembersID_array)){
				            return True;
				        }
				        else{
				            return False;
				        }
				    }
					
                    function deleteLineInFile($file, $line){
                    	$i = 0; $array = array();
                    	
                    	$read = fopen($file, "r") or die("can't open the file");
                    	while(!feof($read)){
                    		$array[$i] = fgets($read);	
                    		++$i;
                    	}
                    	
                    	fclose($read);
                    	
                    	
                    	
                    	$write = fopen($file, "w") or die("can't open the file");
                    	foreach($array as $a) {
                    		    fwrite($write, $a);
                    	}
                    	fclose($write);
                    }
                    
            
                    date_default_timezone_set("Asia/Dhaka");
                    $user = $bot->userProfile($message['sender']['id']);
                    if (!empty($command)){ // otherwise "empty message" wont be understood either
						
						if($command[0] == "$"){  //test message
						    $bot->send(new Message($message['sender']['id'], $username. ", your message was:\n\n" .$command));
						    $filename = date("Y-m-d_h-i-s_a_").time().".txt";
    						$filedir = "../feed/feedtxt_test/".$filename;
    						$feedfile = fopen($filedir, "w");
    						fwrite($feedfile, "<b id='datetime'>".date('d/m/Y h:i:s a')."</b>\n\n".$command."\n\n<em>Forwarded By:\n".$username."</em>");
    						
    						sendToTest($command."\n\nSent by: ".$username);
    						
						}
						
						else if($command[0] == "@"){  //talk to admin
							//sendMsg($username.", thanks for your query! I'll notify the admins and they'll contact you! (y)");
							$bot->send(new Message($message['sender']['id'], $username. ", thanks for your query! I'll notify the admins and they'll contact you! (y)"));
						}
						
						
						else if($command[0] == "^"){  //class routine
							//sendMsg($username.", thanks for your query! I'll notify the admins and they'll contact you! (y)");
							
							if (strpos($command, 'overw') !== false) {
							    $routineFile = fopen("../routine/routine.txt", "w");
    						    fwrite($routineFile, $command."\n");
    						    fclose($routineFile);
    						    routineSaveToGit();
    						    $bot->send(new Message($message['sender']['id'], $username. ", thanks for informing about new class time (y)"));
							}
							
							else if (strpos($command, 'append') !== false) {
							    $routineFile = fopen("../routine/routine.txt", "a");
    						    fwrite($routineFile, $command."\n");
    						    fclose($routineFile);
    						    routineSaveToGit();
    						    $bot->send(new Message($message['sender']['id'], $username. ", thanks for informing about new class time (y)"));
							}
							
							else if (strpos($command, 'show') !== false) {
							    $fileContent = file_get_contents("../routine/routine.txt");
							    $bot->send(new Message($message['sender']['id'], $fileContent));
							}
							else if (strpos($command, 'replace') !== false) {
							    
							    
							    
                                $command = explode(",",$command);
                                $dir = "../routine/routine.txt";
                                $fileContent = file_get_contents($dir);
                                
                                $content = explode("\n",$fileContent);
                                
                                //$fileContent[$command[2]-1] = "";
                                
                                $fileContent = str_replace($content[$command[2]-1]."\n", "", $fileContent);
                                //$fileContent[0] =  "";
                                file_put_contents($dir, $fileContent);
                                routineSaveToGit();
                                $fileContent = file_get_contents($dir);
							    $bot->send(new Message($message['sender']['id'], "File modified!\n\n".$fileContent.$command[2]));
							}
							
							else{
							    $bot->send(new Message($message['sender']['id'], "Invalid usage.\nUsage:\n\n^,append,Physics,10-10-2020,Sunday,10:00 am,\"special message\" \n\n^,overw,Physics,10-10-2020,Sunday,10:00 am,\"special message\" \n\n^ show"));
							}
						}
						
						else if($command[0] == "*"){  //force send message
							//sendMsg($username.", message sent! (y)");
							if(isMember($message['sender']['id'], $MembersID_array) == True){
    							$bot->send(new Message($message['sender']['id'], $username. ", message sent! (y)"));
    							writeFeed();
    							sendToOthers($command."\n\n<em>Forwarded By:\n".$username."</em>");
							}
							else{
							    $bot->send(new Message($message['sender']['id'], $username. ", you're not authorised to perform this operaton! (n)\n\nContact admin via Messenger or email to get authorization. If you have already generated the bot token, wait a while untill admin authorises you manually.\n\nSender ID: ".$message['sender']['id']."\n\nEmail: ssarwar@pm.me"));
							}
						}

						else{
							
							//$bot->send(new Message($message['sender']['id'], $username. ", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3"));
							if(isMember($message['sender']['id'], $MembersID_array) == True){
    							if(strlen($command) > 1920){
    								
    								/*$textsArray = str_split($command, 1940);
    								
    								for($i = 0; $i < sizeof($textsArray); $i++){
    									if($i != sizeof($textsArray)-1){
    										TelecurlPost($telegram_webhook,  $textsArray[$i]."\n\n##Continue reading to next message##");
    										DisccurlPost($discord_webhook, $textsArray[$i]."\n\n##Continue reading to next message##");
    										sleep(3);
    									}
    									else{
    										TelecurlPost($telegram_webhook,  $textsArray[sizeof($textsArray)-1]."\n\nForwarded by:\n".$username);
    										DisccurlPost($discord_webhook, $textsArray[sizeof($textsArray)-1]."\n\nForwarded by:\n".$username);
    									}
    								}*/
    								if(isSimilarMsg($command)){
    							    $bot->send(new Message($message['sender']['id'], $username. ", I have already got the message. (".$percent."% similarity detected!) \nThanks for forwarding though. :-D"));
    							    //sendMsg($username.", I have already got the message. Thanks for forwarding though. :-D");
    							    }
    						    	else{
        								$feed_page_dir = "https://ist27thbatch.tk/feed/";
        								$filename = writeFeed();
        								$mainText = substr($command, 0, 1920);
        								
        								//sendMsg($username.", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3");
        								
        								$bot->send(new Message($message['sender']['id'], $username. ", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3 "));
        								sendToOthers($mainText."\n\n#Full message available at: ".$feed_page_dir."?file=".$filename."\n\n##Forwarded by:\n".$username);
    						    	}
    								
    							}
    							else if(strlen($command) <= 20){
    								//sendMsg("Invalid bot command or message doesn't have a value. Put an asterisk as the first character of the message if the message is important.\n\nExample:\n* here is an important message.");
    								$bot->send(new Message($message['sender']['id'], "Invalid bot command or message doesn't have a value. Put an asterisk as the first character of the message if the message is important.\n\nExample:\n* here is an important message.\n\n\nType 'help' to get started!"));
    							}
    							else{
    							    if(isSimilarMsg($command)){
    							    $bot->send(new Message($message['sender']['id'], $username. ", I have already got the message. (".$percent."% similarity detected!) Thanks for forwarding though. :-D"));
    							    //sendMsg($username.", I have already got the message. Thanks for forwarding though. :-D");
    							    }
    						    	else{
        								//sendMsg($username.", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3");
        								$bot->send(new Message($message['sender']['id'], $username. ", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3"));
        								writeFeed();
        								
        								sendToOthers($command."\n\n##Forwarded by:\n".$username);
    						    	}
    								
    							}
							
						}
						else{
							    $bot->send(new Message($message['sender']['id'], $username. ", you're not authorised to perform this operaton! (n)\n\nContact admin via Messenger or email to get authorization. If you've already generated bot token, please wait a while untill admin authorises you manually.\n\nSender ID: ".$message['sender']['id']."\n\nEmail: ssarwar@pm.me"));
							}
					}
                    
				}
			}
        }
    }
}

sleep(5);