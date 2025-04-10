import { showAlert } from "../../showAlert";

function addOneToCart(bookId, stock) {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    let quantity = parseInt($(`#quantity-${bookId}`).val()) + 1;

    if (quantity <= stock) {
        if (quantity > 1) {
            $(`#removeFromCartBtn-${bookId}`).prop("disabled", false);
        }

        const url = `/client/cart/add/${bookId}`;
        const data = {
            quantity: 1,
            _token: csrfToken,
        };

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (response, _, xhr) {
                if (xhr.status === 200) {
                    $(`#total_price`).text(
                        `$${response.data.total_price.toFixed(2)}`
                    );
                    $(`#total_book_price_${bookId}`).text(
                        `$${response.data.total_book_price.toFixed(2)}`
                    );
                    $(`#quantity-${bookId}`).val(quantity);
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
    } else {
        showAlert("error", "You reached the stock limit");
    }
}

function removeFromCart(bookId) {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    let quantity = parseInt($(`#quantity-${bookId}`).val());
    if (quantity > 1) {
        quantity -= 1;
        const url = `/client/cart/remove/${bookId}`;
        const data = {
            quantity: 1,
            _token: csrfToken,
            _method: "DELETE",
        };

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (response, _, xhr) {
                if (xhr.status === 200) {
                    $(`#total_price`).text(
                        `$${response.data.total_price.toFixed(2)}`
                    );
                    $(`#total_book_price_${bookId}`).text(
                        `$${response.data.total_book_price.toFixed(2)}`
                    );
                    if (quantity === 1) {
                        $(`#removeFromCartBtn-${bookId}`).prop(
                            "disabled",
                            true
                        );
                    }
                    $(`#quantity-${bookId}`).val(quantity);
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
    } else {
        $(`#removeFromCartBtn-${bookId}`).prop("disabled", true);
    }
}

function deleteFromCart(bookId) {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");

    const url = `/client/cart/delete/${bookId}`;
    const data = {
        _token: csrfToken,
        _method: "DELETE",
    };

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function (response, _, xhr) {
            if (xhr.status === 200) {
                $(`#book-${bookId}`).remove();
                $(`#total_book_container_${bookId}`).remove();
                if (response.data.count === 0) {
                    $(`#total_price`).text(`$0`);
                    $("#book-container").append(`
                        <div class="py-10 flex items-center justify-center">
                            <p class="text-red-500 text-4xl font-bold text-center">Your Cart Is Empty</p>
                        </div>
                    `);
                } else {
                    $(`#total_price`).text(
                        `$${response.data.total_price.toFixed(2)}`
                    );
                }
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

window.addOneToCart = addOneToCart;
window.removeFromCart = removeFromCart;
window.deleteFromCart = deleteFromCart;
