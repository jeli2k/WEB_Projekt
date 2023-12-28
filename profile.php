<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/head.php'; ?>
    <?php include 'logic/profilelogic.php'; ?>

    <link href="override.css" rel="stylesheet">
    <title>Update Profile</title>
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <?php include 'components/navbar.php'; ?>

    <main>
        <div class="container mt-3 pt-5">
            <form class="row needs-validation" action="profile.php" method="post" novalidate>
                <div class="col-12 col-sm-7 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control <?php echo !empty($errors['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo $_SESSION['userData']['name']; ?>" required>
                                <?php if (!empty($errors['name'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['name']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Lastname Field -->
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Lastname</label>
                                <input type="text" class="form-control <?php echo !empty($errors['lastname']) ? 'is-invalid' : ''; ?>" id="lastname" name="lastname" value="<?php echo $_SESSION['userData']['lastname']; ?>" required>
                                <?php if (!empty($errors['lastname'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['lastname']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control <?php echo !empty($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo $_SESSION['userData']['email']; ?>" required>
                                <?php if (!empty($errors['email'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Old Password Field -->
                            <div class="mb-3">
                                <label for="oldPassword" class="form-label">Old Password</label>
                                <input type="password" class="form-control <?php echo !empty($errors['oldPassword']) ? 'is-invalid' : ''; ?>" id="oldPassword" name="oldPassword" placeholder="••••••••••••" required>
                                <?php if (!empty($errors['oldPassword'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['oldPassword']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- New Password Field -->
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control <?php echo !empty($errors['newPassword']) ? 'is-invalid' : ''; ?>" id="newPassword" name="newPassword" required>
                                <?php if (!empty($errors['newPassword'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['newPassword']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- City Field -->
                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control <?php echo !empty($errors['city']) ? 'is-invalid' : ''; ?>" id="city" name="city" value="<?php echo $_SESSION['userData']['city']; ?>" required>
                                <?php if (!empty($errors['city'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['city']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Street Field -->
                            <div class="mb-3">
                                <label for="street" class="form-label">Street</label>
                                <input type="text" class="form-control <?php echo !empty($errors['street']) ? 'is-invalid' : ''; ?>" id="street" name="street" value="<?php echo $_SESSION['userData']['street']; ?>" required>
                                <?php if (!empty($errors['street'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['street']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Zip Code Field -->
                            <div class="mb-3">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control <?php echo !empty($errors['zipCode']) ? 'is-invalid' : ''; ?>" id="zipCode" name="zipCode" value="<?php echo $_SESSION['userData']['zipCode']; ?>" required>
                                <?php if (!empty($errors['zipCode'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['zipCode']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Submit Button -->
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary" type="submit">Update Profile</button>
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