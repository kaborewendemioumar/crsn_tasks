
<?php
header('Content-Type: application/json');
header('X-PHP-Test: present');
header(
    'Set-Cookie',
    'php_test_cookie=ok; Path=/; Max-Age=300; Secure; HttpOnly; SameSite=Lax'
);

echo json_encode([
    'test' => 'PHP direct fonctionne',
]);
