<?php
if (!isset($_SESSION)) {
    session_start();
}

use Database\dbconnect;

require_once('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <div class="container mt-5 mb-5">
         <div class="d-flex justify-content-center">
            <form>
                <div class="mb-3">
                    <?php echo $_SESSION['login_status'] ?>
                </div>
                <div class="mb-3">
                    <label for="login_username" class="form-label">เลขรหัสประจำตัวนักเรียน</label>
                    <input type="text" class="form-control" id="login_username" aria-describedby="login_username">
                </div>
                <div class="mb-3">
                    <label for="login_password" class="form-label">เลขรหัสบัตรประชาชน</label>
                    <input type="text" class="form-control" id="login_password" aria-describedby="login_password">
                </div>
                <button type="button" id="submitsignin" class="btn btn-primary">เข้าสู่ระบบ</button>
            </form>
        </div>
    </div>

    <script>
        $("#submitsignin").click(function() {
            var login_username = $("#login_username").val();
            var login_password = $("#login_password").val();

            $.ajax({
                type: 'POST',
                url: '/service/login.php',
                dataType: 'json',
                data: {
                    login_username,
                    login_password
                },
                success: function(data) {
                    if (data.status == "success") {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        })
                        Toast.fire({
                            icon: data.status,
                            title: data.message
                        }).then((result) => {
                            if (result.isDismissed) {
                                window.location.href = data.href;
                            }
                        })
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        })
                        Toast.fire({
                            icon: data.status,
                            title: data.message
                        }).then((result) => {
                            if (result.isDismissed) {
                                window.location.href = data.href;
                            }
                        })
                    }
                }
            })
        });
    </script>

    <?php

    ?>
</body>

</html>