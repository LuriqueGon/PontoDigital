$(function () {
    $("#table input").keyup(function () {

        var index = $(this).parent().index();
        var nth = "#table td:nth-child(" + (index + 1).toString() + ")";
        var valor = $(this).val().toUpperCase();
        $("#table tbody tr").show();

        $(nth).each(function () {
            if ($(this).text().toUpperCase().indexOf(valor) < 0) {
                $(this).parent().hide();
            }
        });
    });

    $("#table input").blur(function () {
        $(this).val("");
    });
});
