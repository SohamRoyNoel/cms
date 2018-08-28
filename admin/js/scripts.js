$(document).ready(function () {

    $('#selectAllBoxes').click(function (event) {
        if (this.checked){
            $('.checkBoxes').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            });
        }
    });

});

// function  loadusersOnLine() {
//     $.get("functions.php?onlineusers=result", function (data) {
//         $("usersonline").text(data);
//     });
// }
//
// setInterval(function () {
//     loadusersOnLine();
// }, 500); // in milisec

