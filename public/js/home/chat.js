// import {loggedUser} from "./userinfo.js" 
let user_section = document.querySelector(".user_section");
let chat_section = document.querySelector(".chat_section");
let floadting_btn = document.querySelector(".floadting_btn");
let go_back_chat = document.querySelector(".go_back_chat");
let fetch_users_div = document.querySelector(".fetch_users_div");
let user_chat_body = document.querySelector(".user_chat_body");
let chat_textarea= document.querySelector(".chat_textarea");
let send_chat = document.querySelector(".send_chat");
let chat_box = document.querySelector(".chat_box");
let inner_chat =  document.querySelector(".inner_chat");
let inner_chat_box =  document.querySelector(".inner_chat_box");
let toUser= {};

floadting_btn.addEventListener("click",e=>
{
    showCustomeSpinner(user_chat_body);
    let data = fetchChatusers();
    loadChatAreaOfUsers(data);
    showUsers();
})
go_back_chat.addEventListener("click",e=>
{

    showUsers();
})

function loadChatAreaOfUsers() {

     removeCustomSpinner(user_chat_body);
     prepareChatAreaOfUsers(allDataChatuser);

}
// preapre area users 
function prepareChatAreaOfUsers(data)
{

     
      fetch_users_div.innerHTML = "";
      if (data.users) {
        let allUsers = data.users;
        if (allUsers.length > 0) {
            for (var i = allUsers.length; i--;) 
            {
               
               
               let msg = allUsers[i]["lastMmsg"]  
               let me = "";
               if(msg != null)
               {
                    if(loggedUser.id == allUsers[i].fromId)
                    {
                       me  = "me" ;
                    }else
                    {
                        me = allUsers[i].firstName;
                    }

                    msg = repairMsg(msg);
                  
               }else
               {msg =" no chat yet"
                   
               }
                let userStatus = allUsers[i].userStatus == 1 ? "online" : "offline";
                let image = allUsers[i].profileImage == null ? 'avatar.jpg' : `${allUsers[i].firstName}${allUsers[i].lastName}/${allUsers[i].profileImage}`;
                fetch_users_div.innerHTML += `
                    <div class="chat_user_box chat_user_box_${allUsers[i].id}" data-userId=${allUsers[i].id} data-lastMmsgId=${allUsers[i].lastMmsgId} data-ChatId=${allUsers[i].ChatId
                    } >
                        <div class="col-2 chat_user_image_box">
                            <img src="../../public/uploades/images/profile/${image}"  class="chat_user_image" alt="...">
                            <i class="fas fa-circle online_chat_status online_icon_status" data-userId=${allUsers[i].id} data-status=${userStatus}></i>
                        </div>
                        <div class="col-10 chat_user_right_box">
                            <div class="chat_user_name">
                                 <!--<a href="/userPosts?id=${allUsers[i].id}" style="color: #795548 ;" class="chat_user_userName"> ${allUsers[i].firstName} ${allUsers[i].lastName}</a>-->
                                 <span class="chat_user_name_span">${allUsers[i].firstName} ${allUsers[i].lastName}</span>
                            </div>
                            <div class="chat_messages">
                            <p class="chat_messages_text">${me} : ${msg} </p>
                            </div>
                        
                        </div>
                   </div>
                        `;
               }
          
        }
        else
        {
            fetch_users_div.innerHTML = "";
        }


    }
}


// after click on specific user load chat in_between 
function showPrivateChatArea()
{
    let chat_user_box = document.querySelectorAll(".chat_user_box");
        
    document.body.addEventListener("click",e=>
    {
      
        if(e.target.classList.contains("chat_user_box")  )
        {   
            let id = e.target.getAttribute("data-userId");
            toUser = allChatusers["user_"+id];
            inner_chat.innerHTML = "";
            let chatid = toUser.ChatId == null ? 0 : toUser.ChatId ; 
            let touserId = id == null ? 0 : id;
            chat_box.setAttribute("data-ChatId", chatid);
            chat_box.setAttribute("data-touserId", touserId);
            showChat();
            showCustomeSpinner(inner_chat_box);
            let name = e.target.querySelector(".chat_user_name_span").innerHTML;
            document.querySelector(".to_username").innerHTML =  name;
            let chat_user_box = document.querySelector(".chat_user_box_"+id);
            let chat_messages= chat_user_box.querySelector(".chat_messages");
            chat_messages.classList.remove("unseen");
            fetchPrivateChatArea( chatid);
        }
    }); 
}

