import { showAlert } from './showAlert';

function addToCart(productId, stock) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    const quantity = parseInt($(`#quantity-${productId}`).val());
    if (quantity <= stock) {
        const url = `/client/cart/add/${productId}`;
        const data = {
            quantity: quantity,
            _token: csrfToken
        };
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(response, _, xhr) {
                if (xhr.status === 200) {
                    $(`#product-${productId} #actions #cart-actions`).removeClass('w-4/5');
                    $(`#product-${productId} #actions #cart-actions`).addClass('flex items-end');
                    $(`#product-${productId} #actions #cart-actions`).html(`
                        <button id="removeFromCartBtn-${productId}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-s-lg" onclick="removeFromCart(${productId})" ${ quantity === 1 ? "disabled" : "" }>-</button>
                        <input type="text" id="quantity-${productId}" name="quantity" value="${quantity}" class="w-3/5 text-center p-2 bg-gray-100 text-gray-900" readonly disabled>
                        <button id="addOneToCartBtn-${productId}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4" onclick="addOneToCart(${productId}, ${stock})">+</button>
                    `);
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

window.addToCart = addToCart;
