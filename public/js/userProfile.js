function eye() {
    const type =
        document.getElementById("newPassword").getAttribute("type") ===
        "password"
            ? "text"
            : "password";
    document.getElementById("newPassword").setAttribute("type", type);

    // toggle the icon
    if (type == "password") {
        document.getElementById("eye").classList.add("bi-eye-fill");
        document.getElementById("eye").classList.remove("bi-eye-slash-fill");
    } else {
        document.getElementById("eye").classList.add("bi-eye-slash-fill");
        document.getElementById("eye").classList.remove("bi-eye-fill");
    }
}

function checkConfirmPassword() {
    var passwords = document.getElementById("newPassword").value;
    var passwords_conmfirm = document.getElementById("confirmPassword").value;
    if (passwords != passwords_conmfirm) {
        document.getElementById("mismatch").style.display = "block";
        document
            .getElementById("confirmPassword")
            .setCustomValidity("Invalid field.");
    } else {
        document.getElementById("mismatch").style.display = "none";
        document.getElementById("confirmPassword").setCustomValidity("");
    }
}

function checkPassword() {
    var passwords = document.getElementById("newPassword").value;
    var passwords_conmfirm = document.getElementById("confirmPassword").value;
    var stregth = 0;

    if (passwords != passwords_conmfirm) {
        document.getElementById("mismatch").style.display = "block";
        document
            .getElementById("confirmPassword")
            .setCustomValidity("Invalid field.");
    } else {
        document.getElementById("mismatch").style.display = "none";
        document.getElementById("confirmPassword").setCustomValidity("");
    }

    if (passwords.length >= 8) {
        document.getElementById("count_check").classList.add("bi-check-circle");
        document.getElementById("count_check").classList.remove("bi-x-circle");
        document.getElementById("count").style.color = "green";
        stregth += 1;
    } else {
        document
            .getElementById("count_check")
            .classList.remove("bi-check-circle");
        document.getElementById("count_check").classList.add("bi-x-circle");
        document.getElementById("count").style.color =
            " rgba(192, 1, 1, 0.932)";
    }

    if (passwords.match(/([a-z])/) && passwords.match(/([A-Z])/)) {
        document
            .getElementById("lower-upper_check")
            .classList.add("bi-check-circle");
        document
            .getElementById("lower-upper_check")
            .classList.remove("bi-x-circle");
        document.getElementById("lower-upper").style.color = "green";
        stregth += 1;
    } else {
        document
            .getElementById("lower-upper_check")
            .classList.remove("bi-check-circle");
        document
            .getElementById("lower-upper_check")
            .classList.add("bi-x-circle");
        document.getElementById("lower-upper").style.color =
            " rgba(192, 1, 1, 0.932)";
    }

    if (passwords.match(/([0-9])/)) {
        document
            .getElementById("numbers_check")
            .classList.add("bi-check-circle");
        document
            .getElementById("numbers_check")
            .classList.remove("bi-x-circle");
        document.getElementById("numbers").style.color = "green";
        stregth += 1;
        console.log("NUMBER");
    } else {
        document
            .getElementById("numbers_check")
            .classList.remove("bi-check-circle");
        document.getElementById("numbers_check").classList.add("bi-x-circle");
        document.getElementById("numbers").style.color =
            "rgba(192, 1, 1, 0.932)";
    }

    if (passwords.match(/([!,@,#,$,%,^,&,*,-,_])/)) {
        document
            .getElementById("specialChar_check")
            .classList.add("bi-check-circle");
        document
            .getElementById("specialChar_check")
            .classList.remove("bi-x-circle");
        document.getElementById("specialChar").style.color = "green";
        stregth += 1;
        console.log("SPECIAL");
    } else {
        document
            .getElementById("specialChar_check")
            .classList.remove("bi-check-circle");
        document
            .getElementById("specialChar_check")
            .classList.add("bi-x-circle");
        document.getElementById("specialChar").style.color =
            "rgba(192, 1, 1, 0.932)";
    }

    if (stregth == 4) {
        console.log(stregth);
        document.getElementById("progress").classList.add("bg-success");
        document.getElementById("progress").classList.remove("bg-danger");
        document.getElementById("newPassword").setCustomValidity("");
    }
    if (stregth != 4) {
        console.log(stregth);
        document.getElementById("progress").classList.add("bg-danger");
        document.getElementById("progress").classList.remove("bg-success");
        document
            .getElementById("newPassword")
            .setCustomValidity("Invalid field.");
    }
}
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage() {
    document.getElementById("formFile").value = null;
    frame.src = "";
}

function preview_2() {
    frame_2.src = URL.createObjectURL(event.target.files[0]);
}

function clearImage_2() {
    document.getElementById("formFile_2").value = null;
    frame_2.src = "";
}

const fileInput = document.querySelector("#formFile");

fileInput.addEventListener("change", function() {
    const file = fileInput.files[0];
    const acceptedImageTypes = ["image/jpeg", "image/png"];

    if (!acceptedImageTypes.includes(file.type)) {
        Swal.fire({
            title: "Invalid file type",
            text: "Please select an image file (JPEG, PNG).",
            icon: "error",
            confirmButtonColor: "#d33",
        });
        fileInput.value = "";
        frame.src = "";
    }
});

const fileInput2 = document.querySelector("#formFile_2");

fileInput2.addEventListener("change", function() {
    const file = fileInput2.files[0];
    const acceptedImageTypes = ["image/jpeg", "image/png"];

    if (!acceptedImageTypes.includes(file.type)) {
        Swal.fire({
            title: "Invalid file type",
            text: "Please select an image file (JPEG, PNG).",
            icon: "error",
            confirmButtonColor: "#d33",
        });
        fileInput2.value = "";
        frame_2.src = "";
    }
});
