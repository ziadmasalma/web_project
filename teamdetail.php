<html>

<head>
    <link rel="stylesheet" type="text/css" href="stylenav.css">
    <title>team detail</title>
    <link rel="icon" href="logo.jpg" type="image/x-icon">


</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>
    <main>
        <nav>
            <?php include('mainnavigation.php'); ?>
        </nav>
        <div class="content">
            <?php
            include('db.php');
            $pdo = db_connect();
            $id = $_GET['id'];
            $sql = "SELECT * FROM team WHERE TeamID='$id'";
            $stm = $pdo->prepare($sql);
            $stm->execute();
            $teams = $stm->fetch();
            echo"<ul>";
            echo "<li>Team Name : " . $teams['TeamName'] . "</li><br>";
            echo "<li>Skill Level : " . $teams['SkillLevel'] . "</li><br>";
            echo "<li>Game Day : " . $teams['GameDay'] . "</li><br>";
            echo "<li>Players : </li><ul><br>";
            $sql = "SELECT Name FROM player where TeamID ='$id'";
            $stm = $pdo->prepare($sql);
            $stm->execute();
            $palyers = $stm->fetchAll();
            foreach ($palyers as $palyer) {
                echo "<li>".$palyer['Name'] . "</li><br>";
            }
            echo"</ul> </ul>";

              if ($teams['UserID'] == $_SESSION['id']) :?>
            <br>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <label>Player Name:</label> 
                <input type="text" name="playername" class="input" required>
                <br>
                <input type="submit" value="add new player" name="add" class="metaphoric-button">
            </form>

            <?php
            endif;
            if ($teams['UserID'] == $_SESSION['id']) {
                echo "<a href='editteam.php?id=" . $id . "'>edit</a>";
                echo "<br>";
                echo "<a href='deleteteam.php?id=" . $id . "'>delete</a>";
            }


            if ((isset($_POST['add']))) {
               
                    if (count($palyers) < 9) {
                        $name = $_POST['playername'];
                        $sql = "INSERT INTO player (Name, TeamID) VALUES (:name, :teamID)";
                        $stm = $pdo->prepare($sql);
                        $stm->bindValue(':name', $name);
                        $stm->bindValue(':teamID', $id);
                        $stm->execute();
                    } else {
                        echo "the team is full";
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
