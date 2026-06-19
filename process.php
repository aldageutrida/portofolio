<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $subject = htmlspecialchars($_POST['subject'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        echo "<h3>❌ Semua field wajib diisi kecuali Subjek.</h3>";
        echo "<a href='index.html#contacts'>Kembali ke Form</a>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h3>❌ Format email tidak valid.</h3>";
        echo "<a href='index.html#contacts'>Kembali ke Form</a>";
        exit;
    }

    $to = "admin@domainkamu.com"; // GANTI dengan email tujuan Anda
    $email_subject = "Pesan Portofolio: " . ($subject ?: "Tidak ada subjek");
    $email_body = "Anda menerima pesan baru dari portofolio:\n\n";
    $email_body .= "Nama: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subjek: $subject\n\n";
    $email_body .= "Pesan:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<h3>✅ Pesan berhasil dikirim!</h3>";
        echo "<p>Terima kasih, $name. Saya akan segera merespon.</p>";
        echo "<a href='index.html'>Kembali ke Beranda</a>";
    } else {
        echo "<h3>❌ Gagal mengirim pesan. Silakan coba lagi.</h3>";
        echo "<a href='index.html#contacts'>Kembali ke Form</a>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>