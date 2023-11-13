<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <link href="override.css" rel="stylesheet">
        <title>Login</title>
    </head>

    <body>
        <header>
            
        </header>

        <?php
            include 'components/navbar.php';
        ?>

        <main>    
          <!-- Login Form -->
          <div class="container mt-5 pt-5">
          <form class="row" action="logic/validate.php" method="post" class="needs-validation">
            <div class="col-12 col-sm-9 col-md-7 m-auto">
              <div class="card border-0 shadow">
                <div class="card-body">
  
                  <svg class="mx-auto my-3 d-flex align-items-center" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                  </svg>
  
                  <!-- email validate start -->
                  <?php
                  $email_validation_class = "";
                    if (isset($_COOKIE["validemail"]) && "valid" === $_COOKIE["validemail"]) {
                        $email_validation_class = "is-valid";
                    }
                    if (isset($_COOKIE["validemail"]) && "invalid" === $_COOKIE["validemail"]) {
                        $email_validation_class = "is-invalid";
                    }

                    $email = "";
                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }
                  ?>

                  <div class="mb-3">
                   <label for="email" class="form-label">E-Mail Address</label>
                   <input id="email" class="form-control <?php echo $email_validation_class ?>" type="email" name="email" <?php echo 'value="' .$email. '"' ?> required>
                   <div id="emailHelp" class="form-text">Your E-Mail won't be shared with anyone.</div>
                   <div class="invalid-feedback"> Incorrect E-Mail </div>
                  </div>
                  <!-- email validate end -->
                  <!-- PW validate start -->
                  <?php
                  $pw_validation_class = "";
                    if (isset($_COOKIE["validpw"]) && "valid" === $_COOKIE["validpw"]) {
                        $pw_validation_class = "is-valid";
                    }
                    if (isset($_COOKIE["validpw"]) && "invalid" === $_COOKIE["validpw"]) {
                        $pw_validation_class = "is-invalid";
                    }

                    $pw = "";
                    if (isset($_COOKIE["pw"])) {
                        $pw = $_COOKIE["pw"];
                    }

                  ?>
                  <div class="mb-3">
                     <label for="InputPW" class="form-label">Password</label>
                     <input id="pw" type="password" class="form-control <?php echo $pw_validation_class ?>" name="pw" <?php echo 'value="' .$pw. '"' ?> required>
                    <div class="invalid-feedback">
                      Incorrect Password
                    </div>
                  </div>
                  
                   <!-- PW validate end -->
  
                   <!-- TODO: Remember Me -->
                   <?php
                    $rememberme = "";
                    if (isset($_COOKIE["rememberme"])) {
                        $rememberme = $_COOKIE["rememberme"];
                    }

                  ?>

                  <div class="mb-3 form-check, spaceholder">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember"checked>
                    <label class="form-check-label" for="remember-me">Remember</label>
                  </div>
  
                  <div class="text-center mt-3">
                      <button class="btn btn-primary mb-2" href="impressum.php" type="submit">Login</button>
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