<?php

namespace StpBoard\Home\Entity;

use StpBoard\Base\BoardProviderInterface;

class Item
{
    protected $ident;
    protected $provider;
    protected $refresh;
    protected $params;
    protected $width;

    /**
     * @return string
     */
    public function getIdent()
    {
        return $this->ident;
    }

    /**
     * @param string $ident
     */
    public function setIdent($ident)
    {
        $this->ident = $ident;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return int
     */
    public function getRefresh()
    {
        return $this->refresh;
    }

    /**
     * @param int $refresh
     */
    public function setRefresh($refresh)
    {
        $this->refresh = (int) filter_var($refresh, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        /** @var BoardProviderInterface $providerClass */
        $providerClass = $this->getProvider();
        $baseUrl =  $providerClass::getRoutePrefix() . '?';
        $urlParts = [
            'id='.$this->getIdent()
        ];

        foreach ($this->getParams() as $key => $value) {
            $urlParts[] = $key . '=' . urlencode($value);
        }

        return $baseUrl . join('&', $urlParts);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = (int) filter_var($width, FILTER_SANITIZE_NUMBER_INT);
    }
}
