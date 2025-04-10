import { showAlert } from "../showAlert";

function markAsRead(e, notificationId, guard) {
    var csrf = $('meta[name="csrf-token"]').attr("content");
    e.preventDefault();
    $.ajax({
        url: `/notifications/mark-as-read/${guard}/${notificationId}`,
        data: {
            _token: csrf,
            _method: "PUT",
        },
        type: "PUT",
        success: function (response, _, xhr) {
            if (xhr.status === 200) {
                $(`#notification-count`).text(response.data.count);
                $(`#notification-${notificationId}`)
                    .removeClass("bg-gray-400")
                    .addClass("bg-gray-200");
                $(`#mark-as-read-${notificationId}`).remove();
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

function deleteNotification(e, notificationId, guard) {
    var csrf = $('meta[name="csrf-token"]').attr("content");
    e.preventDefault();
    $.ajax({
        url: `/notifications/delete-notification/${guard}/${notificationId}`,
        data: {
            _token: csrf,
            _method: "DELETE",
        },
        type: "DELETE",
        success: function (response, _, xhr) {
            if (xhr.status === 200) {
                $(`#notification-count`).text(response.data.unread_count);
                $(`#notification-${notificationId}`).remove();
                showAlert("success", response.message);
                if (response.data.count === 0) {
                    $("#notifications-container").append(
                        `<div class="py-10 flex items-center justify-center">
                            <p class="text-red-500 text-4xl font-bold text-center">You have no notifications</p>
                        </div>`
                    );
                }
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

window.markAsRead = markAsRead;
window.deleteNotification = deleteNotification;
