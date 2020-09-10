
<!DOCTYPE html>
<html lang="en">
    <head>
        
        
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />  
  
        <meta name="theme-color" content="#FFFFFF"/>  
        <meta name="apple-mobile-web-app-capable" content="yes">  
        <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
        <meta name="apple-mobile-web-app-title" content="প্রদীপ্ত-২৭"> 
        <meta name="msapplication-TileImage" content="../../images/icons/icon-144x144.png">  
        <meta name="msapplication-TileColor" content="#FFFFFF">
        
        
        
        <link rel="apple-touch-icon" sizes="180x180" href="../../images/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../../images/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../../images/icons/favicon-16x16.png">
        
        <link rel="mask-icon" href="../../images/icons/safari-pinned-tab.svg" color="#248ba8">
        <link rel="shortcut icon" href="../../images/icons/favicon.ico">

        
        
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        
        <meta property="og:title" content="IST 27th Batch Messenger Notices Feed" />
        <meta property="og:url" content="https://ist27thbatch.tk/notice/message/" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="https://ist27thbatch.tk/ist_logo.png" />
        <meta property="og:description" content="This page shows our Facebook group posts." />
        
        
        <meta property="fb:app_id" content="941310122964942" />
        
        
        
        
        
        
        <title>IST 27th Batch Notices Feed</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        
        html {
          scroll-behavior: smooth;
        }
        
        body {
          font-family: Arial;
          margin: 0;
        }
        
        /* Header/Logo Title */
        .header {
          padding: 60px;
          text-align: center;
          background: #1abc9c;
          color: white;
          font-size: 15px;
        }
        
        
        .footer {
           position: fixed;
           left: 0;
           bottom: 0;
           width: 100%;
           background-color: grey;
           color: white;
           text-align: center;
        }
        
        
        /* Page Content 
        .content {padding:20px;}*/
        
        .msgLoader{
        	position:fixed;
        	z-index: 99999;
        	width:80px;
        	height:80px;
        	bottom:40px;
        	right:10px;
        	background-color:#000000;
        	color:#FFF;
        	border-radius:50px;
        	text-align:center;
        	box-shadow: 2px 2px 3px #999;
            text-decoration: none;
            padding-bottom:-1px;
            transition: transform .2s;
          
        }
        
        .msgLoaderFA{
            z-index: 99999;
        	margin-top: -7px;
          font-size: 18px;
        }
        
        .msgLoader:hover{
          background-color:#FFFFFF;
          color:#000;
          transform: scale(1.5);
        }
        
        
        #item {
          border-radius: 15px 50px;
          background: #4c9aff;
          padding: 20px; 
          width: 80%;
          color: white;
          margin: auto;
          
          /*height: 150px;*/
          overflow: hidden;
          text-overflow: ellipsis;
          text-align: justify;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
          
          
          
        }
        
        .morecontent span {
            display: none;
        }
        
        .morelink {
            display: block;
        }
        
        
        #scrollUp {
          display: none;
          position: fixed;
          bottom: 40px;
          left: 10px;
          z-index: 99999;
          font-size: 18px;
          border: none;
          outline: none;
          background-color: red;
          color: white;
          cursor: pointer;
          /*padding: 15px;*/
          border-radius: 50px;
          height: 80px;
          width: 80px;
          transition: transform .2s;
          
        }
        
        #scrollUpText {
            font-size: 15px;
            */margin-top: -10px;*/
        }
        
        #scrollUp:hover {
          background-color: #555;
          transform: scale(1.5)
        }
        
        .fa-angle-up{
            margin-top: -15px;
        }
        
        #button1{
            display: none;
        }
        
        .overlay {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.9);
            overflow-x: hidden;
            transition: 0.5s;
            border: 1px;
            border-color: #dbd3d3;
            border-style: solid;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        
        .overlay-content {
          position: relative;
          /*top: 25%;*/
          width: 100%;
          text-align: center;
          margin-top: 40px;
        }
        
        .overlay tr  {
            padding: 8px;
            text-decoration: none;
            font-size: 22px;
            color: #fff;
            display: block;
            transition: 0.3s;
            border-bottom: 1px solid antiquewhite;
            background: black;
        }
        
        
        .overlay tr:hover, .overlay tr:focus {
          color: black;
          background-color: white;
        }
        
        .overlay .closebtn {
          text-decoration: none;
          position: absolute;
          top: 10px;
          right: 15px;
          font-size: 20px;
          color: white;
        }
        
        
        #hamburgerButton{
            font-size:30px;
            cursor:pointer;
            float:left;
            right:1px;
            position:static;
            bottom:10px;
            margin-left:-40px;
            margin-top:-29px
        }
        
        
        
        
        @media screen and (min-width: 800px) {
          .header {
              font-size: 20px;
              
          }
        }
        
        @media screen and (min-width: 900px) {
          .header {
          font-size: 25px;
          }
          .msgLoader{
              right: 40px;
          }
          #scrollUp {
              left: 40px;
          }
          #item{
              margin: 10px 20px 10px 20px;
          }
        }
        
        @media screen and (min-width: 1000px) {
            #hamburgerButton{
                margin-left:-10px;
            }
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>




