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
      
      #instructions{
        	text-align:center;
        	margin:50px;
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
   
    <div id="instructions">
      <h1>Instructions</h1>
      <br>
      <p>This is a simple multiple choice quiz game. When you press start the game begins. You are given 5 questions in total. For each question you have to select one answer and then press Next. At the last question you can only press Finish to show the results of the quiz. You can also press the End Game button to finish the game and view the results. When the game ends you can view your score and save it. To save your new score, enter a nickname in the text box and press Save. You can view all high scores at the Highscore Tab. Have fun! </p>
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