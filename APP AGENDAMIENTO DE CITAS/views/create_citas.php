<?php


session_start();
if (!isset($_SESSION['user'])) :
    header("Location: /");
    exit();
endif;
require_once './header.php'
?>



    
    <?php
    require_once './footer.html'
    ?>
</body>

</html>