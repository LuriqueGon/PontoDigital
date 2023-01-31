const data = () => {
    let dateToday = new Date();
    let day = dateToday.getDate();
    let monthName = dateToday.getMonth()
    let monthValue = dateToday.getMonth() + 1

    day = day >= 10 ? day : '0' + day
    monthValue = monthValue >= 10 ? monthValue : '0' + monthValue

    monthName = monthName == 0 ? "Janeiro" : monthName
    monthName = monthName == 1 ? "Fevereiro" : monthName
    monthName = monthName == 2 ? "Março" : monthName
    monthName = monthName == 3 ? "Abril" : monthName
    monthName = monthName == 4 ? "Maio" : monthName
    monthName = monthName == 5 ? "Junho" : monthName
    monthName = monthName == 6 ? "Julho" : monthName
    monthName = monthName == 7 ? "Agosto" : monthName
    monthName = monthName == 8 ? "Setembro" : monthName
    monthName = monthName == 9 ? "Outubro" : monthName
    monthName = monthName == 10 ? "Novembro" : monthName
    monthName = monthName == 11 ? "Dezembro" : monthName

    let dia = dateToday.getDay()
    
    dia = dia == 0 ? "Domingo" : dia
    dia = dia == 1 ? "Segunda" : dia
    dia = dia == 2 ? "Terça" : dia
    dia = dia == 3 ? "Quarta" : dia
    dia = dia == 4 ? "Quinta" : dia
    dia = dia == 5 ? "Sexta" : dia
    dia = dia == 6 ? "Sábado" : dia

    $('.data').html(`${dia}, <span id="day">${day}</span> de ${monthName} de <span id="year">${dateToday.getFullYear()}</span> <input type="hidden" id="month" value="${monthValue}">`)
}

data()
