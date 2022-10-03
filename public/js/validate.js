function emptyObj(obj)
{
    return Object.keys(obj).length === 0;
}
function isEmpty(string)
{
    return string.length == 0 || string == null || string == ""
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

function csutomPostFetch(url , form ,  callback , appendData = {} , parentElement = null ,)
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


