<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index (){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = env ('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env ('MOVIE_DB_API_KEY');
        $MAX_BANNER = 3;
        $MAX_MOVIE_ITEM = 10;
        $MAX_TV_ITEM = 10;

        //hit api banner

        $bannerResponse = Http::get("{$baseUrl}/movie/popular",['api_key' => $apiKey,]);

        //siapkan variable

        $bannerArray = [];

        //check response

        if($bannerResponse->successful()){  
            $resultArray = $bannerResponse->object()->results;
        }
            if(isset($resultArray)){ 
                foreach($resultArray as $item){  
                    //save respon di bannar array
                    array_push( $bannerArray, $item);

                    //max ambil banner
                    if(count($bannerArray) == $MAX_BANNER){
                        break;
                    }
                }

            }
        
        //hit api movie

        $getMovieResponse = Http::get("{$baseUrl}/movie/top_rated",['api_key' => $apiKey,]);

        $topMovieArray = [];
        //check response
        if ($getMovieResponse->successful()) {
            $resultArray = $getMovieResponse->object()->results;
            foreach($resultArray as $item){  
                //save respon di bannar array
                array_push( $topMovieArray, $item);

                //max ambil banner
                if(count($topMovieArray   ) == $MAX_MOVIE_ITEM){
                    break;
                }
            }
        }

         //hit api tv

        $getTVResponse = Http::get("{$baseUrl}/tv/top_rated",['api_key' => $apiKey,]);
        //check response
        $topTVArray = [];

        if ($getTVResponse->successful()) {
            $resultArray = $getTVResponse->object()->results;
            foreach($resultArray as $item){  
                //save respon di bannar array
                array_push( $topTVArray, $item);

                //max ambil banner
                if(count($topTVArray) == $MAX_TV_ITEM){
                    break;
                }
            }

        }
        

        return view('home',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'banner' => $bannerArray,
            'topMovie' => $topMovieArray,
            'topTV' => $topTVArray,
            

        ]);
    }
    public function movies (){
        $baseUrl = env('MOVIE_DB_BASE_URL');
        $imageBaseUrl = env ('MOVIE_DB_IMAGE_BASE_URL');
        dd($imageBaseUrl);
        $apiKey = env ('MOVIE_DB_API_KEY');
        $sortBy = 'popularity.desc';
        $page = 1;
        $minimalVote =100;
        $MovieResponse = Http::get("{$baseUrl}/discover/movie",[
            'api_key' => $apiKey,
            'sort_by' => $sortBy,
            'page' => $page,
            'vote_count.gte' => $minimalVote,
        ]);

        $movieArray = [];
        //check response
        if ($MovieResponse->successful()) {
            $resultArray = $MovieResponse->object()->results;
            foreach($resultArray as $item){  
                //save respon di bannar array
                array_push( $movieArray, $item);
            }
        }
        return view('movie',[
            'baseUrl' => $baseUrl,
            'imageBaseUrl' => $imageBaseUrl,
            'apiKey' => $apiKey,
            'movies' => $movieArray,
            'sortBy' => $sortBy,
            'page' => $page,
            'minimalVote' => $minimalVote,
        ]);
    }
}
