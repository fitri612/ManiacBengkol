function editComment(commentId) {
    var commentElement = document.getElementById('commentText' + commentId);
    var editForm = document.getElementById('commentEdit' + commentId);
    var dropdown = document.getElementById('dropdownComment' + commentId);
    commentElement.style.display = 'none';
    editForm.style.display = 'block';
    dropdown.style.display = 'none';

    var commentValue = document.getElementById('commentValue' + commentId).textContent;
    var commentTextarea = document.getElementById('commentTextarea' + commentId);
    commentTextarea.value = commentValue;
}

function cancelEdit(commentId) {
    var commentElement = document.getElementById('commentText' + commentId);
    var editForm = document.getElementById('commentEdit' + commentId);
    commentElement.style.display = 'block';
    editForm.style.display = 'none';

}

// function editComment(event, commentId) {
//     event.preventDefault();

//     var form = event.target;
//     var formData = new FormData(form);

//     fetch(form.action, {
//             method: 'POST',
//             body: formData,
//         })
//         .then(response => {
//             if (response.ok) {
//                 return response.json();
//             } else {
//                 throw new Error('Failed to update comment');
//             }
//         })
//         .then(data => {
//             var commentElement = document.getElementById('commentText' + commentId);
//             var editForm = document.getElementById('commentEdit' + commentId);
//             commentElement.style.display = 'block';
//             editForm.style.display = 'none';
//             commentElement.querySelector('#commentValue' + commentId).textContent = data.comment;
//             alert('Comment successfully updated');
//         })
//         .catch(error => {
//             alert(error.message);
//         });
// }
