<html>

<head>
    <link rel="stylesheet" type="text/css" href="stylenav.css">
    <title>edit team</title>
    <link rel="icon" href="logo.jpg" type="image/x-icon">


</head>

<body>
    <header>
        <?php
        include('header.php');
        ?>
    </header>
    <main>
        <nav>
            <?php include('mainnavigation.php'); ?>
        </nav>
        <div class="content">
            <?php
            include('db.php');
            $pdo = db_connect();
            if (isset($_GET['id'])):
                $id = $_GET['id'];
                $sql = "SELECT * FROM team WHERE TeamID = :teamID";
                $stm = $pdo->prepare($sql);
                $stm->bindValue(':teamID', $id, PDO::PARAM_INT);
                $stm->execute();
                $teams = $stm->fetch();
                $teamname = $teams['TeamName'];
                $level = $teams['SkillLevel'];
                $day = $teams['GameDay'];
                ?>

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label>Team Name:</label>
                    <input type="text" id="name" name="name" class="input" value="<?php echo "$teamname" ?>" required>
                    <br>
                    <label>Skill Level (1-5):</label>
                    <input type="number" id="skill_level" name="skill_level" class="input" min="1" max="5"
                        value="<?php echo "$level" ?>" required>
                    <br>
                    <label>Game Day:</label>
                    <input type="date" id="game_day" name="game_day" class="input" value="<?php echo "$day" ?>" required>
                    <br>
                    <input type="submit" value="edit Team" Name="edit" class="metaphoric-button">
                </form>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (isset($_POST['edit'])) {
                        $teamname = $_POST['name'];
                        $level = $_POST['skill_level'];
                        $day = $_POST['game_day'];
                        $sql = "UPDATE team SET TeamName = :teamname, SkillLevel = :level, GameDay = :day WHERE TeamID = :teamID";
                        $stm = $pdo->prepare($sql);
                        $stm->bindValue(':teamname', $teamname, PDO::PARAM_STR);
                        $stm->bindValue(':level', $level, PDO::PARAM_STR);
                        $stm->bindValue(':day', $day, PDO::PARAM_STR);
                        $stm->bindValue(':teamID', $id, PDO::PARAM_INT);
                        $stm->execute();
                        header("Location: dashbord.php");
                    }
                }
                ?>
            <?php else:
                echo "Please select a team";
                $user = $_SESSION['id'];
                $sql = "SELECT * FROM team WHERE UserID = :userID";
                $stm = $pdo->prepare($sql);
                $stm->bindValue(':userID', $user, PDO::PARAM_INT);
                $stm->execute();
                $teams = $stm->fetchAll();

                echo "<table border=1>";
                echo "<tr><th>Team Name</th><th>Skill Level</th><th>Number of Players</th><th>Game Day</th></tr>";
                foreach ($teams as $team) {
                    $ID = $team['TeamID'];
                    $sql = "SELECT * FROM player WHERE TeamID = :teamID";
                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(':teamID', $ID, PDO::PARAM_INT);
                    $stm->execute();
                    $palyer = $stm->fetchAll();
                    echo "<tr>";
                    echo "<td><a href='teamdetail.php?id=" . $ID . "'>" . $team['TeamName'] . "</a></td>";
                    echo "<td>" . $team['SkillLevel'] . "/5</td>";
                    echo "<td>" . count($palyer) . "/9</td>";
                    echo "<td>" . $team['GameDay'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            endif;
            ?>

        </div>
    </main>
    <footer>
        <?php include('footer.php'); ?>
    </footer>
</body>

</html>