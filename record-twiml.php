<?php  
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
?>
<Response>
    <Say>
        Record your captain's log after the beep. 
    </Say>
    <Record
        action="recording-goodbye.php"
        method="GET"
        finishOnKey="#"
        maxLength="15"
        />
    <Say>I did not hear a recording.  Goodbye.</Say>
</Response>