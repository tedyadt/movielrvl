<html>
    <head>
        <title>FILMREK | Nonton dan Review Film gapake ribet</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class = "w-full h-auto min-h-screen flex flex-col">
            <!-- header -->
            @include('header')

            <!-- content sort -->
            <div class=" ml-28 mt-8 flex flex-row items-center">
                <span class="font-inter font-bold text-xl">Sort by</span>

                <div class="relative ml-5">
                    <select class="block appearance-none bg-white drop-shadow-lg text-black font-inter py-3 pl-4 pr-8 rounded-lg  leading-tight focus:outline-none focus:bg-white">
                        <option value = "popularity.desc">Popularity descending</option>
                        <option value = "popularity.asc">Popularity ascending</option>
                        <option value = "vote_average.desc">Top Rated</option>
                    </select>
                    <div class=" pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">

                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>

                    </div>
                </div>


            </div>

            <!-- content movie -->
            <div class="w-auto pl-28 pr-18 pt-6 pb-10 grid grid-cols-3 lg:grid-cols-5 gap-5" id="dataWrapper">
            @foreach ($movies as $movieitem)
            @php
            $original_date = $movieitem->release_date;
            $timestamp = strtotime($original_date);
            $movieYear = date('Y', $timestamp);
            $movieID = $movieitem->id;
            $movieTitle = $movieitem->title;
            $movieRating = $movieitem->vote_average * 10;
            $movieImage = "{$imageBaseUrl}/w500{$movieitem->poster_path}";
            @endphp

            <a href="movie/{{$movieID}}" class="group">
                        <div class = "min-w-[200px] h-[350px] bg-white drop-shadow group-hover:drop-shadow-2xl rounded-xl flex flex-col p-4 mr-8 duration-100">
                            <div class = "overflow-hidden rounded-xl">
                                <img class = "w-full h-[220px] rounded-xl group-hover:scale-110 duration-300" src="{{$movieImage}}" />
                            </div>
                          
                            <span class = "font-inter font-bold text-xl mt-3 line-clamp-1 group-hover:line-clamp-none">{{$movieTitle}}</span>
                            <span class = "font-inter text-sm mt-1">{{$movieYear}}</span>
                            <div class = "flex flex-row items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"class = "w-4 h-4" fill ="blue"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>

                                <span class = "font-inter text-sm ml-0.5">{{$movieRating}}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach


            </div>

            <!-- footer -->
            @include('footer')

        </div>
</html>