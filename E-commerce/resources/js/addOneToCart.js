import { showAlert } from './showAlert';

function addOneToCart(productId, stock) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    let quantity = parseInt($(`#quantity-${productId}`).val()) + 1;

    if (quantity <= stock) {
        if (quantity > 1) {
            $(`#removeFromCartBtn-${productId}`).prop('disabled', false);
        }

        const url = `/client/cart/add/${productId}`;
        const data = {
            quantity: 1,
            _token: csrfToken
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response, _, xhr) {
                if (xhr.status === 200) {
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
    } else {
        showAlert("error", "You reached the stock limit");
    }
}

window.addOneToCart = addOneToCart;
