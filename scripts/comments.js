let commentForm = document.querySelectorAll('#comments-section');
if(commentForm) commentForm.forEach((comment) => comment.addEventListener('click', submitComment));

let delComment = document.querySelectorAll('a.com-trash');
if(delComment) delComment.forEach( (comment) => comment.addEventListener('click', deleteComment));

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&'); 
}

function submitComment(event) {
    if(event.target.closest("form input[type=button]"))
    {
        let form = event.target.parentElement;
        let publication_id = form.querySelector('input[name=publication_id]').value;
        let comment_id = form.querySelector('input[name=comment_id]').value;
        let fulltext = form.querySelector('textarea[name=fulltext]').value;

        let request = new XMLHttpRequest();
        request.open('POST', '../api/add_comment.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
        request.addEventListener('load', function() {
            let section = document.querySelector('#comments-section .sub-comment');
            section.innerHTML = this.responseText;          
            let thumbs = document.querySelectorAll("div.vote-toggle");
            if (thumbs) thumbs.forEach((thumb) => thumb.addEventListener('click', submitThumb));
            delComment = document.querySelectorAll('a.com-trash');
            if(delComment) delComment.forEach( (comment) => comment.addEventListener('click', deleteComment));
        });
        request.send(encodeForAjax({publication_id: publication_id, comment_id: comment_id, fulltext: fulltext}));

        event.preventDefault();
    }
}

function deleteComment(event) {

    let clicked = event.target.parentElement;
    let publication_id = clicked.querySelector('input[name=publication_id]').value;
    let comment_id = clicked.querySelector('input[name=comment_id]').value;

    let request = new XMLHttpRequest();
    request.open('POST', '../api/deleteComment.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
    request.addEventListener('load', function() {
        let section = document.querySelector('#comments-section .sub-comment');
        section.innerHTML = this.responseText;          
        let thumbs = document.querySelectorAll("div.vote-toggle");
        if (thumbs) thumbs.forEach((thumb) => thumb.addEventListener('click', submitThumb)); 
        delComment = document.querySelectorAll('a.com-trash');
        if(delComment) delComment.forEach( (comment) => comment.addEventListener('click', deleteComment));
    });
    request.send(encodeForAjax({publication_id: publication_id, comment_id: comment_id}));

    event.preventDefault();
}