#!/usr/bin/env bash

WORKING_DIR=$PWD/laradock
ENV_FILE=$PWD/.env
LARADOCK_URL=https://github.com/Laradock/laradock.git

# install any required dependencies
function install_deps(){
    COMPOSER_COMMAND=`composer install`
    NPM_COMMAND=`npm install`
    exit 0
}

# execute other things
function execute(){
    # check if .env exists. we should copy the file only if it doesn't exist
    if [ ! -f $PWD/.env ]; then
        echo "copying .env.example to .env..."
        cp $PWD/.env.example $PWD/.env
    fi

    if [[ ! -d ${WORKING_DIR} ]]; then
       echo "cloning laradock from ${LARADOCK_URL}"
       git submodule update --init
    fi

    # check if .env exists. we should copy the file only if it doesn't exist
    if [ ! -f $WORKING_DIR/.env ]; then
        echo "copying $WORKING_DIR/env-example to $WORKING_DIR/.env..."
        cp $WORKING_DIR/env-example $WORKING_DIR/.env
    fi

    # run nginx, mysql
    cd ${WORKING_DIR} && docker-compose up -d nginx mysql

    exit 0
}

function check_windows(){
    os=`uname`
    if [[ "$os" == 'Linux' ]]; then
       echo 1;
    elif [[ "$os" == 'MINGW64_NT-10.0' ]]; then
       echo 2;
    fi
}

function login_to_workspace(){
    echo "logging you into the docker workspace..."
    if [[ $(check_windows) -eq 2 ]]; then
        cd ${WORKING_DIR} && winpty docker-compose exec --user=laradock workspace bash
        exit 0
    else
        cd ${WORKING_DIR} && docker-compose exec --user=laradock workspace bash
        exit 0
    fi
}

function login_root(){
    # note that this logs you in as root
    echo "logging you into the docker workspace..."
    if [[ $(check_windows) -eq 2 ]]; then
        cd ${WORKING_DIR} && winpty docker-compose exec workspace bash
        exit 0
    else
        cd ${WORKING_DIR} && docker-compose exec workspace bash
        exit 0
    fi
}

function login_to_mysql(){
    # mysql
    if [[ $(check_windows) -eq 2 ]]; then
        cd ${WORKING_DIR} && winpty docker-compose exec mysql bash
        exit 0
    else
        cd ${WORKING_DIR} && docker-compose exec mysql bash
        exit 0
    fi
}

function stop(){
    # nothing much. for now just stops all containers
    cd ${WORKING_DIR} && docker-compose down
    echo "All containers have been stopped."
    exit 0
}

while [ $# -ne 0 ]
do
    arg="$1"
    case "$arg" in
        deps)
            install_deps
            ;;
        setup)
            execute
            ;;
        up)
            execute
            ;;
        bash)
            login_to_workspace
            ;;
        bash-root)
            login_root
            ;;
        mysql)
            login_to_mysql
            ;;
        down)
            stop
            ;;

    esac
    shift
done

echo "====Usage===="
echo "1. deps => Install project dependencies (npm, composer)"
echo "2. setup => Setup required docker containers (pulls the docker containers - currently hardcoded to nginx, mysql, phpmyadmin, redis, beanstalkd)"
echo "3. up => Start all required docker containers"
echo "4. bash => Login to the docker workspace container"
echo "5. bash-root => Login to the docker workspace container as root user"
echo "6. mysql => Logs in to the docker container, to allow you to run mysql on the command line"
echo "7. down => Stops all docker containers"
