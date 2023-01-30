const data = () => {
    let dateToday = new Date();
    let day = dateToday.getDate();
    let month = dateToday.getMonth() + 1
    let month2 = dateToday.getMonth() + 1

    day = day >= 10 ? day : '0' + day
    month2 = month2 >= 10 ? month2 : '0' + month2

    month = month == 1 ? "Janeiro" : month
    month = month == 2 ? "Fevereiro" : month
    month = month == 3 ? "Março" : month
    month = month == 4 ? "Abril" : month
    month = month == 5 ? "Maio" : month
    month = month == 6 ? "Junho" : month
    month = month == 7 ? "Julho" : month
    month = month == 8 ? "Agosto" : month
    month = month == 9 ? "Setembro" : month
    month = month == 10 ? "Outubro" : month
    month = month == 11 ? "Novembro" : month
    month = month == 12 ? "Dezembro" : month

    let dia = dateToday.getDay()
    
    dia = dia == 0 ? "Domingo" : dia
    dia = dia == 1 ? "Segunda" : dia
    dia = dia == 2 ? "Terça" : dia
    dia = dia == 3 ? "Quarta" : dia
    dia = dia == 4 ? "Quinta" : dia
    dia = dia == 5 ? "Sexta" : dia
    dia = dia == 6 ? "Sábado" : dia

    $('.data').html(`${dia}, <span id="day">${day}</span> de ${month} de <span id="year">${dateToday.getFullYear()}</span> <input type="hidden" id="month" value="${month2}">`)

    

}
const relogio = setInterval(() => {
    let dateToday = new Date();
    let hour = dateToday.getHours()
    let minute = dateToday.getMinutes()
    let second = dateToday.getSeconds()

    hour = hour >= 10 ? hour : '0' + hour
    minute = minute >= 10 ? minute : '0' + minute
    second = second >= 10 ? second : '0' + second

    $('#hour').text(hour)
    $('#minute').text(minute)
    $('#second').text(second)

    if(document.querySelector('.pontoOff')){
        $('.pontoOff').removeClass('pontoOff')
    }
}, 1000)

data()