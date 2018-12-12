let pontuation = document.querySelectorAll("div.vote-toggle");
pontuation.forEach((clicked) => clicked.addEventListener('click', updatePontuation));

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function updatePontuation(event) {
    
    let a = event.target.closest("a[id=thumb]");
    console.log(a);
    console.log(a.querySelector('input[name=publication_username]'));
    console.log(a.querySelector('input[name=comment_username]'));

    /*let idChannel = subscribe.querySelector('input[name=channel]').value;
    
    let request = new XMLHttpRequest();
    request.open('POST', '../api/userLikesChannel.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
    request.addEventListener('load', function() {
        toggle.innerHTML = this.responseText;
    });
    request.send(encodeForAjax({idChannel: idChannel}));*/
} 