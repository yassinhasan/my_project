// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

let logged_user_name_link = getElm("logged_user_name");
let loggedUserId = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim());
let loggedUserName = (logged_user_name_link.innerHTML).trim();
var pusher = new Pusher('24d30dbe202f39f2b07f', {
      cluster: 'ap2'
 });
                   //
var channel = pusher.subscribe('my_project');