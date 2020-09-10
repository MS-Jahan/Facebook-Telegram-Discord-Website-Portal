<!DOCTYPE html>
<html lang="en">
<head>
<title>IST 27th Batch Notification Feed</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../onesignal_notifier.js"></script>
<style>
/* Style the body */
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


/* Page Content */
.content {padding:20px;}

@media screen and (min-width: 800px) {
  .header {
  font-size: 20px;
  }
}

@media screen and (min-width: 900px) {
  .header {
  font-size: 25px;
  }
}

</style>


<script type='text/javascript'>
  window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', '59d112b3de1f2a710f4904770360c9a5b359ee1b');
</script>




</head>
<body>

<div class="header">
  <h1>IST 27th Batch Notification Feed</h1>
  <p>Group Notifications Made Hassle Free!</p>
</div>

<div class="content">
  <h1>Full Message</h1>
  <?php 
    if(empty($_GET['file'])){
      echo nl2br("File Name Not Included In Url. #exception1");
    }
    else {
        $fname = $_GET['file'];
        if($fname == ""){
          echo nl2br("File Not Found!\nContact App Admin. #exception2");
        }
        else{
            if(file_exists("./feedtxt/".$fname)){
                $file = file_get_contents("./feedtxt/".$fname);
                echo nl2br($file);
            }
            else{
                echo nl2br("File Not Found!\nContact App Admin. #exception3");
            }
        }
    }
    
  ?>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/>
<div class="footer">
  <p>Created with ❤️ for IST!</p>
  <p><a style="text-decoration: none; color: black;" href="mailto:ssarwar@pm.me">ssarwar@pm.me</a></p>
</div>

</body>
</html>