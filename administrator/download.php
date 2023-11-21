<?php
if (isset($_POST['download'])) {
    $folderPath = '../student_assignment'; // Replace with the actual folder path

    // Generate a unique name for the zip archive
    $zipFilename = 'CMP319_Assigment_' . date('Y-m-d_H-i-s') . '.zip';

    // Create a new ZipArchive object
    $zip = new ZipArchive();

    // Open the zip archive for writing
    if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
        die('Failed to create zip archive');
    }

    // Add the "student_assignment" folder to the zip archive
    $zip->addEmptyDir('student_assignment');

    // Add files from the "student_assignment" folder to the zip archive
    $files = scandir($folderPath);

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $filePath = $folderPath . '/' . $file;

            if (is_file($filePath)) {
                $zip->addFile($filePath, 'student_assignment/' . $file);
            }
        }
    }

    // Close the zip archive
    $zip->close();

    // Set the appropriate headers for the download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
    header('Content-Length: ' . filesize($zipFilename));
    header('Pragma: no-cache');
    header('Expires: 0');

    // Read the zip file and send it to the browser for download
    readfile($zipFilename);

    // Delete the zip file
    unlink($zipFilename);
}
