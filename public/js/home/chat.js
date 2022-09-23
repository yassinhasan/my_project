function loadChatAreaOfUsers() {

    let url = "/fetchUsers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {

            prepareUsersChatArea(data);

        })

}

function prepareUsersChatArea(data)
{
      let fetch_users_div = document.querySelector(".fetch_users_div");
      let user_chat_body = document.querySelector(".user_chat_body");

      fetch_users_div.innerHTML = "";
      if (data.users) {
          showCustomeSpinner(user_chat_body);
        let allUsers = data.users;
        if (allUsers.length > 0) {
            for (var i = allUsers.length; i--;) 
            {
                let userStatus = allUsers[i].userStatus == 1 ? "online" : "offline";
                let image = allUsers[i].profileImage == null ? 'avatar.jpg' : `${allUsers[i].firstName}${allUsers[i].lastName}/${allUsers[i].profileImage}`;
                fetch_users_div.innerHTML += `
                    <div class="chat_user_box">
                        <div class="col-2 chat_user_image_box">
                            <img src="../../public/uploades/images/profile/${image}"  class="chat_user_image" alt="...">
                            <i class="fas fa-circle online_chat_status online_icon_status" data-userId=${allUsers[i].id} data-status=${userStatus}></i>
                        </div>
                        <div class="col-10 chat_user_right_box">
                            <div class="chat_user_name">
                                 <a href="/userPosts?id=${allUsers[i].id}" style="color: #795548 ;" class="chat_user_userName"> ${allUsers[i].firstName} ${allUsers[i].lastName}</a>
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

         removeCustomSpinner(user_chat_body);

    }
}


export { loadChatAreaOfUsers }
