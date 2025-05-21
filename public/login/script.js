const checkCheckbox = () => {
    const checkbox = document.querySelector("input[type=checkbox]");
    return checkbox.checked ? true : false;
};

function showDiv() {
    document.getElementById("Login").style.display = "none";
    document.getElementById("loadingGif").style.display = "block";
    setTimeout(function () {
        document.getElementById("loadingGif").style.display = "none";
        document.getElementById("showme").style.display = "block";
    }, 2000);
}

function signup() {
    if (!checkCheckbox()) {
        Swal.fire({
            text: "You must agree to the Terms and Conditions HSB FOREX TRADE.",
            icon: "warning",
        });
        return;
    }

    showDiv();
}

function signin() {
    showDiv();
}
