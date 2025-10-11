<?php

// Define the command to be executed
$command = 'browser-sync start --proxy "localhost:8080" --files "**/*.php, **/*.css, **/*.js"';

// Execute the command and display the output
echo "Running: $command\n";

// Execute the command
passthru($command, $resultCode);

// Check if the command failed
if ($resultCode !== 0) {
    echo "Error: Command '$command' failed with exit code $resultCode.\n";
    exit($resultCode);
}

echo "Command '$command' executed successfully.\n";

