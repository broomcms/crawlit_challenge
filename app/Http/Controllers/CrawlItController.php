<?php

namespace App\Http\Controllers;


use DOMDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\HelpersController;
class CrawlItController extends Controller
{

    /**
     * home()
     * This is juste a function to return the homepage view to the user
     *
     * @return void
     */
    public function home(){
        return view("home");
    }

    /**
     * crawl()
     * Main crawler function called by AJAX
     *
     * @param Request $request
     * @return JSON
     */
    public function crawl(Request $request){
        
        // Get the starting page http code
        if (HelpersController::getHeaders($request->url)=="200"){
            // We are good to go and can crawl this website

            // Get the HTML for the starting page
            $start = HelpersController::getHTML($request->url);

            // Get word count
            $words = HelpersController::wordCount($start['html']);
            $totalWords = 0;
            foreach ($words as $key=>$word) {
                $totalWords += $word;
            }

            // Get data for the starting page
            $links = array(array(
                    "pageTitle" => (HelpersController::getTitle($start['html'])?HelpersController::getTitle($start['html']):$request->url),
                    "linkTitle"=> "",
                    "href" => $request->url,
                    "code" => HelpersController::getHeaders($request->url),
                    "int_ext" => "int",
                    "time" => round($start['time'],3),
                    "html" => base64_encode($start['html']),
                    "img" => HelpersController::getImages($start['html']),
                    "img_count" => count(HelpersController::getImages($start['html'])),
                    "word_count" => count($words),
                    "words" => $words,
                    "total_words"=> $totalWords
                )
            );

            // Check how many links we need to capture 
            // We remove one cause we obiously started with 1 url already
            $max = $request->pages -1;

            // Get all links from this HTML & build sub page data
            if ($max>=1){
                $links_found = HelpersController::hrefCrawl($start['html'], $request->url, $request->pages);
                $links = array_merge($links, $links_found);
            }

            $wordArray = array();
            $imgArray = array();
            $uimgArray = array();
            $sumTitle = "0";
            $titleCount = 0;

            // We count how many links are internal and how many are external
            foreach($links as $key=>$link){

                // Lets add the missing link data to the array
                $count = HelpersController::hrefCount(base64_decode($link['html']), $link['href']);
                $links[$key]['int_count'] = count($count['int']);
                $links[$key]['int_links'] = $count['int'];
                $links[$key]['ext_count'] = count($count['ext']);
                $links[$key]['ext_links'] = $count['ext'];

                // Lets rebuild a globolized array of words
                $k=0;
                foreach($link['words'] as $key=>$value){
                    $keyFilter = array_search($key, $wordArray);
                    if ($keyFilter){
                        $wordArray[$keyFilter]['used'] = $value + $wordArray[$keyFilter]['used'];
                    }else{
                        $wordArray[$k]["word"] = $key;
                        $wordArray[$k]["used"] = $value;
                    }
                    $k++;
                }

                // Lets rebuild a globolized array of images
                $total_uimages=0;
                foreach($link['img'] as $key=>$value){
                    $uimgArray[] = $value;
                    $total_uimages++;
                }

                $total_images=0;
                foreach($link['img'] as $key=>$value){
                    $keyFilter = array_search($value, $imgArray);
                    if (!$keyFilter){
                        $imgArray[$total_images] = $value;
                    }
                    $total_images++;
                }

                // Title lenght
                if (isset($link['pageTitle'])&&$link['pageTitle']!=""){
                    $sumTitle = $sumTitle + strlen($link['pageTitle']);
                    $titleCount++;
                }

            }

            //Now that we have perpage stats lets get some over all stats as well
            //Get all links
            $out['res']['href'] = array_unique(array_column($links, 'href'));
            $out['res']['img'] =  $imgArray;
            $out['res']['img_count'] =  count($imgArray);
            $out['res']['img_sum'] =  $total_images;
            $out['res']['img_avr'] =  count($imgArray)/$request->pages;
            $out['res']['uimg'] =  $uimgArray;
            $out['res']['uimg_count'] =  count($uimgArray);
            $out['res']['uimg_avr'] =  count($uimgArray)/$request->pages;
            $out['res']['title_count'] =  $titleCount;
            $out['res']['title_avr'] =  $sumTitle/$titleCount;
            $out['res']['words'] = $wordArray;
            $out['data'] = $links;       
            
            // Return json back to the browser
            return response()->json(HelpersController::datatableOutput($out));

        }

    }

}
