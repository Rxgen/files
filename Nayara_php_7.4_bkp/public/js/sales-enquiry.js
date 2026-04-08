$(document).ready(function () {
    // Email + Name + Mobile validators
    var filter_email = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    var filter_name = /^[a-zA-Z ]*$/;
    var filter_mobile = /^[0-9]{8,15}$/; // 8-15 digits allowed

    // Fetch country list on load
    $.ajax({
        type: "GET",
        url: "https://restcountries.com/v3.1/all?fields=name,cca2",
        success: function (data) {
            data.sort(function (a, b) {
                return a.name.common.localeCompare(b.name.common);
            });

            var countrySelect = $("#country-select");
            countrySelect.empty();
            countrySelect.append('<option value="" disabled selected>Country</option>');

            $.each(data, function (index, country) {
                countrySelect.append(
                    '<option value="' +
                        country.cca2 +
                        '">' +
                        country.name.common +
                        "</option>"
                );
            });
        },
        error: function (xhr) {
            console.error("Error fetching country data: ", xhr);
        },
    });

    // Show institutional products dropdown
    $("#category").on("change", function () {
        if ($(this).val() === "Institutional Business") {
            $("#institutional-dropdown").show();
        } else {
            $("#institutional-dropdown").hide();
        }
    });

    // Submit form
    $(".business-enquiry").on("click", function (e) {
        e.preventDefault();

        let name = $("#name").val().trim();
        let mobile = $("#mobile").val().trim();
        let email = $("input[name='email']").val().trim();
        let city = $("input[name='city']").val().trim();
        let category = $("#category").val();
        let institutional_product = $("select[name='institutional_product']").val();
        let country_code = $("#country-select").val();
        let country_name = $("#country-select option:selected").text();

        // Reset error messages
        $(".name-error").text("");
        $(".mobile-error").text("");

        let error = false;

        if (!name) {
            $(".name-error").text("Name is required.");
            error = true;
        } else if (!filter_name.test(name)) {
            $(".name-error").text("Only letters are allowed.");
            error = true;
        }

        if (!mobile) {
            $(".mobile-error").text("Mobile is required.");
            error = true;
        } else if (!filter_mobile.test(mobile)) {
            $(".mobile-error").text("Invalid mobile number.");
            error = true;
        }

        if (email && !filter_email.test(email)) {
            alert("Invalid email format");
            error = true;
        }

        if (error) return;

        // Send AJAX request
        $.ajax({
            type: "POST",
            url: "/leads", // Laravel route
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                name: name,
                mobile: mobile,
                email: email,
                city: city,
                category: category,
                institutional_product: institutional_product,
                country_code: country_code,
                country_name: country_name,
            },
            success: function (response) {
                if (response.success) {
                    if (response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                        $(".form-thank-you").show();
                        $(".retail-inquiry__contact-form input").val("");
                        $(".retail-inquiry__contact-form select").val("");
                    }
                } else {
                    alert(response.message || "Something went wrong");
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("Error submitting form");
            },
        });
    });
});
