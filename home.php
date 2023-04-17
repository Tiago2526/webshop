<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h1> Welcome to Dodge shop </h1>
        </div>
        <div class="decent">
            <form action="products.php">
                <div class="input">
                    <div class="image">
                        <img src="./fotos/Dodge-logo.png" alt="">
                    </div>
                    <div class="email">
                        <label for="Email">Email </label>
                        <input type="text" name="user" required>
                    </div>
                    <div class="password">
                        <label for="password">Password </label>
                        <input type="password" name="password" required>
                    </div>
                </div>
                <input type="submit" name="login" >
            </form>
        </div>
    </div>
</body>
