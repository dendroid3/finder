<?php
// public/index.php

require_once __DIR__ . '/../app/App.php';

$app = new App();

// Now include routes, $app exists
require_once __DIR__ . '/../routes/web.php';

$app->run();
