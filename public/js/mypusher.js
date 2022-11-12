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

   //  console.log(member)
    })
presenceChannel.bind('pusher:member_removed', function(member) {

        let onlinestatus =  "offline";
        let all_users_status_icons = document.querySelectorAll(".online_icon_status");
        all_users_status_icons.forEach(user_icon=>
            {
                let icon_user_id = user_icon.getAttribute("data-userId");
                if(icon_user_id == member.id)
                {

                    user_icon.setAttribute("data-status" , onlinestatus);
                    user_icon.setAttribute("data-status" , onlinestatus);
                    allChatusers["user_"+icon_user_id] = {
                        status : onlinestatus
                    };

                }
            })
 
})
presenceChannel.bind("pusher_internal:subscription_succeeded", (members) => {
  // For example
 // console.log(members.count);

  members.each((member) => {
    // For example
        let onlinestatus =  "online";
        let all_users_status_icons = document.querySelectorAll(".online_icon_status");
        all_users_status_icons.forEach(user_icon=>
            {
                let icon_user_id = user_icon.getAttribute("data-userId");
                if(icon_user_id == member.id)
                {

                    user_icon.setAttribute("data-status" , onlinestatus);
                    allChatusers["user_"+icon_user_id] = {
                        status : onlinestatus
                    };

                }
            })
  });
});
presenceChannel.bind('pusher:member_added', function(member ) {

        let onlinestatus =  "online";
        let all_users_status_icons = document.querySelectorAll(".online_icon_status");
        all_users_status_icons.forEach(user_icon=>
            {
                let icon_user_id = user_icon.getAttribute("data-userId");
                if(icon_user_id == member.id)
                {
                    user_icon.setAttribute("data-status" , onlinestatus);
                    allChatusers["user_"+icon_user_id] = {
                        status : onlinestatus
                    };
                

                }
            })
 
})

channel = pusher.subscribe('my_project');

function updateUserStatus()
{
    channel.bind('isLogged', function(data) {

      
        let status = data.onlineStatus == 1  ? "online" : "offline";
        let all_users_status_icons = document.querySelectorAll(".online_icon_status");
        all_users_status_icons.forEach(user_icon=>
            {
                let icon_user_id = user_icon.getAttribute("data-userId");
                if(icon_user_id == data.userId)
                {
                    user_icon.setAttribute("data-status" , status);
                    allChatusers["user_"+icon_user_id].status = status;

                }
            })
    });
}
updateUserStatus();


// update chat
function updatechat()
{
    channel.bind('updateChate', function(data) {
        // changfe status
      let messages  = data.msgs;
      let toUserId;
      let me = "";
      let imagesrc = "";
      let msgDiv = "";
      let msg = messages["msg"];
      let name = "";
      let userStatus;
      
      msg =  repairMsg(msg);
      if(loggedUser.id == messages.fromId)
      {
          toUserId = messages.toId;
          me = "me"
      }else
      {
           toUserId = messages.fromId;
           toUser = allChatusers["user_"+toUserId];
            userStatus = toUser.userStatus == 1 ? "online" : "offline";
           name = toUser.firstName+toUser.lastName;
           imagesrc = toUser.image == "avatar.jpg" ? "avatar.jpeg" : name+"/"+toUser.profileImage; 
           me =  messages["firstName"];
           msgDiv =  `<div class="from_otheruser">
                  <div class="from_otheruser_msg" >
                    <p class="small">${msg}</p>
                  </div>
                   <div class="from_otheruser_image">
                      <img src="../../public/uploades/images/profile/${imagesrc}"
                      alt="avatar 1">
                   </div>
                </div>`;
         let title = `message from ${name}` ;
         let icon = imagesrc;
         let body  = msg;
         chatNotification(title , icon , body)       
    }
    let chat_user_box = document.querySelector(`.chat_user_box_${toUserId}`);
    if (chat_user_box)
    {
        let chat_messages = chat_user_box.querySelector(".chat_messages_text");
        chat_messages.classList.add("unseen");
        chat_messages.innerHTML = `${me}:  ${messages["msg"]}`; 
       
    }else
    {
       let chat_user_box =`  <div class="chat_user_box chat_user_box_${toUser.id}" data-userId=${toUser.id}>
                        <div class="col-2 chat_user_image_box">
                            <img src="../../public/uploades/images/profile/${imagesrc}"  class="chat_user_image" alt="...">
                            <i class="fas fa-circle online_chat_status online_icon_status" data-userId=${toUser.id} data-status=${userStatus}></i>
                        </div>
                        <div class="col-10 chat_user_right_box">
                            <div class="chat_user_name">
                                 <!--<a href="/userPosts?id=${toUser.id}" style="color: #795548 ;" class="chat_user_userName"> ${name}</a>-->
                                 <span class="chat_user_name_span">${name}</span>
                            </div>
                            <div class="chat_messages">
                            <p class="chat_messages_text unseen">${me} : ${msg} </p>
                            </div>
                        
                        </div>
                   </div>`  ;
              console.log("no")
        fetch_users_div.insertAdjacentHTML("afterbegin" , chat_user_box)           
    }
      allChatusers["user_"+toUser.id].lastMmsg = msg;
    

    inner_chat.insertAdjacentHTML("beforeend" , msgDiv);
    inner_chat.scrollTop = inner_chat.scrollHeight;
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
         realTimeNoti( post.userId , post.firstName+" "+post.lastName , " added new Post ");
      }  
 });
}



updatePost() ;


function updateAddComment()
{
    channel.bind('addComment', function(data) {
      let id  = data.userId;
      let userName = data.userName;
      let postUserId = data.postUserId;
      let postId = data.postId;
      let noti_count = document.querySelector(".noti_count");
      let noti_count_number = parseInt(noti_count.innerHTML);
      if(loggedUser.id != id && loggedUser.id == postUserId)
      {
            noti_count_number ++;
            noti_count.innerHTML = noti_count_number;
            noti_count.style.display = "block" ;
           let notfication_box = document.querySelector(".notfication_box");
           notfication_box.classList.remove(".no_notification");
           let no_notification_span = notfication_box.querySelector(".no_notification_span");
            no_notification_span.innerHTML = "";
           let notication_string = `
           <div class="notcation_details" > <span class="comment_username">${userName}</span> has added comment at you post <a href="/showPost?postId=${postId}" class="comment_link">click here</a> to show comment
           </div>`;
           notfication_box.insertAdjacentHTML("afterbegin", notication_string);
           
      } 

    });
}
updateAddComment();