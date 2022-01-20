<?php

namespace App\Http\Controllers;

use DOMDocument;
use Illuminate\Http\Request;

class HelpersController extends Controller
{
    /**
     * wordCount()
     * Not 100% accurate but it's a start. With time, I could review this function and get a better output of words
     * 
     * @param [string] $html
     */
    public static function wordCount($html){

        // Get rid of style, script etc
        $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
                '@<head>.*?</head>@siU',            // Lose the head section
                '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
        );

        // This function could defenetly be improved for accuracy but it's still a good start for this challenge

        $contents = preg_replace($search, '', $html); 
        $result = array_count_values(str_word_count(strip_tags($contents), 1));

        return $result;

    }

    /**
     * datatableOutput()
     * Retuns the expected achitechture of the array for datatable
     *
     * @param [array] $array
     * @return void
     */
    public static function datatableOutput($array){

        foreach($array['data'] as $key=>$line){
            $output[] = [
                $line['href'],
                $line['code'],
                $line['time'],
                $line['img_count'],
                $line['int_count'],
                $line['ext_count'],
                $line['word_count'],
                $line['total_words'],
                $line['img']
            ];
        }

        return array('data'=> $output,'res'=> $array['res']);
    }

    /**
     * getHTML()
     * Return the HTML of a remote URL
     * 
     * @param [string] $url
     * @return void
     */
    public static function getHTML($url){
        $time_start = microtime(true); 
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $output["html"] = curl_exec($curl);
        curl_close($curl);
        $time_end = microtime(true);
        $output["time"] = round(($time_end - $time_start), 3);
        return $output;
    }

    /**
     * getHeaders()
     * Returns the HTTP code of a URL
     *
     * @param [string] $url
     * @return void
     */
    public static function getHeaders($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);    // we want headers
        curl_setopt($curl, CURLOPT_NOBODY, true);    // we don't need body
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_TIMEOUT,10);
        $output = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return ($httpcode?$httpcode:false);
    }

    /**
     * hrefCrawl()
     * Search and find href links in HTML and crawl them up to $max
     *
     * @param [string] $html
     * @param [string] $startURL
     * @param [int] $max
     * @return $extractedLinks array()
     */
    public static function hrefCrawl($html, $startURL, $max){

        // Retreive info on the start URL to fix links we retreive
        $parseStart = parse_url($startURL);
        $baseStart = $parseStart["scheme"].'://'.$parseStart["host"];

        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($html);

        //Extract the links from the HTML.
        $links = $htmlDom->getElementsByTagName('a');
        $extractedLinks = array();

        //Loop through the DOMNodeList.
        $i = 1;
        foreach($links as $link){

            // Only scan for the number of pages asked for
            if ($i>=$max){
                continue;
            }else{

                // No duplicates
                if (!in_array($link, $extractedLinks)){

                    $linkText = $link->nodeValue;
                    $linkHref = $link->getAttribute('href');

                    //If the link is empty, skip it and don't
                    //add it to our $extractedLinks array
                    if(strlen(trim($linkHref)) == 0){
                        continue;
                    }

                    //Skip if it is a hashtag / anchor link.
                    if($linkHref[0] == '#'){
                        continue;
                    }

                    // Fixing links
                    // Check if link is missing the base URL
                    $parseCurrent = parse_url($linkHref);
                    if (!isset($parseCurrent["scheme"])||!isset($parseCurrent["host"])){
                        $linkHref = $baseStart.$parseCurrent["path"];
                        $parseCurrent = parse_url($linkHref);
                    }

                    // Skip if the link is equal to the starting URL
                    // Compare with out trailing slashes
                    if(rtrim($linkHref, '/') == rtrim($startURL, '/')){
                        continue;
                    }

                    $code = HelpersController::getHeaders($linkHref);
                    $currentHTML = HelpersController::getHTML($linkHref);

                    // Get word count
                    $words = HelpersController::wordCount($currentHTML['html']);
                    $totalWords = 0;
                    foreach ($words as $key=>$word) {
                        $totalWords += $word;
                    }

                    //Add the link to our $extractedLinks array.
                    $extractedLinks[] = array(
                        'pageTitle' => HelpersController::getTitle($currentHTML['html']),
                        'linkTitle'=> trim(preg_replace("/\s+/"," ",$linkText)),
                        'href' => $linkHref,
                        'code' => $code,
                        'int_ext' => ($parseCurrent["host"]==$parseStart["host"]?"int":"ext"),
                        'time' => round($currentHTML['time'],3),
                        'html' => base64_encode($currentHTML['html']),
                        "img" => HelpersController::getImages($currentHTML['html']),
                        "img_count" => count(HelpersController::getImages($currentHTML['html'])),
                        "word_count" => count($words),
                        "words" => $words,
                        "total_words"=> $totalWords
                    );


                }

                $i++;
            }

        }

        return $extractedLinks;
    }

    /**
     * hrefCount()
     * 
     * @param [string] $html
     * @param [string] $startURL
     * @return $extractedLinks array()
     */
    public static function hrefCount($html, $startURL){

        // Retreive info on the start URL to fix links we retreive
        $parseStart = parse_url($startURL);
        $baseStart = $parseStart["scheme"].'://'.$parseStart["host"];

        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($html);

        //Extract the links from the HTML.
        $links = $htmlDom->getElementsByTagName('a');
        $extractedLinks = array();

        //Loop through the DOMNodeList.
        $i = 1;
        foreach($links as $link){

            // No duplicates
            if (!in_array($link, $extractedLinks)){

                $linkHref = $link->getAttribute('href');

                //If the link is empty, skip it and don't
                //add it to our $extractedLinks array
                if(strlen(trim($linkHref)) == 0){
                    continue;
                }

                //Skip if it is a hashtag / anchor link.
                if($linkHref[0] == '#'){
                    continue;
                }

                // Fixing links
                // Check if link is missing the base URL
                $parseCurrent = parse_url($linkHref);
                if (!isset($parseCurrent["scheme"])||!isset($parseCurrent["host"])){
                    $linkHref = $baseStart.$parseCurrent["path"];
                    $parseCurrent = parse_url($linkHref);
                }

                // Skip if the link is equal to the starting URL
                // Compare with out trailing slashes
                if(rtrim($linkHref, '/') == rtrim($startURL, '/')){
                    continue;
                }

                //Add the link to our $extractedLinks array.
                $extractedLinks[($parseCurrent["host"]==$parseStart["host"]?"int":"ext")][] = array(
                    'href' => $linkHref
                );

            }

            $i++;

        }

        return $extractedLinks;
    }

    /**
     * getTitle()
     * Returns the content found in a <title> tag
     *
     * @param [string] $html
     * @return string | false
     */
    public static function getTitle($html){
        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($html);
        
        $list = $htmlDom->getElementsByTagName("title");
        if ($list->length > 0) {
            return trim(preg_replace("/\s+/"," ",$list->item(0)->textContent));
        }
     
        return false;
    }

    /**
     * getImages()
     * Returns image info found in HTML
     * 
     * @param [string] $html
     * @return $img array
     */
     public static function getImages($html){

        $img = array();
        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($html);

        //Extract the links from the HTML.
        $tags = $htmlDom->getElementsByTagName('img');

        foreach ($tags as $tag) {
            if (!in_array($tag->getAttribute('src'), $img) && $tag->getAttribute('src')!=""){
                $img[] = $tag->getAttribute('src');
            }
        }

        return $img;
     }
}