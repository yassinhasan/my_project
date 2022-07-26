
let register_btn = getElm("register_btn");
let form = getElm("form");
register_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
    showLoadSpinner();
    removeAnyValidation()
    let data = new FormData(form);
    let url = register_btn.getAttribute("data_target"); 
   fetch(url , {
       method: "post" , 
        body: data
   })
   .then(resp=>resp.json())
   .then(data=>{
   
    if(data.errors)
    {
        removeLoadSpinner();
        for(let err in data.errors)
        {
         makeInvalidInput(err  , null, data.errors[err] )
        }
       
    }else if(data.success)
    {
       
        window.location.href = "/login"
      
    }else if(data.sql_error)
    {
        removeLoadSpinner();
        showAlert('error' , 'Error' , data.sql_error)
    }else if(data.message_error)
    {
        removeLoadSpinner();
        showAlert('error' , 'Error' , data.message_error)
    }
   })
})


