let commentForm = document.querySelector('#comments-section form');
commentForm.addEventListener('submit', submitComment);

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function submitComment(event) {
  let publication_id = document.querySelector('#comments-section input[name=publication_id]').value;
  let comment_id = document.querySelector('#comments-section input[name=comment_id]').value;
  let fulltext = document.querySelector('#comments-section textarea[name=fulltext]').value;

  let request = new XMLHttpRequest();
  request.addEventListener('load', receiveComments);
  request.open('POST', '../api/add_comment.php', true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(encodeForAjax({publication_id: publication_id, comment_id: comment_id, fulltext: fulltext}));

  event.preventDefault();
}

function receiveComments(event) {
  let section = document.querySelector('#comments-section');
  let comments = JSON.parse(this.responseText);

  for (let i = 0; i < comments.length; i++) {
    let comment = document.createElement('article');
    comment.classList.add('comment');

    comment.innerHTML = '<p>HELLO</p>';

    section.insertBefore(comment, commentForm);
  }
}
