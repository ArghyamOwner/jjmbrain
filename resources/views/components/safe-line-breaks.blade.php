<?php

@props(['content'])

@foreach(explode(PHP_EOL, $content) as $line)
    {{ $line }} <br>
@endforeach


// Usage
// <x-safe-line-breaks :content="$description"/>
