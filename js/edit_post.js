window.onload=function() {
    var form = document.forms.namedItem("EditForm");
    form.addEventListener('submit', function (ev) {

        var request = new XMLHttpRequest();
        request.open("POST", "form_edit.php");

        request.onreadystatechange = function () {//Call a function when the state changes.
            if (request.readyState === 4 && request.status === 200) {
                document.getElementById("accountdiv").innerHTML = request.responseText;
            }
        };
        request.send(new FormData(form));
        ev.preventDefault();
    }, false)
}