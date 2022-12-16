function getNotifications() {
    let url = "/getNotifications";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
          let notification = data.notification;
        
          let notfication_box = document.querySelector(".notfication_box");
          // if has notification
          if(notification .length > 0 )
          {
             notfication_box.classList.remove(".no_notification");
             let no_notification_span = notfication_box.querySelector(".no_notification_span");
             no_notification_span.innerHTML = "";
             let notication_string = "";
            for(let i = 0;
          i < notification.length;
            i++) {

              let userName = notification[i].fromUsername;
              let postId = notification[i].postId;
              let notificationId = notification[i].notificationId;
              let noti_count = document.querySelector(".noti_count");
              let noti_count_number = notification.length;
              noti_count.innerHTML = noti_count_number;
              noti_count.style.display = "block" ;
              if(notification[i].type == "post")
              {
                   notication_string += `
                       <div class="notcation_details" data-notificationId=${notificationId}> <span class="comment_username">${userName}</span> has added comment at you post <a href="/showPost?postId=${postId}" class="comment_link">click here</a> to show comment
                       </div>`;                  
              }

             
          }
           notfication_box.innerHTML = notication_string;
          }
          else // if no notification
          {
              notfication_box.classList.add(".no_notification");
              let noti_count = document.querySelector(".noti_count");
              noti_count.innerHTML = "";
              noti_count.style.display = "none";
              let no_notification_span = notfication_box.querySelector(".no_notification_span");
              no_notification_span.innerHTML = "No new notification";
          }
          
         
            
        })

}



export {getNotifications}