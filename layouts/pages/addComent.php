
<form method='post'  action='/?action=comment&id=<?php echo $_GET['id']   ?>&userid= <?php echo $_GET['userid']  ?>'>
    

        <label for="text">Opis:</label><br>
        <textarea id="text" name="text" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Dodaj koemantarz">
    </form>