<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <?php include 'components/navbar.php'; ?>

    <main>   
      <div class="container mt-3 pt-5">
        <form class="row needs-validation" action="logic/registerlogic.php" method="post">
          <div class="col-12 col-sm-7 col-md-6 m-auto">
            <div class="card border-0 shadow">
              <div class="card-body">

                <?php
                
                // Retrieve form data and errors from session
                $formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
                $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];

                // Clear session data
                unset($_SESSION['form_data']);
                unset($_SESSION['errors']);

                ?>

                <!-- User Icon -->
                <svg class="mx-auto my-3 d-flex align-items-center" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">First name</label>
                    <input type="text" class="form-control <?php echo !empty($errors['firstname']) ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo isset($formData['name']) ? $formData['name'] : ''; ?>" required>
                    <?php if (!empty($errors['firstname'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['firstname']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Lastname Field -->
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last name</label>
                    <input type="text" class="form-control <?php echo !empty($errors['lastname']) ? 'is-invalid' : ''; ?>" id="lastname" name="lastname" value="<?php echo isset($formData['lastname']) ? $formData['lastname'] : ''; ?>" required>
                    <?php if (!empty($errors['firstname'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['lastname']; ?></div>
                    <?php endif; ?>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                  <label for="email" class="form-label">E-Mail Address</label>
                  <input type="email" class="form-control <?php echo !empty($errors['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo isset($formData['email']) ? $formData['email'] : ''; ?>" required>
                  <?php if (!empty($errors['email'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                  <?php endif; ?>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control <?php echo !empty($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" required>
                  <?php if (!empty($errors['password'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                  <?php endif; ?>
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-3">
                  <label for="confirmPassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control <?php echo !empty($errors['confirmPassword']) ? 'is-invalid' : ''; ?>" id="confirmPassword" name="confirmPassword" required>
                  <?php if (!empty($errors['confirmPassword'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['confirmPassword']; ?></div>
                  <?php endif; ?>
                </div>

                <!-- City Field -->
                <div class="mb-3">
                  <label for="city" class="form-label">City</label>
                  <input type="text" class="form-control <?php echo !empty($errors['city']) ? 'is-invalid' : ''; ?>" id="city" name="city" value="<?php echo isset($formData['city']) ? $formData['city'] : ''; ?>" required>
                  <?php if (!empty($errors['city'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['city']; ?></div>
                  <?php endif; ?>
                </div>

                <!-- Street Field -->
                <div class="mb-3">
                  <label for="street" class="form-label">Street</label>
                  <input type="text" class="form-control <?php echo !empty($errors['street']) ? 'is-invalid' : ''; ?>" id="street" name="street" value="<?php echo isset($formData['street']) ? $formData['street'] : ''; ?>" required>
                  <?php if (!empty($errors['street'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['street']; ?></div>
                  <?php endif; ?>
                </div>

                <!--
                <div class="mb-3">
                      <label for="state" class="form-label">State</label>
                      <select class="form-select" id="state" required>
                      <option selected disabled value="">Choose...</option>
                      <option>Austria</option>
                      <option>Germany</option>
                      <option>Switzerland</option>
                      </select>
                    </div>
                -->

                <!-- Zip Code Field -->
                <div class="mb-3">
                  <label for="zipCode" class="form-label">Zip Code</label>
                  <input type="text" class="form-control <?php echo !empty($errors['zipCode']) ? 'is-invalid' : ''; ?>" id="zipCode" name="zipCode" value="<?php echo isset($formData['zipCode']) ? $formData['zipCode'] : ''; ?>" required>
                  <?php if (!empty($errors['zipCode'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['zipCode']; ?></div>
                  <?php endif; ?>
                </div>

                <div class="mb-3">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="termsAndConditions" id="termsAndConditions" required>
                      <label class="form-check-label" for="termsAndConditions">
                          Agree to terms and conditions
                      </label>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="mb-3 text-center">
                  <button class="btn btn-primary" type="submit">Register</button>
                </div>
                <div class="text-center">
                  <a href="login.php" class="nav-link">Already have an account?</a>
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
