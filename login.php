<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve user details from the file (data.txt)
    $users = file('data.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($username, $userEmail, $hashedPassword) = explode('|', $user);
        if ($userEmail === $email && password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['role'] = 'admin'; // You might want to fetch the role from a database
            header("Location: index.php");
            exit;
        }
    }

    // Redirect if login fails
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Log In</title>
</head>
<body>
<main>
    <form action="login.php" method="post">
        <h1>Log In</h1>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Login</button>
        <footer>Not Registered? <a href="registration.php">Registration here</a></footer>
    </form>
</main>
</body>
</html>