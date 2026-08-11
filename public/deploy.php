<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Deploy</title>
    <style>
        body { font-family: monospace; background: #1a1a2e; color: #e0e0e0; padding: 20px; }
        pre { background: #16213e; padding: 15px; border-radius: 5px; color: #00ff88; }
        .error { color: #ff4444; }
        .success { color: #00ff88; }
    </style>
</head>
<body>
<?php

$secret = getenv('DEPLOY_SECRET') ?: '';

if ($secret && (!isset($_GET['token']) || $_GET['token'] !== $secret)) {
    http_response_code(403);
    echo '<h1 class="error">Token inválido</h1>';
    exit;
}

$repo = '/opt/bitnami/apache/htdocs/wilberth';
$logFile = '/opt/bitnami/apache/htdocs/wilberth/storage/logs/deploy.log';

function run($cmd, $cwd) {
    echo "<pre>\$ $cmd\n";
    $descriptors = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];
    $proc = proc_open($cmd, $descriptors, $pipes, $cwd);
    if (is_resource($proc)) {
        fclose($pipes[0]);
        $stdout = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        $exit = proc_close($proc);
        echo htmlspecialchars($stdout);
        if ($stderr) {
            echo '<span class="error">' . htmlspecialchars($stderr) . '</span>';
        }
        echo "</pre>";
        return $exit === 0;
    }
    echo '<span class="error">Error al ejecutar comando</span></pre>';
    return false;
}

echo "<h1>🚀 Deploy</h1>";

$start = microtime(true);

$success = true;

// 1. Git pull
echo "<h2>1. Git pull</h2>";
$success = run("git reset --hard HEAD 2>&1", $repo);
$success = run("git pull 2>&1", $repo) && $success;

// 2. Composer install
echo "<h2>2. Composer install</h2>";
$success = run("composer install --no-interaction --prefer-dist 2>&1", $repo) && $success;

// 3. PNPM install & build
echo "<h2>3. PNPM install & build</h2>";
$success = run("CI=true pnpm install 2>&1", $repo) && $success;
$success = run("pnpm run build 2>&1", $repo) && $success;

// 4. Database migrations
echo "<h2>4. Migraciones</h2>";
$success = run("php artisan migrate --force 2>&1", $repo) && $success;

// 5. Laravel optimizations
echo "<h2>5. Laravel optimize</h2>";
$success = run("php artisan optimize:clear 2>&1", $repo) && $success;

$elapsed = round(microtime(true) - $start, 2);
$status = $success ? '✅ Completado' : '❌ Con errores';
echo "<h3 class='" . ($success ? 'success' : 'error') . "'>$status en {$elapsed}s</h3>";

$log = "[" . date('Y-m-d H:i:s') . "] $status ({$elapsed}s)\n";
file_put_contents($logFile, $log, FILE_APPEND);

?>
</body>
</html>
