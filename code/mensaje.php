<?php
    if(isset($_SESSION['mensaje']))
    {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
?>