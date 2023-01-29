const data = () => {
    let dateToday = new Date();
    let day = dateToday.getDate();
    let month = dateToday.getMonth() + 1
    let year = dateToday.getFullYear()

    day = day >= 10 ? day : '0' + day

    switch (month) {
        case 1:
            month = "Janeiro"
            break
        case 2:
            month = "Fevereiro"
            break
        case 3:
            month = "Março"
            break
        case 4:
            month = "Abril"
            break
        case 5:
            month = "Maio"
            break
        case 6:
            month = "Junho"
            break
        case 7:
            month = "Julho"
            break
        case 8:
            month = "Agosto"
            break
        case 9:
            month = "Setembro"
            break
        case 10:
            month = "Outubro"
            break
        case 11:
            month = "Novembro"
            break
        case 12:
            month = "Dezembro"
            break

    }

    let dia = dateToday.getDay()

    switch (dia) {
        case 0:
            dia = "Domingo"
            break
        case 1:
            dia = "Segunda"
            break
        case 2:
            dia = "Terça"
            break
        case 3:
            dia = "Quarta"
            break
        case 4:
            dia = "Quinta"
            break
        case 5:
            dia = "Sexta"
            break
        case 6:
            dia = "Sabado"
            break


    }

    $('.data').text(`${dia}, ${day} de ${month} de ${year}`)

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


}, 1000)

data()