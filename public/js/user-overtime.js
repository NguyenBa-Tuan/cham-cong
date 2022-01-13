document.querySelector("#checkout").addEventListener("change", myFunction);

function myFunction() {
    var checkin = $("input#checkin").val();
    var checkout = $("input#checkout").val();
    // var date=$("input#date").val();
    

    // console.log(dateNow);

    // if(date<dateNow){
    //     alert('khong the dang ky lam tang ca cho hom truoc!');
    //     document.getElementById('date').value = "";
    // }

    totalHour = NaN;
    if (checkout > checkin) {
        var timeStart = new Date("01/01/2007 " + checkin).getTime();
        var timeEnd = new Date("01/01/2007 " + checkout).getTime();

        var hourDiff = timeEnd - timeStart;

        var totalHour = Math.floor(hourDiff / 1000 / 60 / 60);
        var totalMin = hourDiff / 1000 / 60 % 60;
        var totalMinFormat = (totalMin < 10) ? '0' + totalMin : totalMin
        total = totalHour + ':' + totalMinFormat;

        if (totalHour > 12) {
            alert('thoi gian lam ot khong duoc qua 12 tieng!');
            document.getElementById('checkin').value = "";
            document.getElementById('checkout').value = "";
            $('#totalTime').val();
        } else {
            $('#totalTime').val(total);
        }
    }
    else {
        alert('gio checkout phai sau ngay gio checkin!');
        document.getElementById('checkout').value = "";
    }
}
