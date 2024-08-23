<?php

namespace LaravelFCM\Message;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class PayloadNotification.
 */
class PayloadNotification implements Arrayable
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
     * PayloadNotification constructor.
     *
     * @param PayloadNotificationBuilder $builder
     */
    public function __construct(PayloadNotificationBuilder $builder)
    {
        $this->title = $builder->getTitle();
        $this->body = $builder->getBody();
        
    }

    /**
     * convert PayloadNotification to array.
     *
     * @return array
     */
    public function toArray()
    {
        $notification = [
            'title' => $this->title,
            'body' => $this->body,
        ];

        // remove null values
        $notification = array_filter($notification, function($value) {
            return $value !== null;
        });
        
        return $notification;
    }
}
