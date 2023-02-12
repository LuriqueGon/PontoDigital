const table = document.querySelector("#data-table");
const monthSelect = document.querySelector("#month-select");
const yearSelect = document.querySelector("#year-select");
const dayInput = document.querySelector("#day-input");

function updateTable() {
    const selectedMonth = monthSelect.value;
    const selectedYear = yearSelect.value;
    const selectedDay = dayInput.value;

    for (let i = 1; i < table.rows.length; i++) {
        let newDate = formatDate(table.rows[i].cells[0].innerHTML)
        const date = new Date(`${newDate}T00:00:00-0300`);
        
        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        const day = date.getDate();

        if (
            (selectedMonth === "" || selectedMonth == month) &&
            (selectedYear === "" || selectedYear == year) &&
            (selectedDay === "" || selectedDay == day)
        ) {
            table.rows[i].style.display = "table-row";
            table.rows[i].classList.add('show');
        } else {
            table.rows[i].style.display = "none";
            table.rows[i].classList.remove('show');
        }

    }
    
    calcularHorasTrabalhadas()
}

const formatDate = date => {
    date = date.replace('/','-').replace('/','-')
    date = date.split('-')

    return `${date[2]}-${date[1]}-${date[0]}`
}

const calcularHorasTrabalhadas = () => {
    const horas = document.querySelectorAll('tr.show td.horasTrabalhadas')
    let secTotal = 0
    horas.forEach(time => {
        time = time.textContent.split(':')
        let hora = Number(time[0])
        let minuto = Number(time[1])
        let segundo = Number(time[2])

        let allSec = minuto*60 + segundo
        allSec += hora *(60 * 60)
        secTotal += allSec
    })
    $('span.horasTotal').text(formatarTempo(secTotal))
}

function formatarTempo(sec) {
  var horas = Math.floor(sec / 3600);
  var minutos = Math.floor((sec - (horas * 3600)) / 60);
  var segundos = sec - (horas * 3600) - (minutos * 60);

  horas = (horas >= 10) ? horas : `0${horas}`
  minutos = minutos >= 10 ? minutos : `0${minutos}`
  segundos = segundos >= 10 ? segundos : `0${segundos}`

  return `${horas}:${minutos}:${segundos}`;
}


monthSelect.addEventListener("change", updateTable);
yearSelect.addEventListener("change", updateTable);
dayInput.addEventListener("input", updateTable);

