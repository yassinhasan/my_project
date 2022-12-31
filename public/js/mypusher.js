let pusher ;
let channel ;
let presenceChannel;
Pusher.log = function(message) {
  //  window.console.log(message)
};

pusher = new Pusher('24d30dbe202f39f2b07f', {
        cluster: 'ap2' ,
        channelAuthorization: {
        endpoint: "/presenceAuth",

     },
    });
     var socketId = null;
presenceChannel = pusher.subscribe("presence-chat");
presenceChannel.bind('pusher:subscription_succeeded', function(member) {
            updateLastActivityById(member.me.id , "online");
            fetchChatusers(true)
          

    })
presenceChannel.bind('pusher:member_removed', function(member) {
       
        updateLastActivityById(member.id , "offline");
        fetchChatusers();
        updateUserStatsInRealtime(allChatusers["user_"+member.id] , "offline");
        showIsUserInChat(loggedUser.id)
   //    console.log(allChatusers["user_"+member.id])
 
})
presenceChannel.bind("pusher_internal:subscription_succeeded", (members) => {
 console.log("pusher_internal:subscription_succeeded" ) 
});
presenceChannel.bind('pusher:member_added', function(member ) {
       updateLastActivityById(member.id , "online");
       fetchChatusers();
      // console.log(allChatusers["user_"+member.id])
      let user = allChatusers["user_"+member.id];
       updateUserStatsInRealtime(allChatusers["user_"+member.id] , "online")
                   //   swett alert
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: `${user.firstName} logged in`
            })
            //  
        
 
})

channel = pusher.subscribe('my_project');

// function updateUserStatus()
// {
   
//     channel.bind('isLogged', function(data) {

//         let user;
//         let  onlinestatus = data.onlineStatus == 1  ? "online" : "offline";
//         if(allUsers != null)
//         {
//           let user = allUsers["user_"+data.userId];
//           if(user != null)
//             {
                  
//               updateUserStatsInRealtime(user ,onlinestatus)
//             }
//         }

//     })
// }
// updateUserStatus();

// update chat
function updatechat()
{
    channel.bind('updateChate', function(data) {
        // changfe status
       
      let messages  = data.msgs;
      let toUserId ;
      let toUser ={};
      let imagesrc = "";
      let msgDiv = "";
      let msg = repairMsg(messages["msg"]);
      let name = "";
      let userStatus;
      // if iam wwho send this message
      if(loggedUser.id == messages.fromId)
      {
         
          toUserId = messages.toId;
          toUser = allChatusers["user_"+toUserId];
          let me = "me" ;
        // update chat user box present in list of users after reciever or send message
         toUser.lastMmsg = msg;
         toUser.ChatId = messages.ChatId;
         let chat_user_box = document.querySelector('.chat_user_box_'+toUserId);
         if (chat_user_box)
        {
            let chat_messages = chat_user_box.querySelector(".chat_messages_text");
            chat_messages.classList.remove("unseen");
            chat_messages.innerHTML = `${me}:  ${msg}`; 
        }
      }else if(loggedUser.id != messages.fromId && loggedUser.id == messages.toId)
      {
          // if iam not who send message
             toUserId = messages.fromId;
             toUser = allChatusers["user_"+toUserId];
             toUser.ChatId = messages.ChatId;
             userStatus = toUser.userStatus == 1 ? "online" : "offline";
             let ChatId = toUser.ChatId;
             toUser.lastMmsg = msg;
             name = toUser.firstName+toUser.lastName;
             imagesrc = toUser.profileImage == null ? "avatar.jpg" : name+"/"+toUser.profileImage; 
             let me =  messages["firstName"];
               msgDiv =  `<div class="from_otheruser">
                  <div class="from_otheruser_msg" >
                    <p class="small">${msg}</p>
                  </div>
                   <div class="from_otheruser_image">
                      <img src="../../public/uploades/images/profile/${imagesrc}"
                      alt="avatar 1">
                   </div>
                </div>`;
        let chat_box = document.querySelector('.chat_box[data-touserid="'+toUserId+'"]');
        if (chat_box)
        {
            let no_msgs = chat_box.querySelector(".no_msgs");
            let inner_chat = chat_box.querySelector(".inner_chat");
            if(no_msgs)
            {
                no_msgs.remove();
                inner_chat.innerHTML  =  msgDiv ;
            }else
            {
                inner_chat.insertAdjacentHTML("beforeend" , msgDiv);
            }
           inner_chat.scrollTop = inner_chat.scrollHeight ;
        }
       let chat_user_box = document.querySelector('.chat_user_box_'+toUserId);
       if(chat_user_box)
        {
           let chat_messages = chat_user_box.querySelector(".chat_messages_text");
           chat_messages.classList.add("unseen");
           chat_messages.innerHTML = `${me}:  ${msg}`;             
        }

    }
 


   
 });
}
updatechat()

