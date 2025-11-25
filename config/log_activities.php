<?php
function logActivity($connect, $id_user, $aktivitas, $detail = null, $tabel = null, $id_data = null)
{
    $ip        = $_SERVER['REMOTE_ADDR'] ?? '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Jika id_user kosong (0, "", atau null), ubah jadi NULL biar tidak melanggar FK
    if (empty($id_user)) {
        $id_user = null;
    }

    $stmt = $connect->prepare("
        INSERT INTO log_activities (id_user, aktivitas, tabel, id_data, detail, ip_address, user_agent, waktu)
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    if ($stmt === false) {
        die("Prepare failed: " . $connect->error);
    }

    // perhatikan! gunakan "ississs" tetap, karena bind_param bisa menerima NULL untuk int
    $stmt->bind_param(
        "ississs",
        $id_user,    // int / null
        $aktivitas,
        $tabel,
        $id_data,
        $detail,
        $ip,
        $userAgent
    );

    if (!$stmt->execute()) {
        error_log("LogActivity Error: " . $stmt->error);
    }

    $stmt->close();
}
