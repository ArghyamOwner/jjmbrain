<?php

namespace App\Traits;

trait WithSlideover
{
    public $show = false;

    protected function getListeners()
    {
        return array_merge($this->listeners, [
            self::getSlideoverEventName() => 'toggle'
        ]);
    }

    public static function getSlideoverEventName()
    {
        return class_basename(static::class) . '.slideover.toggle';
    }

    public function toggle()
    {
        $this->resetErrorBag();
        $this->show = ! $this->show;
    }

    public function open()
    {
        $this->resetErrorBag();
        $this->show = true;
    }

    public function close()
    {
        $this->resetErrorBag();
        $this->show = false;
    }
}
