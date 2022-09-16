function readMore(post , postId)
{
    if(post.length > 300)
    {
        post = post.slice(0,300)+` <a href='/showPost?postId=${postId}'> read More... </a>`;
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