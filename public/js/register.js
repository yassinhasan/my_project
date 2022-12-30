
let register_btn = getElm("register_btn");
let form = getElm("register_form");
register_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
      removeAnyValidation();
    if(isNotEmptyForFullForm(form)  && validName("firstName") && validName("lastName") && isValidPassword("password") && isMatchedPassword("password", "confirmPassword"))
    {
          showLoadSpinner();
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
            removeLoadSpinner();
            for(let err in data.errors)
            {
              makeInvalidInput(err , data.errors[err] )
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
           // showAlert('error' , 'Error' , data.message_error)
           //   swett alert
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'error',
              title: data.message_error
            })
            //  
        }
      })
}
})


