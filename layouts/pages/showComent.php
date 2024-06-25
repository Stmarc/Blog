


        <div class="post">
      <h2 class="post-title"> <?php echo  $params['title'] ?></h2>
      <p class="post-content">    <?php echo  $params['description'] ?></p>
      <p class="post-date">    <?php echo  $params['Date'] ?></p>
      <div class="post-actions">
            
        </div>
    </div>
    
    
    
       
    </div>
 

    <?php 
    

    foreach($params1 as $value) { ?>








<div class="comment">
            <div class="comment-header">
            
                <h3 class="username"><?php echo $value['user']  ?></h3>
            </div>
            <p class="comment-text"><?php echo $value['description']  ?></p>
            <p class="comment-date"><?php echo $value['Date']  ?></p>
        </div>

    
    <?php  }?>