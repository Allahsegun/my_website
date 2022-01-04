<?php
    $msg ="";
    $className = "";
    if(filter_has_var(INPUT_POST,"submit")){
        // using htmlspecialchars() OR htmlentities()
        $name = htmlentities($_POST["name"]);
        $email = htmlentities($_POST["email"]);
        $message = htmlentities($_POST["message"]);
        // check required fields
    if(!empty($email) && !empty($name) && !empty($message)){        // passed
             // check email
        if(filter_var($email , FILTER_VALIDATE_EMAIL)=== false){
            // email failed
            $msg = "Please use a valid E-mail";
            $className = "failed";
        }
        else{  // email passed
          
           $msg = "Fields entered correctly";
           $className = "passed";
            //  setting variables for the email()function
            $toemail = "allahsegun@gmail.com";
            $subject = "Contact request from $name";
            $body = "<h2>Contact Request</h2>
                    <h4>Name</h4><p>$name</p>
                    <h4>Email</h4><p>$email</p>
                    <h4>Message</h4><p>$message</p>";
            $headers = "MIME-Version: 1.0 \r\n";
            $headers .= "Content-type:text/html;charset=UTF-8\r\n";
            $headers .= "From: $name <$email> \r\n";                
            
            if(mail($toemail,$subject,$body,$headers)){
                $msg = "Your E-mail Has Been Sent";
                $className = "passed";
                $name = "";
                $email = "";
                $message = "";
            }
            else{
                $msg = "Sending E-mail Failed ";
                $className = "failed";
            }
        }


        }
        else{  // failed
            $msg = "Please Enter  all fields";
            $className = "failed";
    
        }
    


    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Using PHP</title>
    <link rel = "stylesheet" href="form-contact.css">
    
</head>
<body>
    <nav>
        <div>
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>">My Website</a>
        </div>
    </nav>

        <?php if($msg != ""): ?>
    <div class = "<?php echo $className; ?>">
             <?php echo $msg ;?>
             <?php endif; ?>
    </div>
    <div class="container">
    <form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post">

            <label>Name</label>
            <input value="<?php echo isset($_POST['name'])? $name:""; ?>" placeholder="Enter Name" class="cr-fields"type="text" name="name">

            <label>Email</label>
            <input value="<?php echo isset($_POST['email'])? $email:""; ?>"  placeholder="Enter E-mail" class="cr-fields" type="text" name="email">

            <label>Message</label>
            <textarea name="message" placeholder="Message" name="message" id="" cols="30" rows="10"><?php echo isset($_POST["message"])?$message:""?></textarea>

            <button class="btn" type="submit" name="submit">SUBMIT</button>

        </form>
    </div>
</body>
</html>