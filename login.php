
<?php

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Login';
$error = '';
$email = '';

// Redirect already logged-in users to the central dashboard.
if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}

// Process the login form.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate submitted information.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {

        $error = 'Enter a valid email address and password.';

    } else {

        try {

            // Find the account using the submitted email.
            $stmt = $pdo->prepare(
                'SELECT * FROM users WHERE email = ? LIMIT 1'
            );

            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password.
            if (
                $user &&
                password_verify($password, $user['password'])
            ) {

                // Generate a new session ID after authentication.
                session_regenerate_id(true);

                // Store only the information needed by the application.
                $_SESSION['user'] = [
                    'id'        => $user['id'],
                    'full_name' => $user['full_name'],
                    'email'     => $user['email'],
                    'role'      => $user['role']
                ];

                // Send both citizens and administrators to the central dashboard.
                header('Location: dashboard.php');
                exit;

            } else {

                $error = 'Invalid email address or password.';

            }

        } catch (PDOException $e) {

            // Log technical details privately.
            error_log('Login error: ' . $e->getMessage());

            $error = 'Unable to log in at the moment. Please try again.';
        }
    }
}

// Display the login page.
require_once __DIR__ . '/includes/header.php';

?>

<section class="auth-card">

    <div class="auth-heading">

        <div class="auth-icon">
            <i class="fa-solid fa-right-to-bracket"></i>
        </div>

        <h1>Welcome Back</h1>

        <p>
            Login to manage and track your public service requests.
        </p>

    </div>

    <?php if (
        isset($_GET['registered']) &&
        $_GET['registered'] === '1'
    ): ?>

        <div class="success-message" role="status">
            Account created successfully. Please log in.
        </div>

    <?php endif; ?>

    <?php if ($error !== ''): ?>

        <div class="errors" role="alert">
            <?= e($error) ?>
        </div>

    <?php endif; ?>

    <form method="POST" action="login.php">

        <div class="form-group">

            <label for="email">Email Address</label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?= e($email) ?>"
                placeholder="Enter your email address"
                autocomplete="username"
                required
            >

        </div>

        <div class="form-group">

            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
            >

        </div>

        <button
            type="submit"
            class="btn btn-primary auth-submit"
        >
            <i class="fa-solid fa-right-to-bracket"></i>
            Login
        </button>

    </form>

    <p class="auth-switch">
        Don't have an account?
        <a href="register.php">Create an account</a>
    </p>

</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
