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
  
    <!--Put all content here-->
      
      

  </div>
  <script src="<?php echo $javaScript; ?>"></script>
</body>

</html>