function updatePost()
{
    channel.bind('updatePost', function(data) {
      
      let id  = data.post.fromId;
      let post = data.post.lastPost[0];
      if(loggedUser.id != id)
      {
        //  realTimeNoti( post.userId , post.firstName+" "+post.lastName , " added new Post ");
                 //     //   swett alert
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: `${post.firstName} ${post.lastName} added new Post `
            })
            //  
      }  
 });
}
updatePost() ;

function updateAddComment()
{
    channel.bind('addComment', function(data) {
      let whoAddComment  = data.userId;
      let userName = data.userName;
      let ownerOfPOST = data.postUserId;
      let postId = data.postId;
 
      let to     = data.to;
      let notificationId = data.notificationId;
      let noti_count = document.querySelector(".noti_count");
      let noti_count_number ;
      if(noti_count.innerHTML == "")
      {
          noti_count_number = 0 ;
      }else
      {
          noti_count_number = parseInt(noti_count.innerHTML);
      }
     
        
      // if someone add comment on my post and not me (loggedUser.id != whoAddComment && loggedUser.id == postUserId) 
      //  
      // if iam owner of post put iam not who write comment
      // i need if iam owner and 
      if((loggedUser.id != whoAddComment && loggedUser.id == ownerOfPOST) || (loggedUser.id != whoAddComment &&  whoAddComment== ownerOfPOST && to.length > 1 ))
      {
            noti_count_number ++;
            noti_count.innerHTML = noti_count_number;
            noti_count.style.display = "block" ;
           let notfication_box = document.querySelector(".notfication_box");
           notfication_box.classList.remove(".no_notification");
           let no_notification_span = notfication_box.querySelector(".no_notification_span");
           if(no_notification_span)
          { no_notification_span.innerHTML = "";}
            
           let notication_string = `
           <div class="notcation_details" data-notificationId=${notificationId} > <span class="comment_username">${userName}</span> has added comment at you post <a href="/showPost?postId=${postId}" class="comment_link" data-postId=${postId}>click here</a> to show comment
           </div>`;
           notfication_box.insertAdjacentHTML("afterbegin", notication_string);
            //   swett alert
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: `${userName} add comment on your post`
            })
            //  
      } 

    });
}
updateAddComment();


function registerNewUser()
{
    channel.bind('registerNewUser', function(data) {
        let newUser = data.register;
      allChatusers.push(newUser);
    });
}
registerNewUser();

// add notification when someone sent message to me
function sendMessageNotification()
{
      channel.bind('sendMessageNotification', function(returnData) {
          
        let data = returnData.msgs ;
        // console.log(data)
      if(data.fromId != loggedUser.id  && data.toId == loggedUser.id)
      {

        let userName = data.firstName;
        let notificationId = data.notificationId;
        let msg = data.msg;
        let noti_count = document.querySelector(".noti_count");
        let noti_count_number ;
        if(noti_count.innerHTML == "")
        {
            noti_count_number = 0 ;
        }else
        {
            noti_count_number = parseInt(noti_count.innerHTML);
        }
        noti_count_number ++;
        noti_count.innerHTML = noti_count_number;
        noti_count.style.display = "block" ;
        let notfication_box = document.querySelector(".notfication_box");
        notfication_box.classList.remove(".no_notification");
        let no_notification_span = notfication_box.querySelector(".no_notification_span");
        if(no_notification_span)
          { no_notification_span.innerHTML = "";}
              
            let notication_string = `
            <div class="notcation_details" data-notificationId=${notificationId} data-notificationType="chat"> <span class="comment_username">${userName}</span> sent youm message ( ${msg}  )
            </div>`;
            notfication_box.insertAdjacentHTML("afterbegin", notication_string);
            //   swett alert
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'success',
              title: `${userName} sent you message`
            })
            //            
      }
    })
           
}
sendMessageNotification()

function showIsUserInChat(loggeduserId)
{

      channel.bind('isHereInChat', function(returnData) {
      let data = returnData.data ;
      let whoOpenChat  = data.userId;
      let openChat = data.openChat;
       // another person now is on chat with me 
       if(loggeduserId != whoOpenChat && loggeduserId == data.userId)
       {
           allChatusers["user_" + whoOpenChat].openChat = openChat;
       }

    });
}
// showIsUserInChat()
// sendMessageNotification();
export {showIsUserInChat}