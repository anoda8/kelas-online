<?php

namespace App\Events;

use App\Models\Komentar;
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

    public $komentar;
    public $user;
    public $kelonid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Komentar $komentar)
    {
        $this->komentar = $komentar;
        $this->kelonid = $komentar->kelon_id;
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
