<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="main">
        <div id="header" style="display: flex; justify-content: space-between; align-items: center; padding: 0px;margin-top:-10px;">
            <!-- Social Media Icons -->
            <table width="100px"  style="margin-left:900px;">
                <tr>
                    <td>
                        <a href="https://www.youtube.com/@GENINFOCOMPUTEREDUCATIONCENTRE" target="_blank" margin-right:10px;>
                        <img src="images/youtube-icon.png" alt="YouTube" width="30" height="30"  />
                        </a> 
                    </td>
                    <td>
                      <a href=https://www.facebook.com/people/The-Geninfotech/100063653062101/?mibextid=ZbWKwL target="_blank">
                    <img src="images/facebook_2504903.png" alt="Facebook" width="30" height="30" />
                        </a>  
                    </td>
                    <td>
                      <a href="https://www.instagram.com/geninfotech_official/" target="_blank">
                    <img src="images/instagram_2111463.png" alt="Instagram" width="30" height="30"/>
                    </a>  
                    </td>
                </tr>
            </table>
            
                
            
        </div>

        <div id="content">
            <div id="content1">
                <div id="menu" style="margin-left:-30px;">
                    <ul class="navi">
                        <li><a href="index.php"><img src="images/arrow.png" />Home</a></li>
                        <li><a href="aboutus.php"><img src="images/arrow.png" />About Us</a></li>
                        <li><a href="courses.html"><img src="images/arrow.png" />Courses</a></li>
                        <li><a href="gallery.html"><img src="images/arrow.png" />Gallery</a></li>
                        <li><a href="contact.php"><img src="images/arrow.png" />Contact Us</a></li>
                    </ul>
                </div>
            </div>

         <div id="content2" style="width:400px;">
                <p style="font-size:16px; color:#0000FF; font-weight:bold;">Quick Enquiry</p>
                <?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Initialize an array to hold errors
    $errors = [];

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (empty($errors)) {
        // Prepare email headers
        $to = "genscomputer2013@gmail.com"; // Replace with your desired recipient email
        $subject = "New Contact Form Submission";
        
        // Create the email headers
        $headers = "From: " . "no-reply@" . $_SERVER['SERVER_NAME'] . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Compose the email body
        $email_body = "You have received a new message from your website contact form.\n\n";
        $email_body .= "Name: $name\n";
        $email_body .= "Email: $email\n\n";
        $email_body .= "Message:\n$message\n";

        // Send the email
        if (mail($to, $subject, $email_body, $headers)) {
            echo "<p style='color: green;'>Thank you! Your message has been sent successfully.</p>";
        } else {
            echo "<p style='color: red;'>There was an error sending your message. Please try again later.</p>";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
} else {
    // Display the form if not submitted
?>
    <form action="" method="POST">
        <label for="name">Your name:</label><br>
        <input name="name" type="text" id="name" size="30" required/><br>

        <label for="email">Your email:</label><br>
        <input name="email" type="email" id="email" size="30" required/><br>

        <label for="message">Your message:</label><br>
        <textarea name="message" id="message" rows="7" cols="30" required></textarea><br>

        <input type="submit" value="Send email"/>
    </form>
<?php
}
?>

            </div>



            <div id="content3" style="width:100%; max-width:400px; margin:20px auto; padding:0 20px; box-sizing:border-box; overflow:hidden; text-align:center;">
                <div id="map">
                    <img src="images/maps.jpg" alt="Map Image" style="width:100%; height:auto; border:2px solid #0000FF;"/>
                    <br>
                    <a href="https://www.google.com/maps/place/Geninfotech+Computer+Centre/">
                        Click here for the GenInfotech Computer Education Centre Route Map
                    </a>
                </div>
            </div>
        </div>

        <div id="footer" style="background-color: #333;  color: white;margin-top:-400px; ">
         
            <table width="1100px"  style="margin-left:0; color: white;">
                <tr>
                    <td style="color: white;">
                        Copyright &copy; 2014 GenInfoTech, Tanuku.<br><br>All Rights Reserved
                    </td>
                    <td>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                    </td>
                    <td>
                       &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        &nbsp;
                    </td>
                    <td>
                        <table width="100px">
                        <tr>
                        <td>
                            <a href="https://www.youtube.com/@GENINFOCOMPUTEREDUCATIONCENTRE" target="_blank" margin-right:10px;>
                            <img src="images/youtube-icon.png" alt="YouTube" width="30" height="30"  />
                            </a> 
                        </td>
                        <td>
                          <a href=https://www.facebook.com/people/The-Geninfotech/100063653062101/?mibextid=ZbWKwL target="_blank">
                        <img src="images/facebook_2504903.png" alt="Facebook" width="30" height="30" />
                            </a>  
                        </td>
                        <td>
                          <a href="https://www.instagram.com/geninfotech_official/" target="_blank">
                        <img src="images/instagram_2111463.png" alt="Instagram" width="30" height="30"/>
                        </a>  
                        </td>
                        </tr>
                        </table>
                    </td>
                </tr>
            </table>
                        
        </div>
    </div>
</body>
</html>
