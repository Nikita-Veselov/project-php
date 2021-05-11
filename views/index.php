
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shortener</title>
    <script>
        <?php include "../jquery/jquery-3.6.0.js"?>
    </script>
    <style>
        <?php include '../views/style/style.css'?>
    </style>

</head>
<body>
<div class="container">       
    <div class="header">
       <div class="title">Shortener</div> 

       <!-- ACCOUNT CONTROLL BUTTONS -->
       <div class="account-buttons">
            <form method="POST" action="">
                <input type="submit" name="user" value="<?=$button1?>" />
            </form>

            <form method="POST" action="" id="button2">
                <input type="submit" name="user" value="<?=$button2?>" />
            </form>    
        </div>
    </div>

    <div class="main">
        <!-- FORM TO INSERT URL -->
        <div class="insert-form main-form">
            <form method="POST" action="" >
                <label for="url">Insert URL for shortening:</label>
                <input type="text" name="url" value="<?=$insertedUrl?>" placeholder="Insert your URL here">
                <button type="submit" value="Short Me">Short Me</button>
            </form>   
        </div>
        
        <!-- RETURN CONVERTED URL--> 
        <div class="output-link main-form">
            <form method="POST" action="" >
                <label for="url">Take your new URL here:</label>
                <input type="url" name="url" value="<?=$outputLink?>" readonly placeholder="Empty for now">
            </form>   
        </div>

        <!-- TELL IF LINK IS NOT VALID -->
        <div class="link-validation main-form">
            <form method="POST" action="" >
                <label for="url">Your URL check:</label>
                <input type="url" name="url" value="<?=$linkValidation?>" readonly placeholder="Empty for now">
            </form>   
        </div>
    </div>
    <div class="footer">
        <div>Copyright (c) 2021</div>
    </div>
</div>
<script>
    <?php include "../scripts/test.js"?>
</script> 
</body>
</html>