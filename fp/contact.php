<?php

$first_name = '';
$last_name = '';
$email = '';
$phone = '';
$medium = '';
$comment = '';

$first_name_err = '';
$last_name_err = '';
$email_err = '';
$phone_err = '';
$medium_err = '';
$comment_err = '';

if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(empty($_POST['first_name'])) {
        $first_name_err = 'Please enter your first name';
        } else {
            $first_name = $_POST['first_name'];
        }

    if(empty($_POST['last_name'])) {
        $last_name_err = 'Please enter your last name';
        } else {
            $last_name = $_POST['last_name'];
        }

    if(empty($_POST['email'])) {
        $email_err = 'Please enter your email';
            } else {
                $email = $_POST['email'];
            }

    if(empty($_POST['phone'])) {
        $phone_err = 'Please enter your phone number';
    } elseif(array_key_exists('phone', $_POST)){
        if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['phone'])) {
            $phone_err = 'Invalid format!';
            } else {
                $phone = $_POST['phone'];
            }
    }

    if(empty($_POST['medium'])) {
        $medium_err = 'Please choose a design request';
            } else {
                $medium = $_POST['medium'];
            }

    if(empty($_POST['comment'])) {
        $comment_err = 'Please add a comment';
            } else {
                $comment = $_POST['comment'];
            }

    // function mediums($medium) {
    //     $my_return='';
    //     if(!empty($_POST['medium'])) {
    //         $my_return = implode(', ' , $_POST['medium']);
    //     }
    //     return $my_return;
    // }

    if(isset($_POST['first_name'],
    $_POST['last_name'],
    $_POST['email'],
    $_POST['phone'],
    $_POST['medium'],
    $_POST['comment'])) {

        $to = 'staciwo@gmail.com';
        $subject = 'Design request on '.date('m/d/y, h i A');
        $body = '
            First Name: '.$first_name.' '.PHP_EOL.'
            Last Name: '.$last_name.' '.PHP_EOL.'
            Email: '.$email.' '.PHP_EOL.'
            Phone: '.$phone.' '.PHP_EOL.'
            Medium: '.$medium.' '.PHP_EOL.'
            Comment: '.$comment.' '.PHP_EOL.'
       ';

        $headers = array(
            'From' => 'bethmartini@example.com'
        );

        if(!empty(
        $first_name &&
        $last_name &&
        $email &&
        $phone && 
        $medium &&
        $comment) &&
        preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['phone'])) {

            mail($to, $subject, $body, $headers);
            header('Location:thx.html');
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="Graphic Design by Beth Martini">
    <meta name="keywords" content="graphic design art beth martini chicago illinois">
    <link href="css/styles.css" type="text/css" rel="stylesheet">
    <title>Beth Martini Design Studio</title>
</head>
<body>
    <div class="container">
    <header class="solid">
    <h1><a href="template.html">Beth Martini<br>Design Studio</a></h1>
        <nav>
            <!-- <p class="mobile">TEST</p> -->
            <ul class="desk">
                <li><a href="about.html">about</a></li>
                <li><a href="gallery.html">gallery</a></li>
                <li><a href="contact.php">contact</a></li>
            </ul>
        </nav>
    </header> 
<main class="gallery">
<h2>Follow Beth Martini on <a href="https://www.instagram.com/bethmartini.designs/">Instagram</a></h2>
<div class="formsection">

<p>Use the form below to make a freelance request or inquire further.</p>
    
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="post">
        <fieldset>
            <legend>
                <b>Design Request Form</b>
            </legend>

            <label><b>First Name</b></label>
            <input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) echo htmlspecialchars($_POST['first_name']) ;?>">
            <br><span class="error"><?php echo $first_name_err; ?></span>

            <br><label><b>Last Name</b></label>
            <input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) echo htmlspecialchars($_POST['last_name']) ;?>">
            <br><span class="error"><?php echo $last_name_err; ?></span>

            <br><label><b>Email</b></label>
            <input type="email" name="email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']) ;?>">
            <br><span class="error"><?php echo $email_err; ?></span>

            <br><label><b>Phone</b></label>
            <input type="tel" name="phone" placeholder="xxx-xxx-xxxx" value="<?php if (isset($_POST['phone'])) echo htmlspecialchars($_POST['phone']); ?>">
            <br><span class="error"><?php echo $phone_err; ?></span>

            <!-- <br><label><b>Choose your design request:</b></label> -->
                <select name="medium">
                    <option value="" <?php if(isset($_POST['medium']) && is_null($_POST['medium'])) echo 'selected="unselected"';?>>Choose a request type:</option>

                    <option value="Digital" <?php if(isset($_POST['medium']) && $_POST['medium'] == "Digital") echo 'selected="selected"';?>>Digital</option>

                    <option value="Print" <?php if(isset($_POST['medium']) && $_POST['medium'] == "Print") echo 'selected="selected"';?>>Print</option>

                    <option value="Rendering" <?php if(isset($_POST['medium']) && $_POST['medium'] == "Rendering") echo 'selected="selected"';?>>Rendering</option>

                    <option value="Three-Dimensional" <?php if(isset($_POST['medium']) && $_POST['medium'] == "Three-Dimensional") echo 'selected="selected"';?>>Three-Dimensional</option>

                    <option value="Other" <?php if(isset($_POST['medium']) && $_POST['medium'] == "Other") echo 'selected="selected"';?>>Other</option>

                </select>
                <br><span class="error"><?php echo $medium_err; ?></span>

            <br><label><b>Comments</b></label>
            <textarea type="text" name="comment" value="<?php if(isset($_POST['comment'])) echo htmlspecialchars($_POST['comment']) ;?>"></textarea>
            <br><span class="error"><?php echo $comment_err; ?></span>

            <br><input type="submit" value="Send it">

                <p><a href="">Reset</a></p>
                
        </fieldset>
    </form>
</div>
</main>
    
</div>
< <footer>
        <p><li><a href="../index.html">web design by eric staciwo</a></li></p>
        <p><ul>
            <li>copyright &copy; 2023</li>
            <li>all rights reserved</li>
        </ul>
        </p>
        <p>
        <ul>
            <li><a id="html-checker" href="#">HTML validation</a></li>
            <li><a id="css-checker" href="#">CSS validation</a></li>
        </ul>
        </p>
        
        <script>
                document.getElementById("html-checker").setAttribute("href","https://validator.w3.org/nu/?doc=" + location.href);
                document.getElementById("css-checker").setAttribute("href","https://jigsaw.w3.org/css-validator/validator?uri=" + location.href);
        </script>
</footer>
</body>
</html>    