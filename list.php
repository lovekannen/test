<?php
//处理非法路径。
if(substr($uri,0,10)=="/index.htm"){
    //重定向原来模板中的index.htm*到首页
    header("HTTP/1.1 301 Moved Permanently");
    header ("Location:/");
    exit;
}
if(substr($uri,0,11)=="/robots.txt"){
    //robots.txt文件
    header("Content-Type: text/txt;charset=UTF-8");
    echo "User-agent: *\n";
    echo "Allow:*\n";
    echo "Disallow: /production-line/\n";
    echo "Disallow: /products/\n";
    echo "Disallow: /project-case/\n";
    echo "Disallow: /about.html\n";
    echo "Disallow: /contact.html\n";
    echo 'Sitemap: http://'.$_SERVER['HTTP_HOST']."/sitemap.xml\n";
    exit;
}
if(substr($uri,1,7)=="sitemap"){
    require_once("Kiss.php");
    $kiss=new Kiss("pp.db");
    $hrefFormat = function($post){
        return "crusher-{$post['rowid']}/{$post['postname']}.html";
    };
    $kiss->sitemap(intval(substr($uri,8)),$hrefFormat);
    exit;
}
require_once("Kiss.php");
$kiss=new Kiss("pp.db");
preg_match('/\/crusher\-(\d+)\/[A-Za-z0-9-%]+\.html/',$uri,$tmpUrls);
if(isset($tmpUrls[1])) $rowid=$tmpUrls[1]; else $rowid=0;
if($rowid>0){
  $post=$kiss->getPost($rowid); // 根据ID获取内容
  if(empty($post)){
    header('HTTP/1.1 404 Not Found');
    header('Status: 404 Not Found');
    header('Location:/contact.html');
    exit;
  }
}else{
    header('HTTP/1.1 404 Not Found');
    header('Status: 404 Not Found');
    header('Location:/contact.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$post["title"]?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="/wp-content/themes/39/css/bootstrap.min.css" rel="stylesheet" />
<link href="/wp-content/themes/39/css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="/wp-content/themes/39/css/jcarousel.css" rel="stylesheet" />
<link href="/wp-content/themes/39/css/flexslider.css" rel="stylesheet" />
<link href="/wp-content/themes/39/js/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="/wp-content/themes/39/css/style.css" rel="stylesheet" />
<link rel="shortcut icon" href="/wp-content/themes/39/img/logo00.ico">

</head>
<body>
<div id="wrapper" class="home-page">
<div class="topbar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <p class="pull-left hidden-xs">Welcome</p>
        <p class="pull-right"><script type="text/javascript" src="/wp-content/themes/39/js/email.js"></script></p>
      </div>
    </div>
  </div>
</div>
    <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="/wp-content/themes/39/img/logo.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                          <li><a href="/">Home</span></a></li>
                          <li><a rel="nofollow" href="/about.html"> About </a></li>
                          <li><a rel="nofollow" href="/products/"> Products </a></li>
                          <li><a rel="nofollow" href="/production-line/"> Production Line </a></li>
                          <li><a rel="nofollow" href="/project-case/"> Project Case </a></li>
                          <li><a rel="nofollow" href="/contact.html"> Contact </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

<div class="nbanner bg">
  <div class="container"> 
      <div class="banner-info-y">
        <h2 class="center mt-30"><?=$post["title"]?></h2>
        <ol class="breadcrumb center mt-20">
          <li itemscope="" itemtype="//data-vocabulary.org/Breadcrumb"><a href='/' itemprop="url"><span itemprop="title">Home</span></a></li>
          <li itemscope="" itemtype="//data-vocabulary.org/Breadcrumb" class="active"><a href='#' itemprop="url"><span itemprop="title"><?=$post["title"]?></span></a></li>
        </ol> 
        <ol class="headline-t center mt-20">
            <li><a href="/products/mobile-crusher/" rel="nofollow">mobile-crusher</a></li>
            <li><a href="/products/crushing-plant/" rel="nofollow">crushing-plant</a></li>
            <li><a href="/products/packaging-machine/" rel="nofollow">packaging-machine</a></li>
            <li><a href="/products/coal-roadheader/" rel="nofollow">coal-roadheader</a></li>
            <li><a href="/products/boring-machine/" rel="nofollow">boring-machine</a></li>
            
            <li><a href="/products/mining-equipment/" rel="nofollow">mining-equipment</a></li>

            <li><a href="/products/mill-machine/" rel="nofollow">mill-machine</a></li>
            <li><a href="/products/other-equipment/" rel="nofollow">other-equipment</a></li>
        </ol>
        
        
      </div>
    </div>
</div>
</div>



<section class="section_padding_100  mt-50" >
    <div class="container">
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="row">   
                    <?php
                                $post["content"]=str_replace("Magnattack","",$post["content"]);
                                $content=explode("[|||]",substr($post["content"],0,-5));
                                    foreach($content as $v){ 
                                        echo '<div class="col-md-6 lists mb-20">';
                                        echo '<div class="list-whole"><img src="/JPEG/'.mt_rand(1,120).'.jpg">'
                                        .'<div class="text-list mt-20">'.$v."<a href='javascript:;' rel='nofollow' class='btn-x mt-30 mb-20' onclick='LC_API.open_chat_window({source:'eye catcher'});return false'>Contact Now</a>   </div></div></div>";
                                          
                                    }                               
                    ?>
                
            </div>
            <div class="row">
                <?php
                echo '<div class="neightbor mb-50">';
                $NeighborTxt=array(
                  'pre'=>'Previous：',
                  'next'=>'Next：',
                );
                
$neighborLinks=$kiss->getPostsByNeighbor($post["rowid"]);
echo '<div class="neighbor">';
foreach($NeighborTxt as $k=>$v){
  if(!empty($neighborLinks[$k])) echo "<span>{$v}<a href=\"/crusher-{$neighborLinks[$k]['rowid']}/{$neighborLinks[$k]['postname']}.html\">{$neighborLinks[$k]["title"]}</a></span>";
}
echo '</div>';
?>




            </div>
        </div>
</div>
        <div class="col-12 col-md-3 sidebar-x">
            <div>
                <?php
echo '<div class="related mb-20">';
echo '<h3 class=" mb-20">Related Posts</h3>';
echo '<ul>';
$relatedLinks=$kiss->getPostsByRelated($post["tag"],10);
foreach ($relatedLinks as $link){
    echo "<li><a href=\"/crusher-{$link['rowid']}/{$link['postname']}.html\">{$link["title"]}</a></li>";
}
echo '</ul>';
echo '</div>';
?>

<?php
echo '<div class="related mb-20">';
echo '<h3 class=" mb-20">Top Posts</h3>';
echo '<ul>';
$randLinks=$kiss->getPostsByRand(5);
foreach ($randLinks as $link){
    echo "<li><a href=\"/crusher-{$link['rowid']}/{$link['postname']}.html\">{$link["title"]}</a></li>";
}
echo '</ul>';
echo '</div>';
?>

<script type="text/javascript" src="/wp-content/themes/39/js/quote.js">
</script>



            </div>
        </div>
    </div>
    </div>
</section>


    <footer>
    
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="center">
                        <p>
                            Copyright &copy; 2018. All rights reserved.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    </footer>
</div>

<script src="/wp-content/themes/39/js/jquery.js"></script>
<script src="/wp-content/themes/39/js/bootstrap.min.js"></script>


 <script language=javascript>
var LiveAutoInvite0='Hello, friends from%IP%';
var LiveAutoInvite1='Dialogue from Home Page';
var LiveAutoInvite2='The main functions of Business Link are as follows: <br> 1, invite <br> 2, communicate <br> 3, view real-time access dynamics <br> 4, track access <br> 5, internal dialogue <br> 6, do not install any plug-ins to achieve two-way file transfer <br><br><b> If you have any questions, please accept this invitation to start instant communication </b>.';
</script>
<script language="javascript" src="//mnn.zoosnet.net/JS/LsJS.aspx?siteid=MNN94995150&float=1&lng=en"></script>
<script src="//js.lanthy.com/js/livechat.js" ></script>
<script>$(".btn-x").on("click", function() {if(typeof(openZoosUrl) == 'function') {document.getElementById("chat-widget-container").style.display = "block"; } else { window.location = '/contact.html';}});</script>
</body>
</html>

