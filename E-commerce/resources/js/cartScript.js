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
                    $(`#total_price`).text(`$${response.data.total_price}`);
                    $(`#total_product_price_${productId}`).text(`$${response.data.total_product_price}`);
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
                    $(`#total_price`).text(`$${response.data.total_price}`);
                    $(`#total_product_price_${productId}`).text(`$${response.data.total_product_price}`);
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

function deleteFromCart(productId) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    const url = `/client/cart/delete/${productId}`;
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
                $(`#total_product_container_${productId}`).remove();
                if (response.data.count === 0) {
                    $(`#total_price`).text(`$0`);
                    $('#product-container').append(`
                        <div class="py-10 flex items-center justify-center">
                            <p class="text-red-500 text-4xl font-bold text-center">Your Cart Is Empty</p>
                        </div>
                    `)
                } else {
                    $(`#total_price`).text(`$${response.data.total_price}`);
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

window.addOneToCart = addOneToCart;
window.removeFromCart = removeFromCart;
window.deleteFromCart = deleteFromCart;
