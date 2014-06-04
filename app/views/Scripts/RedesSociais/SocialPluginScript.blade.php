<div id="fb-root"></div>
<script type="text/javascript">
//Ativa plugin Facebook -->
<?php
//window.fbAsyncInit = function() {
    // init the FB JS SDK
    //FB.init({
      //appId      : '327161427413877',                       // App ID from the app dashboard
      //channelUrl : '//www.expoac.com.br/', 					// Channel file for x-domain comms
      //status     : true,                                 	// Check Facebook Login status
      //xfbml      : true                                  	// Look for social plugins on the page
    //});
    // Additional initialization code such as adding Event Listeners goes here
//};
?>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1"; //
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//Ativa plugin Facebook <--
</script>
