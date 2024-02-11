<?php

session_start();

session_destroy();
   
   ?><script>
      alert("Sesión OF");
      window.location = "index.php";
   </script><?php

?>