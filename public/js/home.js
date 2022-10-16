// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;
// follow un follow system 
import {clickedOnFollowBtn} from "./home/follow.js"
clickedOnFollowBtn();


// comments area

import { clickedOnCommentsDiv , clickedOnCommentTextarea , clickedOnAddCommentBtn} from "./home/comments.js"
 clickedOnCommentsDiv();
clickedOnCommentTextarea();
clickedOnAddCommentBtn();


// likes

import { clickedOnAddLiketBtn } from "./home/likes.js"
 clickedOnAddLiketBtn();

 // realTimeNoti( 1 ,"hasn meady" , "is online now");

import {uploadAttach} from "./home/uploadattach.js";

let share_post_box = getElm("shar_post_box");
let image_video_attach_elm  = share_post_box.querySelector(".fa-photo-film"); 
let doc_attach_elm  = share_post_box.querySelector(".fa-file");
uploadAttach(share_post_box , image_video_attach_elm);
uploadAttach(share_post_box , doc_attach_elm);


// must be after uplaod 
import {fetchPostsUrl, clickedShareBtn , preparePostBox , prepareTextarea ,showEditBox , postDelete , updatePost } from "./home/posts.js";

clickedShareBtn();
prepareTextarea();
showEditBox();
postDelete();
updatePost();
fetchPostsUrl();



//edit posts
import {postEdit } from "./home/edit.js"
postEdit();
//fetch all users
import {fetchUsers , prepareUsersBox} from "./home/users.js"
fetchUsers();
// chat 
import { showPrivateChatArea , sendChatMessages} from "./home/chat.js"

showPrivateChatArea();
sendChatMessages();
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
                    user_icon.setAttribute("data-status" , status)

                }
            })

    
    });
}
updateUserStatus()
function notifyMe() {
 if (Notification.permission !== 'granted')
  Notification.requestPermission();
 
}
notifyMe();


// 

// chatNotification()

// 
