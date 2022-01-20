<p align="center"><a href="https://agencyanalytics.com/" target="_blank"><img src="https://yt3.ggpht.com/pSA2H36bm63MQA24wuZBx_JMj0vZgKzpvjsx6WS8NSwqNT1kLamMW1XoM4BOMpz5-Faiy8pPTQ=s900-c-k-c0x00ffffff-no-rj" height="150"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

# What is this?
Hey guys! I just received an onboarding challenge from Agency Analytics. This is my solution! In order to get this challenge going, I created a docker box. Been using it for a while and really like it's simplicity. For this challenge, I decided to create a bootstrap frontend website where the user can submit a URL and a number of pages to crawl. The request in then send by AJAX using jQuery to a server side PHP script. It receives the information and send back a JSON payload. I am using a Laravel 8 framework for this project on a PHP 8 nginx server. Please refer yourself to this readme for a full explanation on how it works.

<p align="center">
<iframe width="560" height="315" src="https://www.youtube.com/embed/-O5fir17sIk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</p>

## About This challenge

Using PHP, build a web crawler to display information about a given website.
Crawl 4-6 pages of our website agencyanalytics.com given a single entry point. Once
the crawl is complete, display the following results:

 - Number of pages crawled
 - Number of a unique images
 - Number of unique internal links
 - Number of unique external links
 - Average page load in seconds
 - Average word count
 - Average title length

Also display a table that shows each page you crawled and the HTTP status code
Deploy to a server that can be accessed over the internet. You can use any host of
your choosing such as AWS, Google Cloud, Heroku, Azure etc. Be sure to include the
url in your submission.

## Docker Information

I created a very nice docker setup for this challenge. It's composed of 2 containers.

 - Container 1: webserver I will be using nginx for my webserver. This container will host the website configurations and will forward port 80 to 3000 we can than use that port to access the website. This container is setup at : http://localhost:3000

 - Container 2: php-fpm This container is used to host the php environment and server setup. I will be using PHP8. There’s no direct access required but if you ever need to do a server side command you can use this container to do it.

I created a network called crawlitchallenge. All container within that network can talk to each other using their container names.

## Environment setup instructions

Repository and Docker setup

    mkdir crawlit
    cd crawlit
    git clone git@github.com:broomcms/crawlit_challenge.git ./
    docker-compose up -d --build

Enter the PHP FPM container and type the following

    chmod -R 0777 storage
    mv "example.env" ".env"

You should now have access to http://localhost:3000

## Deploy (minimal DevOps settings)

I am using a very nice deploy tool to send this repo to production in a DevOps maner.
At the root of this repo, you will find a file called deploy.php You can edit that file to fit your needs.

Once edited, use the following to deploy

    dep deploy prod
    
This will deploy the repo to the remote server and take care of taking the last 5 states of the app using symlinks. I use these tools for small projects where I want to automate as much as possible the production process.

## Project flow

<p align="center">
<img src="https://user-images.githubusercontent.com/63425041/150263488-72e551b7-e860-499b-b484-3742ca4b0a30.png">
</p>

 - The user submits a payload with "URL to scan" and "Number of pages to scan"
 - The payload is sent to the CrawIfController at the crawl() function
 - The crawl function will then build and array of data and send it back to the ajax request in JSON format
 - If successful, the user view will change to the report page by itself

 ## Project highlights

 - Added docker to the project with a 2 containers network setup (PHP8 + nginx)
 - Added bootstrap to the project for the user frontend (Website is responsive)
 - Used jQuery and Ajax to receive a JSON payload from the backend
 - Created nice clean code and left comments
 - Created a nice readme file
 - Explained how to reproduce the solution and how it works

## Project screenshots

<p align="center">
<a href="https://user-images.githubusercontent.com/63425041/150263692-69c324b0-5765-4690-97a9-d1f25db1d0f4.png" target="_blank"><img src="https://user-images.githubusercontent.com/63425041/150263692-69c324b0-5765-4690-97a9-d1f25db1d0f4.png" height="250"></a> <a href="https://user-images.githubusercontent.com/63425041/150263762-3bb1eb62-0773-40ef-b040-4eb49cd91f88.png" target="_blank"><img src="https://user-images.githubusercontent.com/63425041/150263762-3bb1eb62-0773-40ef-b040-4eb49cd91f88.png" height="250"></a> <a href="https://user-images.githubusercontent.com/63425041/150263816-0bb1d9ef-f0bd-4206-acf0-08eba8f89329.png" target="_blank"><img src="https://user-images.githubusercontent.com/63425041/150263816-0bb1d9ef-f0bd-4206-acf0-08eba8f89329.png" height="250"></a>
</p>
