<?php
$queryFile = $_pg['rentQueryType'].'.php';
$queryFolderPath = __DIR__.'/rentQuery/'.$queryFile;
if (file_exists($queryFolderPath)) {
    include_once $queryFolderPath;
} else {
    ___exception('['.$queryFile.'] not exist.');
}
