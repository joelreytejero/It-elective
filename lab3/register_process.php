<?php
$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{5,20}$/";

function test_input($data)
{
    return htmlspecialchars(trim($data));
}

$firstname = test_input($_POST['fname'] ?? '');
$lastname = test_input($_POST['lname'] ?? '');
$email = test_input($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['cpassword'] ?? '';
$birthday = test_input($_POST['birthday'] ?? '');
$gender = test_input($_POST['gender'] ?? '');
$course = test_input($_POST['course'] ?? '');

if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmPassword) || empty($birthday) || empty($gender) || empty($course)) {
    $title = 'Missing required fields';
    $message = 'Please fill in all required fields.';
} elseif ($password !== $confirmPassword) {
    $title = 'Passwords do not match';
    $message = 'The passwords you entered do not match.';
} elseif (!preg_match($regex, $password)) {
    $title = 'Password requirements not met';
    $message = 'Use 5–20 characters with uppercase, lowercase, and a number.';
} else {
    $title = 'Registration submitted';
    $message = 'Full Name: ' . $firstname . ' ' . $lastname .
        '<br>Email: ' . $email .
        '<br>Birthday: ' . $birthday .
        '<br>Gender: ' . $gender .
        '<br>Course: ' . $course;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Registration Result</title>
    <style>
        .result-card {
            max-width: 640px;
            margin: 10vh auto;
            padding: 2.5rem;
            border-radius: 28px;
            text-align: center;
            color: #1d1d1f;

            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(30px) saturate(180%);
            -webkit-backdrop-filter: blur(30px) saturate(180%);

            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .result-card h1 {
            font-size: 28px;
            font-weight: 700;
            color: #007aff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .result-card p {
            font-size: 17px;
            line-height: 1.7;
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 16px;
            padding: 1.25rem;
            margin: 1.5rem 0;
        }

        .result-card .btn-ios {
            display: inline-block;
            padding: 12px 28px;
            border: none;
            border-radius: 14px;
            background: #007aff;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .result-card .btn-ios:hover {
            background: #0071e3;
        }

        .result-card .btn-ios:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="result-card">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $message; ?></p>
        <a href="register.php" class="btn-ios">Back to Register</a>
    </div>
</body>
</html>
