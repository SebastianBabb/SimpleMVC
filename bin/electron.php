#!/usr/bin/php

<?php

define('GENERATE', 'generate');

/**
 * Electron utility generates controller and view files.
 */
// echo '============ Electron ============' . PHP_EOL;

// Check the command line args.
if (3 == sizeof($argv)) {
    // Store the command.
    $command = $argv[1];
    // Store the controller name to generate.
    $controllerName = $argv[2]; // TODO: do some validation on the username.

    // Execute the command.
    switch ($command) {
        case GENERATE:
            generate($controllerName);
            break;
        default:
            echo "{command} is an invalid command.";
            break;
    }
} else {
    echo 'Usage: electron generate <controller_name>' . PHP_EOL;
}

/**
 * Create a controller and view files.
 */
function generate($controllerName) {
    // Controller placeholders.
    $controllerClassNamePlaceholder = '&TemplateController&';
    $viewFilePlaceholder = '&ViewFile&';
    $viewMessagePlaceholder = '&DefaultMessage&';

    // New controller class and filename.
    $controllerClassName = ucfirst($controllerName) . 'Controller';
    $controllerFilename =  lcfirst($controllerName) . '.controller.php';
    $viewMessage = ucfirst($controllerName) . ' Works!';

    // New view filename.
    $viewFilename = lcfirst($controllerName) . '.view.php';

    // Read the template controller file to a string.
    // TODO: add exception handling.
    $controllerContent = file_get_contents(__DIR__.'/../src/templates/controller.php');

    // Replace controller classname and view file place holders.
    $controllerContent = str_replace($controllerClassNamePlaceholder, $controllerClassName, $controllerContent);
    $controllerContent = str_replace($viewFilePlaceholder, $viewFilename, $controllerContent);
    $controllerContent = str_replace($viewMessagePlaceholder, $viewMessage, $controllerContent);

    // Write the new controller to a file.
    // TODO: add exception handling - check if files already exist.
    file_put_contents(__DIR__ . '/../app/controllers/' . $controllerFilename, $controllerContent);

    // $viewContents = file_get_contents(__DIR__.'/../src/templates/view.php');
    // $viewContents = str_replace($viewContentPlaceholder, $viewMessage, $viewContents);

    // file_put_contents(__DIR__ . '/../app/views/' . $viewFilename, $viewContents);
    copy(__DIR__.'/../src/templates/view.php', __DIR__ . '/../app/views/' . $viewFilename);

    // TODO: Out success or failure message.
    // echo "{GENERATE} {$controllerName}" . PHP_EOL;
}
