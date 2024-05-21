
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

    <style>
        .loader__wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .loader__wrapper .spinner-border {
            font-size: 32px;
            width: 100px;
            height: 100px;
        }

        .loader__wrapper p {
            margin-top: 0;
            margin-bottom: 1rem;
            margin-top: 20px;
            /* margin-left: 22px; */
            font-size: 25px;
            font-weight: 700;
        }
    </style>

</head>

<body>

    <div class="loader__wrapper">
        <div>
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-danger">
                <span>Loading...</span>
            </p>
        </div>
    </div>

    <?php

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost'; // Default to 'localhost' if not set

        $hostMappings = [
            '192.168.45.22:5306' => 'http://192.168.45.22:5306/api/loginAPI',
            '124.109.105.40:5306' => 'http://124.109.105.40:5306/api/loginAPI',
            'localhost' => 'http://mtb-clone.test/api/loginAPI'
        ];

        if (isset($hostMappings[$host])) {
            $apiUrl = $hostMappings[$host];
        } else {
            echo "This is not a valid request!";
            die();
        }

        //   print_r($host);
        //   print_r($apiUrl);
        //   die();
        
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $path = dirname($scriptName);
        
        // Construct the base URL
        $baseUrl = $protocol . $host . rtrim($path, '/');

        if (isset($_POST['emp_id']) && isset($_POST['password']) && isset($_POST['channel_id'])) {

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
                'channel_id' => $_POST['channel_id'],
                'base_url' => $_POST['base_url'],
            ));

            // Set headers
            $headers = array(
                'password: ' . $_POST['password'],
                
            );

            // Set cURL options
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                echo 'cURL error: ' . curl_error($curl);
                exit;
            }

            curl_close($curl);

            ?>
            <div class="d-none">
                <?php
                var_dump($response);
                die();

                ?>
            </div>
            <?php

        } else {
            echo "User ID, password, and channel ID are required!";
        }
    ?>

</body>

</html>
