<?php
// Check if user ID and password are provided
if (isset($_POST['userId']) && isset($_POST['password'])) {
    // Get user ID and password from form data
    // $userId = $_POST['userId'];
    // $password = $_POST['password'];

//  m net data prosesing
// $mNetUserInfo = array(
//     'empid' => 'C2140',
//     'username' => 'Roni Shikder',
//     'desname' => 'Manager',
//     'branchcode' => '0001',
//     'branchname' => 'Corporate Head Office',
//     'deptcode' => 'hodigital',
//     'deptnname' => 'MTB Digital Banking Division',
//     'corpemail' => 'roni.shikder@mutualtrustbank.com',
//     'officephone' => '9558754545',
//     'mobilephone' => '01717498794',
//     'office_type' => 'CHO',
//     'username_or_email' => $userId,
//     'password' => $password
// );

    // // Prepare POST data for login request
    $postData = http_build_query(array(
        'empid' => $_POST['userId'],
        'username' => $_POST['username'],
        'desname' => $_POST['desname'],
        'branchcode' => $_POST['branchcode'],
        'branchname' => $_POST['branchname'],
        'deptcode' => $_POST['deptcode'],
        'deptnname' => $_POST['deptnname'],
        'corpemail' => $_POST['corpemail'],
        'officephone' => $_POST['officephone'],
        'mobilephone' => $_POST['mobilephone'],
        'office_type' => $_POST['office_type'],
        'username_or_email' => $_POST['userId'],
        'password' => $_POST['password']
    ));

    // Set cURL options
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://mtb-clone.test/api/loginAPI');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo 'cURL error: ' . curl_error($curl);
        exit;
    }

    // Close cURL session
    curl_close($curl);

    // Debug: Print response
    var_dump($response);
    die();
} else {
    echo "User ID and password are required!";
}
?>
