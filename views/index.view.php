<?php require 'partials/head.php'; ?>
<?php require 'partials/nav.php'; ?>
<?php require 'partials/header.php'; ?>

<main>
    <div class="container">
        <img src="assets/img/homepage.jpg" alt="Gym scene" width="720" height="300">

        <p>Streamline your gym operations with our comprehensive management tools:</p>

        <div class="card-row">
            <div class="card">
                <i class="fas fa-users icon"></i>
                <h2>Manage Trainers</h2>
                <a href="/instructors">View Trainers</a>
            </div>

            <div class="card">
                <i class="fas fa-user-plus icon"></i>
                <h2>Empower Members</h2>
                <a href="/members">View Members</a>
            </div>

            <div class="card">
                <i class="fas fa-dumbbell icon"></i>
                <h2>Optimize Equipment</h2>
                <a href="/equipment">View Equipment</a>
            </div>
        </div>

    </div>



</main>

<?php require 'partials/footer.php'; ?>