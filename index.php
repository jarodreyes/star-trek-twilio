<!-- Generate Capability Token and initiate outbound app -->
<!-- @start snippet -->
<?php 
include 'helper/twilio-php-library/Services/Twilio/Capability.php';
$accountSid = $_ENV["TWILIO_ACCOUNT_SID"];
$authToken  = $_ENV["TWILIO_AUTH_TOKEN"];
$token = new Services_Twilio_Capability($accountSid, $authToken);
$token->allowClientOutgoing($_ENV['CAPTAINS_LOG_SID']);
$deviceToken = $token->generateToken(); 
?>
<!-- @end snippet -->

<!DOCTYPE HTML>
<html>
  <head>
    <title>
      The Star Trek Communicator
    </title>
    <!-- @start snippet -->
    <link rel='stylesheet' href='css/main.css' />
    <link href='img/favicon.png' rel='shortcut icon'>
    <script type="text/javascript" src="//static.twilio.com/libs/twiliojs/1.1/twilio.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript">
    var connection=null;
    $(document).ready(function(){
      Twilio.Device.setup("<?php echo $deviceToken?>",{"debug":true});
      $(".record-btn").click(function() {  
        Twilio.Device.connect();
      });
      $(".hangup-btn").click(function(e) {
          connection.sendDigits("#");
          $(".hangup-btn").text('Saving...');
          setState('saving');
      });

      Twilio.Device.ready(function (device) {
        setState('ready');
      });

      Twilio.Device.offline(function (device) {
        setState('saving');
      });

      Twilio.Device.error(function (error) {
        setState('error');
        $('#status').text("Error");
      });

      Twilio.Device.connect(function (conn) {
        connection=conn;
        setState('record');
        toggleCallStatus();
      });

      Twilio.Device.disconnect(function (conn) {
        $(".hangup-btn").text('Stop');
        setState('ready');
        toggleCallStatus();
      });
      
      function toggleCallStatus(){
        $(".record-btn").toggleClass('hidden');
        $(".hangup-btn").toggleClass('hidden');
      }
      function setState(state){
        $('.indicator').removeClass('active');
        $('.indicator.'+state).addClass('active');
      }
    });
    </script>
    <!-- @end snippet -->

  </head>
  <body>
    <div class="space-bg">
      <img class="hero-type" src="img/type.png" />
      <div align="center">
        <div class="communicator">
          <span class="indicator ready active"></span>
          <span class="indicator record"></span>
          <span class="indicator saving"></span>
          <a class="record-btn btn" title="Record" href="#">Record</a>
          <a class="hangup-btn btn hidden" title="Stop" href="#">Stop</a>
        </div>
        <a class="go_recordings" href="show_logs.php">View Captain's Log</a>
      <!-- @start snippet -->
        <div id="status">
          Offline
        </div>
      <!-- @end snippet -->
      </div>
    </div>

  </body>
</html>
