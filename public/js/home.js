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

import {uploadAttach} from "./home/uploadattach.js"
uploadAttach()


// must be after uplaod 
import {fetchPostsUrl, clickedShareBtn , preparePostBox , prepareTextarea ,showEditBox , postDelete} from "./home/posts.js"
clickedShareBtn();
prepareTextarea();
showEditBox();
postDelete();
// function fetch all posts 
fetchPostsUrl()



function notifyMe() {
 if (Notification.permission !== 'granted')
  Notification.requestPermission();
 else {
  var notification = new Notification('Notification title', {
   icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
   body: 'Hey there! You\'ve been notified!',
  });
 }
}
notifyMe()