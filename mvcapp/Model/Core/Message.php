<?php

Mage::loadClassByFileName("model_core_session");

class Model_Core_Message extends Model_Core_Session{
    
    public function setSuccess($message)
    {
        $this->success = $message;    
        return $this;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function setFailure($message)
    {
        $this->failure = $message;
        return $this;
    }

    public function getFailure()
    {
        return $this->failure;
    }

    public function clearSuccess()
    {
        unset($this->success);
    }
}
