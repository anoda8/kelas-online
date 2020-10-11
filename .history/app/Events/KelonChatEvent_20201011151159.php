<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KelonChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pesan;
    public $user;
    public $kelonid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($pesan, User $user, $kelonid)
    {
        $this->pesan = $pesan;
        $this->user = $user->name;
        $this->kelonid = $kelonid;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('kelonChat' . $this->kelonid);
    }

    // public function broadcastAs()
    // {
    //     return 'pesan-kelon-' . $this->kelonid;
    // }
}
