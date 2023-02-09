const fileInput = document.querySelector("#perfil");
const preview = document.querySelector("#preview");

fileInput.addEventListener("change", e => {
    const file = this.files[0];
    const reader = new FileReader();

    reader.addEventListener("load", e => {
        preview.src = reader.result;
        preview.style.display = "block";
    });

    reader.readAsDataURL(file);
});

$(document).ready(e => {
    $("#phoneInput").on("change paste keyup", e => {
        if (this.value.length > 10) {
            var value = this.value.replace(/\D/g, '').substring(0, 11);
            this.value = value.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");

        } else {
            var value = this.value.replace(/\D/g, '').substring(0, 10);
            this.value = value.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
        }
    });
});

const reset = e => document.querySelector("#preview").setAttribute('src', '/img/perfil/noPerfil.png')