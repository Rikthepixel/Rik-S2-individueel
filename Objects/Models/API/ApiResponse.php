<?php
    class ApiResponse{
        
        private $Result = null;
        private $Message = null;
        private $Data = null;

        public function __construct($ResponseResult, $ResponseMessage, $ResponseData){
            $this->Result = $ResponseResult;
            $this->Message = $ResponseMessage;
            $this->Data = $ResponseData;
        }
        
        public function ChangeResponse($ResponseResult, $ResponseMessage, $ResponseData){
            if (isset($ResponseResult) && $ResponseResult != null) {
                $this->Result = $ResponseResult;
            }
            if (isset($ResponseData) && $ResponseData != null) {
                $this->Data = $ResponseData;
            }
            if (isset($ResponseMessage) && $ResponseMessage != null) {
                $this->Message = $ResponseMessage;
            }
        }

        public static function GenerateResponse($ResultValue)
        {
            $ReturnValue = array(
                "Result" => false,
                "Message" => "Unknown Error"
            );
    
            if (isset($ResultValue)) {
                if (!$ResultValue) {
                    $ReturnValue["Result"] = false;
                    $ReturnValue["Message"] = "Database query failed";
                } else {
                    $ReturnValue["Result"] = true;
                    $ReturnValue["Message"] = "No Errors";
                }
            } else {
                $ReturnValue["Result"] = false;
                $ReturnValue["Message"] = "Error while retrieving data";
            }
            return $ReturnValue;
        }

        public function EchoResponse(){
            $Array = array(
                "Result" => $this->Result,
                "Message" => $this->Message,
            );
            if ($this->Data != null) {
                $Array["Data"] = $this->Data;
            }

            echo(json_encode($Array));
        }
    }
?>