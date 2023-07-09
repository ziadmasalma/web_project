<html>

<head>
    <link rel="stylesheet" type="text/css" href="stylenav.css">
    <title>kickball league dashbord</title>
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
            <?php
            $sql = 'SELECT * FROM team';
            $stm = $pdo->prepare($sql);
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

            ?>
            <a href="newteam.php" class="button">Create New Team</a>



        </div>
    </main>
    <footer>
        <?php include('footer.php'); ?>
    </footer>
</body>

</html>