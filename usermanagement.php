<?php
require_once("data/dbaccess.php");
require_once("data/dbfunctions.php");

function findAllNonAdmin() {
    global $db;

    $sql = "SELECT * FROM userdata WHERE is_admin = 0";
    $result = $db->query($sql);

    $users = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    return $users;
}

$users = findAllNonAdmin();
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <?php include 'includes/head.php'; ?>
    <link href="override.css" rel="stylesheet">
    <title>User Management</title>
    <?php
        // Check if the user is not logged in
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header("Location: login.php");
            exit();
        }
    ?>
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <?php include 'components/navbar.php'; ?>

    <main>   
        <div class="container mt-5">
            <h1 class="mb-">User Management</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th style="width:1%">ID</th>
                            <th style="width:10%">First Name</th>
                            <th style="width:10%">Last Name</th>
                            <th style="width:20%">Email</th>
                            <th styke="width:15%">Password</th>
                            <th style="width:15%">City</th>
                            <th style="width:15%">Street</th>
                            <th style="width:9%">ZIP</th>
                            <th style="width:9%">Status</th>
                            <th style="width:1%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <form action="data/updateuser.php" method="post">
                <td><?php echo $user['id']; ?>
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                </td>
                <td><input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" class="form-control"></td>
                <td><input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" class="form-control"></td>
                <td><input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control"></td>
                <td><input type="password" name="password" placeholder="New Password" class="form-control"></td>
                <td><input type="text" name="city" value="<?php echo $user['city']; ?>" class="form-control"></td>
                <td><input type="text" name="street" value="<?php echo $user['street']; ?>" class="form-control"></td>
                <td><input type="text" name="zipCode" value="<?php echo $user['zipCode']; ?>" class="form-control"></td>
                <td><input type="submit" value="Update" class="btn btn-primary"></td>
            </form>
            <form action="data/changeStatus.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <td>
                    <?php if ($user['status'] == 0): ?>
                        <input type="submit" name="changeStatus" value="Deactivate" class="btn btn-warning">
                    <?php else: ?>
                        <input type="submit" name="changeStatus" value="Activate" class="btn btn-success">
                    <?php endif; ?>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
</tbody>

                </table>
            </div>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>