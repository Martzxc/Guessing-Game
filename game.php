<?php

session_start();

if (!isset($_SESSION['secret_number']) || isset($_POST['reset'])) {
    $_SESSION['secret_number'] = rand(1, 5); 
    $_SESSION['attempts'] = 0; 
    $_SESSION['message'] = ''; 
}

if (isset($_POST['guess'])) {
    $guess = (int) $_POST['guess'];
    $_SESSION['attempts']++;

    
    if ($guess === $_SESSION['secret_number']) {
        $_SESSION['message'] = "Congratulations! You guessed the right number {$_SESSION['secret_number']} in {$_SESSION['attempts']} attempts!";
        $_SESSION['secret_number'] = rand(1, 5);
        $_SESSION['attempts'] = 0; 
    } elseif ($guess < $_SESSION['secret_number']) {
        $_SESSION['message'] = "Guess is too low. Please Try again!";
    } else {
        $_SESSION['message'] = "Guess is too high. Please Try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Guessing Game</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { max-width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        h1 { text-align: center; }
        .message { margin-top: 20px; padding: 10px; text-align: center; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 5px; }
        input[type="number"] { width: 100%; padding: 10px; font-size: 16px; margin-bottom: 10px; }
        button { padding: 10px; width: 100%; background-color: #007BFF; color: white; border: none; font-size: 16px; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .reset { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <h1>Guess the Number Game</h1>

    <?php if ($_SESSION['message']): ?>
        <div class="message"><?php echo $_SESSION['message']; ?></div>
    <?php endif; ?>

    <form method="POST">
        <label for="guess">Enter your guess (1 to 5):</label>
        <input type="number" id="guess" name="guess" min="1" max="5" required>
        <button type="submit">Submit Guess</button>
    </form>

    <?php if (!isset($_SESSION['message']) || $_SESSION['message'] === ''): ?>
        <p>Attempts: <?php echo $_SESSION['attempts']; ?></p>
    <?php endif; ?>

    <div class="reset">
        <form method="POST">
            <button type="submit" name="reset" style="background-color: #ff00ff;">Reset</button>
        </form>
    </div>
</div>

</body>
</html>
