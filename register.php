<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="override.css" rel="stylesheet">
        <title>Register</title>
    </head>

    <body>
        <header>
           
        </header>

    <main>
        <?php
        include 'navbar.php';
        ?>
        
          
          <!-- Login Form -->
          <div class="container mt-3 pt-5">
            <form class="row">
              <div class="col-12 col-sm-7 col-md-6 m-auto">
                <div class="card border-0 shadow">
                  <div class="card-body">
    
                    <svg class="mx-auto my-3 d-flex align-items-center" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                      <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                      <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>

                    <div class="mb-3">
                      <label for="validationDefault01" class="form-label">First name</label>
                      <input type="text" class="form-control" id="validationDefault01" value="Mark" required pattern="[A-Za-z]+" title="Letters only.">
                    </div>
                    

                    <div class="mb-3">
                      <label for="validationDefault01" class="form-label">Last name</label>
                      <input type="text" class="form-control" id="validationDefault01" value="Jones" required pattern="[A-Za-z]+" title="Letters only.">
                    </div>

                    <div class="mb-3">
                      <label for="InputEmail1" class="form-label">E-Mail Address</label>
                      <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" required>
                      <div id="emailHelp" class="form-text">Your E-Mail won't be shared with anyone.</div>
                    </div>
           
                    <div class="mb-3">
                      <label for="validationDefault03" class="form-label">City</label>
                      <input type="text" class="form-control" id="validationDefault03" required>
                    </div>

                    <div class="mb-3">
                      <label for="validationDefault04" class="form-label">State</label>
                      <select class="form-select" id="validationDefault04" required>
                      <option selected disabled value="">Choose...</option>
                      <option>Austria</option>
                      <option>Germany</option>
                      <option>Switzerland</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="validationDefault05" class="form-label">Zip Code</label>
                      <input type="text" class="form-control" id="validationDefault05" required pattern="\d{4}" title="The ZIP-Code must be 4 Numbers long.">
                      <small id="zipHelp" class="form-text">Please enter a 4-digit zip code.</small>
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

          </form>
        </div>
    </main>
    <?php
      include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>