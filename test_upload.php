<?php
/**
 * Simple test script to verify image upload functionality
 * Run this after deployment to test file uploads
 */

// Test 1: Check if storage directory exists and is writable
echo "=== Testing Storage Directory ===\n";
$storagePath = __DIR__ . '/storage/app/public';
if (is_dir($storagePath)) {
    echo "✅ Storage directory exists: $storagePath\n";
    if (is_writable($storagePath)) {
        echo "✅ Storage directory is writable\n";
    } else {
        echo "❌ Storage directory is NOT writable\n";
    }
} else {
    echo "❌ Storage directory does not exist: $storagePath\n";
}

// Test 2: Check if public/storage symlink exists
echo "\n=== Testing Storage Symlink ===\n";
$symlinkPath = __DIR__ . '/public/storage';
if (is_link($symlinkPath)) {
    echo "✅ Storage symlink exists: $symlinkPath\n";
    $target = readlink($symlinkPath);
    echo "   Target: $target\n";
} else {
    echo "❌ Storage symlink does not exist: $symlinkPath\n";
    echo "   Run: php artisan storage:link\n";
}

// Test 3: Check required directories
echo "\n=== Testing Required Directories ===\n";
$requiredDirs = [
    'avatars',
    'logos', 
    'resumes',
    'blog',
    'blog-content'
];

foreach ($requiredDirs as $dir) {
    $fullPath = $storagePath . '/' . $dir;
    if (is_dir($fullPath)) {
        echo "✅ Directory exists: $dir\n";
    } else {
        echo "❌ Directory missing: $dir\n";
        echo "   Creating directory...\n";
        if (mkdir($fullPath, 0755, true)) {
            echo "   ✅ Directory created successfully\n";
        } else {
            echo "   ❌ Failed to create directory\n";
        }
    }
}

// Test 4: Check file permissions
echo "\n=== Testing File Permissions ===\n";
$testFile = $storagePath . '/test_permissions.txt';
if (file_put_contents($testFile, 'test') !== false) {
    echo "✅ Can write to storage directory\n";
    if (unlink($testFile)) {
        echo "✅ Can delete files from storage directory\n";
    } else {
        echo "❌ Cannot delete files from storage directory\n";
    }
} else {
    echo "❌ Cannot write to storage directory\n";
}

// Test 5: Check PHP upload settings
echo "\n=== Testing PHP Upload Settings ===\n";
$uploadMax = ini_get('upload_max_filesize');
$postMax = ini_get('post_max_size');
$maxExecution = ini_get('max_execution_time');
$memoryLimit = ini_get('memory_limit');

echo "Upload max filesize: $uploadMax\n";
echo "Post max size: $postMax\n";
echo "Max execution time: {$maxExecution}s\n";
echo "Memory limit: $memoryLimit\n";

// Test 6: Check if Laravel is properly configured
echo "\n=== Testing Laravel Configuration ===\n";
if (file_exists(__DIR__ . '/.env')) {
    echo "✅ .env file exists\n";
} else {
    echo "❌ .env file missing\n";
}

if (file_exists(__DIR__ . '/artisan')) {
    echo "✅ Laravel artisan exists\n";
} else {
    echo "❌ Laravel artisan missing\n";
}

echo "\n=== Test Complete ===\n";
echo "If all tests pass, your image upload should work correctly.\n";
echo "If any tests fail, fix the issues before testing image uploads.\n";
?>
