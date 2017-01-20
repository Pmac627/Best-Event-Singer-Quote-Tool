<?php /* failed.php */
    session_start();
    $ErrArray = $_SESSION['ErrArray'];
    $OrigArray = $_SESSION['OrigArray'];
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <style type="text/css">
        body { background-color: white; }
    </style>
</head>
<body>
    <h1>Music Quote Generator</h1>
    <p>FAILED!</p>
    <p><?php echo var_dump($ErrArray); ?></p>
    <p>ORIGINAL!</p>
    <p><?php echo var_dump($OrigArray); ?></p>
</body>