<?php
    class URLParameter{

        public static function getParam($variableName, $Offset = 0, $default = null) {

            // Was the variable actually part of the request
            if(array_key_exists($variableName, $_REQUEST))
                return $_REQUEST[$variableName];
            
            
            // Was the variable part of the url
            $ReplacedString = preg_replace('/\?.+/', '', $_SERVER['REQUEST_URI']);
            //$StartSearchPosition = (strpos($ReplacedString, $variableName) + strlen($variableName));
            //$VariableStartPos = (strpos($ReplacedString, '/', $StartSearchPosition));

            //$VariableEndPos = (strpos($ReplacedString, '/', $VariableStartPos + 1));
            
            $PositionOffset = 1 + $Offset;
            $CharacterArray = str_split($variableName);
            for ($i = 1; $i < count($CharacterArray); $i++) {
                if ($CharacterArray[$i] == '/') {
                    $PositionOffset += 1;
                }
            }
            if(strpos($variableName, '/')) {
                $EndPosition = strpos($variableName, '/');
                $variableName = substr($variableName, 0, $EndPosition);
            }


            $urlParts = explode('/', $ReplacedString);
            $position = array_search($variableName, $urlParts);
            if($position !== false && array_key_exists($position+$PositionOffset, $urlParts))
                return $urlParts[$position+$PositionOffset];
        
            return $default;
        }
    }
?>