let loggedUser = {};
let allDataChatuser = {};
let allChatusers  = {};
let allUsers = {};


//  load all users who iam follow them

function  fetchChatusers()
{
    let url = "/fetchChatusers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
         
          let users = data.users;
          let loggedUserId = data.loggedUserId;
        if (users.length > 0) {
            for (var i = users.length; i--;) 
            {
                if(users[i].id ==  loggedUserId)
                {
                    loggedUser = users[i];
                    allUsers["user_"+users[i].id] = users[i]
                } else
                {
                    
                    allChatusers["user_"+users[i].id] = users[i];
                    let diff = isOffline(users[i].lastActivity);
                    let lastSeen = handleLastSeen(diff);
                    allUsers["user_"+users[i].id] = users[i];
                    allChatusers["user_"+users[i].id].lastSeen = lastSeen;
                    if( diff > 2)
                    {
                        updateLastStatusById(users[i].id , "offline")
                        allChatusers["user_"+users[i].id].userStatus = 0;
                        updateUserStatsInRealtime(allChatusers["user_"+users[i].id] , "offline")
                    }
                } 
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
    .then(data => {
        if(data.succ)
        {
           fetchChatusers();
        }
    })

}


function updateLastActivityById(id , userStatus)
{
    
    let url = "/updateLastActivityById";
    let form = new FormData();
    form.append("id" , id);
    form.append("userSatus", userStatus)
fetch(url, {
        method: "POST" , 
        body: form
    })
    .then(resp => resp.json())
    .then(data => {
        if(data.succ)
        {
           fetchChatusers();
        }
    })

}
function updateLastStatusById(id , userStatus)
{
    
    let url = "/updateLastStatusById";
    let form = new FormData();
    form.append("id" , id);
    form.append("userSatus", userStatus)
fetch(url, {
        method: "POST" , 
        body: form
    })
    .then(resp => resp.json())
    .then(data => {
        if(data.succ)
        {
          
        }
    })

}
function isOffline(lastActivity)
{
    let n = new Date();
    let nowInSeconds = n.getTime();

    let dateInSeconds = new Date(lastActivity);
    let lastActivityInSeconds = dateInSeconds.getTime();

       
    let diff = Math.round((nowInSeconds - lastActivityInSeconds) /( 1000 * 60 ));
    
    
    return diff;
    
}

function handleLastSeen(diff)
{
    let lastSeen = "";
    if (diff == 0) {
        lastSeen = "Just now";
    }
    else if (diff == 1) {
        lastSeen = "1 minute ago";
    }

    if (diff > 1 && diff < 60) {
        lastSeen = diff + " minutes ago";
    }
    else if (diff >= 60 && diff < 3600) {
        lastSeen = Math.round(diff / 60) + " hours ago";
    }
    else if (diff >= 3600 && diff < 86400) {
    
        lastSeen = Math.round(diff / 3600) + " days ago";
        }
    
    return lastSeen;
    

}
function updateUserStatsInRealtime(user , userStatus)
{
        
        let users_status_icons = document.querySelectorAll(".online_icon_status[data-userId = '"+user.id+"']");
        if(users_status_icons)
        {
            users_status_icons.forEach(users_status_icon =>{
                users_status_icon.setAttribute("data-status" , userStatus);
            })
        }
        let lastSeenSpans = document.querySelectorAll(".lastseen[data-userId = '"+user.id+"']"); 
        if(lastSeenSpans)
        {  
            lastSeenSpans.forEach(lastSeenSpan =>{
               lastSeenSpan.innerHTML = user.lastSeen;
            })
        }

}
// setInterval(updateLastActivity, 60000);


