<p align="center"><a href="https://agencyanalytics.com/" target="_blank"><img src="https://yt3.ggpht.com/pSA2H36bm63MQA24wuZBx_JMj0vZgKzpvjsx6WS8NSwqNT1kLamMW1XoM4BOMpz5-Faiy8pPTQ=s900-c-k-c0x00ffffff-no-rj" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
</p>

# What is this?
Hey guys! I just received an onboarding challenge from Agency Analytics. This is my solution! In order to get this challenge going, I created a docker box. Been using it for a while and really like it's simplicity. For this challenge, I decided to create a bootstrap frontend website where the user can submit a URL and a number of pages to crawl. The request in then send by AJAX using jQuery to a server side PHP script. It receives the information and send back a JSON payload. I am using a Laravel 8 framework for this project on a PHP 8 nginx server. Please refer yourself to this readme for a full explanation on how it works.
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

 - Container 2: php-fpm This container is used to host the php envirement and server setup. I will be using PHP8. Theres no direct access required but if you ever need to do a server side comand you can use this container to do it.

I created a network called crawlitchallenge. All containers withing that network can talk to each others using there container names.

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

## Project flow

 - The user submits a payload with "URL to scan" and "Number of pages to scan"
 - The payload is sent to the CrawIfController at the crawl() function
 - The crawl function will then build and array of data and send it back to the ajax request in JSON format
 - If successful, the user view will change to the report page by it self

 ## Project highlights

 - Added docker to the project
 - Added bootstrap to the project for the user frontend
 - Used jQuery and Ajax request to output the result to the view
 - Created nice clean code and left comments
 - Created a nice readme file to show that I can document when needed
 - Explained how to reproduce the solution and how it works