import {showIsUserInChat } from "../mypusher.js" 
let user_section = document.querySelector(".user_section");
let chat_section = document.querySelector(".chat_section");
let floadting_btn = document.querySelector(".floadting_btn");
let go_back_chat = document.querySelector(".go_back_chat");
let fetch_users_div = document.querySelector(".fetch_users_div");
let user_chat_body = document.querySelector(".user_chat_body");
let chat_textarea = document.querySelector(".chat_textarea");
let send_chat = document.querySelector(".send_chat");
let chat_box = document.querySelector(".chat_box");
let inner_chat = document.querySelector(".inner_chat");
let inner_chat_box = document.querySelector(".inner_chat_box");
let toUser = {};

floadting_btn.addEventListener("click", e => {
    showCustomeSpinner(user_chat_body);
    fetchChatusers();
    loadChatAreaOfUsers(allChatusers);
    showUsers();

})

let close_private_chat = document.querySelector(".close_private_chat");
close_private_chat.addEventListener("click", e => {
     blurEvent();
});

go_back_chat.addEventListener("click", e => {
    blurEvent();
    showUsers();
})
function blurEvent()
{
    
    let form = new FormData();
    form.append("ChatId", toUser.ChatId);
    form.append("loggedUser", loggedUser.id);
    form.append("toId", toUser.id);
    let url = "/chat/blurEvent";
    fetch(url, {
            method: "POST",
            body: form
        })
        .then(resp => resp.json())
        .then(data => {
            if (data) {
             
            }
        })
}
function loadChatAreaOfUsers(allChatusers) {

    removeCustomSpinner(user_chat_body);
    prepareChatAreaOfUsers(allChatusers);

}
// preapre area users 
function prepareChatAreaOfUsers(users) {

    fetch_users_div.innerHTML = "";

    let allUsers = users;
    if (allUsers != null) {
        for (let [i, value] of Object.entries(allUsers)) {

            let msg = allUsers[i]["lastMmsg"]
            let me = "";
            if (msg != null) {
                if (loggedUser.id == allUsers[i].fromId) {
                    me = "me";
                }
                else {
                    me = allUsers[i].firstName;
                }

                msg = repairMsg(msg);

            }
            else {
                msg = " no chat yet"

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
                                 <small class="lastseen" data-userId=${allUsers[i].id}>${allUsers[i].lastSeen}</small>
                            </div>
                            <div class="chat_messages">
                            <p class="chat_messages_text">${me} : ${msg} </p>
                            </div>
                        
                        </div>
                   </div>
                        `;
        }

    }
    else {
        fetch_users_div.innerHTML = "";
    }



}


// after click on specific user load chat in_between 
function showPrivateChatArea() {
    let chat_user_box = document.querySelectorAll(".chat_user_box");

    document.body.addEventListener("click", e => {

        if (e.target.classList.contains("chat_user_box")) {
            showIsUserInChat(loggedUser.id)
            let id = e.target.getAttribute("data-userId");
            toUser = allChatusers["user_" + id];
            inner_chat.innerHTML = "";
            let chatid = toUser.ChatId == null ? 0 : toUser.ChatId;
            let private_chat_box = document.querySelector(".chat_box");
            private_chat_box.setAttribute("data-ChatId", chatid);
            private_chat_box.setAttribute("data-touserId", id);
            let send_msg = document.querySelector(".send_msg");
            send_msg.setAttribute("data-touserId", id);
            send_msg.setAttribute("data-ChatId", chatid);
            showChat();
            showCustomeSpinner(inner_chat_box);
            let name = e.target.querySelector(".chat_user_name_span").innerHTML;
            document.querySelector(".to_username").innerHTML = name;
            let chat_user_box = document.querySelector(".chat_user_box_" + id);
            let chat_messages_text  = chat_user_box.querySelector(".chat_messages_text");
            chat_messages_text.classList.remove("unseen");
            fetchPrivateChatArea(chatid, private_chat_box);
        }
    });
}

// load chat content 
function fetchPrivateChatArea(ChatId, private_chat_box) {
    let form = new FormData();
    form.append("ChatId", ChatId);
    form.append("fromId", loggedUser.id);
    form.append("toId", toUser.id);
    let url = "/chat/fetchPrivateChat";
    fetch(url, {
            method: "POST",
            body: form
        })
        .then(resp => resp.json())
        .then(data => {
            if (data) {
             //   console.log(data)
                preparePrivateChat(data, private_chat_box)
            }
        })
}


// fetch chat 
function preparePrivateChat(data, private_chat_box) {

    let private_inner_chat = private_chat_box.querySelector(".inner_chat");
    let messages = data.msgs;
    let loggedUserName = loggedUser.firstName + loggedUser.lastName;
    let loggedUserImage = loggedUser.profileImage == null ? "avatar.jpg" : loggedUserName + "/" + loggedUser.profileImage;
    let touserName = toUser.firstName + toUser.lastName;
    let touserImagesrc = toUser.profileImage == null ? "avatar.jpg" : touserName + "/" + toUser.profileImage;
    if (messages.length > 0) {
        for (var i = messages.length; i--;) {
            let msg = messages[i]["msg"]
            //   msg = repairMsg(msg);
            if (messages[i].fromId == loggedUser.id) {

                private_inner_chat.innerHTML +=
                    `<div class="from_me">
                         <div class="from_me_image col-1">
                          <img src="../../public/uploades/images/profile/${loggedUserImage}"
                            alt="avatar 1">
                        </div>
                       <div class="from_me_msg col-9">
                            <p class="small">${msg}</p>
                           
                      </div>
                 </div>`;
            }
            else {


                private_inner_chat.innerHTML += `<div class="from_otheruser">
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
    }
    else {
        private_inner_chat.innerHTML = "<div class='no_msgs'>Sorry No Chat Yet</div>";
    }
    let private_inner_chat_box = private_chat_box.querySelector(".inner_chat_box");
    private_inner_chat.scrollTop = private_inner_chat.scrollHeight;
    removeCustomSpinner(private_inner_chat_box);
}

function showChat() {
    user_section.classList.add("hide");
    chat_section.classList.remove("hide");
}

function showUsers() {
    user_section.classList.remove("hide");
    chat_section.classList.add("hide");
}

let send_msg_btns = document.querySelectorAll(".send_msg");
send_msg_btns.forEach(send_msg_bt => {
    send_msg_bt.addEventListener("click", e => {
        e.preventDefault();
        let touserId = send_msg_bt.getAttribute("data-touserId");
        let private_chat_box = document.querySelector('.chat_box[data-touserid="' + touserId + '"]');
        removeAnyValidation();
        let message = chat_textarea.value;
        chat_textarea.value = "";
        if (isEmpty(message)) {
            makeInvalidInput("msg", "soory this can not be empty")
        }
        else {
            let no_msgs = inner_chat.querySelector(".no_msgs");

            if (no_msgs) no_msgs.remove();
           let f_time =  insertMsgWithoutFetch(message);
           let who_sending_msg_to_user = allChatusers["user_"+touserId];
           console.log(who_sending_msg_to_user)
            let form = new FormData();
            form.append("ChatId", toUser.ChatId);
            form.append("msg", message);
            form.append("fromId", loggedUser.id);
            form.append("toId", toUser.id);
            form.append("firstName", loggedUser.firstName);
            form.append("f_time", f_time);
            form.append("openChat" , who_sending_msg_to_user.openChat)
            let url = "/chat/addMsg";
            fetch(url, {
                    method: "POST",
                    body: form
                })
                .then(resp => resp.json())
                .then(data => {
                    if (data) {
                        sendChatCallable(data, private_chat_box , touserId)
                    }
                })
        }
    })
})

function insertMsgWithoutFetch(msg) {

    let f_time = new Date();
    f_time = f_time.getTime();
    msg = repairMsg(msg)
    let name = loggedUser.firstName + loggedUser.lastName;
    let image = loggedUser.profileImage == null ? "../../public/uploades/images/profile/avatar.jpg" : "../../public/uploades/images/profile/" + name + "/" + loggedUser.profileImage;
    let inner_chat = chat_box.querySelector(".inner_chat");
    let msgFromMe = `
    <div class="from_me">
        <div class="from_me_image">
        <img src="${image}"
            alt="avatar 1">
        </div>
         <div class="from_me_msg" >
                <p class="small">${msg}</p>
                <div class="sending_flags_wraper" data_flag=${f_time}>
                    <i class="fa-solid fa-check sending"></i>
                </div>
                
        </div>
    </div>
    `;
    inner_chat.insertAdjacentHTML("beforeend", msgFromMe);
    inner_chat.scrollTop = inner_chat.scrollHeight;
    return f_time;
}

function sendChatCallable(data, private_chat_box , touserId) {
    if (data.succ == "done") {

        toUser.ChatId = data.ChatId;
        let msg = data.msgId;
        let flag = data.f_time;
        let sending_flags_wraper = private_chat_box.querySelector(".sending_flags_wraper[data_flag='" + flag + "']");
        sending_flags_wraper.innerHTML = `
        <i class="fa-solid fa-check done"></i>
        <i class="fa-solid fa-check done"></i>
        `;
    }
    // chat_textarea.focus();

}








prepareTextarea(chat_textarea);



export { showPrivateChatArea }


// after insert update touser => uniqye id to unique table id so update all records
