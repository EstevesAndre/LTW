let subscribe = document.querySelector("div.subscribe");
if(subscribe) subscribe.addEventListener('click', toggleSubscribe);

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function toggleSubscribe(event) {

    let toggle = subscribe.querySelector('a');
    let idChannel = subscribe.querySelector('input[name=channel]').value;

    let request = new XMLHttpRequest();
    request.open('POST', '../api/userLikesChannel.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
    request.addEventListener('load', function() {
        toggle.innerHTML = this.responseText;
    });
    request.send(encodeForAjax({idChannel: idChannel}));
} 