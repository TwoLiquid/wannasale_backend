<?php

namespace App\Support\Analytics;

class ItemGraph {

    protected $clientOffers;
    protected $sellerOffers;
    protected $successfullyOffers;
    protected $unsuccessfullyOffers;

    /**
     * ItemGraph constructor.
     * @param array $clientOffers
     * @param array $sellerOffers
     * @param array $successfullyOffers
     * @param array $unsuccessfullyOffers
     */
    public function __construct(
        array $clientOffers,
        array $sellerOffers,
        array $successfullyOffers,
        array $unsuccessfullyOffers
    )
    {
        $this->clientOffers = $clientOffers;
        $this->sellerOffers = $sellerOffers;
        $this->successfullyOffers = $successfullyOffers;
        $this->unsuccessfullyOffers = $unsuccessfullyOffers;
    }

    /**
     * @return array
     */
    public function getClientOffers() : array
    {
        return $this->clientOffers;
    }

    /**
     * @param array $clientOffers
     * @return ItemGraph
     */
    public function setClientOffers(array $clientOffers) : ItemGraph
    {
        $this->clientOffers = $clientOffers;

        return $this;
    }

    /**
     * @return array
     */
    public function getSellerOffers() : array
    {
        return $this->sellerOffers;
    }

    /**
     * @param array $sellerOffers
     * @return ItemGraph
     */
    public function setSellerOffers(array $sellerOffers) : ItemGraph
    {
        $this->sellerOffers = $sellerOffers;

        return $this;
    }

    /**
     * @return array
     */
    public function getSuccessfullyOffers() : array
    {
        return $this->successfullyOffers;
    }

    /**
     * @param array $setSuccessfullyOffers
     * @return ItemGraph
     */
    public function setSuccessfullyOffers(array $setSuccessfullyOffers) : ItemGraph
    {
        $this->successfullyOffers = $setSuccessfullyOffers;

        return $this;
    }

    /**
     * @return array
     */
    public function getUnsuccessfullyOffers() : array
    {
        return $this->unsuccessfullyOffers;
    }

    /**
     * @param array $unsuccessfullyOffers
     * @return ItemGraph
     */
    public function setUnsuccessfullyOffers(array $unsuccessfullyOffers) : ItemGraph
    {
        $this->unsuccessfullyOffers = $unsuccessfullyOffers;

        return $this;
    }
}