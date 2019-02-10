<?php

include ('dbcron.php');

$set = $DB->query("SELECT id,url_img FROM `images`");
	?>
	<html>
   <head>
      <title>INT20H emotions</title>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">	<!-- Режим для инт. эксплорэра - последний -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="keywords" content="INT20H emotions, Kiev february 2019">
      <meta name="description" content="INT20H emotions, Kiev february 2019, Hackathon">
      <meta name="author" content="Vladimir Samkov, Oksana Popova">    
      <link rel="shortcut icon" href="Da.ico"> <!-- Иконка вкладки -->
      <!-- Гугл шрифты -->
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:700" rel="stylesheet">
      			
      <!-- Global CSS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <!--link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css"-->   
      <!-- Plugins CSS -->
      <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.css">
      <!-- Theme CSS -->  
      <link id="theme-style" rel="stylesheet" href="INT20H css/INT20H.css">
      
      <!--script defer src="js/garlic.js"></script-->
   </head>
<body class="center-block" id="body">
   <div class="imgscreen row justify-content-cente" id="imgscreen">
      <div class="imgactive col-12 col-sm row ">
         <img src="img/30323171370_4fe6acfdd0_o.jpg" alt="" class="col align-items-cente" id="imgmax">
      </div>
      <div class="heshteg col-12 col-sm-auto" id="heshtegActive">
         <ul>
            <li>Кодинг</li>
            <li>Смех</li>
            <li>Напряженность</li>
            <li>Кодинг</li>
            <li>Смех</li>
            <li>Напряженность</li>
         </ul>
     </div>
      <button class="imgclose"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" width="50px" height="50px">
            <g id="surface1">
            <path class= "svgcolor" style="" d="M 16 3 C 8.832031 3 3 8.832031 3 16 C 3 23.167969 8.832031 29 16 29 C 23.167969 29 29 23.167969 29 16 C 29 8.832031 23.167969 3 16 3 Z M 16 5 C 22.085938 5 27 9.914063 27 16 C 27 22.085938 22.085938 27 16 27 C 9.914063 27 5 22.085938 5 16 C 5 9.914063 9.914063 5 16 5 Z M 12.21875 10.78125 L 10.78125 12.21875 L 14.5625 16 L 10.78125 19.78125 L 12.21875 21.21875 L 16 17.4375 L 19.78125 21.21875 L 21.21875 19.78125 L 17.4375 16 L 21.21875 12.21875 L 19.78125 10.78125 L 16 14.5625 Z "/>
            </g>
            </svg></button>
      </div>
   <div class="top-block">
   <div class="screen">
      <header>
         Эмоции на хакатоне INT20H, Kiev 2019.
      </header>
   </div>
   <div class="screen">
      <div class="sorting row justify-content-center">
         <div class="col-sm-7 col-md-7 col-lg-5 col-xl-5" id="list-ul1">
            <input class="text_sort input0" type="text" placeholder="All emocion" name="vh" value="" id="inputList1">
            <div class="list" id="ul1">
               <div class="listinput">
                   <ul name="food" class="listinSmol" id="list-ul-li">
                   <li id="li1" class="" value="u1">All emocion</li>
                   <li id="li2" class="" value="u2">surprise</li>
                   <li id="li3" class="" value="u3">neutral</li>
                   <li id="li4" class="" value="u4">fear</li>
                   <li id="li6" class="" value="u6">happiness</li>
                   <li id="li6" class="" value="u6">sadness</li>
                   </ul>
                   </div>
               </div>
         </div>
         <div class="col-sm-5 col-md-5 col-lg-4 col-xl-3">
            <button class="btnsort" id="sort">Sort</button>
         </div>
      </div>
   </div>
   </div>
   <div class="screen">
      <div class="sort_result row  justify-content-center">

<?php
	foreach ($set as &$value) {
		$cou_set = $DB->query("SELECT COUNT(*) FROM `emo` WHERE id_img=?", array($value['id']));
			//print_r($cou_set[0]['COUNT(*)']);
			if($cou_set[0]['COUNT(*)'] != 0){
				//echo '<img src="'.$value['url_img'].'"><br />';
?>

         <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
         <div class="picturis_block">
            <div class="picturis">
               <img class="sss" src="<?php echo $value['url_img']; ?>" alt="">
            </div>
            <div class="heshteg">

            		<?php
            			$set_emo = $DB->query("SELECT emocion FROM `emo` WHERE id_img=?", array($value['id']));
						echo '<p class="heshtegLine">';
						foreach ($set_emo as &$value_emo) {
							
							echo $value_emo['emocion'].' ';

						}
						echo '</p>';
               ?>
            </div>
         </div>
         </div>
        <?php
		}
	}


        ?>
      </div>
   </div>
   <div class="screen ">
      <footer class="row justify-content-center" >
            <div class="col-8 col-sm-5 col-md-4 col-lg-3 col-xl-2">
            <a href="#iconnext" class="btnsort row justify-content-cente" id="addfoto"><div class="iconfoot col" id="iconnext"></div><div class="col">Показать еще</div></a>
            </div>
      </footer>
   </div>

   <script src="js/INT20H.js"></script>
</body>
</html>