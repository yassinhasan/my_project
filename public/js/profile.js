let edit_profile = getElm("edit_profile");
let cancel_profile = getElm("cancel_profile");
let save_profile = getElm("save_profile");
let info = getAllElm("info");
let list_edit = getElm("list_edit");
let form = getElm("form");
let formURL = form.action;
let profile_iamge = getElm("profile_iamge");
let profile_image_input = getElm("profile_image_input");
let all_input_profile = getAllElm("input_profile");
let update_profile_image = getElm("update_profile_image");
let cancel_profile_image = getElm("cancel_profile_image");
edit_profile.addEventListener("click",()=>
{
    hideAll(info)
    showAll(all_input_profile)
    hide(edit_profile)
    show(list_edit)
})
cancel_profile.addEventListener("click",()=>
{
    showAll(info)
    hideAll(all_input_profile)
    show(edit_profile)
    hide(list_edit)
})



save_profile.addEventListener("click",(e)=>
{
    e.preventDefault();
    showLoadSpinner();
    removeAnyValidation()
    let formdata = new FormData(form);
    fetch(formURL ,
    {
        method: "post" ,
        body  : formdata
    })
    .then(resp=>resp.json())
    .then(data=>{
       
        if(data.errors)
        {
            removeLoadSpinner();
            for(let err in data.errors)
            {
            
             makeInvalidInput(err  , "bio" ,data.errors[err] )
            }
        }else
        {
            //showAlert('success' , 'Success' , data.success)
            // setTimeout(function()
            // {
                window.location.reload();
            // },2000)
        }
    })
})




profile_iamge.addEventListener("click",()=>
{
     hideAlert();
     profile_image_input.click();
    removeAnyValidation()
})




singleUpload(profile_image_input , ALLOWD_TYPE_IMAGE , ALLOWD_SIZE ,showImagePorfile);
let oldsrc = profile_iamge.getAttribute("src");
function showImagePorfile(file , imagesrc)
{
    
    if(!file.type.includes(ALLOWD_TYPE_IMAGE))
    {
        hide(update_profile_image);
        profile_iamge.src = "./public/uploades/images/error.png";
        makeInvalidInput("image"  , null ,"sorry you suoud select only images " );
        

    }else
    {
        removeAnyValidation();
        profile_iamge.src =  imagesrc;  
        show(update_profile_image);
        show(cancel_profile_image);
    }
 
    cancel_profile_image.addEventListener("click",()=>
    {
        hide(update_profile_image);
        hide(cancel_profile_image);
        profile_iamge.src = oldsrc;
        removeAnyValidation()
    })
    update_profile_image.addEventListener("click",()=>
    {
        let file_form = getElm("file_form");
        let file_form_url = file_form.action;
        fetchUpdateImage(file_form , file_form_url)
    })
}

function fetchUpdateImage(form,url)
{
   
    let formdata = new FormData(form);
    fetch(url ,
    {
        method: "post" ,
        body  : formdata
    })
    
    .then(resp=>resp.json())
    .then(data=>{
        removeAnyValidation()
        if(data.errors)
        {
            for(err in data.errors)
            {
                makeInvalidInput(err  , null ,data.errors[err] )
            }
        }else
        {
            hide(update_profile_image);
            hide(cancel_profile_image);
           
            hideAlert();
            showAlert("success" ,"Success !" , " you have updated your profile");
        }
    
    })
}
