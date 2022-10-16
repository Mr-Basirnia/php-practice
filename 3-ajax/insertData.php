<?php

sleep(1);

function getMsg(string $text, string $className)
{
    echo "<span class='$className'>$text</span>";
    die();
}

$cityName = $_POST['cityName'];

if (strlen($cityName) < 3) {
    getMsg('طول نام شهر وارد شده کمتر از حد تعیین شده است', 'error');
}

try {
    $db = new PDO("mysql:host=localhost;dbname=iran;charset=utf8mb4", "root", "");
} catch (PDOException $e) {
    echo "<pre>";
    print_r($e->errorInfo);
    echo "</pre>";
    getMsg('در ارتباط به دیتابیس مشکلی پیش آمده است', 'error');
}

$query = "INSERT INTO city (province_id,name) VALUES (?,?)";
$stmt = $db->prepare($query);
$insertData = $stmt->execute([rand(1, 31),$cityName]);

if ($insertData) {
    getMsg("شهر '$cityName' با موفقیت ثبت گردید . با سپاس از شما", 'success');
}
