#!/bin/bash

cd ../.. # Move outside of the snowproblem folder

if [ -d "snowproblem_temp" ]; then
   echo "snowproblem_temp already exists, sadly"
else
    rm snowproblem.zip

    cp -r ./snowproblem ./snowproblem_temp

    # Remove non esential elements.
    rm -rf ./snowproblem_temp/coffee
    rm -rf ./snowproblem_temp/sass
    rm -rf ./snowproblem_temp/scripts
    rm -rf ./snowproblem_temp/.sass-cache
    rm -rf ./snowproblem_temp/.git

    zip -r snowproblem.zip ./snowproblem_temp

    rm -rf ./snowproblem_temp
fi
