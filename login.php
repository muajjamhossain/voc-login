<?php
// Check if user ID and password are provided
if (isset($_POST['emp_id']) && isset($_POST['password'])) {

    $postData = http_build_query(array(
        'emp_id' => $_POST['emp_id'],
        'username' => $_POST['username'],
        'desname' => $_POST['desname'],
        'branchcode' => $_POST['branchcode'],
        'branchname' => $_POST['branchname'],
        'deptcode' => $_POST['deptcode'],
        'deptname' => $_POST['deptname'],
        'corp_email' => $_POST['corp_email'],
        'officephone' => $_POST['officephone'],
        'mobilephone' => $_POST['mobilephone'],
        'office_type' => $_POST['office_type'],
        'username_or_email' => $_POST['emp_id'],
        'password' => $_POST['password']

    ));

    // Set cURL options
   
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'http://mtb-clone.test/api/loginAPI');
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'cURL error: ' . curl_error($curl);
        exit;
    }

    curl_close($curl);

    var_dump($response);
    die();
} else {
    echo "User ID and password are required!";
}
?>
