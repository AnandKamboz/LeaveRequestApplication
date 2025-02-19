function validateNumber(input) {
    input.value = input.value.replace(/[^0-9]/g, "");
}

$(document).ready(function () {
    $("#login-button").on("click", function () {
        $(".loader").removeClass("d-none");
        $(".invalid-feedback").remove();
        $('input[name="phone"]').removeClass("is-invalid");

        $.ajax({
            url: BASE_URL + "/login",
            type: "POST",
            data: {
                phone: $("#phone").val(),
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status === "success") {
                    window.location.href = response.redirect_url;
                }
                $(".loader").addClass("d-none");
            },
            error: function (xhr) {
                console.error("Error:", xhr);
                $(".loader").addClass("d-none");
                if (xhr.status === 422) {
                    let errors =
                        xhr.responseJSON && xhr.responseJSON.errors
                            ? xhr.responseJSON.errors
                            : {};
                    $('input[name="phone"]').addClass("is-invalid");
                    $('input[name="phone"]').after(`
            <span class="invalid-feedback" role="alert" style="display: block;">
                <strong>${errors.phone
                            ? errors.phone[0]
                            : "Record not found. Please verify details."
                        }</strong>
            </span>
        `);
                } else {
                    alert("An unexpected error occurred.");
                }
            },
        });
    });
});
