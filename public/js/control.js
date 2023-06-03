function editComment(commentId) {
    var commentElement = document.getElementById("commentText" + commentId);
    var editForm = document.getElementById("commentEdit" + commentId);
    var dropdown = document.getElementById("dropdownComment" + commentId);
    commentElement.style.display = "none";
    editForm.style.display = "block";
    dropdown.style.display = "none";

    var commentValue = document.getElementById(
        "commentValue" + commentId
    ).textContent;
    var commentTextarea = document.getElementById(
        "commentTextarea" + commentId
    );
    commentTextarea.value = commentValue;
}

function cancelEdit(commentId) {
    var commentElement = document.getElementById("commentText" + commentId);
    var editForm = document.getElementById("commentEdit" + commentId);
    commentElement.style.display = "block";
    editForm.style.display = "none";
}

// $(document).ready(function() {
//     $('.likeDislike').click(function() {
//         var button = $(this);
//         var itemId = button.data('item-id');
//         var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Get the CSRF token from a meta tag

//         $.ajax({
//             method: 'POST',
//             url: '{{ route('like') }}',
//             // data: { item_id: itemId},
//             data: {
//                 item_id: itemId,
//                 _token: csrfToken // Include the CSRF token in the request data
//             },
//             success: function(response) {
//                 console.log('success');

//             },
//             error: function(xhr, status, error) {
//                 // ddd
//             }
//         });
//     });
// });

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
function searchByName() {
    // Ambil nilai input search
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();

    // Ambil semua product cards
    let productCards = document.getElementsByClassName("tabel-produk");
    let article = document.getElementsByClassName("artikel");

    // Looping semua product cards
    for (let i = 0; i < productCards.length; i++) {
        let productName = productCards[i].getElementsByClassName("nama")[0];
        let productNameText = productName.textContent || productName.innerText;

        // Cek apakah product name match dengan search query
        if (productNameText.toUpperCase().indexOf(filter) > -1) {
            productCards[i].style.display = "";
        } else {
            productCards[i].style.display = "none";
        }
    }

    for (let i = 0; i < article.length; i++) {
        let articleName = article[i].getElementsByClassName("title")[0];
        let articleNameText = articleName.textContent || articleName.innerText;

        // Cek apakah product name match dengan search query
        if (articleNameText.toUpperCase().indexOf(filter) > -1) {
            article[i].style.display = "";
        } else {
            article[i].style.display = "none";
        }
    }
}