const markAll = (ref) => {
    let mark = (ref.checked == true) ? true : false
    document.querySelectorAll('.tdCheckbox').forEach(item => item.checked = mark);
}

