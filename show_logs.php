<!DOCTYPE HTML>
<html>
  <head>
    <title>
      My recordings
    </title>
    <link rel='stylesheet' href='css/main.css' />
  </head>
    <body>
      <div class="trekky"></div>
      <img class="hero-type" src="img/captains-type.png" />
      <div class="recordings">
        <?php
          // Include the PHP TwilioRest library 
          include 'helper/twilio-php-library/Services/Twilio.php';
          
          // Twilio REST API version 
          $ApiVersion = "2010-04-01";
          
          // Set our AccountSid and AuthToken 
          $accountSid = $_ENV["TWILIO_ACCOUNT_SID"];
          $authToken  = $_ENV["TWILIO_AUTH_TOKEN"];

          // @start snippet
          // Instantiate a new Twilio Rest Client 
          $client = new Services_Twilio($accountSid, $authToken);
          // Display each Log 
          foreach($client->account->recordings as $recording) {
              echo "<div class='log'><i>Captains Log: {$recording->date_created}</i>";
              echo "<p><audio src=\"https://api.twilio.com/2010-04-01/Accounts/$accountSid/Recordings/{$recording->sid}.mp3\" controls preload=\"auto\" autobuffer></audio></p></div>";
              
          }
          echo ("<table>");
          // @end snippet
        ?>
      </div>
  </body>
</html>