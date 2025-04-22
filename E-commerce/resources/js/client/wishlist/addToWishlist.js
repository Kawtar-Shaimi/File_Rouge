import { showAlert } from "../../showAlert";

function addToWishlist(bookId) {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const url = `/client/wishlist/add/${bookId}`;
    const data = {
        _token: csrfToken,
    };
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function (response, _, xhr) {
            if (xhr.status === 200) {
                $(`#toggleWishlistBtn-${bookId}`).replaceWith(`
                    <button id="toggleWishlistBtn-${bookId}" 
                        class="w-full flex items-center justify-center py-1.5 px-3 bg-gray-50 text-gray-700 text-sm border border-gray-200 rounded-md hover:bg-gray-100 transition-colors duration-200"
                        onclick="removeFromWishlist('${bookId}')">
                        <svg class="w-4 h-4 mr-1.5 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                        </svg>
                        Remove from Wishlist
                    </button>
                `);
                showAlert("success", response.message);
            }
        },
        error: function (xhr) {
            if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                    showAlert("error", xhr.responseJSON.message);
                } else {
                    console.error(xhr.responseJSON.message);
                }
            } else {
                console.error(xhr.responseJSON.message);
            }
        },
    });
}

window.addToWishlist = addToWishlist;
