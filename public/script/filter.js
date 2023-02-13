function filterTable() {
    // Obtenha os valores dos filtros
    var filterSessions = {};
    var filterRoles = {};

    var sessionFilters = document.getElementsByClassName("filterSession");
    for (var i = 0; i < sessionFilters.length; i++) {
        filterSessions[sessionFilters[i].value] = sessionFilters[i].checked;
    }

    var roleFilters = document.getElementsByClassName("filterRole");
    for (var i = 0; i < roleFilters.length; i++) {
        filterRoles[roleFilters[i].value] = roleFilters[i].checked;
    }

    // Obtenha a tabela
    var table = document.getElementById("table");
    var rows = table.getElementsByTagName("tr");

    // Loop através das linhas da tabela
    for (var i = 0; i < rows.length; i++) {
        var sessionColumn = rows[i].getElementsByTagName("td")[3];
        var roleColumn = rows[i].getElementsByTagName("td")[4];

        // Verifique se os valores da coluna de sessão e cargo correspondem aos filtros
        if (sessionColumn && roleColumn) {
            if (filterSessions[sessionColumn.innerHTML] === true) {
                if (filterRoles[roleColumn.innerHTML] === true) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}

const mark = () => {
    checkItem('td.session', '.filterSession')
    checkItem('td.cargo', '.filterRole')
}

const checkItem = (item, itemClass) => {
    const functions = document.querySelectorAll(item)
    functions.forEach(value => {
        let func = document.querySelectorAll(itemClass)

        func.forEach(check => {
            console.log(check.value)
            if(check.value == value.textContent){
                check.checked = true
            }
        })
    })
}

mark()