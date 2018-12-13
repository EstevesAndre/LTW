let delPublication = document.querySelectorAll('a.fresh-trash');
if(delPublication) delPublication.forEach( (publication) => publication.addEventListener('click', deletePublication));

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&'); 
}

function deletePublication(event) {

    let clicked = event.target.parentElement;
    
    let publication_id = clicked.querySelector('input[name=publication_id]').value;
    let order = clicked.querySelector('input[name=order]').value;

    let request = new XMLHttpRequest();
    request.open('POST', '../api/deletePublication.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
    request.addEventListener('load', function() {
        let freshPublications = document.querySelector('div.ordered-publications');
        freshPublications.innerHTML = this.responseText;
        let thumbs = document.querySelectorAll("div.vote-toggle");
        if (thumbs) thumbs.forEach((thumb) => thumb.addEventListener('click', submitThumb)); 
        let delComment = document.querySelectorAll('a.fresh-trash');
        if(delComment) delComment.forEach( (comment) => comment.addEventListener('click', deletePublication));
    });
    request.send(encodeForAjax({publication_id: publication_id, order: order}));

    event.preventDefault();
}