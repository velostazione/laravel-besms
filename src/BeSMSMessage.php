<?php

namespace Velostazione\Laravel\BeSMS;

final class BeSMSMessage
{
    public string $content;

    public string|null $sender;

    public function __construct(string $content = '', string $sender = null)
    {
        $this->content = $content;
        $this->sender = $sender;
    }

    public function content(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function sender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
