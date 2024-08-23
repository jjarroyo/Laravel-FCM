<?php

namespace LaravelFCM\Message;

/**
 * Class PayloadNotificationBuilder.
 *
 * Official google documentation :
 *
 * @link http://firebase.google.com/docs/cloud-messaging/http-server-ref#downstream-http-messages-json
 */
class PayloadNotificationBuilder
{
    /**
     * @internal
     *
     * @var null|string
     */
    protected $title;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $body;

    /**
     * Title must be present on android notification and ios (watch) notification.
     *
     * @param string $title
     */
    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Indicates notification title. This field is not visible on iOS phones and tablets.
     * but it is required for android.
     *
     * @param string $title
     *
     * @return PayloadNotificationBuilder current instance of the builder
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Indicates notification body text.
     *
     * @param string $body
     *
     * @return PayloadNotificationBuilder current instance of the builder
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
   
    /**
     * Get title.
     *
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get body.
     *
     * @return null|string
     */
    public function getBody()
    {
        return $this->body;
    }
    
    /**
     * Build an PayloadNotification.
     *
     * @return PayloadNotification
     */
    public function build()
    {
        return new PayloadNotification($this);
    }
}
