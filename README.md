# Canoe Interview Test

In your web browser, navigate to <http://localhost> to start the example.

## Installation

use `git clone` to copy this code to a directory of your choice; I use ~/Projects/canoe

`cd canoe` and perform a `git submodule update --init` command to get the files for docker

copy the `./laradock/env-example` to the `./laradock/.env` and make any modifications for your system
 
copy the `./.env.example` to `./.env` for a corresponding environment which laravel can use with laradock

`cd laradock` and `docker-compose up -d nginx mysql` to start the docker container 

`docker-compose exec --user=laradock workspace bash` to enter the docker workspace container and perform a 
`php artisan migrate:fresh --seed`

I pre compiled the javascript assets, but if you want to run the compiler you can run 
`yarn` and `yarn dev` to recompile the assets.

That's it, if you kept the default configurations you can access the example from <http://localhost:80>

## Caveats

Sometimes docker gets mixed up on a dev machine due to the amount of images or especially the mysql volume can become weird.
I suggest a `docker system prune`, see the documentation <https://docs.docker.com/engine/reference/commandline/system_prune/> 
for more detail on how to use that tool. 
