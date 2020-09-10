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







$ready = 0;

// Make Bot Instance
$bot = new FbBotApp($token);

if (!empty($_REQUEST['local'])) {

    $message = new ImageMessage(1585388421775947, dirname(__FILE__).'/fb4d_logo-2x.png');

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
} else {

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
                if(isset($message['message']['attachments'])){ 
                    $command = $message['message']['attachments'][0]['payload']['url'];
                    
                }
                    
                else if(isset($message['message']['text'])){ 
                    $messageText = $message['message']['text']; 
                    //$command = 'text';
                    $command = $messageText;
                    
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

            // Handle command
            $user = $bot->userProfile($message['sender']['id']);
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
                    $bot->send(new QuickReply($message['sender']['id'], "Hi, ".$user->getFirstName()." ".$user->getLastName()."! Type help to get started!", 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Help', 'help_p')

                            ]
                    ));
                    break;
                    

                    /*$bot->send(new StructuredMessage($message['sender']['id'], 
                        StructuredMessage::TYPE_BUTTON,
                        [
                            'text' => $user->getFirstName()." ".$user->getLastName().". You are in! Type 'help' to get started!"
                        
                        ],
                        [
                        	new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'help','help_payload') 
                        ]
                    ));*/
                    
                    break;
                    
                case 'help':
                case 'Help':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], $user->getFirstName()." ".$user->getLastName().", you have to copy important messages related to our batch or college and then paste it to 'IST 27th Batch Cross-Platform Notifier Bot' page inbox. Image uploading or forwarding is supported too, only image url will be sent. These things can be done from Messenger easily. :-D\n\nKeep in mind that when you forward a message (not bot commands), friends from other platforms will know your name. It's just for record who is sending what.\n\nIf the page conversation goes down in the conversation list, you can always message the bot saying 'hi' or 'help' in small letter without quotes to keep the page conversation up in the conversation list.\n\nType 'additional info' to get some extra tips before getting started. Type 'commands' to get a list of available bot commands.\n\nThanks <3.", 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Additional info', 'addition_p'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Commands', 'commands_p'),

                            ]
                    ));
                    break;
                    
                case 'Additional info':
                case 'additional info':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], $user->getFirstName()." ".$user->getLastName().", when you post a notice, try to make it in one message. Don't create multiple messages for one notice. For example, if you want to share Mr Mazid's zoom meeting link, just write 'Mr Mazid's zoom link' (in English or Bengali or Banglish), paste the link and send. It's that simple!\n\n If you mistakenly send a message which requires correction, just add an asterisk sign (*) as the first character of the message and then just mention the correction. DON'T SEND THE WHOLE MESSAGE AGAIN! \nIf you try to send a previous message fully with some correction, bot will ignore message and mark as similar.\n\nGot it?", 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Yeah', 'yeah_p'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'Need Help', 'need_help_p'),

                            ]
                    ));
                    break;
                    
                case 'commands':
                case 'Commands':
                    //$user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new QuickReply($message['sender']['id'], $user->getFirstName()." ".$user->getLastName().", use the commands below for bot operation:\n\nhelp -> Get help.\ncommands -> Get bot commands.\nhi/hello -> Just greet the bot!\nadditional info -> Get additional info before forwarding messages.\n\nAdditional use cases:\n----------------------\n\n1. Use an asterisk before your message if the bot doesn't send any message.\nExample: * here is an important short message.\nDon't put asterisk without any need.\n\n2. Use an @ sign if you want to send a message to admin.\nExample: @ here is a message to admin, thanks.\nNote: Messages sent to admin will not be sent to friends on other platforms.\n\n\nYou got it, right?",
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





                case 'text':
                    $bot->send(new Message($message['sender']['id'], 'This is a simple text message.'));
                    break;

                // When bot receive "image"
                case 'image':
                    $bot->send(new ImageMessage($message['sender']['id'], 'http://bit.ly/2p9WZBi'));
                    break;

                // When bot receive "local image"
                //case 'local image':
                    //$bot->send(new ImageMessage($message['sender']['id'], dirname(__FILE__).'/fb_logo.png'));
                    //break;

                // When bot receive "profile"
                case 'profile':
                    $user = $bot->userProfile($message['sender']['id']);
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_GENERIC,
                        [
                            'elements' => [
                                new MessageElement($user->getFirstName()." ".$user->getLastName(), " ", $user->getPicture())
                            ]
                        ],
                        [ 
                        	new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button','PAYLOAD') 
                        ]
                    ));
                    break;

                // When bot receive "button"
                case 'button':
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_BUTTON,
                        [
                            'text' => 'Choose category',
                            'buttons' => [
                                new MessageButton(MessageButton::TYPE_POSTBACK, 'First button', 'PAYLOAD 1'),
                                new MessageButton(MessageButton::TYPE_POSTBACK, 'Second button', 'PAYLOAD 2'),
                                new MessageButton(MessageButton::TYPE_POSTBACK, 'Third button', 'PAYLOAD 3')
                            ]
                        ],
                        [ 
                        	new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button','PAYLOAD') 
                        ]
                    ));
                    break;
                
                // When bot receive "quick reply"
                case 'quick reply':
                    $bot->send(new QuickReply($message['sender']['id'], 'Your ad here!', 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button 1', 'PAYLOAD 1'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button 2', 'PAYLOAD 2'),
                                new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button 3', 'PAYLOAD 3'),
                            ]
                    ));
                    break;
                    
                // When bot receive "location"
                case 'location':
                    $bot->send(new QuickReply($message['sender']['id'], 'Please share your location', 
                            [
                                new QuickReplyButton(QuickReplyButton::TYPE_LOCATION),
                            ]
                    ));
                    break;
                    
                // When bot receive "generic"
                case 'generic':
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_GENERIC,
                        [
                            'elements' => [
                                new MessageElement("First item", "Item description", "", [
                                    new MessageButton(MessageButton::TYPE_POSTBACK, 'First button'),
                                    new MessageButton(MessageButton::TYPE_WEB, 'Web link', 'http://facebook.com')
                                ]),

                                new MessageElement("Second item", "Item description", "", [
                                    new MessageButton(MessageButton::TYPE_POSTBACK, 'First button'),
                                    new MessageButton(MessageButton::TYPE_POSTBACK, 'Second button')
                                ]),

                                new MessageElement("Third item", "Item description", "", [
                                    new MessageButton(MessageButton::TYPE_POSTBACK, 'First button'),
                                    new MessageButton(MessageButton::TYPE_POSTBACK, 'Second button')
                                ])
                            ]
                        ],
                        [ 
                        	new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button','PAYLOAD')
                        ]
                    ));
                    break;
                    
                // When bot receive "list"
                case 'list':
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_LIST,
                        [
                            'elements' => [
                                new MessageElement(
                                    'Classic T-Shirt Collection', // title
                                    'See all our colors', // subtitle
                                    'http://bit.ly/2pYCuIB', // image_url
                                    [ // buttons
                                        new MessageButton(MessageButton::TYPE_POSTBACK, // type
                                            'View', // title
                                            'POSTBACK' // postback value
                                        )
                                    ]
                                ),
                                new MessageElement(
                                    'Classic White T-Shirt', // title
                                    '100% Cotton, 200% Comfortable', // subtitle
                                    'http://bit.ly/2pb1hqh', // image_url
                                    [ // buttons
                                        new MessageButton(MessageButton::TYPE_WEB, // type
                                            'View', // title
                                            'https://google.com' // url
                                        )
                                    ]
                                )
                            ],
                            'buttons' => [
                                new MessageButton(MessageButton::TYPE_POSTBACK, 'First button', 'PAYLOAD 1')
                            ]
                        ],
                        [
                            new QuickReplyButton(QuickReplyButton::TYPE_TEXT, 'QR button','PAYLOAD')
                        ]
                    ));
                    break;

                // When bot receive "receipt"
                case 'receipt':
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_RECEIPT,
                        [
                            'recipient_name' => 'Fox Brown',
                            'order_number' => rand(10000, 99999),
                            'currency' => 'USD',
                            'payment_method' => 'VISA',
                            'order_url' => 'http://facebook.com',
                            'timestamp' => time(),
                            'elements' => [
                                new MessageReceiptElement("First item", "Item description", "", 1, 300, "USD"),
                                new MessageReceiptElement("Second item", "Item description", "", 2, 200, "USD"),
                                new MessageReceiptElement("Third item", "Item description", "", 3, 1800, "USD"),
                            ],
                            'address' => new Address([
                                'country' => 'US',
                                'state' => 'CA',
                                'postal_code' => 94025,
                                'city' => 'Menlo Park',
                                'street_1' => '1 Hacker Way',
                                'street_2' => ''
                            ]),
                            'summary' => new Summary([
                                'subtotal' => 2300,
                                'shipping_cost' => 150,
                                'total_tax' => 50,
                                'total_cost' => 2500,
                            ]),
                            'adjustments' => [
                                new Adjustment([
                                    'name' => 'New Customer Discount',
                                    'amount' => 20
                                ]),

                                new Adjustment([
                                    'name' => '$10 Off Coupon',
                                    'amount' => 10
                                ])
                            ]
                        ]
                    ));
                    break;

                // When bot receive "set menu"
                case 'set menu':
                    $bot->deletePersistentMenu();
                    $bot->setPersistentMenu([
                        new LocalizedMenu('default', false, [
                            new MenuItem(MenuItem::TYPE_NESTED, 'My Account', [
                                new MenuItem(MenuItem::TYPE_NESTED, 'History', [
                                    new MenuItem(MenuItem::TYPE_POSTBACK, 'History Old', 'HISTORY_OLD_PAYLOAD'),
                                    new MenuItem(MenuItem::TYPE_POSTBACK, 'History New', 'HISTORY_NEW_PAYLOAD')
                                ]),
                                new MenuItem(MenuItem::TYPE_POSTBACK, 'Contact Info', 'CONTACT_INFO_PAYLOAD')
                            ])
                        ])
                    ]);
                    break;

                // When bot receive "delete menu"
                case 'delete menu':
                    $bot->deletePersistentMenu();
                    break;

                // When bot receive "login"
                case 'login':
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_GENERIC,
                        [
                            'elements' => [
                                new AccountLink(
                                    'Welcome to Bank',
                                    'To be sure, everything is safe, you have to login to your administration.',
                                    'https://www.example.com/oauth/authorize',
                                    'https://www.facebook.com/images/fb_icon_325x325.png')
                            ]
                        ]
                    ));
                    break;

                // When bot receive "logout"
                case 'logout':
                    $bot->send(new StructuredMessage($message['sender']['id'],
                        StructuredMessage::TYPE_GENERIC,
                        [
                            'elements' => [
                                new AccountLink(
                                    'Welcome to Bank',
                                    'To be sure, everything is safe, you have to login to your administration.',
                                    '',
                                    'https://www.facebook.com/images/fb_icon_325x325.png',
                                    TRUE)
                            ]
                        ]
                    ));
                    break;

                // When bot receive "sender action on"
                case 'sender action on':
                    $bot->send(new SenderAction($message['sender']['id'], SenderAction::ACTION_TYPING_ON));
                    break;

                // When bot receive "sender action off"
                case 'sender action off':
                    $bot->send(new SenderAction($message['sender']['id'], SenderAction::ACTION_TYPING_OFF));
                    break;

                // When bot receive "set get started button"
                case 'set get started button':
                    $bot->setGetStartedButton('PAYLOAD - get started button');
                    break;

                // When bot receive "delete get started button"
                case 'delete get started button':
                    $bot->deleteGetStartedButton();
                    break;

                // When bot receive "show greeting text"
                case 'show greeting text':
                    $response = $bot->getGreetingText();
                    $text = "";
                    if(isset($response['data'][0]['greeting']) AND is_array($response['data'][0]['greeting'])){
                        foreach ($response['data'][0]['greeting'] as $greeting)
                        {
                            $text .= $greeting['locale']. ": ".$greeting['text']."\n";
                        }
                    } else {
                        $text = "Greeting text not set!";
                    }
                    $bot->send(new Message($message['sender']['id'], $text));
                    break;

                // When bot receive "delete greeting text"
                case 'delete greeting text':
                    $bot->deleteGreetingText();
                    break;

                // When bot receive "set greeting text"
                case 'set greeting text':
                    $bot->setGreetingText([
                        [
                            "locale" => "default",
                            "text" => "Hello {{user_full_name}}"
                        ],
                        [
                            "locale" => "en_US",
                            "text" => "Hi {{user_first_name}}, welcome to this bot."
                        ],
                        [
                            "locale" => "de_DE",
                            "text" => "Hallo {{user_first_name}}, herzlich willkommen."
                        ]
                    ]);
                    break;

                // When bot receive "set target audience"
                case 'show target audience':
                    $response = $bot->getTargetAudience();
                    break;

                // When bot receive "set target audience"
                case 'set target audience':
                    $bot->setTargetAudience("all");
                    //$bot->setTargetAudience("none");
                    //$bot->setTargetAudience("custom", "whitelist", ["US", "CA"]);
                    //$bot->setTargetAudience("custom", "blacklist", ["US", "CA"]);
                    break;

                // When bot receive "delete target audience"
                case 'delete target audience':
                    $bot->deleteTargetAudience();
                    break;

                // When bot receive "show domain whitelist"
                case 'show domain whitelist':
                    $response = $bot->getDomainWhitelist();
                    $text = "";
                    if(isset($response['data'][0]['whitelisted_domains']) AND is_array($response['data'][0]['whitelisted_domains'])){
                        foreach ($response['data'][0]['whitelisted_domains'] as $domains)
                        {
                            $text .= $domains."\n";
                        }
                    } else {
                        $text = "No domains in whitelist!";
                    }
                    $bot->send(new Message($message['sender']['id'], $text));
                    break;

                // When bot receive "set domain whitelist"
                case 'set domain whitelist':
                    //$bot->setDomainWhitelist("https://petersfancyapparel.com");
                    $bot->setDomainWhitelist([
                        "https://petersfancyapparel-1.com",
                        "https://petersfancyapparel-2.com",
                    ]);
                    break;

                // When bot receive "delete domain whitelist"
                case 'delete domain whitelist':
                    $bot->deleteDomainWhitelist();
                    break;

                // Other message received
                /*default:
                    if (!empty($command)) // otherwise "empty message" wont be understood either
                        $bot->send(new Message($message['sender']['id'], 'Sorry. I don’t understand you.'));
                        
                        $user->getFirstName()." ".$user->getLastName()*/
                        
                default:
                    
                    
                    function TelecurlPost($chatId, $textData){
                        $botToken="1099333083:AAGJ2AXaveKcrWzkYee9QINNJd6ZDuMivKs";
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
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    /*function TelecurlPost($chatID, $messageText){    
                        require_once "../ISTtelegram/vendor/autoload.php";
                        // or initialize with botan.io tracker api key
                        // $bot = new \TelegramBot\Api\Client('YOUR_BOT_API_TOKEN', 'YOUR_BOTAN_TRACKER_API_KEY');
                        $teleBot = new \TelegramBot\Api\BotApi('1099333083:AAGJ2AXaveKcrWzkYee9QINNJd6ZDuMivKs');
                    
                    	//$chatID = '-1001222923440';
                    	//$messageText = $_POST['texts'];
                    
                    	$teleBot->sendMessage($chatID, $messageText);
                    }*/
                 
                    
                    
                    
                    
                    
                    
                    /*function TelecurlPost($url, $data) {
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        $response = curl_exec($ch);
                        //curl_close($ch);
                        $error = curl_error($ch);
                        if ($error !== '') {
                            throw new \Exception($error);
                        }
                    
                        return $response;
                    }*/
                    
                    
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
                    
                    
                    $filename = "";
                    
                    //Test
                    //$telegram_webhook = "https://mrchat.tk/mysites_visitor_tracking_bot/run.php";
                    $telegram_webhook = '718057913';
                    $discord_webhook = "https://discord.com/api/webhooks/720920912089710603/DrVtAXjjtGGBXoF_GIkNQ3kR5vdskDKC89bljhG53fdBdp0ovUxoNkq_x6CESTp-e6ZC";
                    
                    //Actual
                    //$telegram_webhook = "https://securechat70.000webhostapp.com/ISTtelegram/run.php";
                    //$telegram_webhook = '-1001222923440';
                    //$discord_webhook = "https://discord.com/api/webhooks/721054965065318401/aULmBSIyX7Cirwf3uUkkK_HR5zszK-LDo9fR5fH1kDDLQMXMpEEhHxOHCULVZOlnsrlA";
            
                    date_default_timezone_set("Asia/Dhaka");
                    $user = $bot->userProfile($message['sender']['id']);
                    if (!empty($command)){ // otherwise "empty message" wont be understood either
                        //if($ready == 1){
                            $file = fopen("lastmsg.txt", "r") or die("Unable to open lastmsg.txt file!");
                            $lastmsg = fread($file,filesize("lastmsg.txt"));
                            $temp = similar_text($command, $lastmsg);
                            
                            
                            
                            if($command[0] == "@"){
                                $bot->send(new Message($message['sender']['id'], $user->getFirstName()." ".$user->getLastName(). ", thanks for your query! I'll notify the admins and they'll contact you! (y)"));
                            }
                            else if($command[0] == "*"){
                                $bot->send(new Message($message['sender']['id'], $user->getFirstName()." ".$user->getLastName(). ", message sent! (y)"));
                                TelecurlPost($telegram_webhook,  $command."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                DisccurlPost($discord_webhook, $command."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                            }
                            else if(strlen($command) == $temp || strlen($lastmsg) == $temp){
                                $bot->send(new Message($message['sender']['id'], $user->getFirstName()." ".$user->getLastName(). ", I have already got the message. Thanks for forwarding though. :-D"));
                            }
                            /*if($lastmsg == $command){
                                $bot->send(new Message($message['sender']['id'], $user->getFirstName()." ".$user->getLastName(). ", I have already got the message. Thanks for forwarding though. :-D"));
                            }*/
                            else{
                                $bot->send(new Message($message['sender']['id'], $user->getFirstName()." ".$user->getLastName(). ", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3"));
                                
                                if(strlen($command) > 1940){
                                    
                                    /*$textsArray = str_split($command, 1940);
                                    
                                        for($i = 0; $i < sizeof($textsArray); $i++){
                                            if($i != sizeof($textsArray)-1){
                                                TelecurlPost($telegram_webhook,  $textsArray[$i]."\n\n##Continue reading to next message##");
                                                DisccurlPost($discord_webhook, $textsArray[$i]."\n\n##Continue reading to next message##");
                                                sleep(3);
                                            }
                                            else{
                                                TelecurlPost($telegram_webhook,  $textsArray[sizeof($textsArray)-1]."\n\nForwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                                DisccurlPost($discord_webhook, $textsArray[sizeof($textsArray)-1]."\n\nForwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                            }
                                        }*/
                                        $feed_page_dir = "https://securechat70.000webhostapp.com/feed/";
                                        
                                        $filename = date("Y-m-d_h-i-s_a_").time().".txt";
                                        $filedir = "../feed/feedtxt/".$filename;
                                        $feedfile = fopen($filedir, "w");
                                        fwrite($feedfile, $command);
                                        
                                        $mainText = substr($command, 0, 1940);
                                        TelecurlPost($telegram_webhook,  $mainText."\n\n#Full message available at: ".$feed_page_dir."?file=".$filename."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                        DisccurlPost($discord_webhook, $mainText."\n\n#Full message available at: ".$feed_page_dir."?file=".$filename."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                }
                                else if(strlen($command) <= 20){
                                    $bot->send(new Message($message['sender']['id'], "Invalid bot command or message doesn't have a value. Put an asterisk as the first character of the message if the message is important.\n\nExample:\n* here is an important message."));
                                }
                                else{
                                    //$bot->send(new Message($message['sender']['id'], $user->getFirstName()." ".$user->getLastName(). ", your message is being forwarded to friends in other social platforms. Thanks for your kind effort! <3"));
                                   
                                    TelecurlPost($telegram_webhook,  $command."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                    DisccurlPost($discord_webhook, $command."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                    //$bot->send(new Message($message['sender']['id'], $t));
                                }
                                
                                $file = fopen("lastmsg.txt", "w") or die("Unable to open lastmsg.txt file!");
                                fwrite($file, $command);
                               
                                if($filename == ""){
                                    $filename = date("Y-m-d_h-i-s_a_").time().".txt";
                                    $filefeed = fopen("../feed/feedtxt/".$filename, "w");
                                    fwrite($filefeed, $command."\n\n##Forwarded by:\n".$user->getFirstName()." ".$user->getLastName());
                                }
                                
                                 $fileArr = fopen("../feed/mList.txt", "a+") or die("Unable to open gList.txt file!");
                                 fwrite($fileArr, $filename."\n");
                                
                                
                            }
                    
                }
            }
        }
    }
}