
var pusher = new Pusher('24d30dbe202f39f2b07f', {
      cluster: 'ap2'
 });
                   //
var channel = pusher.subscribe('my_project');



document.addEventListener('DOMContentLoaded', function() {
 if (!Notification) {
  alert('Desktop notifications not available in your browser. Try Chromium.');
  return;
 }

 if (Notification.permission !== 'granted')
  Notification.requestPermission();
  return;
});


// when something happen 
// in notification is granted only 
// make new instance then 
// noti = new notification("title herer" ,{icon , body});
// noti.onclick = window.open("something")
//   var notification = new Notification('Notification title', {
//   icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
//   body: 'Hey there! You\'ve been notified!',
//   });
//   notification.onclick = function() {
//   window.open('http://stackoverflow.com/a/13328397/1269037');
//   };