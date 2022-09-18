function readMore(post , postId)
{
    let cut_post ="";
    let remian_post ="";
    if(post.length > 300)
    {
        
        cut_post =  post.slice(0,300);
        remian_post = post.slice(300);
        post = `<span class="cut_post">${cut_post}</span><a href='/showPost?postId=${postId}'> ... read More </a><p class="remain_post">${remian_post}</p>`
    }else
    {
        post = `<p class="cut_post">${post}</p>`
    }
    return post;
}
function handleFileName(filename)
{
    if(filename.length > 15)
    {
        let first_file_name = filename.slice(0,8);
        let ext = filename.split(".").pop();
        let last_file_name = filename.split(".").shift().slice(-4);
        filename = first_file_name+"..."+last_file_name+"."+ext
        
    }
    return filename;
}
export {readMore , handleFileName}