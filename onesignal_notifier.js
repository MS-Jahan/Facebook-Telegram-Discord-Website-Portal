
var notif_script = document.createElement("script");
notif_script.src = "https://cdn.onesignal.com/sdks/OneSignalSDK.js";
notif_script.async="";
document.head.appendChild(notif_script);




var notif_script1 = document.createElement("script");

notif_script1.innerText = "window.OneSignal = window.OneSignal || []; OneSignal.push(function() {OneSignal.init({appId: 'onesignal-app-token',});});";
  
document.head.appendChild(notif_script1);