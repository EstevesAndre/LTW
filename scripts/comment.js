let commentForm = document.querySelector('#comments-section form input[type=button]');
commentForm.addEventListener('click', submitComment);

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function submitComment(event) {
  let publication_id = document.querySelector('#comments-section form input[name=publication_id]').value;
  let comment_id = document.querySelector('#comments-section form input[name=comment_id]').value;
  let fulltext = document.querySelector('#comments-section form textarea[name=fulltext]').value;
  console.log(publication_id);
  console.log(comment_id);
  console.log(fulltext);
    
  let request = new XMLHttpRequest();
  request.open('POST', '../api/add_comment.php', true);
  console.log("HERE");
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');  
  request.addEventListener('load', receiveComments);
  request.send(encodeForAjax({publication_id: publication_id, comment_id: comment_id, fulltext: fulltext}));

  event.preventDefault();
}

function receiveComments(event) 
{
  let newComment = JSON.parse(this.responseText);
  console.log(newComment);
  let section = document.querySelector('#comments-section .sub-comment');
  console.log(document.querySelector('#comments-section'));
  
    let commentDiv = document.createElement('div');
    commentDiv.setAttribute('class', 'comment');
    commentDiv.innerHTML = createComment(newComment);

  section.appendChild(commentDiv);
}


function createComment(newComment)
{
  var html = "<a href='' class='com-user'>" + newComment['username'] + "</a>" + 
            "<p class='sep'>&nbsp - &nbsp</p>" + 
            "<p class='com-date'>" + newComment['timestamp'] + "</p>" + 
            "<a class='com-trash' href='" + "../api/deleteComment.php?publication_id=" + newComment['publication_id'] + "&comment_id=" + newComment['id'] + "' >" + 
                "<i class='far fa-trash-alt'></i>" + 
            "</a>" + 
            "<p class='com-text'>&nbsp  &nbsp &nbsp" + newComment['text'] + "</p>" + 
            "<div class='vote-section'>" +
                "<div class='votes'>" + 
                    "<a href='" + "../api/thumbsUpDown.php?publication_id=" + newComment['publication_id'] + "&choice=up&option=single_article&comment_id=" + newComment['id'] + "' >" + 
                        "<i class='far fa-thumbs-up'></i>" +                                                  
                    "</a>" + 
                    "<span> 0</span>" + 
                "</div>" + 
                "<div class='votes'>" + 
                    "<a href='" + "../api/thumbsUpDown.php?publication_id=" + newComment['publication_id'] + "&choice=down&option=single_article&comment_id=" + newComment['id'] + "' >" + 
                        "<i class='far fa-thumbs-down'></i>" + 
                    "</a>" +
                    "<span> 0</span>" + 
                "</div>" + 
            "</div>" + 
            "<section id='sub-comment-section'>" +
                "<form class='comment-response'>" +                                 
                    "<input type='hidden' name='publication_id' value=" + newComment['publication_id'] + ">" + 
                    "<input type='hidden' name='comment_id' value=" + newComment['id'] + ">" + 
                    "<textarea name='fulltext' rows='2' cols='40'></textarea>" + 
                    "<input class='button' type='button' value='Comment' >" +
                "</form>" + 
                "<div class='sub-comment'>" +
                "</div>" + 
            "</section>";
  return html;
}