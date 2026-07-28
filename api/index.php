<?php

/**
 * Vercel Serverless Entry Point for Laravel
 *
 * This file bootstraps the Laravel application in Vercel's serverless environment.
 * Since Vercel's filesystem is read-only (except /tmp), we need to ensure
 * all writable directories exist in /tmp before Laravel boots.
 */

// Create required /tmp directories for Laravel
// These are needed because the default storage/ paths are read-only on Vercel
$tmpDirs = [
    '/tmp/views',      // Compiled Blade views (VIEW_COMPILED_PATH)
    '/tmp/cache',      // Framework cache
    '/tmp/sessions',   // Session files (if using file driver)
    '/tmp/logs',       // Log files (fallback)
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Forward the request to Laravel's public/index.php
require __DIR__ . '/../public/index.php';