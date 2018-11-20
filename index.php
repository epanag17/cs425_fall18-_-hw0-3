<?php
	// Start the session
	session_start();
	$_SESSION['StartGame'] = false;
?>

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
		h1{
			text-align:center;
		}
	
		#startButton{
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 180px;
		}
      
      #sticky {
          position: -webkit-sticky; /* Safari */
          position: sticky;
          top: 0;
      }
      
      #contents{
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
    
	<div id="contents">
  
      <div id="StartTitle" <?php
                             if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['startGame']))
                              echo 'style="display:none"';  
                              if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['nextButton']))
                                echo 'style="display:none"';  
           					?> >
	  	<h1 class="display-4"><?php if( ($_SERVER['REQUEST_METHOD'] == "POST") and !isset($_POST['saveScoreButton']) )
  									  echo 'Do you wish to play again?';	
  									else
                                      echo 'Welcome, are you ready to start a short quiz?';	?></h1>
	  	<br><br>
      	<form action="index.php" method="post">
        	<input type="submit" name="startGame" value="START" class="btn btn-danger btn-lg" id="startButton"/>
    	</form>
      </div>
     
	 <br><br>
      <form action="index.php" method="post">
        
    
  	<?php
        
        $xml=simplexml_load_file("questions.xml") or die("Error: Cannot create object");
   
        
        function start()
        {  
          	$_SESSION["currentQuestion"] = rand(0,24)+25;
          	$_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
            $_SESSION["counterQuestion"] = 0;
            $_SESSION["totalQuestions"] =5;
          	$_SESSION["correctAnswers"] =0;
          	$_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
            displayQuery() ;             
        }
        
        function displayQuery()
        {
   			/*$dom = new DOMDocument();
			$dom->loadHTML("index.php");
          	$div = $dom->getElementById("StartTitle");
          	echo $div;*/
          
          	echo $_SESSION['counterQuestion']+1;
            $query=htmlspecialchars($GLOBALS['xml']->question[$_SESSION["currentQuestion"]]->query);
          	$leftQuestions = $_SESSION["totalQuestions"]-$_SESSION["counterQuestion"]-1;
            echo  $query. " (left $leftQuestions questions)<br>";
            foreach($GLOBALS['xml']->question[$_SESSION["currentQuestion"]]->selections->children() as $selection){
          
              $epilogi=htmlspecialchars($selection);
              
              echo '<input type="radio" name="selections" value="'.$epilogi.'">';
              echo $epilogi;
             
              echo "<br>";
            }
          	if($_SESSION["counterQuestion"] !== ($_SESSION["totalQuestions"]-1)) {
          	 	echo '<input type="submit" value="NEXT" name="nextButton">';
              	echo '<input type="submit" value="END GAME" name="endGameButton">';
            }
          	else
              echo '<input type="submit" value="FINISH" name="finishButton">';
        }
        
        function checkAnswer()
        {
          
          if(isset($_POST['selections'])){
            $_SESSION["counterQuestion"]++;
          	$selected_val = $_POST['selections'];
          	//echo $GLOBALS['xml']->question[$_SESSION["preQuestion"]]->answer;
          	//echo $selected_val;
          	if($GLOBALS['xml']->question[$_SESSION["preQuestion"]]->answer == $selected_val){
              //echo "true";
              $_SESSION["answersByQuery"][$_SESSION["counterQuestion"]-1]="true";
               $_SESSION["correctAnswers"]++;
               if($_SESSION["preQuestion"]<25){
                 $query = rand(0,24)+25;
                 while(in_array($query,  $_SESSION["givenQuestions"])){
                 	$query = rand(0,24)+25;
                 }
                 $_SESSION["currentQuestion"] = $query;
                 $_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
                 $_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
               }
              elseif($_SESSION["preQuestion"]<50){
                $query = rand(25,49)+25;
                while(in_array($query,  $_SESSION["givenQuestions"])){
                 	$query = rand(25,49)+25;
                }
                $_SESSION["currentQuestion"] = $query;
                $_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
                $_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
              }
              else{
                $query = rand(50,74);
                 while(in_array($query,  $_SESSION["givenQuestions"])){
                 	$query = rand(50,74);
                 }
                 $_SESSION["currentQuestion"] = $query;
                 $_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
                 $_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
              }
            }
            else{
              //echo "false";
              $_SESSION["answersByQuery"][$_SESSION["counterQuestion"]-1]="false";
              if($_SESSION["preQuestion"]>50){
                 $query = rand(50,74)-25;
                while(in_array($query,  $_SESSION["givenQuestions"])){
                 $query = rand(50,74)-25;
                }
                $_SESSION["currentQuestion"] = $query;
                $_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
                $_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
              }
              elseif($_SESSION["preQuestion"]>25){
                $query= rand(25,49)-25; 
                while(in_array($query,  $_SESSION["givenQuestions"])){
                 $query= rand(25,49)-25; 
                }
                $_SESSION["currentQuestion"] = $query;
                $_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
                $_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
              }
              else{
                $query= rand(0,24);
                while(in_array($query,  $_SESSION["givenQuestions"])){
                 	$query = rand(0,24);
                 }
                 $_SESSION["currentQuestion"] = $query;
                 $_SESSION["preQuestion"] = $_SESSION["currentQuestion"];
                 $_SESSION["givenQuestions"][$_SESSION["counterQuestion"]]=$_SESSION["currentQuestion"];
              }
            }
            
          }
            
        }
        
       /* function isGivenQuery($query)
        {
          $isGiven = 0;
          $arrLength = count($_SESSION["givenQuestions"]);
          echo $arrlength;
          for($i=0; $i<$arrlength;$i++){
            if($query==$_SESSION["givenQuestions"][$i]){
              $isGiven = 1;
              break;
            }
              
          }
          return $isGAiven;
        }*/
        
        function showResults()
        {
         $overallScore = 0;
          echo $_SESSION['counterQuestion'];
          echo " question answered!<br>";
          $leftQuestions=($_SESSION['totalQuestions'])-$_SESSION['counterQuestion'];
          echo $leftQuestions;
          echo " questions left!<br>";
          for ($x = 0; $x < $_SESSION['counterQuestion']; $x++) {
           	echo $x;
            $query=htmlspecialchars($GLOBALS['xml']->question[$_SESSION["givenQuestions"][$x]]->query);
            echo  $query. "<br>";
            if($_SESSION["answersByQuery"][$x]==="true")
            	echo "answered correctly!";
             else
                echo "answered not correctly...";
            $level = $GLOBALS['xml']->question[$_SESSION["givenQuestions"][$x]]->level;
            echo "dificulty:".$level. "<br>";
            $score=0;
            if($_SESSION["answersByQuery"][$x]==="true"){
              if($level== "EASY"){
                $score=5;
              }
              elseif($level=="MEDIUM"){
                $score=10;
              }
              else{
                $score=15;
              }
            }
            else
              $score=0;
            echo  "score= ".$score. "<br>";
            $overallScore+=$score;
          }
          	echo "Overall Score: ".$overallScore. "<br>";
          	$_SESSION["ScoreUser"]=$overallScore;
          
          echo '<form method="post" action="">
          <div class="form-row">
    		
          		
           
            <div class="col-md-4 mb-3">
				<input type="text" name="nickname" class="form-control is-invalid"  placeholder="Give your name" required>
				<div class="invalid-feedback">
         			 Please choose a username.
       			 </div>
             </div>
             <div class="col-md-4 mb-3">
			<input type="submit" value="Save Score" name="saveScoreButton">
            </div>
            </div>
		</form>';
          
        }
        
        function saveScore(){
         echo '<div class="alert alert-success" role="alert">
  Successfullly save your score!
</div>';
          if(isset($_POST['nickname'])){
            $file ='highScore.txt';
            $score = $_SESSION["ScoreUser"];
            $string = "".$score;
            if( $score < 10 )
              $string = "0".$string;
            $scoreByUser= $string." : ".$_POST["nickname"].'<br>';
            file_put_contents($file, $scoreByUser, FILE_APPEND | LOCK_EX);
          }
        }
        
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['startGame']))
        {
  			$_SESSION['StartGame'] = true;
            start();
        }
        
        
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['nextButton']))
        {
            checkAnswer();
         	if($_SESSION["counterQuestion"]<$_SESSION["totalQuestions"])
            	displayQuery();
        	
          
        }
        
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['finishButton']))
        {
          	checkAnswer();
            showResults();
        }
        
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['endGameButton']))
        {
            showResults();
        }
        
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['saveScoreButton']))
        {
            saveScore();
        }
    ?>
        
        
       
      </form>
      
      
     
      
	</div>
    
     <!-- Footer -->
<footer class="page-footer font-small blue pt-4 bg-dark">

    

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 text-white">© 2018 Copyright: Elli Panagi
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>