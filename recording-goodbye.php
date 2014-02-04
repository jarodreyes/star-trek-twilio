<?php  
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
?>
<Response>
	<Say>Your captain's log has been recorded.  Here is what I heard</Say>
	<Play><?php echo $_REQUEST['RecordingUrl']; ?></Play>
	<Say>Goodbye</Say>
</Response>