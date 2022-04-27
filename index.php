<?php

    require "PHPMailer/Exception.php";
    require "PHPMailer/PHPMailer.php";
    require "PHPMailer/SMTP.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    $msg = "";

    if(isset($_POST["send"])){

        try{
            

            //Emailező szerver beállításai
            $mail->isSMTP();                                       
            $mail->Host = "smtp.gmail.com";                         
            $mail->SMTPAuth = true;                                
            $mail->Username = "emailem@gmail.com";              
            $mail->Password = "jelszavam";                        
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     
            $mail->Port = 587;                                     
            $mail->CharSet = "UTF-8";                              


            //Email adatainak beállítása
            $mail->setFrom($_POST["senderAddress"], $_POST["senderName"]);      
            $mail->addAddress("emailem@gmail.com");                              
                                 
         
                         


            //Email tartalmi beállításai
            $mail->isHTML(true);                           
            $mail->Subject = $_POST["senderAddress"];            
            $mail->Body = nl2br($_POST["message"]);         

            $mail->send();                                  
            $msg = "Levél sikeresen elküldve!";

        }
        catch(Exception $e){

            $msg = "Levél küldése sikertelen: ".$mail->ErrorInfo;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<title>PHP Email</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">

            <form action="" enctype="multipart/form-data" method="post" class="bg-dark text-light p-5 text-center w-50">

                <h2 class="mb-3">PHP - Email küldés</h2>

                <span class="mb-3"><?php if(!empty($msg)){echo $msg;}  ?></span>

                <label for="">Feladó neve:</label>
                <input type="text" name="senderName" class="form-control my-2">

                <label for="">Feladó e-mail címe:</label>
                <input type="text" name="senderAddress" class="form-control my-2">

                <label for="">Üzenet:</label>
                <textarea name="message"  cols="50" rows="10" class="form-control my-2"></textarea>

                <button class="btn btn-primary" type="submit" name="send">Küldés</button>

            </form>

        </div>
    </div>
</body>
</html>