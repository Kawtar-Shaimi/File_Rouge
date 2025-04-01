import { showAlert } from './showAlert';

function deleteFromWishlist(productId) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    const url = `/client/wishlist/remove/${productId}`;
    const data = {
        _token: csrfToken,
        _method: 'DELETE'
    };

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response, _, xhr) {
            if (xhr.status === 200) {
                $(`#product-${productId}`).remove();
                if (response.data.count === 0) {
                    $('#product-container').append(`
                        <div class="py-10 flex items-center justify-center">
                            <p class="text-red-500 text-4xl font-bold text-center">Your Wishlist Is Empty</p>
                        </div>
                    `)
                }
                showAlert("success", response.message)
            }
        },
        error: function(xhr) {
            if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                    showAlert("error", xhr.responseJSON.message)
                } else {
                    console.error(xhr.responseJSON.message);
                }
            } else {
                console.error(xhr.responseJSON.message);
            }
        }
    });

}

window.deleteFromWishlist = deleteFromWishlist;
