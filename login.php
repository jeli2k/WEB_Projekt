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
          <form class="row">
            <div class="col-12 col-sm-9 col-md-7 m-auto">
              <div class="card border-0 shadow">
                <div class="card-body">
  
                  <svg class="mx-auto my-3 d-flex align-items-center" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                  </svg>
  
                  <div class="mb-3">
                   <label for="InputEmail1" class="form-label">E-Mail Address</label>
                   <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" required>
                   <div id="emailHelp" class="form-text">Your E-Mail won't be shared with anyone.</div>
                  </div>
          
                  <div class="mb-3">
                     <label for="InputPassword1" class="form-label">Password</label>
                     <input type="password" class="form-control" id="InputPassword1" required>
                  </div>
  
                  <div class="mb-3 form-check, spaceholder">
                    <input type="checkbox" class="form-check-input" id="Check1">
                    <label class="form-check-label" for="Check1">Remember</label>
                  </div>
  
                  <div class="text-center mt-3">
                      <button class="btn btn-primary mb-2" type="submit">Login</button>
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