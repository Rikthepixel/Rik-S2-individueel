<?php

class ViewController 
{

    public function IncludeView(string $Path, $Variables = array())
    {
        extract($Variables);
        $ViewController = $this;
        return include_once $this->getIncludePath($Path);
    }

    public function getIncludePath(string $Path)
    {
        return $GLOBALS["PATHS"]->Views."/ViewPages/".$Path;
    }

    public function getRelativeIncludePath(string $Path)
    {
        return GetRelativePath($this->getIncludePath($Path));
    }
}