<?php

namespace Modules\Pos\Services\DTE\Entities\DTE;

abstract class DTE
{
    // Variables
    protected $token;
    protected $folio;
    protected $logoBase64;
    protected $pdfBase64;
    protected $timbreBase64;
    protected $xmlBase64;
    
    // Methods
    abstract public function getJson();
    abstract public function sendDTE();
    abstract public function saveFilesDte(string $path);

    /**
     * Get the value of folio
     */ 
    public function getFolio()
    {
        return isset($this->folio) ? $this->folio : null;
    }

    /**
     * Get the value of logoBase64
     */ 
    public function getLogoBase64()
    {
        return isset($this->logoBase64) ? $this->logoBase64 : null;
    }

    /**
     * Get the value of pdfBase64
     */ 
    public function getPdfBase64()
    {
        return isset($this->pdfBase64) ? $this->pdfBase64 : null;
    }

    /**
     * Get the value of timbreBase64
     */ 
    public function getTimbreBase64()
    {
        return isset($this->timbreBase64) ? $this->timbreBase64: null;
    }

    /**
     * Get the value of xmlBase64
     */ 
    public function getXmlBase64()
    {
        return isset($this->xmlBase64) ? $this->xmlBase64 : null;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }
}