<?php

include __DIR__ . DIRECTORY_SEPARATOR . 'env.php';

// Get the signature from github
@$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];

// Generate your own signature using the secret you put while making the webhook
$secret = $_ENV["GITHUB_WEBHOOK_SECRET"];
$post_data = file_get_contents('php://input');
$realSignature = 'sha1=' . hash_hmac('sha1', $post_data, $secret);

// Verify the signature matches
if ($signature == $realSignature) {

    echo "Verified";

    // Other data gihub provides
    $gitHubEvent = $_SERVER['HTTP_X_GITHUB_EVENT'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $githubDelivery = $_SERVER['HTTP_X_GITHUB_DELIVERY'];

    $payload = $_POST['payload'];
    $json = json_decode($payload);

    // $repo = $json->repository->name;

    if ($gitHubEvent == "push") {

        $name = $json->pusher->name;
        $commit = $json->head_commit->message;

        $output = "\n\n-------------------------------------------------------------------\n";
        $gitResponse = shell_exec('git pull');
        $details = "\nAuthor-> $name \nCommit -> $commit";

        $log = $output . $gitResponse . $details;
        $output = "\n\n-------------------------------------------------------------------" . date("m/d/Y:h:i") . "\n";
        $eLog = $output . $gitResponse . $details;


        // LOGGING

        // Log to the logs file
        error_log($eLog, 3, 'logs/pulls.log');
        
        // Log to discord
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $_ENV["DISCORD_DEPLOYMENT_URL"]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'content-type'   => "application/json",
            'content' => $log,
            'username' => "Hostgator Pull Bot " . time(),
        ]));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        echo $data = curl_exec($ch);
        curl_close($ch);

    } else {
        http_response_code(403);
        die("<h1>Not a Pull!</h1>\n");
    }

} else {
    http_response_code(403);
    die("<h1>Forbidden</h1>\n");
}