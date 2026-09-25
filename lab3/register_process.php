<?php
require_once __DIR__ . '/../includes/db.php';

$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{5,20}$/";
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$email = $_POST['email'];
$password = test_input($_POST['password']);
$confirmPassword = test_input($_POST['cpassword']);
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$course = $_POST['course'];

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmPassword) || empty($birthday) || empty($gender) || empty($course)) {
    $title = "Missing Required Fields !";
    $message = "Please fill in all the required fields.";
} else {
if ($password == $confirmPassword) {
    if (!preg_match($regex, $password)) {
        $title = "Password complexity requirements does not meet.";
        $message = "Password must contain: Only lowercase, atleast (1) number, no special character, and no white spaces.";
    } else {
        $pdo = get_db();

        $check = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $check->execute([$email]);

        if ($check->fetchColumn() > 0) {
            $title = "Email already registered !";
            $message = "This email is already in use.";
        } else {
            $title = "Registration Saved !";
            $message = "Full Name: " . htmlspecialchars($fname . ' ' . $lname) .
            "<br>Email : " . htmlspecialchars($email) .
            "<br>Birthday : " . htmlspecialchars($birthday) .
            "<br>Gender : " . htmlspecialchars($gender) .
            "<br>Course : " . htmlspecialchars($course);
        }

    }
} else {
    $title = "❎ Wrong Confirmation Password !";
    $message = "The passwords you entered do not match.";
}
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
        :root {
            color-scheme: dark;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            color: #f8fafc;
            background:
                radial-gradient(circle at 15% 15%, rgba(56, 189, 248, 0.42), transparent 32%),
                radial-gradient(circle at 85% 85%, rgba(168, 85, 247, 0.42), transparent 34%),
                linear-gradient(135deg, #0f172a, #312e81 55%, #581c87);
        }

        .result-card {
            position: relative;
            width: min(100%, 640px);
            padding: 2.75rem;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 28px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.16), rgba(255, 255, 255, 0.06));
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(28px) saturate(160%);
            -webkit-backdrop-filter: blur(28px) saturate(160%);
        }

        .result-card::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(125deg, rgba(255,255,255,.2), transparent 35%, transparent 65%, rgba(255,255,255,.08));
        }

        .result-card > * { position: relative; }

        .result-card h1 {
            margin: 0 0 1rem;
            font-size: clamp(1.8rem, 5vw, 2.6rem);
            font-weight: 750;
            letter-spacing: -0.04em;
            color: #fff;
        }

        .result-card p {
            margin: 1.5rem 0;
            padding: 1.35rem 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .result-card .btn-ios {
            display: inline-block;
            padding: .8rem 1.4rem;
            border: 1px solid rgba(255, 255, 255, .35);
            border-radius: 999px;
            background: rgba(255, 255, 255, .15);
            color: #fff;
            font-size: 1rem;
            font-weight: 650;
            text-decoration: none;
            transition: background .2s ease, transform .2s ease, box-shadow .2s ease;
        }

        .result-card .btn-ios:hover {
            background: rgba(255, 255, 255, .28);
            box-shadow: 0 8px 24px rgba(0, 0, 0, .2);
            transform: translateY(-2px);
        }

        @media (max-width: 540px) {
            body { padding: 16px; }
            .result-card { padding: 2rem 1.35rem; border-radius: 22px; }
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
