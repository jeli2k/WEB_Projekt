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
          <a href="login.php">
            <button class="btn btn-light ms-3" type="submit" name="logout" value="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
              </svg>
            Login
            </button>
          </a>
          </li>
        <?php endif; ?>

        <!-- If user is logged in -->
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
          <!-- Reservations Dropdown -->
          <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" id="reservationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                          // TODO: swap href to different confirmation or make confirmation.php interactive (confirmation shows info of the clicked reservation)
                          echo '<li><a a href="confirmation.php"  class="dropdown-item">' . $bookingDetails['selectedRoom'] . '</a></li>'; 
                        }
                    }
                }
                ?>
              </ul>
          </div>
          <!-- Profile Link -->
          <li class="nav-item">
          <a href="profile.php" method="POST">
            <button class="btn btn-light ms-3" type="submit" name="profile">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z"/>
              </svg>
              Profile
            </button>
          </a>
          </li>
          <!-- Logout -->
          <li class="nav-item">
            <form action="logic/logout.php" method="POST">
            <button class="btn btn-light ms-3" type="submit" name="logout" value="true">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
              </svg>
              Logout
            </button>
            </form>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
