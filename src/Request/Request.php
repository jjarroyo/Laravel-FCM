<?php

namespace LaravelFCM\Request;

use LaravelFCM\Message\Topics;
use LaravelFCM\Message\Options;
use LaravelFCM\Message\PayloadData;
use LaravelFCM\Message\PayloadNotification;

/**
 * Class Request.
 */
class Request extends BaseRequest
{
    /**
     * @internal
     *
     * @var string|array
     */
    protected $to;

    /**
     * @internal
     *
     * @var Options
     */
    protected $options;

    /**
     * @internal
     *
     * @var PayloadNotification
     */
    protected $notification;

    /**
     * @internal
     *
     * @var PayloadData
     */
    protected $data;

    /**
     * @internal
     *
     * @var Topics|null
     */
    protected $topic;

    /**
     * Request constructor.
     *
     * @param                     $to
     * @param Options             $options
     * @param PayloadNotification $notification
     * @param PayloadData         $data
     * @param Topics|null         $topic
     */
    public function __construct($to, Options $options = null, PayloadNotification $notification = null, PayloadData $data = null, Topics $topic = null)
    {
        parent::__construct();

        $this->to = $to;
        $this->options = $options;
        $this->notification = $notification;
        $this->data = $data;
        $this->topic = $topic;
    }

    /**
     * Build the body for the request.
     *
     * @return array
     */
    protected function buildBody()
    {
       /* $message = [
            'topic' => $this->getTo(),
            'registration_ids' => $this->getRegistrationIds(),
            'notification' => $this->getNotification(),
            'data' => $this->getData(),
        ];*/

        $body = [
            'topic' => $this->getTo(),
           // 'registration_ids' => $this->getRegistrationIds()[0],
            'notification' => $this->getNotification(),
            'data' => $this->getData(),
        ];
        $body =array_filter(array_merge($body, $this->getOptions()));
        $message = [
            'message' => $body
        ];
        // remove null entries
        return array_filter($message);
    }


    protected function buildRequestHeader()
    {
        return [
           // 'Authorization' => 'Bearer '.$this->client->fetchAccessTokenWithAssertion()['access_token'],
            'Content-Type' => 'application/json',
            'project_id' => $this->config['sender_id'],
        ];
    }


    /**
     * get to key transformed.
     *
     * @return array|null|string
     */
    protected function getTo()
    {
        $to = is_array($this->to) ? null : $this->to;

        if ($this->topic && $this->topic->hasOnlyOneTopic()) {
            $to = $this->topic->build();
        }

        return $to;
    }

    /**
     * get registrationIds transformed.
     *
     * @return array|null
     */
    protected function getRegistrationIds()
    {
        return is_array($this->to) ? $this->to : null;
    }

    /**
     * get Options transformed.
     *
     * @return array
     */
    protected function getOptions()
    {
        $extra = [];
        $options = $this->options ? $this->options->toArray() : [];

        if ($this->topic && !$this->topic->hasOnlyOneTopic()) {
            $options = array_merge($options, $this->topic->build());
        }
        $apns = [];
        if(count($options)){

            if (isset($options['badge'])) {
                $apns["badge"] = $options['badge'];          
            }
            if (isset($options['mutable-content'])) {
                $apns["mutable-content"] = $options['mutable-content'];           
            }
            if (isset($options['sound'])) {
                $apns["sound"] = $options['sound'];
            }
            if (isset($options['content-available'])) {
                $apns["content-available"] = $options['content-available'] ? 1 : 0;
                unset($options['content-available']);
            }

           // $extra["android"] = $options;
        }

        if(count($apns)){
            $extra["apns"] =[
                "payload" =>[
                    "aps" => $apns
                ]
            ];
        }

        return $extra;
    }

    /**
     * get notification transformed.
     *
     * @return array|null
     */
    protected function getNotification()
    {
        return $this->notification ? $this->notification->toArray() : null;
    }

    /**
     * get data transformed.
     *
     * @return array|null
     */
    protected function getData()
    {
        return $this->data ? $this->data->toArray() : null;
    }
}
