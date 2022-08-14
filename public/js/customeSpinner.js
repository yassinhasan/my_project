function showCustomeSpinner(div)
{
    div.style.position ="relative";
    let elm =  
    `
    <div class="custome_overlay_spinner"></div>
    <div class="custom_load_spinner">
    
        <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
  </div>`;

 div.insertAdjacentHTML("beforeend" , elm)
}


function removeCustomSpinner(div)
{
    
    let custome_overlay_spinner =  div.querySelector(".custome_overlay_spinner");
    if(custome_overlay_spinner)
    { custome_overlay_spinner.remove();}
   
    let custom_load_spinner = div.querySelector(".custom_load_spinner");
    if(custom_load_spinner)
    {  custom_load_spinner.remove();}
  
   
} 