# stream-with-obs-to-reddit-rpan
Stream video to reddit rpan using a computer.
A script that creates a stream key for reddit rpan. To stream with OBS or other rtmp based video streaming software.

## How to use
On linux or mac run stream.command it will open your browser and ask you to authorize with reddit, ask for a subredit and a stream title. After you do those things press "start stream" and a stream will be created and the stream key will be given you you. Copy the stream key in to OBS and start streaming.

## OBS settings
server: rtmp://ingest.redd.it/inbound

broadcast_height: 854

broadcast_width: 480


## Requirements
curl and php. OSX has those included from Apple so there is no need to install anything. On linux you will have to install those two pices of software.
