<?php 
  $accc = $_SESSION['name'];
  echo '<script> var sessionStarted = ' . (isset($_SESSION['session_started']) && !empty($_SESSION['name']) ? 'true' : 'false') . '; </script>';

?>

<?php
require_once "../server/connectdb.php";
$accc = $_SESSION['name'];
$sql = "SELECT likedmovies.userName, COUNT(likedmovies.movieId) as darab FROM likedmovies WHERE likedmovies.userName ='{$accc}'";
$stmt = $conn -> query( $sql );
$data = $stmt -> fetchAll();
$darab = $data[0]['darab'];
echo json_encode($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../client/css/favorite.css">
    <title>Document</title>
</head>
<body>

<div class="container" id="movie-list">
  <div class="row text-center" id="movie-row">
    <h1 class="text-white mb-3" id="welcome"></h1>
  </div>
</div>

<script>


let acc = "<?php echo $accc?>";
console.log(acc);
document.getElementById('welcome').innerHTML = `Hello, ${acc}`;

const darab = <?php echo $darab;?>;
console.log(darab);

if (darab > 0) {
  getData('../server/Favorite.php', renderCards);
    
    function renderCards(data) {
        console.log(data);
        console.log(data.movieId);
       
        for (const item of data) {
          console.log(item);
          
            document.getElementById('movie-row').innerHTML += 
            `
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
              <div class="card text-bg-dark p-2" style="width: 100%; max-height: 100%">
                <img src="${item.poster_path}" class="card-img-top" alt="${item.title}">
              <div class="card-body text-md-start">
                <h5 class="card-title">${item.title}</h5>
                <p class="card-text">${item.overview}</p>
                <div class="remove">
                  <button type="button" class="btn m-2"  onclick="remove(${item.movieId})">
                    <img src="../client/images/remove.png" value="${item.movieId}" class="img-fluid w-50">
                  </button>
                </div>
              </div>
              </div>
            </div>
            `;
        }
    }

    
    
    function remove(movieId) {
    let idk = movieId;
    console.log("remove" + idk);
    
    // Send an HTTP request to your PHP script
    fetch(`../server/removeFav.php?idk=${idk}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error removing movie');
        }
        return response.json();
    })
    .then(data => {
        console.log('Movie removed successfully:', data);
        // Refresh the page
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle errors if the request fails
    });
}

}else{
  document.getElementById('welcome').innerHTML = `You have no favorites yet.`;
}

    

    
</script>
</body>
</html>