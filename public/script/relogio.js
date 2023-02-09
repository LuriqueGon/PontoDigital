
const relogio = setInterval(() => {
    let dateToday = new Date();
    let hour = dateToday.getHours()
    let minute = dateToday.getMinutes()
    let second = dateToday.getSeconds()

    hour = hour >= 10 ? hour : '0' + hour
    minute = minute >= 10 ? minute : '0' + minute
    second = second >= 10 ? second : '0' + second

    setTime(hour, minute, second)

    if(document.querySelector('.pontoOff')){
        $('.pontoOff').removeClass('pontoOff')
    }
}, 999)

const setTime = (hour, minute, second) => {
    $('#hour').text(hour)
    $('#minute').text(minute)
    $('#second').text(second)
}
