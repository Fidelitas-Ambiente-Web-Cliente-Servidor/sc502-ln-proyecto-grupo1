$(function () {

    $("#formLogin").on("submit", function (e) {

        e.preventDefault();

        let username = $("#username").val();
        let password = $("#password").val();

        if (username === "" || password === "") {
            alert("Debe completar todos los campos");
            return;
        }

        $.post("index.php", {
            username: username,
            password: password,
            option: "login"
        }, function (data) {

            console.log(data); 

            data = JSON.parse(data);

            if (data.response === "00") {
                window.location = "admin.php";
            } else {
                alert(data.message);
            }

        });

    });

});