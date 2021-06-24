#!/bin/bash

echo Make sure brew and Docker are installed on machine please. Starting in a few seconds...
sleep 3

docker run -p "80:80" -v ${PWD}/app:/app mattrayner/lamp:latest-1804 &

echo This might take some time. Waiting 30 seconds.
sleep 15
echo 15 seconds to go
sleep 15
echo ok here goes nothing!
echo ...
echo ...
echo
echo $ curl localhost

curl localhost

echo
echo Done.
echo
echo Type curl localhost to run again.
