<?php

$username = 'C2140';
$password = '$2y$10$PP8UnkMdRRDu3FMw3eBsHOMcgD/Giz/oaMXakyCkD5XdifSpeZVQC';

$mNetUserInfo = array(
    'empid' => $username,
    'username' => 'Roni Shikder',
    'desname' => 'Manager',
    'branchcode' => '0001',
    'branchname' => 'Corporate Head Office',
    'deptcode' => 'hodigital',
    'deptnname' => 'MTB Digital Banking Division',
    'corpemail' => 'roni.shikder@mutualtrustbank.com',
    'officephone' => '9558754545',
    'mobilephone' => '01717498794',
    'office_type' => 'CHO',
    'username_or_email' => $username,
    'password' => $password
);

if ($mNetUserInfo) {
    $url = 'http://mtb-clone.test/api/loginAPI';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($mNetUserInfo),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'cURL error: ' . curl_error($curl);
        exit;
    }

    curl_close($curl);

     $responseData = json_decode($response, true);
    print_r($responseData);
    die();

    if ($response === 'success') {
        header("Location: http://mtb-clone.test/");
        // Redirect to the URL
        exit;
    } else {
        // Handle login failure
        echo "Login failed!";
    }

    return $responseData;
    // var_dump($responseData);
} else {
    echo "User data is missing!";
}
?>
