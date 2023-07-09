<html>

<head>
    <link rel="stylesheet" type="text/css" href="stylenav.css">
    <title>Create New Team</title>
    <link rel="icon" href="logo.jpg" type="image/x-icon">

</head>

<body>
    <header>
        <?php include('header.php');
        include('db.php');
        $pdo = db_connect(); ?>
    </header>
    <main>
        <nav>
            <?php include('mainnavigation.php'); ?>
        </nav>
        <div class="content">
            <h1>Create New Team</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label>Team Name:</label>
                <input type="text" id="name" name="name"class="input" required>
                <br>
                <label>Skill Level (1-5):</label>
                <input type="number" id="skill_level" name="skill_level"class="input" min="1" max="5" required>
                <br>
                <label>Game Day:</label>
                <input type="date" id="game_day" name="game_day"class="input" required>
                <br>
                <input type="submit" value="Create Team" Name="create" class="metaphoric-button">
            </form>
            <p><a href="dashbord.php">Back to Dashboard</a></p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["create"])) {
                    $TeamName = $_POST['name'];
                    $SkillLevel = $_POST['skill_level'];
                    $GameDay = $_POST['game_day'];
                    $userid = $_SESSION['id'];
                    $sql = "INSERT INTO team (TeamName, SkillLevel, GameDay, UserID) VALUES (:teamName, :skillLevel, :gameDay, :userID)";
                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(':teamName', $TeamName, PDO::PARAM_STR);
                    $stm->bindValue(':skillLevel', $SkillLevel, PDO::PARAM_STR);
                    $stm->bindValue(':gameDay', $GameDay, PDO::PARAM_STR);
                    $stm->bindValue(':userID', $userid, PDO::PARAM_INT);
                    $stm->execute();
                    // After team creation, redirect to the dashboard
                    header("Location: dashbord.php");
                    exit();
                }
            }
            ?>
        </div>
    </main>
    <footer>
        <?php include('footer.php'); ?>
    </footer>
</body>

</html>