<?php
    $connect = new PDO("mysql:host-localhost; dbname-name, charset-utf-8", 'user', 'pass');
    
// date_default_timezone_set('Europe/Riga');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d H:i:s');
    $query = $connect->query("INSERT INTO db_name.comments (username, comment, date) VALUES ('$username', '$comment', '$date')");
}
?>
<?php
    session_start();
    $conn = mysqli_connect('host', 'user', 'pass', 'db_name');

    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $check_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
    if (mysqli_num_rows($check_user) > 0 ) {
        $user = mysqli_fetch_assoc($check_user);
        
        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "about" => $user['about']
        ];
    }
?>
<!-- пхп end -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
    <link rel="icon" href="../img/groznij.ico">
    <style>
        input, textarea {
            margin: 10px 0;
            width: 150px;
            padding: 10px;
            border: unset;
            border-bottom: 2px solid #e3e3e3;
            outline: none;
        }
        button {
            padding: 10px;
            background: #e3e3e3;
            border: unset;
            cursor: pointer;
        }
    </style>
    <title>Чат Skladplay</title>
</head>
<body>
<p><button style="color: red;" type="button" id="login-btn_chat">Login SkladPlay</button></p>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="Ваше имя" value="<?php echo $_POST['login']; ?>" title="Ваше имя (будет отображаться в чате)" required>
        <textarea name="comment" cols="30" rows="5" placeholder="Сообщение" required title="Сообщение (Будет отображатся прямо в таблице)" style="font-family: Arial;"></textarea>
        <input type="submit">
    </form>





<!-- login skladplay -->
<div class="modal" id="skladmodal">
        <div class="modal_content">
            <span class="close_modall">&times;</span>
            <form action="" method="post">
                <input type="text" name="login" placeholder="Логин" minlength="2" maxlength="20" required title="Никнейм для сайта"><br>
                <input type="password" name="pass" placeholder="Пароль" minlength="3" maxlength="40" required title="Пароль"><br>
                <p style="text-align: center;"><button type="submit" class="login-btn">войти</button></p> 
            </form>
        </div>
    </div>
<!-- login skladplay -->





    <h2 id="edit_msg">Чат</h2>
    <?php
        $comments = $connect->query("SELECT * FROM register.comments ORDER BY date DESC");
        if($comments) {
            $comments = $comments->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach ($comments as $comment) {
    ?>
        <p><?="{$comment['date']} {$comment['username']} написал(-а) '{$comment['comment']}'"?></p>
    <? } ?>
</body>
<script>
    // alert("Пишите все сообщения на Английском языке!");
    var modal = document.getElementById("skladmodal");
    var btn = document.getElementById("login-btn_chat");
    var close = document.getElementsByClassName("close_modall")[0];

    btn.onclick = function () {
        modal.style.display = "block";
    }

    close.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if(event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</html>
