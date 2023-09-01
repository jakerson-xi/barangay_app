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
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
// Example starter JavaScript for disabling form submissions if there are invalid fields

function isCheck() {
    var checkbox = document.getElementById("agree").checked;
    if (checkbox) {
        document.getElementById("btn").disabled = false;
    } else {
        document.getElementById("btn").disabled = true;
    }
}
var select = document.getElementById("applicationType");
select.addEventListener("change", showDiv);

function showDiv() {
    var value = this.value;
    var div = document.getElementById("upload_id");
    if (value === "Renew") {
        div.style.display = "block";
        document.getElementById("formFile").required = true;
    } else {
        div.style.display = "none";
        document.getElementById("formFile").required = false;
    }
}

function preview() {
    frame.src = URL.createObjectURL(event.target.files[0]);
    frame.width = "400";
    frame.height = "200";
}



function resizeTextarea() {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
}







