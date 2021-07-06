<?php
$EnviromentFilePath = $_SERVER['DOCUMENT_ROOT']."/.env";

//Setup ENV
if (file_exists($EnviromentFilePath))
{
  $EnviromentFile = fopen($EnviromentFilePath, "r");
  $JsonEnvString = fread($EnviromentFile, filesize($EnviromentFilePath));
  fclose($EnviromentFile);
  
  $EnvVariables = json_decode($JsonEnvString);
  if ($EnvVariables != null && gettype($EnvVariables) == "object") {
    foreach ((array)$EnvVariables as $key => $value) {

      if ($key == "Paths") {
        $value = (array)$value;

        foreach ($value as $PathKey => $Path) {
          $value[$PathKey] = $_SERVER['DOCUMENT_ROOT'].$Path;
        }

        $value = (object)$value;
      }

      $_ENV[$key] = $value;
    }
  }
}

//Setup Globals
if (true)
{
  $SourcePaths = array_diff(scandir($_ENV["Paths"]->Source), array('..', '.'));

  $GLOBALS["PATHS"] = (object)array();

  foreach ($SourcePaths as $key => $SourceFolder) {
    $SourcePath = $_ENV["Paths"]->Source."/".$SourceFolder;

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

function GetActiveHREF()
{
  $parsed_url = parse_url($_SERVER['REQUEST_URI']);
  if (isset($parsed_url["path"]))
  {
    return $parsed_url["path"];
  }

  return null;
}

//Autoloader
if (true)
{
  function myAutoLoad($Classname)
  {
    //echo $Classname;
    $ClassPath = $_ENV["Paths"]->Source."\\".$Classname.".php";
    
    //echo $ClassPath;
    if (!file_exists($ClassPath))
    {
      echo "Autoload fail: ".$ClassPath;
      return false;
    }

    include_once $ClassPath;
  }

  spl_autoload_register('myAutoLoad');
}

// Run router
Router\Router::run("/");