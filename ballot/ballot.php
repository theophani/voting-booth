<?php
  mysql_select_db($database_egatetif, $egatetif);
  $query = "SELECT * FROM hackathon_projects ORDER BY run_order";
  $projects = mysql_query($query, $egatetif) or die(mysql_error());
?>
<!doctype html>
<html>
<title>BG Hackathon Voting Ballot</title>
<meta charset="utf-8">
<meta name="viewport" content="width=450; initial-scale=0.6;">
<link rel="stylesheet" href="../style.css">
<body>
  <h1>Pick your 3 favorites!</h1>
  <h2>Projects with the most votes win :)</h2>
    <form method="post" action="./">
    <input type="hidden" name="voter" value="<?php echo $voter; ?>">
    <ul>
      <?php while ($project = mysql_fetch_assoc($projects)) { ?>
      <li class="checkbox">
        <input type="checkbox" name="projects[]" value="<?php echo $project['id']; ?>" id="project_<?php echo $project['id']; ?>">
        <label for="project_<?php echo $project['id']; ?>">
          <span class="run_order"><?php echo $project['run_order']; ?></span>
          <span class="desc"><?php echo $project['desc']; ?></span>
        </label>
      </li>
      <?php } ?>
    </ul>
    <button type="submit">Vote!</button>
  </form>
</body>
</html>
