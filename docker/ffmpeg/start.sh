#!/bin/bash
# Aguarda o Icecast subir
sleep 5

# Stream de música contínuo
ffmpeg -re -stream_loop -1 -i "/playlist/gta-sa/K-DST_ADS_FULL.mp3" \
-c:a libmp3lame -b:a 128k -ar 44100 -ac 2 \
-id3v2_version 3 -write_id3v1 1 -f mp3 \
icecast://source:OnAtIVeRonfLOwlI@icecast:8000/stream.mp3

