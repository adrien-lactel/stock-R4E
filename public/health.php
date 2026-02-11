<?php
// Simple health check that doesn't require Laravel bootstrap
header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
exit(0);
