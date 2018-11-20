<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	 

    <meta name="author" content="Elli Panagi">
	 <meta name="description" content="Exercise 3 for CS425 Fall2018">
	 <meta name="keywords" content="Exercise 3, CS425, Fall2018, HTML, CSS, PHP, forms, quiz, game">

	
	 
	 <link rel="shortcut icon" type="image/png" href="quiz.png"/>

    <title>Quiz game!</title>
	
	<style type="text/css">
		
      
      #sticky {
          position: -webkit-sticky; /* Safari */
          position: sticky;
          top: 0;
      }
      
      #scores{
        	margin:50px;
        	text-align:center;
      }
      
      .top_arrow{
		position: -webkit-sticky;
    	position: sticky;
    	top: 90%;
        
	}
      
	</style>
  </head>
  <body>
 
    <section id="top"></section>
    
    <ul class="nav justify-content-center bg-primary " id="sticky">
      <li class="nav-item">
        <a class="nav-link text-white" href="index.php">Home Page</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="help.php">Help Page</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="scores.php">High Scores Page</a>
      </li>
    </ul>
    
    <a href="#top" class="top_arrow float-right"><i class="far fa-arrow-alt-circle-up fa-3x"></i></a>
    
    <div id="scores">
      <h1>High Scores:</h1> 
      <br>
      <?php
      	
        $file = fopen("highScore.txt","r");
      	$scores = array();
      	
        while(! feof($file))
  		{
          	$string = fgets($file);
          	$tokens = explode("<br>",$string);
          	foreach( $tokens as &$token )
          		array_push($scores,$token);  			  
  		}

      	rsort($scores, SORT_NATURAL | SORT_FLAG_CASE  );
     
      	for( $i = 0; $i < count($scores); $i++ ){
         	echo $scores[$i].'<br>'; 
        }
      
		fclose($file);
      ?>
    </div>
      
      
      <!-- Footer -->
<footer class="page-footer font-small blue pt-4 bg-dark">

    

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 text-white">© 2018 Copyright: Elli Panagi
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->
      <li class="nav-item">
        <a class="nav-link text-white" href="scores.php">High Scores Page</a>
      </li>
    </ul>

</body>
</html> 