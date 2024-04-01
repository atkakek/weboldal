<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../client/css/home.css">
  <title>Movie List</title>
</head>
<body>


<div class="container genres-container">
    <div class="row genres" id="genre-row"> 
      
    </div>
</div>

<div class="container-fluid">
    <div class="row">
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div id="poster" class="col-md-6"></div>
            <div class="col-md-6 ms-auto"  id="movieInfo">
              <p></p><br>
            </div>
          </div>
          <div class="row" id="popularity" class="col-md-2">
            <p></p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn closeButton" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>


<div class="container" id="movie-list">
  <div class="row" id="movie-row"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
 



function showModal(button) {
        let movieid = button.getAttribute("data-movieid");
        console.log(movieid);

        const options = {
          method: 'GET',
          headers: {
            accept: 'application/json',
            Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhNDA1ZTNlMzY4YTNhYzlmMDM5ZWMwYjMyODQ4YjdiOSIsInN1YiI6IjY1YWU0NGFmNTQ0YzQxMDBhZTI0ZjBiOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.FobF9qy1qBiHfiYbaw8yi2g2wzQs8R-YGAJ96W-7g_k'
          }
        };
        fetch(`https://api.themoviedb.org/3/movie/${movieid}`, options)
    .then(response => response.json())
    .then(data => {
      console.log(data);
      
      console.log(data.title);
      const modalPoster = `https://image.tmdb.org/t/p/w300${data.poster_path}`;
      
      document.getElementById('modalTitle').innerHTML = data.title
      document.getElementById('movieInfo').innerHTML = data.overview
      document.getElementById('popularity').innerHTML = "Popularity: " + data.popularity
      document.getElementById('poster').innerHTML = `<img src="${modalPoster}" class="img-fluid" id="poster">`

    });
  }

function getSelectedGenres() {
  const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  const selectedGenres = Array.from(checkboxes).map(checkbox => parseInt(checkbox.value));
  return selectedGenres;
}

function fetchMovies(selectedGenres = []) {
  const page = Math.floor(Math.random() * 101);

  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhNDA1ZTNlMzY4YTNhYzlmMDM5ZWMwYjMyODQ4YjdiOSIsInN1YiI6IjY1YWU0NGFmNTQ0YzQxMDBhZTI0ZjBiOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.FobF9qy1qBiHfiYbaw8yi2g2wzQs8R-YGAJ96W-7g_k'
    }
  };

  fetch(`https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=${page}&sort_by=popularity.desc`, options)
    .then(response => response.json())
    .then(data => {
      const movies = data.results.filter(movie => {
        //ha a tomb ures akkor nincs szures
        if (selectedGenres.length === 0) {
          return true;
        }
        return movie.genre_ids.some(genreId => selectedGenres.includes(genreId));
      });

      const movieRow = document.querySelector('#movie-row');
      movieRow.innerHTML = '';

      movies.forEach(movie => {
        console.log(movie);
        
        const { id, title, overview, poster_path } = movie;
        const imageUrl = `https://image.tmdb.org/t/p/w300${poster_path}`;
        let movieOverview = overview.replace(/['"]/g, '');
        let movieTitle = title.replace(/['"]/g, '');

        const card = document.createElement('div');
        card.classList.add('col-3');
        card.innerHTML = `
          <div class="card text-bg-dark p-2" style="width: 100%; max-height: 100%">
            <img src="${imageUrl}" class="card-img-top" alt="${movieTitle}">
            <div class="card-body text-md-start">
              <h5 class="card-title">${movieTitle}</h5>
              <p class="card-text">${movieOverview}</p>
              <div class="like">
                <button href="#" class="btn m-2" data-bs-toggle="modal" data-bs-target="#myModal" tpye="button" data-movieid="${id}" onclick="showModal(this)">Details</button>
                <button class="btn m-2" id="likeButton" onclick="addFavorite([${id}, '${movieTitle}', '${movieOverview}', '${imageUrl}'])">
                  <img src="../client/images/whiteheart.png" value="${id}" class="img-fluid w-50">
                </button>
              </div>
            </div>
          </div>
        `;
        movieRow.appendChild(card);
      });    
    })
    .catch(err => console.error(err));

   
    
}
//mufajok betoltese
function fetchGenres() {
  const checkboxes = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJhNDA1ZTNlMzY4YTNhYzlmMDM5ZWMwYjMyODQ4YjdiOSIsInN1YiI6IjY1YWU0NGFmNTQ0YzQxMDBhZTI0ZjBiOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.FobF9qy1qBiHfiYbaw8yi2g2wzQs8R-YGAJ96W-7g_k'
    }
  };

  fetch('https://api.themoviedb.org/3/genre/movie/list?language=en', checkboxes)
    .then(response => response.json())
    .then(data => {
      const genres = data.genres;
      const genreCheck = document.querySelector("#genre-row");

      genres.forEach(genre => {
        const { id, name } = genre;

        const listItem = document.createElement('div');
        listItem.classList.add('form-check', 'p-1', 'col-1', 'mx-4');

        listItem.innerHTML = `
          <div>
            <input class="form-check-input" type="checkbox" value="${id}" id="genre-${id}" onchange="fetchMovies(getSelectedGenres())">
            <label class="form-check-label" for="genre-${id}">
              ${name}
            </label>
          </div>
        `;

        genreCheck.appendChild(listItem);
      });
      
      // filmek megjelenitese szures eseten
      fetchMovies();
    })
    .catch(err => console.error(err));
}

// mufajok megjelenitese az oldal betoltesekor
fetchGenres();

      function addFavorite(objString) {
        var obj = eval(objString);
        console.log(obj[0], obj[1], obj[2], obj[3]);
        console.log(obj[2], "test");
        let myFormData = new FormData();
        myFormData.append('id', obj[0])
        myFormData.append('title', obj[1])
        myFormData.append('overview', obj[2])
        myFormData.append('poster_path', obj[3]);

        let configObj = {
            method: 'POST',
            body: myFormData
        }
        postData('../server/addFavorite.php', renderResult, configObj);
        
    }
    function renderResult(data) {
        console.log(data.msg);
    }

      

</script>
</body>
</html>
