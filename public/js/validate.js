function emptyObj(obj)
{
    return Object.keys(obj).length === 0;
}
function isEmpty(string)
{
    return string.length == 0 || string == null || string == ""
}
function isNotEmptyForFullForm(form)
{
  
    let errors = 0;
    let allInputs = form.getElementsByTagName("input");
  
    for (let i = 0; i < allInputs.length; i++) {
          let name =   allInputs[i].getAttribute("name") ;
         if (allInputs[i].value.length == 0 || allInputs[i].value == null || allInputs[i].value == "")
         {
                makeInvalidInput(name, "Sorry this "+name + " is iequired" );
                errors++;
         }
    }
    return errors == 0;
   
}

function validName(name) {
    let err = 0;
    let nameValue = document.querySelector(`input[name=${name}]`).value;
     if (nameValue.length < 4)
     {
          makeInvalidInput(name, `Sorry  ${name} Is must not be less than 4 ` ); 
          err ++
     }else if (/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#0-9_-]+/.test(nameValue))
     {
          makeInvalidInput(name, `Sorry  ${name} has in valid characters` ); 
          err ++
     }
   return err == 0;

}
function isMatchedPassword(password, confirmPassword) {
     password = document.querySelector(`input[name=${password}]`).value;
     confirmPassword = document.querySelector(`input[name=${confirmPassword}]`).value;
     if(password !== confirmPassword)
     {
        
        makeInvalidInput("confirmPassword", "Sorry this password is not matched" ); 
        return false;
     }

    return true;
}

function isValidPassword(password) {
    let err = 0;
     password = document.querySelector(`input[name=${password}]`).value;
     if (password.length < 8)
     {
          makeInvalidInput("password", "Sorry  password is must not be less than 8 characters" ); 
          err ++
     }
     if (!/[A-Z]+/g.test(password))
     {
          makeInvalidInput("password", "Sorry  password must has one Uppercase" ); 
          err ++
     }
     if (!/[0-9]/.test(password))
     {
          makeInvalidInput("password", "Sorry  Password Is Must Contain  numbers" ); 
          err ++
     }
      return err == 0;

}
function prepareTextarea(textarea) {
    textarea.addEventListener("keydown", (e) => {
        textarea.classList.remove("is-invalid");
        textarea.classList.remove("is-valid");
    })
    textarea.addEventListener("click", (e) => {
        textarea.classList.remove("is-invalid");
        textarea.classList.remove("is-valid");
    })

}

function csutomPostFetch(url , form ,  callback , appendData = {} , parentElement = null)
{   
    if(parentElement != null)
    {
        showCustomeSpinner(parentElement);
    }
    let formdata = new FormData(form);
    if(! isEmpty(appendData))
    {
            for(let key in appendData)
            {
                formdata.append(key ,appendData[key])
            }
    }
    fetch(url, {
            method: "POST" , 
            body  : formdata
        })

        .then(resp => resp.json())
        .then(data => {
          
            callback(data)
            if(parentElement != null)
            {
                removeCustomSpinner(parentElement);
            }   
        });
 
}


