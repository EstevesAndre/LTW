let pontuation = document.querySelectorAll("div.vote-toggle");
if(pontuation) pontuation.forEach((clicked) => clicked.addEventListener('click', updatePontuation));

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function updatePontuation(event) {
    
    let thumb = event.target.closest("a[id=thumb]");

    if(thumb)
    {
        let publication_username = thumb.querySelector('input[name=publication_username]').value;
        let comment_username = thumb.querySelector('input[name=comment_username]').value;
        let session_username = thumb.querySelector('input[name=session_username]').value;

        if(session_username && (session_username == comment_username || session_username == publication_username))
        {
            let request = new XMLHttpRequest();
            request.open('POST', '../api/pontuation.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
            request.addEventListener('load', function() {
                let points = document.querySelector("header a[name=pontuation]");                
                points.innerHTML = this.responseText;
            });
            request.send(encodeForAjax({session_username: session_username}));
        }
    }
} 