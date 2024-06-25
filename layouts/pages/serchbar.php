
<form action="/?action=show" method="GET">
        <label for="search_query">Wyszukaj:</label>
        <input type="text" id="search_query" name="authors" list="dostepne_wartosci">
        <datalist id="dostepne_wartosci">
       
        <?php foreach ($params1 as $value) {?>

         
        <option value='<?php echo $value['userName']  ?>'>
         
          
       


    <?php }?>
    </datalist>
        <input type="submit" value="Szukaj">
    </form>

   


      
        
           
    