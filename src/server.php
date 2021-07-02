<?php


//Setup ENV


//Setup Globals
$SourceDirectory = __DIR__;
$SourcePaths = array_diff(scandir($SourceDirectory), array('..', '.'));

$GLOBALS["PATHS"] = (object)array();

foreach ($SourcePaths as $key => $SourceFolder) {
  $SourcePath = $SourceDirectory."/".$SourceFolder;

  //If the path is a file (not a directory/folder) skip it
  if (is_file($SourcePath)) {
    continue;
  }

  $GLOBALS["PATHS"]->$SourceFolder = $SourcePath;
}

//Define Functions
function GetRelativePath($path) {
  $npath = str_replace('\\', '/', $path);
  return str_replace($_SERVER['DOCUMENT_ROOT'], '', $npath);
}

// Run router
include_once $GLOBALS["PATHS"]->Router."/Route.php";
Route::run("/");