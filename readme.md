
# API - Send message & Subscribe for user


## Welcome to our API
Here are a few steps to use this API :

## Consume APi :  

### Step 1 

* In your own project -> Create new folder
* Open it with your editor, Go to terminal or Git Bash , 
* Execute : 
  ```markdown 
  :point_down:
    * git init
    * composer require sk-web-app-api/skwebapp-api

* if you take a look at this folder , you find some files added..
  
                --.git
                --vendor
                    --composer
                    --sk-web-app-api
                    --autoload.php
                --composer.json
                --composer.lock


### Step 2 

Wherever you want to use this APi, into your 'file.php':

* Call : require_once './vendor/autoload.php';


* Instantiate the class "SkMailing" with its namespace :

exemple :

$instClass = new \SkMailing\SkMailing();

* Data to provide  : 

$data['askmailconfirm'] = true;
$data['firstname'] = "...";
$data['lastname'] = "...";
$data['email'] = "...";

$message_id = "...";

$mailing_id= "...";

// json or array
$response_format = 'json';//default json

### Call functions : 

* Send Mail funcion
$instClass->sendmail($data,$message_id, 'array'));

* Subcribe funcion
$instClass->subscribe_to_ml($data,$mailing_id));


### Problems? Please let us know

If you run into any problems or issues, **please** let us know so we can address and fix them right away. You can contact us by
Email : khiri@gmail.com


