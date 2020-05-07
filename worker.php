<pre style="word-wrap: break-word; white-space: pre-wrap;">
<?php
function github_api($token,$ACTION,$endpoint,$data){
    $headers = array('Content-type: application/json','User-Agent: '.$_SERVER['HTTP_USER_AGENT'],'Authorization: token '.$token);
    $data = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.github.com'.$endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    switch ($ACTION) {
        case "GET":
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            break;
        
        case "POST":
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;

        case "HEAD":
        case "PUT":
        case "PATCH":
        case "DELETE":
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$ACTION);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            break;

        default:
            $output="invalid action";
            curl_close($ch);
            break;
    }

    if (!$output) {
        $output = curl_exec($ch);
        curl_close($ch);
    }
    return $output;//json_decode($output,true);
}
    $invite_group = 'YOUR ORG NAME HERE';
    $invite_username = $_GET["username"];
    $invite_api = '/orgs/'.$invite_group.'/memberships/'.$invite_username;
    $execute = github_api('YOUR TOKEN HERE',"PUT", $invite_api, null);
    var_dump($execute);
    //echo "<br/>$execute<br/>";
?>
</pre>
