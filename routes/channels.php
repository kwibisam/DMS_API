<?php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('document.{id}', function ($user, $id) {
    Log::info("document event");
    return (int) $user->id === (int) $id;
});
