function showCustomeSpinner(div)
{
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


function removeCustomSpinner()
{
    document.querySelector(".custome_overlay_spinner").remove();
    document.querySelector(".custom_load_spinner").remove();
}