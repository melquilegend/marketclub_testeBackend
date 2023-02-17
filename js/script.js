const loginCheckbox = document.querySelector("#input_permissao_login");
const otherCheckboxes = document.querySelectorAll(".permissao input[type='checkbox']:not(#input_permissao_login)");

loginCheckbox.addEventListener("change", function () {
    if (this.checked) {
        otherCheckboxes.forEach(function (checkbox) {
            checkbox.disabled = false;
        });
    } else {
        otherCheckboxes.forEach(function (checkbox) {
            checkbox.disabled = true;
            checkbox.checked = false;
        });
    }
});