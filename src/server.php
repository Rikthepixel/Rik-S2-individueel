<?php
$EnviromentFilePath = $_SERVER['DOCUMENT_ROOT']."/.env";
$SourceDirectoryPath = $_SERVER['DOCUMENT_ROOT']."/src";

//Setup ENV
if (file_exists($EnviromentFilePath))
{
  $EnviromentFile = fopen($EnviromentFilePath, "r");
  $JsonEnvString = fread($EnviromentFile, filesize($EnviromentFilePath));
  fclose($EnviromentFile);
  
  $EnvVariables = json_decode($JsonEnvString);
  if ($EnvVariables != null && gettype($EnvVariables) == "object") {
    foreach ((array)$EnvVariables as $key => $value) {
      $_ENV[$key] = $value;
    }
  }
}

//Setup Globals
if (true)
{
  $SourcePaths = array_diff(scandir($SourceDirectoryPath), array('..', '.'));

  $GLOBALS["PATHS"] = (object)array();

  foreach ($SourcePaths as $key => $SourceFolder) {
    $SourcePath = $SourceDirectoryPath."/".$SourceFolder;

    //If the path is a file (not a directory/folder) skip it
    if (is_file($SourcePath)) {
      continue;
    }

    $GLOBALS["PATHS"]->$SourceFolder = $SourcePath;
  }
}

//Define Functions
function GetRelativePath($path) {
  $npath = str_replace('\\', '/', $path);
  return str_replace($_SERVER['DOCUMENT_ROOT'], '', $npath);
}

// Run router
include_once $GLOBALS["PATHS"]->Router."/Route.php";
Route::run("/");