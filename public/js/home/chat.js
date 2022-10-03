import {loggedUser} from "./userinfo.js" 
let user_section = document.querySelector(".user_section");
let chat_section = document.querySelector(".chat_section");
let floadting_btn = document.querySelector(".floadting_btn");
let go_back_chat = document.querySelector(".go_back_chat");
let fetch_users_div = document.querySelector(".fetch_users_div");
let user_chat_body = document.querySelector(".user_chat_body");
let chat_textarea= document.querySelector(".chat_textarea");
let send_chat = document.querySelector(".send_chat");
let chat_box = document.querySelector(".chat_box");
let allusers  = {};
let toUser= {};
floadting_btn.addEventListener("click",e=>
{
    showCustomeSpinner(user_chat_body);
    showUsers();
    loadChatAreaOfUsers();
})
go_back_chat.addEventListener("click",e=>
{
    showCustomeSpinner(user_chat_body);
    showUsers();
    loadChatAreaOfUsers();
})
function loadChatAreaOfUsers() {

    let url = "/fetchUsers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
           
             removeCustomSpinner(user_chat_body);
            prepareUsersChatArea(data);

        })

}

function prepareUsersChatArea(data)
{

     
      fetch_users_div.innerHTML = "";
      if (data.users) {
        let allUsers = data.users;
        if (allUsers.length > 0) {
            for (var i = allUsers.length; i--;) 
            {
                
                allusers["user_"+allUsers[i].id] = allUsers[i];
                let userStatus = allUsers[i].userStatus == 1 ? "online" : "offline";
                let image = allUsers[i].profileImage == null ? 'avatar.jpg' : `${allUsers[i].firstName}${allUsers[i].lastName}/${allUsers[i].profileImage}`;
                fetch_users_div.innerHTML += `
                    <div class="chat_user_box" data-userId=${allUsers[i].id}>
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
                            <p> hello iam message </p>
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


function showChatArea()
{
    let chat_user_box = document.querySelectorAll(".chat_user_box");

    document.body.addEventListener("click",e=>
    {
       
        if(e.target.classList.contains("chat_user_box")  )
        {   
            showChat();
            loadPrivateChat(e.target);
        }
    }); 
}

function loadPrivateChat(data)
{
    let name = data.querySelector(".chat_user_name_span").innerHTML;
    document.querySelector(".to_username").innerHTML =  name;
   let id = data.getAttribute("data-userId");

   toUser = allusers["user_"+id];

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
function insertMsg(msg)
{
    let inner_chat = document.querySelector(".inner_chat");
    let msgFromMe = `
    <div class="from_me">
        <div class="from_me_image">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
            alt="avatar 1">
        </div>
         <div class="from_me_msg">
                <p class="small">${msg}</p>
        </div>
    </div>
    `;
    inner_chat.insertAdjacentHTML("beforeend" , msgFromMe);
}
function sendChat()
{
    let send_msg = document.querySelector(".send_msg");
    send_msg.addEventListener("click" , e=>
    {
        e.preventDefault();
        removeAnyValidation()
        let message = chat_textarea.value;
        if(isEmpty(message))
        {
            makeInvalidInput(  "msg" , "soory this can not be empty" )
        }else
        {
            insertMsg(message)
            csutomPostFetch("/chat/addMsg" , send_chat , sendChatCallable , {
                "fromId": loggedUser.id, 
                "toId" : toUser.id
            })
        }
    })
}


function sendChatCallable(data)
{
    console.log(data);
    chat_textarea.value ="";
    chat_textarea.focus();
}
prepareTextarea(chat_textarea)
export {sendChat,showChatArea}
