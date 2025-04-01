import { showAlert } from './showAlert';

function removeFromCart(productId) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    let quantity = parseInt($(`#quantity-${productId}`).val());
    if (quantity  > 1) {
        quantity -= 1;
        const url = `/client/cart/remove/${productId}`;
        const data = {
            quantity: 1,
            _token: csrfToken,
            _method: 'DELETE'
        };

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response, _, xhr) {
                if (xhr.status === 200) {
                    if (quantity === 1) {
                        $(`#removeFromCartBtn-${productId}`).prop('disabled', true);
                    }
                    $(`#quantity-${productId}`).val(quantity);
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
    }else{
        $(`#removeFromCartBtn-${productId}`).prop('disabled', true);
    }

}

window.removeFromCart = removeFromCart;
