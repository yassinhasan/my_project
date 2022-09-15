function readMore(post , postId)
{
    if(post.length > 300)
    {
        post = post.slice(0,300)+` <a href='/showPost?postId=${postId}'> read More... </a>`;
    }
    return post;
}

export {readMore}