<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "onesignal-app-token",
    });
  });
</script>


<script type='text/javascript'>
  window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '59d112b3de1f2a710f4904770360c9a5b359ee1b');
</script>





    
</head> 
  
<body style="text-align:center;">
    
    
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '941310122964942',
          xfbml      : true,
          version    : 'v7.0'
        });
        FB.AppEvents.logPageView();
      };
    
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
    
    
    
    <div class="header">
      <span id="hamburgerButton" onclick="openNav()">&#9776;</span>
      <h1>IST 27th Batch Messenger Notices Feed</h1>
      <p>College Notifications Made Hassle Free!</p>
      <!--<button id="refresh" onClick="location.reload()"><div id="refreshText">Refresh Page</div></button>-->
      
  
      
    </div>
    <button onclick="topFunction()" id="scrollUp" title="Go to top"><b><i class="fa fa-arrow-up" aria-hidden="true"></i><div id="scrollUpText">Scroll Up</div></b>
    </button>
    
    
    
    <div id="hamburgerNav" class="overlay">
      
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        
        <table class="overlay-content">
            <tr><td style="cursor: pointer;" onClick="location.reload()"><i class="fa fa-refresh"></i> Reload Posts</td></tr>
            <tr><td style="cursor: pointer;" onClick="location.replace('https://ist27thbatch.tk/notice/group/');"><i class="fa fa-users" aria-hidden="true"></i>
 Load FB Group Posts</td></tr>
            <tr><td style="cursor: pointer;" onClick="g_classroom_prompt()"><i class="fa fa-google" aria-hidden="true"></i>
Join Google Classroom</td></tr>
            <tr><td style="cursor: pointer;" onClick="pdfselector()"><i class="fa fa-book" aria-hidden="true"></i>
