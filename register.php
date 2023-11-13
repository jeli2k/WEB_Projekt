<!DOCTYPE html>
<html lang="de">
    <head>
        <?php include 'includes/head.php'; ?>
        <link href="override.css" rel="stylesheet">
        <title>Register</title>
    </head>

    <body>
        <header>
           
        </header>

        <?php include 'components/navbar.php'; ?>

        <main>   
          
          <!-- Register Form -->
          <div class="container mt-3 pt-5">
            <form class="row" action="logic/register.php" method="post" class="needs-validation">
              <div class="col-12 col-sm-7 col-md-6 m-auto">
                <div class="card border-0 shadow">
                  <div class="card-body">
    
                    <svg class="mx-auto my-3 d-flex align-items-center" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <!--FN Validation-->
                    <?php
                      $fn_validation_class = "";
                      if (isset($_COOKIE["validfn"]) && "valid" === $_COOKIE["validfn"]) {
                          $fn_validation_class = "is-valid";
                      }
                      if (isset($_COOKIE["validfn"]) && "invalid" === $_COOKIE["validfn"]) {
                          $fn_validation_class = "is-invalid";
                      }

                      $firstname = "";
                      if (isset($_COOKIE["firstname"])) {
                          $firstname = $_COOKIE["firstname"];
                      }
                    ?>

                    <div class="mb-3">  
                      <label for="firstname" class="form-label">First name</label>
                      <input type="text" class="form-control <?php echo $fn_validation_class ?>" id="firstname" name="firstname" <?php echo 'value="' .$firstname. '"' ?> required pattern="[A-Za-z]+" title="Letters only.">
                      <div class="valid-feedback"> First name is valid </div>
                      <div class="invalid-feedback"> Invalid First name </div>
                    </div>   
                    <!--LN Validation-->
                    <?php
                      $ln_validation_class = "";
                      if (isset($_COOKIE["validln"]) && "valid" === $_COOKIE["validln"]) {
                          $ln_validation_class = "is-valid";
                      }
                      if (isset($_COOKIE["validln"]) && "invalid" === $_COOKIE["validln"]) {
                          $ln_validation_class = "is-invalid";
                      }

                      $lastname = "";
                      if (isset($_COOKIE["lastname"])) {
                          $lastname = $_COOKIE["lastname"];
                      }
                    ?>

                    <div class="mb-3">
                      <label for="lastname" class="form-label">Last name</label>
                      <input type="text" class="form-control <?php echo $ln_validation_class ?>" name="lastname" id="lastname" <?php echo 'value="' .$lastname. '"' ?> required pattern="[A-Za-z]+" title="Letters only.">
                      <div class="valid-feedback"> Last name is valid </div>
                      <div class="invalid-feedback"> Invalid Last name </div>
                    </div>
                    
                    <!--EMAIL Validation-->
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
                      <input type="email" class="form-control <?php echo $email_validation_class ?>" name="email" id="email" <?php echo 'value="' .$email. '"' ?> aria-describedby="emailHelp" required>
                      <div id="emailHelp" class="form-text">Your E-Mail won't be shared with anyone.</div>
                      <div class="valid-feedback"> E-Mail is valid </div>
                      <div class="invalid-feedback"> Invalid E-Mail </div>
                    </div>
           
                    <!--CITY Validation-->
                    <?php
                      $city_validation_class = "";
                        if (isset($_COOKIE["validcity"]) && "valid" === $_COOKIE["validcity"]) {
                            $city_validation_class = "is-valid";
                        }
                        if (isset($_COOKIE["validcity"]) && "invalid" === $_COOKIE["validcity"]) {
                            $city_validation_class = "is-invalid";
                        }

                        $city = "";
                        if (isset($_COOKIE["city"])) {
                            $city = $_COOKIE["city"];
                        }
                    ?>

                    <div class="mb-3">
                      <label for="city" class="form-label">City</label>
                      <input type="text" class="form-control <?php echo $city_validation_class ?>" name="city" id="city" <?php echo 'value="' .$city. '"' ?> required>
                      <div class="valid-feedback"> City is valid </div>
                      <div class="invalid-feedback"> Invalid City </div>
                    </div>
                    
                    <!-- TODO: State Validation -->
                    <div class="mb-3">
                      <label for="state" class="form-label">State</label>
                      <select class="form-select" id="state" required>
                      <option selected disabled value="">Choose...</option>
                      <option>Austria</option>
                      <option>Germany</option>
                      <option>Switzerland</option>
                      </select>
                    </div>

                    <!--ZIP Validation-->
                    <?php
                      $zip_validation_class = "";
                        if (isset($_COOKIE["validzip"]) && "valid" === $_COOKIE["validzip"]) {
                            $zip_validation_class = "is-valid";
                        }
                        if (isset($_COOKIE["validzip"]) && "invalid" === $_COOKIE["validzip"]) {
                            $zip_validation_class = "is-invalid";
                        }

                        $zip = "";
                        if (isset($_COOKIE["zip"])) {
                            $zip = $_COOKIE["zip"];
                        }
                    ?>

                    <div class="mb-3">
                      <label for="zip" class="form-label">Zip Code</label>
                      <input type="text" class="form-control <?php echo $zip_validation_class ?>" name="zip" id="zip" <?php echo 'value="' .$zip. '"' ?> required pattern="\d{4}" title="The ZIP-Code must be 4 Numbers long.">
                      <small id="zipHelp" class="form-text">Please enter a 4-digit zip code.</small>
                      <div class="valid-feedback"> Zip is valid </div>
                      <div class="invalid-feedback"> Invalid Zip </div>
                    </div>
                    

                    <div class="mb-3">
                      <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                      <label class="form-check-label" for="invalidCheck2">
                        Agree to terms and conditions
                      </label>
                    </div>

                    </div>
                    <div class="mb-3 text-center" >
                      <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                    <div class="text-center">
                        <a href="login.php" class="nav-link">Already have an account?</a>
                    </div>
                    
                  

          </form>
        </div>
    </main>
    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
   </body>

</html>