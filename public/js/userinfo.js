let loggedUser = {};
let allDataChatuser = {};
let allChatusers  = {};

let logged_user_name_link = getElm("logged_user_name");
if(logged_user_name_link)
{
    
  let username = logged_user_name_link.querySelector(".username").innerHTML;
  loggedUser.name = username.trim();
  loggedUser.firstName = loggedUser.name.split(" ").shift();
  let srcimage = logged_user_name_link.querySelector(".user_profile_image").src;
  loggedUser.image = srcimage.split("/").pop();
  loggedUser.id = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim()) ;
  loggedUser.status = "online"
}


//  load all users who iam follow them

function  fetchChatusers()
{
    
    let url = "/fetchChatUsers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
          allDataChatuser = data;
          let users = data.users;
          console.log(users)
        if (users.length > 0) {
            for (var i = users.length; i--;) 
            {
                
                allChatusers["user_"+users[i].id] = users[i];
                
             
            }
        }
        })  
}

if(window.location.href.split("/").pop() == "home")
{
   fetchChatusers(); 
}


