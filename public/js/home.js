// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;



//fetch all users
import {fetchUsers , prepareUsersBox} from "./home/users.js"
fetchUsers();


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
import {fetchPostsUrl, clickedShareBtn , preparePostBox , prepareTextarea ,showEditBox , postDelete , updatePost} from "./home/posts.js"
clickedShareBtn();
prepareTextarea();
showEditBox();
postDelete();
updatePost();
fetchPostsUrl()


//edit posts
import {postEdit } from "./home/edit.js"
postEdit();

// function notifyMe() {
//  if (Notification.permission !== 'granted')
//   Notification.requestPermission();
//  else {
//   var notification = new Notification('Notification title', {
//    icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
//    body: 'Hey there! You\'ve been notified!',
//   });
//  }
// }
// notifyMe()


// 

channel.bind('isLogged', function(data) {
      
     
        console.log(data);
      
});