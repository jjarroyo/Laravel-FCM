<?php

namespace LaravelFCM\Message;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class Options.
 */
class Options implements Arrayable
{
    /**
     * @internal
     *
     * @var null|string
     */
    protected $collapseKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $priority;

    /**
     * @internal
     *
     * @var bool
     */
    protected $contentAvailable;

    /**
     * @internal
     *
     * @var bool
     */
    protected $isMutableContent = false;

    /**
     * @internal
     *
     * @var bool
     */
    protected $delayWhileIdle;

    /**
     * @internal
     *
     * @var int|null
     */
    protected $timeToLive;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $restrictedPackageName;

    /**
     * @internal
     *
     * @var bool
     */
    protected $isDryRun = false;

        /**
     * @internal
     *
     * @var null/string
     */
    protected $channelId;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $icon;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $sound;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $badge;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $tag;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $color;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $clickAction;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationArgs;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $titleLocationKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $titleLocationArgs;

    /**
     * Options constructor.
     *
     * @param OptionsBuilder $builder
     */
    public function __construct(OptionsBuilder $builder)
    {
        $this->collapseKey = $builder->getCollapseKey();
        $this->priority = $builder->getPriority();
        $this->contentAvailable = $builder->isContentAvailable();
        $this->isMutableContent = $builder->isMutableContent();
        $this->delayWhileIdle = $builder->isDelayWhileIdle();
        $this->timeToLive = $builder->getTimeToLive();
        $this->restrictedPackageName = $builder->getRestrictedPackageName();
        $this->isDryRun = $builder->isDryRun();
        $this->channelId = $builder->getChannelId();
        $this->icon = $builder->getIcon();
        $this->sound = $builder->getSound();
        $this->badge = $builder->getBadge();
        $this->tag = $builder->getTag();
        $this->color = $builder->getColor();
        $this->clickAction = $builder->getClickAction();
        $this->bodyLocationKey = $builder->getBodyLocationKey();
        $this->bodyLocationArgs = $builder->getBodyLocationArgs();
        $this->titleLocationKey = $builder->getTitleLocationKey();
        $this->titleLocationArgs = $builder->getTitleLocationArgs();
    }

    /**
     * Transform Option to array.
     *
     * @return array
     */
    public function toArray()
    {
        $contentAvailable = $this->contentAvailable ? true : null;
        $mutableContent = $this->isMutableContent ? true : null;
        $delayWhileIdle = $this->delayWhileIdle ? true : null;
        $dryRun = $this->isDryRun ? true : null;

        $options = [
            'collapse_key' => $this->collapseKey,
            'priority' => $this->priority,
            'content-available' =>$contentAvailable,
            'mutable-content' => $mutableContent,
            'delay_while_idle' => $delayWhileIdle,
            'ttl' => $this->timeToLive,
            'restricted_package_name' => $this->restrictedPackageName,
            'dry_run' => $dryRun,            
            'channel_id' => $this->channelId,
            'icon' => $this->icon,
            'sound' => $this->sound,
            'badge' => $this->badge,
            'tag' => $this->tag,
            'color' => $this->color,
            'click_action' => $this->clickAction,
            'body_loc_key' => $this->bodyLocationKey,
            'body_loc_args' => $this->bodyLocationArgs,
            'title_loc_key' => $this->titleLocationKey,
            'title_loc_args' => $this->titleLocationArgs,
        ];

        return array_filter($options);
    }
}
