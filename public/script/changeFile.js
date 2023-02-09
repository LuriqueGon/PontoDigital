const fileInput = document.querySelector("#perfil");
const preview = document.querySelector("#preview");

fileInput.addEventListener("change", function() {
    const file = this.files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function() {
    preview.src = reader.result;
    preview.style.display = "block";
    });

    reader.readAsDataURL(file);
});

$(document).ready(function() {
  $("#phoneInput").on("change paste keyup", function() {
    if(this.value.length > 10){
        var value = this.value.replace(/\D/g, '').substring(0, 11);
        this.value = value.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");

    }else{
        var value = this.value.replace(/\D/g, '').substring(0, 10);
        this.value = value.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3");
    }
  });
});

const reset = () => {
  console.log(1)
  document.querySelector("#preview").setAttribute('src', '/img/perfil/noPerfil.png')
}