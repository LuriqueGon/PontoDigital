
const openMenu = () => {
    $('#filters').toggle('show')
    $('.hamb').removeClass('close')
    $('.hamb').toggleClass('open')
    $('.functions').toggleClass('openMenu')
    $('#filters').toggleClass('show')

    if(document.querySelector('#filters.show')){
        setTimeout(e => {
            $('.hamb').toggleClass('close')
        }, 1300)
    }
}