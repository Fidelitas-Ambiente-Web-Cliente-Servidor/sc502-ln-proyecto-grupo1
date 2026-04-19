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

            try {
                data = JSON.parse(data);
            } catch (e) {
                alert("Error del servidor");
                return;
            }

            if (data.response === "00") {

                if (data.rol === "admin") {
                    window.location = "admin.php";
                } else {
                    window.location = "index.php";
                }

            } else {
                alert(data.message);
            }

        });

    });

});