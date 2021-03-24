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