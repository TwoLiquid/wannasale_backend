<?php

namespace App\Support\Notifications;

class ClientMessage {
    protected $fromName;
    protected $mailTitle;
    protected $mailText;

    /**
     * ClientMessage constructor.
     * @param string $fromName
     * @param string $mailTitle
     * @param string $mailText
     */
    public function __construct(
        string $fromName,
        string $mailTitle,
        string $mailText
    )
    {
        $this->fromName = $fromName;
        $this->mailTitle = $mailTitle;
        $this->mailText = $mailText;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->mailTitle;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->mailText;
    }
}