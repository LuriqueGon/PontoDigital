const defineCargo = (select) => {
    $('#cargo').html('');

    $.ajax({
        url: "/auth/cadastrar/empregado/getCargos",
        type: 'post',
        data: {session : select.value}
    })
    .done( response =>cargosCreate(response))
}

const cargosCreate = response =>{
    response = JSON.parse(response)

    if(response.length == 0){

        CriarOption("", "-- Selecione uma Sessão --")

    }else{

        CriarOption("", "-- Selecione um Cargo --")

        response.forEach(e => {
            CriarOption(e.id, e.nome_cargo)
        });
    }
}

const CriarOption = (id, value, append = "cargo") => {
    const option = document.createElement('option');
    option.value = id
    option.textContent = value
    
    $(`#${append}`).append(option);
}