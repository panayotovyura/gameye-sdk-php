<?php

namespace Gameye\Test;

use Gameye\SDK\GameyeClient;

final class GameyeMock
{
    private function __construct()
    {
    }
 
    public function mockGame()
    {
        return json_decode('
{
    "game": {
        "csgo": { "gameKey": "csgo", "location": {} },
        "tf2": { "gameKey": "tf2", "location": {} },
        "css": { "gameKey": "css", "location": {} },
        "l4d2": { "gameKey": "l4d2", "location": {} },
        "kf2": { "gameKey": "kf2", "location": {} },
        "test": { "gameKey": "test", "location": { "100": true } }
    },
    "location": {
        "1": { "locationKey": 1, "locationName": "Rotterdam" },
        "2": { "locationKey": 2, "locationName": "Ireland" },
        "3": { "locationKey": 3, "locationName": "Dubai" },
        "4": { "locationKey": 4, "locationName": "Tokyo" },
        "5": { "locationKey": 5, "locationName": "Los Angeles" },
        "6": { "locationKey": 6, "locationName": "Washington DC" },
        "100": { "locationKey": 100, "locationName": "Local" }
    }
}
');
    }
 
    public function mockMatch()
    {
        return json_decode('
{
    "match": {
        "test-match-123": {
            "created": 1518191338368,
            "gameKey": "test",
            "host": "127.0.0.1",
            "locationKey": 100,
            "matchKey": "test-match-123",
            "port": {
                "game": 57015,
                "tv": 57025
            }
        },
        "test-match-456": {
            "created": 1518191339368,
            "gameKey": "testing",
            "host": "127.0.0.1",
            "locationKey": 100,
            "matchKey": "test-match-456",
            "port": {
                "game": 67015,
                "tv": 67025
            }
        }
    }
}
');
    }
 
    public function mockTemplate()
    {
        return json_decode('
{
    "template": {
        "t1": {
            "templateKey": "t1",
            "arg": [{
                "name": "tickRate",
                "type": "number",
                "defaultValue": 64,
                "option": [64, 128]
            }]
        },
        "t2": {
            "templateKey": "t2",
            "arg": [{
                "name": "steamToken",
                "type": "string",
                "defaultValue": ""
            }, {
                "name": "hostname",
                "type": "string",
                "defaultValue": "gameye.com Match Server"
            }]
        }
    }
}
');
    }
}
