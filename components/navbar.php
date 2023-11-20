<nav class="navbar navbar-expand-lg" style="background-color: #f0f0f0;">
  <div class="container-fluid">
    <a href="home.php">
      <img src="./Content/Logo.png" alt="Logo" title="Logo" height="50" width="50" margin="5">
    </a>
    <span style="font-family: 'Arial', sans-serif; font-size: 24px; margin-left: 10px; vertical-align: middle;">Sapphire Shores Hotel</span>
    </a>


    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">

        <!-- If user is NOT logged in -->
        <?php if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false): ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php endif; ?>

        <!-- If user is logged in -->
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
          <!-- Reservations Dropdown -->
          <div class="dropdown">
          <button class="nav-link btn btn-link" type="button" id="reservationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Reservations
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="reservationsDropdown">
                    <?php
                    // Use PHP to generate reservations from the session (if any)
                    // important: before accessing $_SESSION variable/array, always introduce with this:
                    // if (isset($_SESSION['bookingDetails'])) {  $bookingDetails = $_SESSION['bookingDetails'];  }
                    if (isset($_SESSION['counter'])) {
                      for ($i = 1; $i <= $_SESSION['counter']; $i++) {
                          $bookingDetailsKey = 'bookingDetails' . $i;
          
                          if (isset($_SESSION[$bookingDetailsKey])) {
                              $bookingDetails = $_SESSION[$bookingDetailsKey];
                              echo '<li><a a href="confirmation.php"  class="dropdown-item">' . $bookingDetails['selectedRoom'] . '</a></li>';
                              // Add more details as needed
                            }
                        }
                    }
                    /*
                    if (isset($_SESSION['bookingDetails'])) {                       
                      $bookingDetails = $_SESSION['bookingDetails'];
                      echo '<li><a class="dropdown-item">' . $bookingDetails['selectedRoom'] . '</a></li>';
                      /*
                      foreach ($_SESSION['bookingDetails'] as $room) {
                        echo '<li><a class="dropdown-item">' . $room . '</a></li>';
                      }
                    
                    }
                    */
                    ?>
                  </ul>
                </div>


          <!-- Profile Link -->
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>

          
          <!-- Logout -->
          <li class="nav-item">
            <form action="logic/logout.php" method="POST">
              <button class="nav-link btn btn-link" type="submit" name="logout" value="true">Logout</button>
            </form>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
