<?php
    class ApiResponse{
        
        public $Result = null;
        public $Message = null;
        public $Data = null;

        public function __construct($ResponseResult = null, $ResponseMessage = null, $ResponseData){
            $this->Result = $ResponseResult;
            $this->Message = $ResponseMessage;
            $this->Data = $ResponseData;
        }

        public function EchoResponse($result = null, $message = null, $data = null){
            if ($result == null) {
                $result = $this->Result;
            }
            if ($message == null) {
                $message = $this->Message;
            }
            if ($data == null) {
                $data = $this->Data;
            }
            
            $Array = array(
                "Result" => $result,
                "Message" => $message,
            );

            if ($this->Data != null) {
                $Array["Data"] = $this->Data;
            }

            echo(json_encode($Array));
        }
    }
?>