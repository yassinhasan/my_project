
let login_btn = getElm("login_btn");
let form = getElm("form");
let container = getElm("container");
login_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
    showCustomeSpinner(container);
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
         makeInvalidInput(err,data.errors[err] )
        }
       
    }else if(data.success)
    {
       
        window.location.href = "/home"
      
    }else if(data.success_admin)
    {
       
        window.location.href = "/dashboard"
      
    }else if(data.sql_error)
    {
       
        showAlert('error' , 'Error' , data.sql_error)
    }else if(data.message_error)
    {
      
        showAlert('error' , 'Error' , data.message_error)
    }
      removeCustomSpinner(container);
   })
})


