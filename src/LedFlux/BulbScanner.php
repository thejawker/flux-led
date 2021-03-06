<?php

namespace TheJawker\ControlStuff\LedFlux;

use TheJawker\ControlStuff\Socket;

class BulbScanner
{
    /**
     * The message that gets broadcasted.
     *
     * @var string
     */
    const MESSAGE = 'HF-A11ASSISTHREAD';

    /**
     * A list of the Discovered lights.
     *
     * @var array
     */
    public $discoveredLights = [];

    /**
     * Starts scanning the network and discovering devices.
     *
     * @param int $timeout
     * @return array
     */
    public function scan(int $timeout = 1): array
    {
        $socket = new Socket();
        $socket->timeout = $timeout;
        $socket->broadcast(self::MESSAGE, function ($data) {
            $this->addLight($data);
        });

        return $this->discoveredLights;
    }

    /**
     * Adds the Light to the list.
     *
     * @param $data
     */
    private function addLight($data)
    {
        [$ip, $id, $model] = $response = explode(',', $data, 3);

        if (count($response) < 3) {
            return;
        }

        $this->discoveredLights[$id] = [
            'ip' => $ip,
            'id' => $id,
            'model' => $model
        ];
    }
}