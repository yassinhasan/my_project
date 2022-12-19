let loggedUser = {};
let allDataChatuser = {};
let allChatusers  = {};
let allChatusersId = {};

let logged_user_name_link = getElm("logged_user_name");
if(logged_user_name_link)
{
    
  let username = logged_user_name_link.querySelector(".username").innerHTML;
  loggedUser.name = username.trim();
  loggedUser.firstName = loggedUser.name.split(" ").shift();
  let srcimage = logged_user_name_link.querySelector(".user_profile_image").src;
  loggedUser.image = srcimage.split("/").pop();
  loggedUser.id = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim()) ;
  loggedUser.status = "online" ;
  setInterval(updateLastActivity, 100000)
  
}


//  load all users who iam follow them

function  fetchChatusers()
{
    allChatusersId.id = [];
    let url = "/fetchChatUsers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
          allDataChatuser = data;
          let users = data.users;
        
        if (users.length > 0) {
            for (var i = users.length; i--;) 
            {
                allChatusers["user_"+users[i].id] = users[i];
                if(isOffline(users[i].lastActivity))
                {
                      allChatusers["user_"+users[i].id].status = 0;
                }
                console.log(allChatusers["user_" + users[i].id]);
              
              
             
            }
        }
        })  
}

if(window.location.href.split("/").pop() == "home")
{
   fetchChatusers(); 
  
}



function updateLastActivity()
{
    
    let url = "/updateLastActivity";
fetch(url, {
        method: "POST"
    })
    .then(resp => resp.json())
    .then(data => {})

}



function isOffline(lastActivity)
{
    let n = new Date();
    let nowInSeconds = n.getTime();
    let dateInSeconds = new Date(lastActivity);
    let lastActivityInSeconds = dateInSeconds.getTime();
    console.log(nowInSeconds )
    console.log(lastActivityInSeconds )
       
    let diff = Math.round((nowInSeconds - lastActivityInSeconds) /( 1000 * 60 ));
    
    if (diff > 5) {
        return true;
    }else
    {
        return false;
    }
    
}



