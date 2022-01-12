document.querySelector("#checkout").addEventListener("change", myFunction);

function myFunction() {
    var checkin = $("input#checkin").val();
    var checkout = $("input#checkout").val();

    totalHour = NaN;
    if (checkout > checkin) {
        var timeStart = new Date("01/01/2007 " + checkin).getTime();
        var timeEnd = new Date("01/01/2007 " + checkout).getTime();

        var hourDiff = timeEnd - timeStart;

        var totalHour = Math.floor(hourDiff / 1000 / 60 / 60);
        var totalMin = hourDiff / 1000 / 60 % 60;
        total = totalHour + ':' + totalMin;

        console.log(totalMin);

        // if (totalHour > 24) {
        //     alert('thoi gian lam ot khong duoc qua 24 tieng!');
        //     document.getElementById('checkin').value = "";
        //     document.getElementById('checkout').value = "";
        //     $('#totalTime').val();
        // } else {
        //     $('#totalTime').val(total);
        // }
    }
    else {
        alert('ngay check out phai sau ngay check in!');
        document.getElementById('checkout').value = "";
    }
}