// load chat content 
function fetchPrivateChatArea( ChatId)
{
    let form = document.createElement("form");
   csutomPostFetch("/chat/fetchPrivateChat" , form , preparePrivateChat , {
       "fromId": loggedUser.id, 
       "toId" : toUser.id , 
       "ChatId"     : ChatId
   })
}  


// fetch chat 
function preparePrivateChat(data)
{
      
      let messages  = data.msgs;
      let loggedUserName = loggedUser.name.replace(" ","");
      let loggedUserImage = loggedUser.image == "avatar.jpg" ? "avatar.jpg" : loggedUserName+"/"+loggedUser.image;   
      let touserName = toUser.firstName+toUser.lastName;
      let touserImagesrc = toUser.profileImage == null ? "avatar.jpg" : touserName+"/"+toUser.profileImage; 
      if(messages.length > 0)
      {
          for(var i = messages.length  ; i-- ;)
          {
            let msg = messages[i]["msg"]
         //   msg = repairMsg(msg);
             if(messages[i].fromId == loggedUser.id)
             {
                
                 inner_chat.innerHTML+=
                 `<div class="from_me">
                         <div class="from_me_image col-1">
                          <img src="../../public/uploades/images/profile/${loggedUserImage}"
                            alt="avatar 1">
                        </div>
                       <div class="from_me_msg col-9">
                            <p class="small">${msg}</p>
                      </div>
                 </div>` ;
             }else
             {
                
                
               inner_chat.innerHTML+=  `<div class="from_otheruser">
                  <div class="from_otheruser_msg" >
                    <p class="small">${messages[i].msg}</p>
                  </div>
                   <div class="from_otheruser_image">
                      <img src="../../public/uploades/images/profile/${touserImagesrc}"
                      alt="avatar 1">
                   </div>
                </div>`
             }
          }
      }else
      {
           inner_chat.innerHTML = "<div class='no_msgs'>Sorry No Chat Yet</div>";
      }
      
       inner_chat.scrollTop = inner_chat.scrollHeight;
       removeCustomSpinner(inner_chat_box);
   }
   
function showChat()
{
      user_section.classList.add("hide");
      chat_section.classList.remove("hide");
}
function showUsers()
{
     user_section.classList.remove("hide");
     chat_section.classList.add("hide");
}

function sendChatMessages()
{
    let send_msg = document.querySelector(".send_msg");
    send_msg.addEventListener("click" , e=>
    {
        e.preventDefault();
        removeAnyValidation();
        let message = chat_textarea.value;
        chat_textarea.value ="";
        if(isEmpty(message))
        {
            makeInvalidInput(  "msg" , "soory this can not be empty" )
        }else
        {
            let no_msgs =inner_chat.querySelector(".no_msgs");
            
            if(no_msgs)no_msgs.remove();
            insertMsgWithoutFetch(message);
            let form = document.createElement("form");
            csutomPostFetch("/chat/addMsg" , form , sendChatCallable , {
                "msg"   : message,
                "fromId": loggedUser.id, 
                "toId" : toUser.id , 
                "firstName" : loggedUser.firstName , 
                "ChatId" : toUser.ChatId
            })
        }
    })
}

function insertMsgWithoutFetch(msg)
{
    
    msg = repairMsg(msg)
    let name = loggedUser.name.replace(" ","");
    let image = loggedUser.image == "avatar.jpg" ? "../../public/uploades/images/profile/avatar.jpg" : "../../public/uploades/images/profile/"+name+"/"+loggedUser.image;
    let inner_chat = chat_box.querySelector(".inner_chat");
    let msgFromMe = `
    <div class="from_me">
        <div class="from_me_image">
        <img src="${image}"
            alt="avatar 1">
        </div>
         <div class="from_me_msg">
                <p class="small">${msg}</p>
        </div>
    </div>
    `;
    inner_chat.insertAdjacentHTML("beforeend" , msgFromMe);
    inner_chat.scrollTop = inner_chat.scrollHeight;
}
function sendChatCallable(data)
{
    if(data.succ == "done")
    {
        toUser.ChatId= data.ChatId;
    }
   // chat_textarea.focus();
    
}








prepareTextarea(chat_textarea);



export {sendChatMessages,showPrivateChatArea}


 // after insert update touser => uniqye id to unique table id so update all records 
