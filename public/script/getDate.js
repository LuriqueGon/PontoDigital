const data = () => {

    let monthName = getMonthName()
    let monthValue = getMonthValue()
    let day = getDate()
    let dia = getDay()
    let year = getYear()
    
    setDate(dia, day, monthName, year, monthValue)
}

const setDate = (dia, day, monthName, year, monthValue) => {
    $('.data').html(`${dia}, <span id="day">${day}</span> de ${monthName} de <span id="year">${year}</span> <input type="hidden" id="month" value="${monthValue}">`)
}

const getMonthName = () => {
    let dateToday = new Date();

    let month = dateToday.getMonth()
    
    month = month == 0 ? "Janeiro" : month
    month = month == 1 ? "Fevereiro" : month
    month = month == 2 ? "Março" : month
    month = month == 3 ? "Abril" : month
    month = month == 4 ? "Maio" : month
    month = month == 5 ? "Junho" : month
    month = month == 6 ? "Julho" : month
    month = month == 7 ? "Agosto" : month
    month = month == 8 ? "Setembro" : month
    month = month == 9 ? "Outubro" : month
    month = month == 10 ? "Novembro" : month
    month = month == 11 ? "Dezembro" : month

    return month
}

const getMonthValue = () => {
    let dateToday = new Date();

    let monthValue = dateToday.getMonth() + 1
    monthValue = monthValue >= 10 ? monthValue : '0' + monthValue

    return monthValue

}

const getDate = () => {
    let dateToday = new Date();

    let day = dateToday.getDate();
    day = day >= 10 ? day : '0' + day
    return day
}

const getDay = () => {
    let dateToday = new Date();

    let dia = dateToday.getDay()

    dia = dia == 0 ? "Domingo" : dia
    dia = dia == 1 ? "Segunda" : dia
    dia = dia == 2 ? "Terça" : dia
    dia = dia == 3 ? "Quarta" : dia
    dia = dia == 4 ? "Quinta" : dia
    dia = dia == 5 ? "Sexta" : dia
    dia = dia == 6 ? "Sábado" : dia

    return dia
}

const getYear = () => new Date().getFullYear()

data()
