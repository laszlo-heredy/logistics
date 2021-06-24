#!/bin/bash

echo Make sure brew and Docker are installed on machine please. Starting in a few seconds...
sleep 3

docker run -i -t -p "80:80" -v ${PWD}/app:/app -v ${PWD}/mysql:/var/lib/mysql mattrayner/lamp:latest &

echo This might take some time. Waiting 60 seconds.
sleep 30
echo 30 seconds to go
sleep 30
echo ok here goes nothing!

curl localhost
