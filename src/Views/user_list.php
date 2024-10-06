<?php
// Đặt tiêu đề trang
$title = "List User";

// Include header
include_once __DIR__ . "/Layouts/header.php";
?>

<div class="container">
    <button id="new-user-btn" type="button" class="btn btn-primary mt-4">New user</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Full name</th>
                <th scope="col">Gender</th>
                <th scope="col">Age</th>
                <th scope="col">Address</th>
                <th scope="col" class="text-center">Birthday</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <th scope="row"><?php echo $user['id']; ?></th>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                    <td><?php echo $user['gender'] ? 'Male' : 'Female' ?></td>
                    <td><?php echo htmlspecialchars($user['age']); ?></td>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                    <td class="text-center"><?php echo !empty($user['birthday']) ? htmlspecialchars($user['birthday']) : '-'; ?></td>
                    <td colspan="2" class="d-flex flex-row justify-content-center">
                        <div class="me-3">
                            <a href="/users/update?id=<?php echo $user['id'] ?>" id="editUserBtn" type="button" class="btn btn-secondary">Edit</a>
                        </div>
                        <button id="delete-user-btn" type="button" class="btn btn-danger" user-id="<?php echo $user['id'] ?>">Delete</button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>

    </table>
</div>

<?php
// Include footer
include __DIR__ . '/Layouts/footer.php';
?>