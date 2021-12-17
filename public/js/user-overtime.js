document.querySelector("#checkout").addEventListener("change", myFunction);

function myFunction() {
    var checkin = Date.parse($("input#checkin").val());
    var checkout = Date.parse($("input#checkout").val());
    totalHour = NaN;
    if (checkout > checkin) {
        totalHour = Math.floor((checkout - checkin) / 1000 / 60 / 60);
        totalMin = Math.floor((checkout - checkin) / 1000 / 60 % 60);

        total = totalHour + ':' + totalMin;
        console.log(total);
        if (totalHour > 24) {
            alert('thoi gian lam ot khong duoc qua 24 tieng!');
            document.getElementById('checkin').value = "";
            document.getElementById('checkout').value = "";
            $('#totalTime').val();
        } else {
            $('#totalTime').val(total);
        }
    }
    else {
        alert('ngay check out phai sau ngay check in!');
        document.getElementById('checkout').value = "";
    }
}
