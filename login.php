<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <?php include 'components/navbar.php'; ?>

    <main>
        <div class="container mt-3 pt-5">
            <form class="row needs-validation" action="logic/loginlogic.php" method="post" novalidate>
                <div class="col-12 col-sm-7 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">

                            <?php 
                            $error = isset($_SESSION['error']) ? $_SESSION['error'] : '';

                            // Clear the error message from the session
                            unset($_SESSION['error']);


                            $success = isset($_SESSION['success']) ? $_SESSION['success'] : false; 
                            if ($success) {
                                echo '<div class="alert alert-success">Registration successful! You can now login.</div>';
                                // clear the success message from the session
                                unset($_SESSION['success']);
                            }
                            ?>
                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>

                            <!-- Error Message -->
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Submit Button -->
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
