<?php

define("CONFIG_WATSON_WORKSPACE_ID","c9fa227e-25e8-4889-88d1-b27992abb289");
define("CONFIG_WATSON_USERNAME","apikey");
define("CONFIG_WATSON_PASSWORD","h-kXlX0hwDg7509hjQrQ9Xf4iWHzRRh9JANp5yYtQe99");

if(empty($_ENV["VCAP_SERVICES"]))
{ 
   //local dev
   define("mysqlServer","localhost:3306"); 
   define("mysqlDB", "watson-assistant-workspace-restaurant"); 
   define("mysqlUser","root"); 
   define("mysqlPass","");
   define("mysqlPort","3306");
} 
else 
{ 
    //running in Bluemix
    $vcap_services = json_decode($_ENV["VCAP_SERVICES" ]);
    if($vcap_services->{'mysql-5.5'}){ //if "mysql" db service is bound to this application
        $db = $vcap_services->{'mysql-5.5'}[0]->credentials;
    }
    else if($vcap_services->{'cleardb'}){ //if cleardb mysql db service is bound to this application
        $db = $vcap_services->{'cleardb'}[0]->credentials;
    } 
    else { 
        echo "Error: No suitable MySQL database bound to the application. <br>";
        die();
    }
    
   define("mysqlServer", $db->hostname . ':' . $db->port); 
   define("mysqlDB", $db->name); 
   define("mysqlUser",$db->username); 
   define("mysqlPass",$db->password);
   define("mysqlPort","3306");
}
?>