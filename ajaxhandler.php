<?php
if(isset($_GET['textformat'])){
    $textformat = $_GET['textformat'];
    echo "success: " . $textformat;
} else {
    echo "something went wrong.";
}
?>
