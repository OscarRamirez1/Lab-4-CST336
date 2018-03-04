<?php
    $backgroundImage = "img/sea.jpg";
    
    if(isset($_GET['keyword']))
    {
        include 'api/pixabayAPI.php';
        $imageURLs = getImageURLs($_GET['keyword']);
        $backgroundImage = $imageURLs[array_rand($imageURLs)];
        echo "Your searched for: " .$_GET['keyword'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
        <style>
            @import url("css/styles.css");
            body
            {
                background-image: url('<?=$backgroundImage ?>');
            }
        </style>
    </head>
    <body>
        <br/> <br/>
        <?php
            if(!isset($imageURLs)) 
            {
                echo "<h2> Type a keyword to display a slideshow <br/> with random images from Pixabay.com </h2>";
            }
            else 
            {
        ?>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php 
            for($i = 0; $i < 7; $i++)
            {
                echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
                echo ($i == 0)?" class='active'": "";
                echo "></li>";
            }
        ?>
        </ol>
        <div class="carousel-inner" role="listbox">
        <?php
            for($i = 0; $i < 7; $i++)
            {
                do {
                        $randomIndex = rand(0,count($imageURLs));
                    } while(!isset($imageURLs[$randomIndex]));
                echo '<div class="item ';
                echo ($i == 0)?"active": "";
                echo '">';
                echo "<img src='" . $imageURLs[$randomIndex] . "' width='200' >";
                echo '</div>';
                unset($imageURLs[$randomIndex]);
            }
        ?>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div> 
        <?php
            }
        ?>
        <h1> I'm a:  </h1>
        <form>
            <input type = "radio" id = "lhorizontal" name = "layout" value = "horizontal" />
            <label for = "Horizontal"></label><label for = "lhorizontal">Horizontal</label>
            <input type = "radio" id = "lvertical" name = "layout" value = "verical"/>
            <label for = "Verical"></label><label for = "lvertical">Vertical</label>
            <select name="keyword">
              <option value="none">Select One</option>
              <option value="forest">Forest</option>
              <option value="sky">Sky</option>
              <option value="otters">Otters</option>
              <option value="cars">Cars</option>
            </select> <br/><br/>
            
            <input type="submit" value="Submit"/>
            <input type="text" name="keyword" placeholder="Keyword" value = "<?= $_GET['keyword']?>"/>
        </form>
        <br/> <br/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity = sha384></script>
    </body>
</html>