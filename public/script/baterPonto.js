const baterPonto = pin => {

    if(!document.querySelector('.pontoBatido')){
        if(confirm("Dejesa bater o ponto?")){
            const PIN = prompt('Informe seu pin')
    
            if(pin == PIN){
                let timeNow = `${$('#year').text()}-${$('#month').val()}-${$('#day').text()} ${$('#hour').text()}:${$('#minute').text()}:${$('#second').text()}`
                console.log(timeNow)
                location.href = `/registrarPonto/Entrada?timeNow=${timeNow}`
            }else{
                alert("PIN incorreto")
            }
        }
    }else{
        if(confirm("Dejesa Registrar a saida?")){
            const PIN = prompt('Informe seu pin')
    
            if(pin == PIN){
                let timeNow = `${$('#year').text()}-${$('#month').val()}-${$('#day').text()} ${$('#hour').text()}:${$('#minute').text()}:${$('#second').text()}`
                console.log(timeNow)
                location.href = `/registrarPonto/Saida?timeNow=${timeNow}`
            }else{
                alert("PIN incorreto")
            }
        }
    }

    
}