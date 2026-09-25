<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page-shell">
        <section class="glass-card" aria-labelledby="page-title">
            <div class="card-heading">
                <h1 id="page-title">Register</h1>
                <p>Fill in your details below.</p>
            </div>

            <form class="glass-form" action="register_process.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First name</label>
                        <input type="text" id="fname" name="fname" class="form-control" placeholder="Juan" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last name</label>
                        <input type="text" id="lname" name="lname" class="form-control" placeholder="Dela Cruz" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="you@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" class="form-control" placeholder="5–20 characters" minlength="5" maxlength="20" required>
                        <button class="password-toggle" type="button" data-target="password" aria-label="Show password">Show</button>
                    </div>
                    <small>Use uppercase, lowercase, and a number.</small>
                </div>

                <div class="form-group">
                    <label for="cpassword">Confirm password</label>
                    <div class="password-field">
                        <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Repeat your password" minlength="5" maxlength="20" required>
                        <button class="password-toggle" type="button" data-target="cpassword" aria-label="Show password">Show</button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" id="birthday" name="birthday" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select id="course" name="course" class="form-control" required>
                            <option value="" selected disabled>Select course</option>
                            <option value="Bachelor of Information Technology">BSIT</option>
                            <option value="Bachelor of Education">BSED</option>
                            <option value="Criminology">BSCRIM</option>
                            <option value="Bachelor of Computer Science">BSCS</option>
                        </select>
                    </div>
                </div>

                <fieldset class="form-group">
                    <legend>Gender</legend>
                    <div class="choice-row">
                        <label class="choice"><input type="radio" name="gender" value="Male" required><span>Male</span></label>
                        <label class="choice"><input type="radio" name="gender" value="Female"><span>Female</span></label>
                        <label class="choice"><input type="radio" name="gender" value="Other"><span>Other</span></label>
                    </div>
                </fieldset>

                <button class="btn-glass" type="submit">Create account <span aria-hidden="true">→</span></button>
            </form>
        </section>
    </main>

    <script>
        document.querySelectorAll(".password-toggle").forEach(function (button) {
            button.addEventListener("click", function () {
                var input = document.getElementById(button.dataset.target);
                var isHidden = input.type === "password";
                input.type = isHidden ? "text" : "password";
                button.textContent = isHidden ? "Hide" : "Show";
                button.setAttribute("aria-label", isHidden ? "Hide password" : "Show password");
            });
        });
    </script>
</body>
</html>
