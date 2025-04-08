import { showAlert } from './showAlert';

function rateBook() {
    let rating = 0;

    $('#review-rating i').on('mouseover', function () {
        let value = $(this).data('value');
        highlightStars(value);
    });

    $('#review-rating i').on('mouseleave', function () {
        highlightStars(rating);
    });

    $('#review-rating i').on('click', function () {
        rating = $(this).data('value');
        $('#rating-value').text(rating);
    });

    function highlightStars(value) {
        $('#review-rating i').each(function () {
            let starValue = $(this).data('value');
            if (starValue <= value) {
                $(this).removeClass('fa-regular').addClass('fa-solid');
                $(this).removeClass('text-gray-400').addClass('text-yellow-400');
            } else {
                $(this).removeClass('text-yellow-400').addClass('text-gray-400');
                $(this).removeClass('fa-solid').addClass('fa-regular');
            }
        });
    }

}

$(document).ready(rateBook);

function addReview(bookId) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    let review_rating = parseInt($("#rating-value").text())
    if (!review_rating || review_rating == 0) {
        $("#review-err").text("Review rating is required");
        return;
    }

    let review_content = $("#review-content").val()
    if (!review_content || review_content == "") {
        $("#review-err").text("Review content is required");
        return;
    }

    const url = `/client/review/${bookId}`;
    const data = {
        content: review_content,
        rate: review_rating,
        _token: csrfToken
    };

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response, _, xhr) {
            if (xhr.status === 200) {
                if ($(`#no-reviews-msg`).text() !== "") {
                    $(`#no-reviews-msg-div`).remove();
                }
                $(`#review-form`).removeClass('border-b border-b-black').empty();

                let reviews_count = parseInt($(`#reviews_count`).text())
                $(`#reviews_count`).text(reviews_count + 1);
                $(`#book_reviews_count`).text(reviews_count + 1);


                let reviews_avg = (( parseFloat($(`#reviews_avg`).text()) * reviews_count ) + review_rating) / (reviews_count + 1);
                $(`#reviews_avg`).text(reviews_avg.toFixed(1));

                let book_rating_stars = "";
                for (let i = 1; i <= 5; i++) {
                    if (i <= reviews_avg) {
                        book_rating_stars += '<i class="fa-solid fa-star ms-2 cursor-pointer text-yellow-400"></i>';
                    } else {
                        book_rating_stars += '<i class="fa-regular fa-star ms-2 cursor-pointer"></i>';
                    }
                }
                $(`#book_reviews_stars`).html(book_rating_stars);

                let rating_stars = "";
                for (let i = 1; i <= 5; i++) {
                    if (i <= review_rating) {
                        rating_stars += '<i class="fa-solid fa-star ms-2 cursor-pointer text-yellow-400"></i>';
                    } else {
                        rating_stars += '<i class="fa-regular fa-star ms-2 cursor-pointer"></i>';
                    }
                }

                $(`#reviews-container`).prepend(`
                    <div id="review-${response.data.review_id}" class="border-b pb-4 mb-4 flex items-center justify-between">
                        <div>
                            <div class="flex items-center space-x-1">
                                <h4 class="text-lg font-semibold">${response.data.name}</h4>
                                <div class="flex items-center space-x-1">
                                    ${rating_stars}
                                </div>
                            </div>
                            <p class="ps-2 text-gray-500">${review_content}</p>
                        </div>
                        <div id="actions">
                            <div class="mt-4 flex items-center justify-end">
                                <button id="updateReviewBtn-${response.data.review_id}" class="w-4/5 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-s-lg" onclick="showUpdateReviewForm('${bookId}', '${response.data.review_id}', '${review_content}', ${review_rating})">
                                    update
                                </button>
                                <button id="deleteReviewBtn-${response.data.review_id}" class="bg-red-500 hover:bg-red-600 text-red-500 py-2 px-4 rounded-e-lg" onclick="deleteReview('${response.data.review_id}', '${bookId}')">🗑</button>
                            </div>
                        </div>
                    </div>
                `)
                showAlert("success", response.message);
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

function showUpdateReviewForm(bookId, reviewId, content, rate) {
    let rating_stars = "";
    for (let i = 1; i <= 5; i++) {
        if (i <= rate) {
            rating_stars += `<i class="fa-solid fa-star text-3xl cursor-pointer text-yellow-400" data-value="${i}"></i>`;
        } else {
            rating_stars += `<i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="${i}"></i>`;
        }
    }

    $(`#review-form`).addClass('border-b border-b-black').html(`
        <h3 class="text-xl font-bold text-gray-800 mb-4">Leave a Review:</h3>

        <div class="flex items-center mb-4 space-x-1" id="review-rating">
            ${rating_stars}
            <p class="text-center text-lg font-semibold text-gray-700 !ml-5"><span id="rating-value">${rate}</span> / 5</p>
        </div>

        <div class="mb-4">
            <div class="flex justify-center">
                <input id="review-content" type="text" value="${content}" class="w-4/5 p-3 border border-gray-300 rounded-s-lg focus:ring focus:ring-purple-400" placeholder="Write your review here...">
                <button id="submit-review" class="w-1/5 bg-purple-500 text-white font-bold py-3 rounded-e-lg hover:bg-purple-600 transition duration-200" onclick="updateReview('${reviewId}', '${bookId}')">
                    Send
                </button>
                <p id="review-err" class="text-red-500 text-xs mt-1"></p>
            </div>
        </div>
    `)
    rateBook()
}

function updateReview(reviewId, bookId) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    let review_rating = parseInt($("#rating-value").text())
    if (!review_rating || review_rating == 0) {
        $("#review-err").text("Review rating is required");
        return;
    }

    let review_content = $("#review-content").val()
    if (!review_content || review_content == "") {
        $("#review-err").text("Review content is required");
        return;
    }

    const url = `/client/review/edit/${reviewId}`;
    const data = {
        content: review_content,
        rate: review_rating,
        _token: csrfToken,
        _method: 'PUT'
    };

    $.ajax({
        url: url,
        type: 'PUT',
        data: data,
        success: function(response, _, xhr) {
            if (xhr.status === 200) {
                $(`#review-form`).removeClass('border-b border-b-black').empty();

                let reviews_count = parseInt($(`#reviews_count`).text());

                let reviews_avg = (( parseFloat($(`#reviews_avg`).text()) * reviews_count ) - response.data.old_rating + review_rating) / reviews_count;
                $(`#reviews_avg`).text(reviews_avg.toFixed(1));

                let book_rating_stars = "";
                for (let i = 1; i <= 5; i++) {
                    if (i <= reviews_avg) {
                        book_rating_stars += '<i class="fa-solid fa-star ms-2 cursor-pointer text-yellow-400"></i>';
                    } else {
                        book_rating_stars += '<i class="fa-regular fa-star ms-2 cursor-pointer"></i>';
                    }
                }
                $(`#book_reviews_stars`).html(book_rating_stars);

                let rating_stars = "";
                for (let i = 1; i <= 5; i++) {
                    if (i <= review_rating) {
                        rating_stars += '<i class="fa-solid fa-star ms-2 cursor-pointer text-yellow-400"></i>';
                    } else {
                        rating_stars += '<i class="fa-regular fa-star ms-2 cursor-pointer"></i>';
                    }
                }

                $(`#review-${reviewId}`).html(`
                    <div>
                        <div class="flex items-center space-x-1">
                            <h4 class="text-lg font-semibold">${response.data.name}</h4>
                            <div class="flex items-center space-x-1">
                                ${rating_stars}
                            </div>
                        </div>
                        <p class="ps-2 text-gray-500">${review_content}</p>
                    </div>
                    <div id="actions">
                        <div class="mt-4 flex items-center justify-end">
                            <button id="updateReviewBtn-${reviewId}" class="w-4/5 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-s-lg" onclick="showUpdateReviewForm('${bookId}', '${reviewId}', '${review_content}', ${review_rating})">
                                update
                            </button>
                            <button id="deleteReviewBtn-${reviewId}" class="bg-red-500 hover:bg-red-600 text-red-500 py-2 px-4 rounded-e-lg" onclick="deleteReview('${reviewId}', '${bookId}')">🗑</button>
                        </div>
                    </div>
                `)
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

function deleteReview(reviewId, bookId) {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    const url = `/client/review/delete/${reviewId}`;

    const data = {
        _token: csrfToken,
        _method: 'DELETE'
    };

    $.ajax({
        url: url,
        type: 'DELETE',
        data: data,
        success: function(response, _, xhr) {
            if (xhr.status === 200) {
                $(`#review-${reviewId}`).remove();

                let reviews_count = parseInt($(`#reviews_count`).text());
                $(`#reviews_count`).text(reviews_count - 1);
                $(`#book_reviews_count`).text(reviews_count - 1);

                let reviews_avg = (( parseFloat($(`#reviews_avg`).text()) * reviews_count ) - response.data.old_rating) / (reviews_count - 1);
                $(`#reviews_avg`).text(reviews_avg.toFixed(1));

                let book_rating_stars = "";
                for (let i = 1; i <= 5; i++) {
                    if (i <= reviews_avg) {
                        book_rating_stars += '<i class="fa-solid fa-star ms-2 cursor-pointer text-yellow-400"></i>';
                    } else {
                        book_rating_stars += '<i class="fa-regular fa-star ms-2 cursor-pointer"></i>';
                    }
                }
                $(`#book_reviews_stars`).html(book_rating_stars);

                if (response.data.count === 0) {
                    $(`#reviews_count`).text("0.0");
                    $(`#reviews_avg`).text(0);
                    $('#reviews-container').append(`
                        <div id="no-reviews-msg-div" class="py-10 flex items-center justify-center">
                            <p id="no-reviews-msg" class="text-red-500 text-4xl font-bold text-center">No Reviews Yet</p>
                        </div>
                    `)
                }

                if (response.data.client_count === 0) {
                    $(`#review-form`).addClass('border-b border-b-black').html(`
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Leave a Review:</h3>

                        <div class="flex items-center mb-4 space-x-1" id="review-rating">
                            <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="1"></i>
                            <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="2"></i>
                            <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="3"></i>
                            <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="4"></i>
                            <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="5"></i>
                            <p class="text-center text-lg font-semibold text-gray-700 !ml-5"><span id="rating-value">0</span> / 5</p>
                        </div>

                        <div class="mb-4">
                            <div class="flex justify-center">
                                <input id="review-content" type="text" class="w-4/5 p-3 border border-gray-300 rounded-s-lg focus:ring focus:ring-purple-400" placeholder="Write your review here...">
                                <button id="submit-review" class="w-1/5 bg-purple-500 text-white font-bold py-3 rounded-e-lg hover:bg-purple-600 transition duration-200" onclick="addReview('${bookId}')">
                                    Send
                                </button>
                            </div>
                            <p id="review-err" class="text-red-500 text-xs mt-1"></p>
                        </div>
                    `)
                }
                showAlert("success", response.message)
                rateBook()
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

window.rateBook = rateBook;
window.addReview = addReview;
window.showUpdateReviewForm = showUpdateReviewForm;
window.updateReview = updateReview;
window.deleteReview = deleteReview;
