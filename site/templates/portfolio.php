<?php namespace ProcessWire; ?>


<?php

  //Get globarl data
  $globalData = $pages->get("/global-website-data/");

  $name =  $globalData->Name;
  $profession = $globalData->Profession;
  $selfPhoto = $globalData->Self_photo->url;
  
  $favicon = $globalData->Website_favicon;
  
  //Get page specific data
  $cssSheet = strval($config->urls->templates) . "styles/Template.css";
  $javaScript = strval($config->urls->templates) . "scripts/Template.js";
  $pageName = $page->get('name');
  $portFolioEntries = $page->children();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $pageName; ?></title>
  <meta name="keywords" content="HTML, JavaScript">
  <meta name="description" content="<?php echo $pageName; ?>">
  <meta name="author" content="<?php echo $name; ?>">
  <link rel="icon" href="<?php echo $favicon; ?>">
  <link rel="stylesheet" href="<?php echo $cssSheet;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
</head>

<body>

  <header>
    <div class="logo">
      <img id="logoImg" src="<?php echo $selfPhoto; ?>" alt="<?php echo $name; ?>"></img>
      <h1><?php echo $name; ?></h1>
      <p><?php echo $profession; ?></p>
    </div>
  </header>
  <div id="nav">
    <a class="active" onclick="navBarfunc()">Menu</a>
    <div id="myLinks">
      <a href="<?php echo $pages->get('portfolio')->url; ?>">Home</a>
      <a href="<?php echo $pages->get('contact')->url; ?>">Contact</a>
      <a href="<?php echo $pages->get('about-me')->url; ?>">About me</a>
    </div>
      <div id="login">
        <?php if($page->editable()) echo "<a href='$page->editURL'>Edit</a>"; ?>
      </div>
  </div>
  <div class="content">
      <div class="searchbar">
        <form action="<?php echo $pages->get('portfolio')->url; ?>" method="GET">
        <label for="search">Search Portfolio</label>
        <input id = "search"type="text" name="search" placeholder="Search portfolio...">
        <input type="submit" value=">>"/>
        </form>
      </div>
    <!--Put all content here-->
      <?php
    $searching = false;
    $text = "";
    //check if searching, if so, set search text
      if(isset($_GET['search'])){
        $searching = true;
        $text = strtolower($_GET['search']);
      }
        $num=1;
        $output='';
        foreach($page->portfolioEntries as $entry)
        {
        $colour = $num % 2 == 0 ? '#101010' : '#1e1e1e';
          if($searching==false || ((strstr(strtolower($entry->title), $text)) || (strstr(strtolower($entry->LanguageTags), $text))))
          {
          $output.=" 
          <div class='portfolioEntry' , style='background-color: $colour;'>
          <h1>$entry->title</h1>
          <h2>$entry->LanguageTags</h2>
          <iframe height='350' src='$entry->youtubeURL'>Your browser does not support this video</iframe>
          <p> $entry->projectDescription </p>";
          //check if github link exists
          if($entry->gitHubLink != "")
          {
            $output .= "
          <a style='margin-top:10px;' href='$entry->gitHubLink'
          title='Click here to go to the github page for this project'> You can find this project here.</a>";
          }
          $output.="</div>";

          
          $num++;
          }
        }
        echo $output;
      ?>
  </div>
  <script src="<?php echo $javaScript; ?>"></script>
</body>

</html>