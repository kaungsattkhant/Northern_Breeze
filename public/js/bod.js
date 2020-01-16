$(function () {

    for (i = new Date().getFullYear() ; i > 1900; i--) {
        $('#years').append($('<option />').val(i).html(i));
    }

    for (i = 1; i < 13; i++) {
        $('#months').append($('<option />').val(i).html(i));
    }
    updateNumberOfDays();

    $('#years, #months').change(function () {

        updateNumberOfDays();

    });

});

function updateNumberOfDays() {
    $('#days').html('');
    month = $('#months').val();
    year = $('#years').val();
    days = daysInMonth(month, year);

    for (i = 1; i < days + 1 ; i++) {
        $('#days').append($('<option />').val(i).html(i));
    }

}

function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}


$(function () {

    for (i = new Date().getFullYear() ; i > 1900; i--) {
        $('#Eyears').append($('<option />').val(i).html(i));
    }

    for (i = 1; i < 13; i++) {
        $('#Emonths').append($('<option />').val(i).html(i));
    }
    updateNumberOfDaysE();

    $('#Eyears, #Emonths').change(function () {

        updateNumberOfDaysE();

    });

});

function updateNumberOfDaysE() {
    $('#Edays').html('');
    month = $('#Emonths').val();
    year = $('#Eyears').val();
    days = daysInMonthE(month, year);

    for (i = 1; i < days + 1 ; i++) {
        $('#Edays').append($('<option />').val(i).html(i));
    }

}

function daysInMonthE(month, year) {
    return new Date(year, month, 0).getDate();
}
