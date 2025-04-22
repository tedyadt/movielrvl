<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILMREK</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<link rel="icon" href="/path/to/favicon.ico" type="image/x-icon">
<script src="https://kit.fontawesome.com/69cc9ff7e6.js" crossorigin="anonymous"></script>

    @vite('resources/css/app.css')
</head>
<body>
    <div class="w-full h-auto min-h-screen flex flex-col">
        <!-- header -->
        @include('header')

        <div class="w-full h-[512px] flex flex-col relative bg-black">
            <!-- banner -->
                @foreach ($banner as $bannerItem)
                @php
                $imageBaseUrl = env('MOVIE_DB_BASE_IMAGE_URL');
                $bannerImage ="{$imageBaseUrl}/original{$bannerItem->backdrop_path}";
                @endphp
                <div class="flex flex-row items-center w-full h-full relative slide">
                    <img src="{{$bannerImage}}"class="absolute w-full h-full object-cover">
                    <!-- efek overlay -->
                    <div class="w-full h-full absolute bg-black bg-opacity-30"></div>
                    <!-- text judul -->
                    <div class="w-10/12 flex flex-col ml-32 z-10">
                        <span class="font-bold text-3xl font-inter text-white" >{{$bannerItem->title}}  </span>
                        <span class="font-inter text-sm text-white w-1/2 mt-1 line-clamp-2" >{{$bannerItem->overview}}</span>
                        <a href="/movie/{{ $bannerItem->id }}" class="w-fit bg-purple-700 text-white pl-2 pr-5 mt-4 py-3 font-inter text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg transition-shadow" >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-4 h-4 ml-2 mr-1" fill="white"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/></svg>

                        Details
                        
                        </a>
                    </div>
                </div>
                @endforeach
             <!-- next button -->
            <div class="absolute left-0 top-1/2 rotate-180 translate-y-0 w-1/12 flex justify-center" onclick="moveSlide(-1)">
                <button class="bg-white p-3 rounded-full opacity-25 hover:opacity-100 duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                </button>
                
            </div>

            <div class="absolute right-0 rotate top-1/2 translate-y-0 w-1/12 flex justify-center" onclick="moveSlide(1)">
                <button class="bg-white p-3 rounded-full opacity-25 hover:opacity-100 duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-6 h-6"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                    </button>
        
            </div>
            <!-- INDICATOR -->
            <div class="absolute bottom-0 w-full mb-8 bg ">
                
                <div class="w-full flex flex-row items-center justify-center">
                    @for($pos= 1 ;$pos <= count($banner); $pos++)
                    <div class="w-2 h-2 rounded-full mx-1 cursor-pointer dot" onclick ="currentSlide({{$pos}})"></div>
                    @endfor  
                    </div>
                </div>        
            </div>
            <!-- top 10 section movie -->
            <div class = "mt-7">
                <span class = "ml-28 font-inter font-bold text-[26px]">Top 10 Movies</span>


                <div class= "w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($topMovie as $movieitem)

                @php
                $original_date = $movieitem->release_date;
                $timestamp = strtotime($original_date);
                $movieYear = date('Y', $timestamp);

                $movieID = $movieitem->id;
                $movieTitle = $movieitem->title;   
                $movieRating = $movieitem->vote_average;
                $ratingPercentage = number_format($movieRating * 10, 0) . '%';
                $movieImage = "{$imageBaseUrl}/w500{$movieitem->poster_path}";  
                @endphp
                

                    <a href="movie/{{$movieID}}" class="group">
                        <div class = "min-w-[200px] h-[350px] bg-white drop-shadow group-hover:drop-shadow-2xl rounded-xl flex flex-col p-4 mr-8 duration-100">
                            <div class = "overflow-hidden rounded-xl">
                                <img class = "w-full h-[220px] rounded-xl group-hover:scale-110 duration-300"src="{{$movieImage}}" alt="">
                            </div>
                            <span class = "font-inter font-bold text-xl mt-3 line-clamp-1 group-hover:line-clamp-none">{{$movieTitle}}</span>
                            <span class = "font-inter text-sm mt-1">{{$movieYear}}</span>
                            <div class = "flex flex-row items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"class = "w-4 h-4" fill ="blue"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>

                                <span class = "font-inter text-sm ml-0.5">{{$ratingPercentage}}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
            </div>
            </div>

            <!-- top 10 section tv -->
            <div>
                <span class = "ml-28 font-inter font-bold text-[26px]">Top 10 TV Show</span>


                <div class= "w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
                @foreach ($topTV as $tvitem)

                @php
                $original_date = $tvitem->first_air_date;
                $timestamp = strtotime($original_date);
                $tvYear = date('Y', $timestamp);

                $tvID = $tvitem->id;
                $tvTitle = $tvitem->original_name;   
                $tvRating = $tvitem->vote_average;
                $ratingPercentagetv = number_format($tvRating * 10, 0) . '%';
                $tvImage = "{$imageBaseUrl}/w500{$tvitem->poster_path}";  
                @endphp
                    <a href="movie/{{$tvID}}" class="group">
                        <div class = "min-w-[200px] h-[350px] bg-white drop-shadow group-hover:drop-shadow-2xl rounded-xl flex flex-col p-4 mr-8 duration-100">
                            <div class = "overflow-hidden rounded-xl">
                                <img class = "w-full h-[220px] rounded-xl group-hover:scale-110 duration-300"src="{{$tvImage}}" alt="">

                            </div>
                            <span class = "font-inter font-bold text-xl mt-3 line-clamp-1 group-hover:line-clamp-none">{{$tvTitle}}</span>
                            <span class = "font-inter text-sm mt-1">{{$tvYear}}</span>
                            <div class = "flex flex-row items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"class = "w-4 h-4" fill ="blue"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>

                                <span class = "font-inter text-sm ml-0.5">{{$ratingPercentagetv}}</span>
                            </div>
                        </div>
                    </a> 
                @endforeach   
            </div>
            </div>

            <!-- footer -->
            @include('footer')


            <script>
                //slider function
                let slideindex = 1;
                showSlide(slideindex);
                
                function showSlide(position){   
                    let index;
                    const slides = document.getElementsByClassName('slide');
                    const dots = document.getElementsByClassName('dot');

                    if(position > slides.length){
                        slideindex = 1;
                    }

                    if (position < 1){
                        slideindex = slides.length;
                    }
                    //sembunyikan slides banner
                    for (let i = 0; i < slides.length; i++){
                        slides[i].classList.add('hidden');
                    }
                    //tampilkan slide
                    slides [slideindex - 1].classList.remove('hidden');

                    for(index = 0 ; index < dots.length; index++){
                        dots[index].classList.remove('bg-blue-500');
                        dots[index].classList.add('bg-white');
                    }
                    dots[slideindex - 1].classList.remove('bg-white');
                    dots[slideindex - 1].classList.add('bg-blue-500');
                }
                
                function moveSlide(moveStep){
                    showSlide(slideindex += moveStep);

                }

                function currentSlide(position){    
                    showSlide(slideIndex = position);
                }

            </script>
    
    
</body>
</html>