NU CSE Syllabus</td></tr>
        </table>
    </div>
 
 
 
 
 
 
 
 
 
 
 
 
  
    <?php
        
        $colors = array("red", "green", "blue", "yellow", "black", "white","grey"); 
        //$i = sizeof($colors) - 1;
        //echo $colors[0]."<br>";
        //$temp = $i;
        
        //if(isset($_POST['button1'])) {
            $lines = file("../../feed/mList.txt", FILE_IGNORE_NEW_LINES);
            
            //print_r($lines);
            
            echo "<br><br><br>";
            
            
            //echo nl2br(file_get_contents("../../feed/feedtxt/2020-06-24_01-12-16_pm_1592982736.txt"));
            
            
            //$file = file_get_contents("../../feed/feedtxt/".$i);
            //print_r(nl2br($file));
            
            
            $i = 0;
            
            
            //echo gettype($lines)."<br>";
            //echo sizeof($lines);
            
            $file_strings = array();
            
            for($i = 0; $i < sizeof($lines); $i++){
                $file = file_get_contents("../../feed/feedtxt/".$lines[$i]);
                //print_r(nl2br($file."<br> <hr style='height:2px;border-width:0;color:gray;background-color:gray'> <br>"));
                array_push($file_strings, nl2br($file));
            }
            
            //print_r($file_strings);

            
            //array_shift($colors);
            //echo $colors[0]."<br>";
            /*echo "i = ".$i."<br>";
            $temp = $temp - 1;
            echo "temp = ".$temp."<br>";
            
            if($i < 0 || $i >= sizeof($colors)){
                echo "baal fala ela <br>";
            }
            else{

                echo $colors[$temp]."<br>";

            }*/
        //} 
        if(isset($_POST['button2'])) { 
            echo "This is Button2 that is selected"; 
        } 
    ?> 
    

    
    
    
    
    
    
    <!--<button class='button' align="center" style="background-color: green;height: 20px; weight: 10px;">Next item</button>-->
    <a href="#follow" id="button" class="msgLoader"><br><b>Load Posts</b><br><i class="fa fa-arrow-down msgLoaderFA"></i></a>
    <a href="#follow" id="button1" class="msgLoader"><br><b>Scroll Down</b><br><i class="fa fa-arrow-down msgLoaderFA"></i></a>
    <div id='display'></div> 
    
    <script>
    
        function g_classroom_prompt(){
            Swal.fire({
              icon: 'info',
              title: 'Join Google Classroom',
              html: 'তোমাকে গুগল ক্লাসরুমের লিংকে পাঠানো হচ্ছে। জিমেইলে লগিন করা না থাকলে ইমেইল আর পাসওয়ার্ড চাইবে, সঠিক তথ্য দিয়ে লগিন করে নিতে হবে। <br/><br/>যদি আগেই ক্লাসে জয়েন হয়ে থাকো, তবে স্বয়ংক্রিয়ভাবেই ক্লাসরুমের ফিড পেজ দেখতে পাবে। আর যদি আগে জয়েন হয়ে না থাকো, তবে পেজের উপরের দিকে + (যোগ চিহ্ন) তে ক্লিক করে Join Class এ ক্লিক করতে হবে। এরপরে নিচের Class code-টি লিখে জয়েন হতে হবে:<br/><br/><b>dtbe3oc</b><br/>',
              confirmButtonText:"<a style='text-decoration: none; color: white' href='https://classroom.google.com/?emr=0'><i class='fa fa-thumbs-up'></i> ঠিকাছে!</a>"
            });
        }
    
    
    
    
        
        function urlify(text) {
          var urlRegex =/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
          return text.replace(urlRegex, function(url) {
            return '<a href="' + url + '">' + url + '</a>';
          })
          // or alternatively
          // return text.replace(urlRegex, '<a href="$1">$1</a>')
        }
        
        //var text = 'Find me at http://www.example.com and also at http://stackoverflow.com';
        //var html = urlify(text);
        
        
        
        
        
        var items = <?php echo json_encode($file_strings); ?>;
        var i = 0;
        
        
        
        function popup(){
            Swal.fire({
              icon: 'info',
              title: 'Stop Right There!',
              text: 'Last post on server has been shown!'
            });
        }
        
        
        function showMsg(j){
            for(i = 0; i < j; i++){
            if(items.length <= 0){
                document.getElementById("button").style.display = "none";
                document.getElementById("button1").style.display = "block";
                setTimeout(popup, 500);
                break;
            }
            else{
                var rand = items[items.length - 1];
            	$('#display').append("<br><div id='item'>"+urlify(rand)+"</div><br>");
            	
            	//items.splice(items.indexOf(rand), 1);
            	items.pop();
            }
          }
        }
        
        
        
        function openNav() {
            if(window.screen.availWidth >= 800){
                document.getElementById("hamburgerNav").style.width = "40%";
            }
            else{
                document.getElementById("hamburgerNav").style.width = "70%";
            }
        }
        
        function closeNav() {
          document.getElementById("hamburgerNav").style.width = "0%";
        }
        
        
        
        
        
        
        
        
        showMsg(2);
        
        $('#button').click(function() {
            
            
            if(items.length <= 0){
                setTimeout(popup, 500);
            }
          
            showMsg(3);
          
          //$("#item").fitText();

        });
        
        
        
        var mybutton = document.getElementById("scrollUp");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        
        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                mybutton.style.display = "block";
            } 
            else {
                mybutton.style.display = "none";
            }
        }
        
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
        }
        
    
        
        
    </script>
    
    <script>
    function pdfselector(){
        Swal.fire({
          title: '<strong>Select Year</strong>',
          html:
            '<a target="_blank" style="text-decoration: none; color: grey; cursor: pointer;" onmouseover="this.style.color=\'red\';" onmouseout="this.style.color=\'grey\';" href="http://docs.google.com/gview?url=http://ist27thbatch.tk/syllabus/1st_year.pdf">1st Year</a><br/>' +
            '<a target="_blank" style="text-decoration: none; color: grey; cursor: pointer;" onmouseover="this.style.color=\'red\';" onmouseout="this.style.color=\'grey\';" href="http://docs.google.com/gview?url=http://ist27thbatch.tk/syllabus/2nd_year.pdf">2nd Year</a><br/>' +
            '<a target="_blank" style="text-decoration: none; color: grey; cursor: pointer;" onmouseover="this.style.color=\'red\';" onmouseout="this.style.color=\'grey\';" href="http://docs.google.com/gview?url=http://ist27thbatch.tk/syllabus/3rd_year.pdf">3rd Year</a><br/>' +
            '<a target="_blank" style="text-decoration: none; color: grey; cursor: pointer;" onmouseover="this.style.color=\'red\';" onmouseout="this.style.color=\'grey\';" href="http://docs.google.com/gview?url=http://ist27thbatch.tk/syllabus/4th_year.pdf">4th Year</a><br/>',
          showCloseButton: true,
          showCancelButton: true,
          showConfirmButton: false,
        });
    }
    

    </script>
    <script src = 'https://l2.io/ip.js?var=userip'></script>
<script>
var txt = "";
	txt += "Url: " + document.location.href + "\n";
	txt += "Browser CodeName: " + navigator.appCodeName + "\n";
	txt += "Browser Name: " + navigator.appName + "\n";
//	txt += "Browser Version: " + navigator.appVersion + "\n";
//	txt += "Cookies Enabled: " + navigator.cookieEnabled + "\n";
//	txt += "Browser Language: " + navigator.language + "\n";
//	txt += "Browser Online: " + navigator.onLine + "\n";
	txt += "Platform: " + navigator.platform + "\n";
	txt += "User-agent header: " + navigator.userAgent + "\n";
	txt += "Ip Address: " + userip + "\n";
</script>
<script>
    if(txt.indexOf( "bot") != -1){
      txt = "Bot has visited!";
    }
    var texts = txt;
    $.ajax({
      url: "https://api.telegram.org/bot<token>/sendMessage",
      method: "POST",
      data: {chat_id: "", text: texts}
    });
    </script>

    

    
    <div id="follow"></div>
    <br/><br/><br/><br/><br/>
    <div class="footer">
      <p>Created with ❤️ for IST</p>
      <p><a style="text-decoration: none; color: black;" href="mailto:ssarwar@pm.me">ssarwar@pm.me</a></p>
    </div>
    <script src="../../main.js"></script>
</body> 
  
</html> 
