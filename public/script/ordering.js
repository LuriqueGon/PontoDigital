
function sortTable(n, item) {
    var table, rows, switching
    table = document.querySelector("#table");
    switching = true;
    let type = "maior"
    console.log(item)
    
    if(item.querySelectorAll('i')[1].classList[2] == 'ordering'){

        removeAll()
        type = null

    }else if(item.querySelectorAll('i')[0].classList[2] == 'ordering'){

        removeAll()
        item.querySelectorAll('i')[1].classList.add('ordering')
        type = "maior"

    }else{

        removeAll()
        item.querySelectorAll('i')[0].classList.add('ordering')
        type = "menor"

    }

    while (switching) {
        switching = false;
        rows = table.rows;

        for (var i = 2; i < (rows.length - 1); i++) {
            var shouldSwitch = false;
            var x = rows[i].querySelectorAll("td")[n + 1];
            var y = rows[i + 1].querySelectorAll("td")[n + 1];

            if (type == 'maior') {
                if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (type == "menor"){
                if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else{
                break;
            }

        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

const removeAll = () => document.querySelectorAll('th.thMain i').forEach(item => item.classList.remove('ordering'));
