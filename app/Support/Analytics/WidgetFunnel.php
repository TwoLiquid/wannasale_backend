<?php

namespace App\Support\Analytics;

class WidgetFunnel {

    protected $seen;
    protected $opened;
    protected $madeRequest;
    protected $successfullyClosedRequest;
    protected $unsuccessfullyClosedRequest;

    /**
     * WidgetFunnel constructor.
     * @param int $seen
     * @param int $opened
     * @param int $madeRequest
     * @param int $successfullyClosedRequest
     * @param int $unsuccessfullyClosedRequest
     */
    public function __construct(
        int $seen,
        int $opened,
        int $madeRequest,
        int $successfullyClosedRequest,
        int $unsuccessfullyClosedRequest
    )
    {
        $this->seen = $seen;
        $this->opened = $opened;
        $this->madeRequest = $madeRequest;
        $this->successfullyClosedRequest = $successfullyClosedRequest;
        $this->unsuccessfullyClosedRequest = $unsuccessfullyClosedRequest;
    }

    /**
     * @return int
     */
    public function getSeen() : int
    {
        return $this->seen;
    }

    /**
     * @param int $seen
     * @return WidgetFunnel
     */
    public function setSeen(int $seen) : WidgetFunnel
    {
        $this->seen = $seen;

        return $this;
    }

    /**
     * @return int
     */
    public function getOpened() : int
    {
        return $this->opened;
    }

    /**
     * @param int $opened
     * @return WidgetFunnel
     */
    public function setOpened(int $opened) : WidgetFunnel
    {
        $this->opened = $opened;

        return $this;
    }

    /**
     * @return int
     */
    public function getMadeRequest() : int
    {
        return $this->madeRequest;
    }

    /**
     * @param int $madeRequest
     * @return WidgetFunnel
     */
    public function setMadeRequest(int $madeRequest) : WidgetFunnel
    {
        $this->madeRequest = $madeRequest;

        return $this;
    }

    /**
     * @return int
     */
    public function getSuccessfullyClosedRequest() : int
    {
        return $this->successfullyClosedRequest;
    }

    /**
     * @param int $successfullyClosedRequest
     * @return WidgetFunnel
     */
    public function setSuccessfullyClosedRequest(int $successfullyClosedRequest) : WidgetFunnel
    {
        $this->successfullyClosedRequest = $successfullyClosedRequest;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnsuccessfullyClosedRequest() : int
    {
        return $this->unsuccessfullyClosedRequest;
    }

    /**
     * @param int $unsuccessfullyClosedRequest
     * @return WidgetFunnel
     */
    public function setUnsuccessfullyClosedRequest(int $unsuccessfullyClosedRequest) : WidgetFunnel
    {
        $this->unsuccessfullyClosedRequest = $unsuccessfullyClosedRequest;

        return $this;
    }
}