<?php

session_start();

/**
 * چک میکند که متد فٌرم صفحه آپلود پٌست هست یا خیر
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**
     * چک میکند دکمه آپلود ساب میت شده یا خیر
     */
    if (isset($_POST['fileBtn'])) {
        $uploadMsg = false;

        /**
         * حتما باید فایل در اینپوت آپلود شده باشد
         * و خالی نباشد
         */
        if (isset($_FILES['fileInput']) && !empty($_FILES['fileInput'])) {
            $fileName = $_FILES['fileInput']['name'];
            $fileType = explode('.', $fileName);
            $fileType = strtolower(end($fileType));
            $newFileName = md5(time() . $fileName) . '.' . $fileType;
            $typeAllowed = ['png', 'jpg', 'jpeg', 'zip', 'rar', 'doc', 'txt'];

            /**
             * چک میکند فرمت فایل مجاز میباشد یا خیر
             */
            if (in_array($fileType, $typeAllowed)) {
                if (!file_exists('upload')) {
                    mkdir('upload');
                }
                $uploadPath = 'upload/' . $newFileName;

                if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadPath)) {
                    $uploadMsg = true;
                }
            }
        }
    }
}

$_SESSION['uploadMsg'] = $uploadMsg;

header('location:index.php');
