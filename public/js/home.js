let share_post_btn = getElm("share_post_btn");
let form = getElm("share_post_form");
let textarea_text = getElm("textarea_text");
share_post_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
     removeAnyValidation()
    let data = new FormData(form);
    let url = form.action; 
   fetch(url , {
       method: "post" , 
        body: data
   })
   .then(resp=>resp.json())
   .then(data=>{
   
    if(data.errors)
    {
        for(let err in data.errors)
        {
            
           makeInvalidInput(err  , "textarea", data.errors[err] )
         //  showAlert('danger' , 'Error' , data.errors[err])
        }
       
    }else if(data.success)
    {

           textarea_text.value = ""; 
           makevalidInput("post" , data.success );
           fetchPosts(data.posts);
         //  showAlert('danger' , 'Error' , data.errors[err])

      
    }else if(data.sql_error)
    {
       
        showAlert('error' , 'Error' , data.sql_error)
    }
   })
});

textarea_text.addEventListener("keydown",()=>
{
    textarea_text.classList.remove("is-invalid");
     textarea_text.classList.remove("is-valid");
})


// function fetch all posts 

function fetchPosts(data)
{
        console.log(data);
}