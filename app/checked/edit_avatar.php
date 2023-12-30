<?php
require_once("../../vendor/autoload.php");
use App\DateBase;

$data = [
    "id" => htmlspecialchars(trim($_GET["id"])),
];

$db = new DateBase();


if (isset($_FILES['file'])) {
    $avatar = $_FILES['file'];

  
    if ($avatar['error'] === UPLOAD_ERR_OK) {
      
        $uploadPath = __DIR__ . '/../../public/uploads/';

        $fileName = uniqid() . '_' . basename($avatar['name']);
        $uploadedFile = $uploadPath . $fileName;

        move_uploaded_file($avatar['tmp_name'], $uploadedFile);

        $stmt = $db->conn->prepare('UPDATE `reg_log` SET `avatar` = ? WHERE `id` = ?');
        $stmt->execute([$fileName, $data['id']]);

        echo "Файл успішно завантажено: $uploadedFile";
        exit;
    } else {
        echo "Помилка завантаження файлу: {$avatar['error']}";
        exit;
    }
} else {
    
    echo "Ви не вибрали файл для завантаження";
    exit;
}
?>
