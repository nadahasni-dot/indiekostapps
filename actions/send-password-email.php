<?php 
include 'koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';

require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';

 

if(isset($_POST["reset_pass"])){

    $emailTo = mysqli_real_escape_string($conn, $_POST["email_reset"]); //email kamu atau email penerima link reset
    $code = uniqid(true); //Untuk kode atau parameter acak

    session_start();
    $_SESSION["code"] = "$code";

    $query = mysqli_query($conn, "INSERT INTO lupa_password VALUES ('','$emailTo','$code')");

    if(!$query){ exit("Error");}

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    try {

        //Server settings

        $mail->SMTPDebug = 0;                                 // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP

        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers

        $mail->SMTPAuth = true;                               // Enable SMTP authentication

        $mail->Username = "indiekostteknotirta@gmail.com";     // SMTP username

        $mail->Password = 'indieforever';                         // SMTP password

        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients

        $mail->setFrom("indiekostteknotirta@gmail.com", "Tekno Tirta"); //email pengirim

        $mail->addAddress($emailTo); // Email penerima

        $mail->addReplyTo("no-reply@gmail.com");

        //Content

        $url = "http://" . $_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"]). "/reset.php?reset_pass=$code"; //sesuaikan berdasarkan link server dan nama file

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "Link reset password";

        $mail->Body    = "
        <!DOCTYPE html>
        <head>
        <style>
            a {
                margin: auto;
                font-size: 20px;
                padding: 10px;
                background-color: green;
                text-decoration: none;
                color: white;
                border-radius: 5px;
            }
        </style>
        </head>
        <body>
        <div class='container'>
            <h1 class='text-center'>Permintaan reset password</h1>
            <p> Klik Link dibwah untuk mereset password</p>
            <br>
            <a class'btn btn-success' href='$url'>Reset Password</a>
        </div>
        </body>
        </html>
        " ;

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        echo "
            <script type='text/javascript'>
            window.location.href = '../pages/forgot-password-alert.php';
            </script>
        ";

    } catch (Exception $e) {

        echo 'Message could not be sent.';

        echo 'Mailer Error: ' . $mail->ErrorInfo;

    }

    exit();

}

?>