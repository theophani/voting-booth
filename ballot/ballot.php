<html>
<title>BG Hackathon Voting Ballot</title>
<body>
  <form method="post" action="./">
    <input type="hidden" name="voter" value="<?php echo $voter; ?>">
    <ul>
      <li>
        <label>
          <input type="checkbox" name="projects" value="1">
          Project 1
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="projects" value="2">
          Project 2
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="projects" value="3">
          Project 3
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="projects" value="4">
          Project 4
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="projects" value="5">
          Project 5
        </label>
      </li>
    </ul>
    <input type="submit" value="Vote!">
  </form>
</body>
</html>
