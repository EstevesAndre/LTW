function burger_menu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

var btnContainer = document.getElementById("orderDiv");
if (btnContainer) var btns = btnContainer.getElementsByClassName("order-button");
if (btns) {
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";

            let order = current[0].querySelector('p').innerHTML;

            let request = new XMLHttpRequest();
            request.open('POST', '../api/orderPublications.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.addEventListener('load', function () {
                let freshPublications = document.querySelector('div.ordered-publications');
                freshPublications.innerHTML = this.responseText;
                let thumbs = document.querySelectorAll("div.vote-toggle");
                if (thumbs) thumbs.forEach((thumb) => thumb.addEventListener('click', submitThumb));
                let delComment = document.querySelectorAll('a.fresh-trash');
                if(delComment) delComment.forEach( (comment) => comment.addEventListener('click', deletePublication));                
            });
            request.send(encodeForAjax({ order: order }));
        });
    }
}