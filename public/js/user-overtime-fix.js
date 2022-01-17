$(document).ready(function () {
    $("#checkin_form").DateTimePicker({
        dateTimeFormat: "yyyy-MM-dd hh:mm",
    });
    $("#checkout_form").DateTimePicker();

    $("#checkin_date").DateTimePicker({
        dateTimeFormat: "yyyy-MM-dd",
    })

    $("#checkout").change(function () {

        var checkinDate = $("#date").val();
        var checkin_y = checkinDate.getFullYear();
        var checkin_m = checkinDate.getMonth();
        var checkin_d = checkinDate.getDate();

        var checkinTime = $("#checkin").val();
        var checkin_h = checkinTime.getHours();
        var checkin_m = checkinTime.getMinutes();

        var checkin = new Date(checkin_y, checkin_m, checkin_d, checkin_h, checkin_m);
        console.log(checkin);


        var checkout = new Date($("#checkout").val());

        var checkin_day = checkin.getDate();
        var checkin_month = checkin.getMonth();
        var checkin_year = checkin.getFullYear();

        var checkout_day = checkin.getDate();
        var checkout_month = checkin.getMonth();
        var checkout_year = checkin.getFullYear();

        var checkinStart = new Date(checkin_year, checkin_month, checkin_day, 17, 59, 0, 0);
        var checkinEnd = new Date(checkin_year, checkin_month, checkin_day, 6, 59, 0, 0);

        var checkoutStart = new Date(checkout_year, checkout_month, checkout_day, 17, 59, 0, 0);
        var checkoutEnd = new Date(checkout_year, checkout_month, checkout_day, 6, 59, 0, 0);

        if (checkinStart < checkin || checkin < checkinEnd && checkoutStart < checkout || checkout < checkoutEnd) {
            if (checkout > checkin) {
                totalHour = Math.floor((checkout - checkin) / 1000 / 60 / 60);
                totalMin = Math.floor((checkout - checkin) / 1000 / 60 % 60);

                if (totalHour >= 12) {
                    alert('Tổng thời gian làm việc OT trong 1 ngày không được quá 12 giờ!');
                    document.getElementById('checkin').value = "";
                    document.getElementById('checkout').value = "";
                } else {
                    total = totalHour + ':' + totalMin;
                    $('#totalTime').val(total);
                }
            } else {
                alert('Thời gian checkout phải lớn hơn thời gian checkin!');
                document.getElementById('checkin').value = "";
                document.getElementById('checkout').value = "";
            }
        } else {
            alert('Khung giờ làm OT từ 18:00 đến 07:00!');
            document.getElementById('checkin').value = "";
            document.getElementById('checkout').value = "";
        }
    });
});
