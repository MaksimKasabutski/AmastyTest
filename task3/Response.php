<?php

class Response implements JsonSerializable
    {
        protected $message;

        public function __construct($message) 
        {
            $this->message=$message;
        }
        public function jsonSerialize() : array
        {
            return [
                'message' => $this->message,
            ];
        }
    }