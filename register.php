
<?php
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Create an Account';
$errors = [];
$fullName = '';
$email = '';
$phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($fullName === '') {
        $errors[] = 'Full name is required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }

    if ($password === '') {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must contain at least 8 characters.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'The passwords do not match.';
    }

    if (!$errors) {
        try {
            /*
             * This code expects a PDO connection in $pdo
             * and a users table containing:
             * full_name, email, phone, password, role.
             *
             * Adjust these column names if your existing
             * database uses different names.
             */
            $check = $pdo->prepare(
                'SELECT id FROM users WHERE email = ? LIMIT 1'
            );
            $check->execute([$email]);

            if ($check->fetch()) {
                $errors[] = 'An account with this email already exists.';
            } else {
                $hashedPassword = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                $stmt = $pdo->prepare(
                    'INSERT INTO users
                    (full_name, email, phone, password, role)
                    VALUES (?, ?, ?, ?, ?)'
                );

                $stmt->execute([
                    $fullName,
                    $email,
                    $phone,
                    $hashedPassword,
                    'citizen'
                ]);

                header('Location: login.php?registered=1');
                exit;
            }
        } catch (PDOException $e) {
            error_log('Registration error: ' . $e->getMessage());
            $errors[] = 'Registration could not be completed. Please check your details or contact support.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="auth-card">
    <div class="auth-heading">
        <div class="auth-icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>

        <h1>Create Your Account</h1>
        <p>Register to submit and track public service requests.</p>
    </div>

    <?php if ($errors): ?>
        <div class="errors" role="alert">
            <?php foreach ($errors as $error): ?>
                <p><?= e($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                value="<?= e($fullName) ?>"
                placeholder="Enter your full name"
                autocomplete="name"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= e($email) ?>"
                placeholder="you@example.com"
                autocomplete="email"
                required
            >
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input
                type="tel"
                id="phone"
                name="phone"
                value="<?= e($phone) ?>"
                placeholder="Enter your phone number"
                autocomplete="tel"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="At least 8 characters"
                autocomplete="new-password"
                minlength="8"
                required
            >
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Re-enter your password"
                autocomplete="new-password"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary auth-submit">
            <i class="fa-solid fa-user-plus"></i>
            Create Account
        </button>
    </form>

    <p class="auth-switch">
        Already have an account?
        <a href="login.php">Login here</a>
    </p>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
