$(document).ready(function () {
    $("#checkout_form").DateTimePicker();

    $("#checkin_date").DateTimePicker({
        dateTimeFormat: "yyyy-MM-dd",
    });

    $("#checkin_form").DateTimePicker();

    $("#checkout").change(function () {
        if (!$("#checkin").val()) {
            alert('Bạn hãy nhập checkin trước khi nhập checkout!');
            document.getElementById('checkout').value = "";
        }
        else {
            var checkinDate = $("#date").val();
            var checkinTime = $("#checkin").val();
            var checkin_merge = checkinDate + " " + checkinTime;
            var checkin = Date.parse(checkin_merge, 'yyyy-MM-dd HH:mm:ss');

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
                        document.getElementById('totalTime').value = "";
                    } else {
                        total = totalHour + ':' + totalMin;
                        $('#totalTime').val(total);
                    }
                } else {
                    alert('Thời gian checkout phải lớn hơn thời gian checkin!');
                    document.getElementById('checkin').value = "";
                    document.getElementById('checkout').value = "";
                    document.getElementById('totalTime').value = "";
                }
            } else {
                alert('Khung giờ làm OT từ 18:00 đến 07:00!');
                document.getElementById('checkin').value = "";
                document.getElementById('checkout').value = "";
                document.getElementById('totalTime').value = "";
            }
        }
    });

    $("#checkin").change(function () {
        var checkinDate = $("#date").val();
        var checkinTime = $("#checkin").val();
        var checkin_merge = checkinDate + " " + checkinTime;
        var checkin = Date.parse(checkin_merge, 'yyyy-MM-dd HH:mm:ss');
        $("#checkin_date").val(checkin_merge);
        var checkout = new Date($("#checkout").val());
        if (checkout === '') document.getElementById('totalTime').value = "";
        else {

            var checkinDate = $("#date").val();
            var checkinTime = $("#checkin").val();
            var checkin_merge = checkinDate + " " + checkinTime;
            var checkin = Date.parse(checkin_merge, 'yyyy-MM-dd HH:mm:ss');

            var checkin_day = checkin.getDate();
            var checkin_month = checkin.getMonth();
            var checkin_year = checkin.getFullYear();

            var checkinStart = new Date(checkin_year, checkin_month, checkin_day, 18, 00, 0, 0);
            var checkinEnd = new Date(checkin_year, checkin_month, checkin_day, 7, 00, 0, 0);

            if (checkinStart > checkin && checkin > checkinEnd) {
                alert('Khung giờ làm OT từ 18:00 đến 07:00!');
                document.getElementById('checkin').value = "";
                document.getElementById('checkout').value = "";
                document.getElementById('totalTime').value = "";
            }
        }

        if (checkout <= checkin) {
            alert('Thời gian checkout phải lớn hơn thời gian checkin!');
            document.getElementById('checkin').value = "";
            document.getElementById('checkout').value = "";
            document.getElementById('totalTime').value = "";
        }
        else {
            var checkout = new Date($("#checkout").val());

            if (checkout > checkin) {
                totalHour = Math.floor((checkout - checkin) / 1000 / 60 / 60);
                totalMin = Math.floor((checkout - checkin) / 1000 / 60 % 60);
                if (totalHour >= 12) {
                    alert('Tổng thời gian làm việc OT trong 1 ngày không được quá 12 giờ!');
                    document.getElementById('checkin').value = "";
                    document.getElementById('checkout').value = "";
                    document.getElementById('totalTime').value = "";
                } else {
                    total = totalHour + ':' + totalMin;
                    $('#totalTime').val(total);
                    $("#checkin_date").val(checkin_merge);
                }
            }
        }

    });

    $("#ot_submit").click(function () {
        $("#checkin").val();
        $("#checkout").val();
        console.log(checkin, checkout);
    });
});
