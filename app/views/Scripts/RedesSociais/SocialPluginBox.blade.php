<?php //SOCIAL PLUGIN --> ?>
<?php $siteUrlToFace = /*'srv-local'.*/$_SERVER['SERVER_NAME'].str_replace('page=', '/', $_SERVER['QUERY_STRING']); ?>
<!--<div class="fb-like"  data-send="true" data-width="450" data-show-faces="false" style="margin: 20px 0 10px 0"></div>-->
<div class="fb-comments" data-href="<?php echo $siteUrlToFace; ?>" data-width="950" data-num-posts="10" data-colorscheme="light" style="float:left;"></div>	
<?php //SOCIAL PLUGIN --< ?>