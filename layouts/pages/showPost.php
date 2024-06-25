<center><a class='hello' href="/?action=show"><h1>Cześć <?php echo $_SESSION['user']; ?>.</h1></a></center>
 
<?php

include_once('serchbar.php');

if(isset($_GET['authors']))
{
    echo "Przeglądasz posty". $_GET['authors'];
}


?>

<center>
<button><a href="/?action=add">Dodaj post</a></button>

<?php 

    foreach ($params as $value) {?>

<a href="/?action=showComment&id=<?php echo $value['id'] ?>">
    <div class="post">
  <h2 class="post-title"> <?php echo  $value['title'] ?></h2>
  <p class="post-content">    <?php echo  $value['description'] ?></p>
  <p class="post-date">    <?php echo  $value['Date'] ?></p>
  <div class="post-actions">
        <div>
        <?php if (!isset($_GET['authors'])) { ?>
            <button class="post-button"><a href="/index.php?action=edit&id=<?php echo $value['id'] ?>">Edytuj</a></button>
            <?php } ?>
            <button ><a href="/?action=comment&id=<?php echo ($value['id']) ?>&userid=<?php echo ($_SESSION['id']) ?>"> Skomentuj </a> </button>
   
        </div>
    </div>
</div>



   
</div>
</a>
<?php  } ?>




</center>








<form action="/?action=logout" method="post">
        <button type="submit">Wyloguj się</button>
    </form>