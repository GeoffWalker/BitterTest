<?php

function whoToTroll($con){
    $sql = 'SELECT user_id, first_name, last_name, screen_name, profile_pic FROM users WHERE user_id <> "' . $_SESSION["SESS_MEMBER_ID"] . '" AND user_id NOT IN (SELECT to_id FROM follows WHERE from_id = "' . $_SESSION["SESS_MEMBER_ID"] . '") ORDER BY RAND() LIMIT 3;';
                                    
    $users = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_array($users)){
      
        $info = $row["first_name"] . " " . $row["last_name"] . " @" . $row["screen_name"];
        $info = substr($info, 0, 25);
        echo    '<div class="bold">';
            if($row["profile_pic"] != null){
                echo '<img class="bannericons" src="images/profilepics/' . $row["profile_pic"] . '" title style>';
            }
            else{
                echo '<img class="bannericons" src="images/profilepics/default.jfif" title style>';
            }
        echo '<a href="userpage.php?user_id=' . $row["user_id"] . '">' . $info . '</a></div>';
        echo '<a href = "Follow_proc.php?user_id=' . $row["user_id"] . '"><input type="button" style = "margin: 0" name="Follow" id="button" value="Follow"/></a><hr>';
    };
}

function timePassed($tweetDate){
    date_default_timezone_set("America/Halifax");
    $now = new DateTime(); //defaults to the current timestamp
    $tweetDate = new DateTime($tweetDate);
    $interval = $tweetDate->diff($now);

    if($interval->y > 1) return $interval->format("%y years ago");
    else if ($interval->y > 0) return $interval->format("%y year ago");
    else if ($interval->m > 1) return $interval->format("%m months ago");
    else if ($interval->m > 0) return $interval->format("%m month ago");
    else if ($interval->d > 1) return $interval->format("%d days ago");
    else if ($interval->d > 0) return $interval->format("%d day ago");
    else if ($interval->h > 1) return $interval->format("%h hours ago");
    else if ($interval->h > 0) return $interval->format("%h hour ago");
    else if ($interval->i > 1) return $interval->format("%i minutes ago");
    else if ($interval->i > 0) return $interval->format("%i minute ago");
    else if ($interval->s > 1) return $interval->format("%s seconds ago");
    else if ($interval->s >= 0) return $interval->format("%s second ago");

}

function userExists($con, $userid){
    $sql = 'SELECT user_id from users WHERE screen_name = "' . $userid . '";';
    
    $username = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($username) > 0){
        return true;
    }
    else{
        return false;
    }
}

function verifyPostal($postal, $province){
    require_once('includes/Fedex/fedex-common.php');

    $newline = "<br />";
    //Please include and reference in $path_to_wsdl variable.
    $path_to_wsdl = "includes/Fedex/wsdl/CountryService/CountryService_v5.wsdl";

    ini_set("soap.wsdl_cache_enabled", "0");

    $client = new SoapClient($path_to_wsdl, array('trace' => 1)); // Refer to http://us3.php.net/manual/en/ref.soap.php for more information

    $request['WebAuthenticationDetail'] = array(
            'ParentCredential' => array(
                    'Key' => getProperty('parentkey'), 
                    'Password' => getProperty('parentpassword')
            ),
            'UserCredential' => array(
                    'Key' => getProperty('key'), 
                    'Password' => getProperty('password')
            )
    );

    $request['ClientDetail'] = array(
            'AccountNumber' => getProperty('shipaccount'), 
            'MeterNumber' => getProperty('meter')
    );
    $request['TransactionDetail'] = array('CustomerTransactionId' => ' *** Validate Postal Code Request using PHP ***');
    $request['Version'] = array(
            'ServiceId' => 'cnty', 
            'Major' => '5', 
            'Intermediate' => '0', 
            'Minor' => '1'
    );

    $request['Address'] = array(
            'PostalCode' => $postal,
            'StateOrProvinceCode' => $province,
            'CountryCode' => 'CA'
    );

    $request['CarrierCode'] = 'FDXE';


    try {
        if(setEndpoint('changeEndpoint')){
            $newLocation = $client->__setLocation(setEndpoint('endpoint'));
        }

        $response = $client -> validatePostal($request);

        $actualProv = $response->PostalDetail->StateOrProvinceCode;
        if ($response -> HighestSeverity != 'FAILURE' && $response -> HighestSeverity != 'ERROR'){  	
            if($actualProv == $province){
                return true;
            }
            else{
                return false;
            }
        }

    } catch (SoapFault $exception) {
       printFault($exception, $client);        
    }
}
?>