let otp_get;
$(document).ready(function () {
    var minm = 100000;
    var maxm = 999999;
    otp_get = Math.floor(Math.random() * (maxm - minm + 1)) + minm;
    document.getElementById("otp").value = otp_get;
});

function isCheck() {
    var checkbox = document.getElementById("agree").checked;
    if (checkbox) {
        document.getElementById("btn").disabled = false;
    } else {
        document.getElementById("btn").disabled = true;
    }
}

function checkOTP() {
    var otp = document.getElementById("otp_in").value;
    console.log(otp, otp_get);
    if (otp == otp_get) {
        document.getElementById("otp_in").setCustomValidity("");
    } else {
        document.getElementById("otp_in").setCustomValidity("Invalid field.");
        document.getElementById("otp_in").value = "";
    }
}

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

function hideMiddleName(checkbox) {
    if (checkbox.checked == true) {
        document.getElementById("middleName").value = "";
        document.getElementById("middleName").placeholder = "N/A";
        document.getElementById("middleName").readOnly = true;
    } else {
        document.getElementById("middleName").value = "";
        document.getElementById("middleName").placeholder = "Middle Name";
        document.getElementById("middleName").readOnly = false;
    }
}
function eye() {
    const type =
        document.getElementById("password").getAttribute("type") === "password"
            ? "text"
            : "password";
    document.getElementById("password").setAttribute("type", type);

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
    var passwords = document.getElementById("password").value;
    var passwords_conmfirm = document.getElementById("confirm_password").value;
    if (passwords != passwords_conmfirm) {
        document.getElementById("mismatch").style.display = "block";
        document
            .getElementById("confirm_password")
            .setCustomValidity("Invalid field.");
    } else {
        document.getElementById("mismatch").style.display = "none";
        document.getElementById("confirm_password").setCustomValidity("");
    }
}

function checkPassword() {
    var passwords = document.getElementById("password").value;
    var passwords_conmfirm = document.getElementById("confirm_password").value;
    let stregth = 0;
    if (passwords != passwords_conmfirm) {
        document.getElementById("mismatch").style.display = "block";
        document
            .getElementById("confirm_password")
            .setCustomValidity("Invalid field.");
    } else {
        document.getElementById("mismatch").style.display = "none";
        document.getElementById("confirm_password").setCustomValidity("");
    }

    if (passwords.length >= 8) {
        document.getElementById("count_check").classList.add("bi-check-circle");
        document.getElementById("count_check").classList.remove("bi-x-circle");
        document.getElementById("count").style.color = "green";
        stregth += 1;
        console.log(stregth);
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
        console.log(stregth);
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
        console.log(stregth);
    } else {
        document
            .getElementById("numbers_check")
            .classList.remove("bi-check-circle");
        document.getElementById("numbers_check").classList.add("bi-x-circle");
        document.getElementById("numbers").style.color =
            "rgba(192, 1, 1, 0.932)";
    }
    if (passwords.match(/([!,@,#,$,%,^,&,*,_,-])/)) {
        document
            .getElementById("specialChar_check")
            .classList.add("bi-check-circle");
        document
            .getElementById("specialChar_check")
            .classList.remove("bi-x-circle");
        document.getElementById("specialChar").style.color = "green";
        stregth += 1;
        console.log(stregth);
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
        document.getElementById("password").setCustomValidity("");
    }
    if (stregth != 4) {
        console.log(stregth);
        document.getElementById("progress").classList.add("bg-danger");
        document.getElementById("progress").classList.remove("bg-success");
        document.getElementById("password").setCustomValidity("Invalid field.");
    }
}

function updatenum() {
    document.getElementById("num_show").innerHTML =
        "0" + document.getElementById("number").value;
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