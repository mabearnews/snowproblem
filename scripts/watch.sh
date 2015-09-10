#!/bin/bash


type -P compass &>/dev/null  || { echo "Compass command not found."; exit 1; }
type -P coffee &>/dev/null  || { echo "Coffee command not found."; exit 1; }


# change directory
cd '../'

compass watch &

coffee --watch --output js --compile coffee &

trap "kill -TERM -$$" SIGINT

wait
