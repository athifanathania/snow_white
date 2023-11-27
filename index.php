<?php
include "koneksi.php";
session_start();

if(isset($_SESSION['role'])){
  header('Location: home.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Landing Page</title>
  <link rel="stylesheet" href="css/landing_page.css" />
</head>

<body>
  <nav>
    <img src="images/snowwhite.svg" alt="logo" />
    <a href="login_register.php" class="login">LOG IN</a>
    <a href="login_register.php" class="register">REGISTER</a>
  </nav>
  <div class="container">
    <h1>Snow White and The Seven Dwarfs</h1>
    <div class="content">
      <img src="images/img_landing_page.jpg" width="500" />
      <pre>
            	Snow White is a princess who lives in a castle with her stepmother, who is a witch. 
The witch uses an enchanted mirror to tell her who is the most beautiful woman in the kingdom. 
When the mirror answers ‘Snow White’, her stepmother has her taken into the forest to be killed. 
The huntsman charged with the task takes pity on the girl, and sets Snow White free. 
She comes across a little house where seven dwarfs live, and makes her home with them.

         On discovering her stepdaughter is still alive, the witch disguises herself as an old 
woman and makes her way into the forest. She finds Snow White and gives her a poisoned apple to 
eat. Snow White instantly falls down as if dead. The dwarfs find her, apparently dead, when they 
return from work, and place her in a glass coffin.

        The next day, a prince is riding through the forest and sees the beautiful Snow White in 
her coffin. He asks to take her back to her father’s castle. During the journey, one of the men 
carrying the coffin trips, and the piece of poisoned apple is dislodged from Snow White’s throat. 
She instantly wakes up, and she and the prince are married.
        </pre>
    </div>
  </div>
</body>

</html>