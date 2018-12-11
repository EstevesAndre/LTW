let thumbs = document.querySelectorAll("div.vote-toggle a[id=thumb]");
thumbs.forEach((thumb) => thumb.addEventListener('click', submitThumb));

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function submitThumb(event) {
    let votes = event.target.closest('div.vote-toggle');
    let parent = event.target.parentElement;
    let publication_id = parent.querySelector('input[name=publication_id]').value;
    let comment_id = parent.querySelector('input[name=comment_id]').value;
    let choice = parent.querySelector('input[name=choice]').value;
    let option = parent.querySelector('input[name=option]').value;

    let request = new XMLHttpRequest();
    request.open('POST', '../api/thumbsUpDown.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
    request.addEventListener('load', function() {  
        votes.innerHTML = this.responseText;
    });
    request.send(encodeForAjax({publication_id: publication_id, comment_id: comment_id, choice: choice, option: option}));
}