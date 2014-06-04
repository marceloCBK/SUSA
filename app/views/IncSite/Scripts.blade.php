<?php

echo '
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
';
/*
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald" />
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Cantora+One' />
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Oxygen' />
*/


if (empty($diff)) {$diff[]='NULL';} // impede que $diff fique com valor NULL

$val = array('BUSCA','VALID','FANCY','CYCLE','JQUERY','INDEX');
for ($i=0;$i<count($val);$i++){ //verifica se $diff possui alguma string de $val
	if (in_array($val[$i], $diff)) {
	/*?><script src="http://code.jquery.com/jquery-1.10.1.min.js"></script><?php */
    echo '
        <script type="text/javascript" src="/ScriptLibrary/jquery.js"></script>
    ';
    break;
	}
}

if (in_array('CYCLE', $diff)) {
    echo'
        <script type="text/javascript" src="/ScriptLibrary/cycle/jquery.cycle.all.js"></script>
        <script type="text/javascript" src="/ScriptLibrary/cycle/jquery.easing.1.3.js"></script>
    ';
    /*
    <script type="text/javascript" src="/ScriptLibrary/cycle2/build/jquery.cycle2.js"></script>
    <script type="text/javascript" src="/ScriptLibrary/cycle2/src/jquery.cycle2.carousel.js"></script>
    */
}



if (in_array('FIXED', $diff)) {

}



if (in_array('INDEX', $diff)) {
    echo '
        <script type="text/javascript">
            $(function() {
                $("#publicadades, .SliderDest .SliderInfoBox").cycle({
                    fx					: "fade",
                    //easing              : "easeInOutBack",
                    speed				: 1500,
                    timeout				: 4000,
                    next				: ".SliderDest .Right",
                    prev				: ".SliderDest .Left",
                    pager				: "#NavDest",
                    //pause				: true,
                    //pauseOnPagerHover   : true,
                    containerResize		: 0,
                    slideResize			: 0
                });
            });
        </script>
    ';
}

/*?><script type="text/javascript" src="/ScriptLibrary/swfobject.js"></script> <?php //MOSTRA SWF ?><?php */

if (in_array('VALID', $diff)) {
    //VALIDATION
    echo '
        <script type="text/javascript" src="/ScriptLibrary/jquery.validation/jquery.validate.js"></script>
        <script type="text/javascript" src="/ScriptLibrary/jquery.validation/additional-methods.js"></script>
        <script type="text/javascript" src="/ScriptLibrary/jquery.validation/lib/jquery.form.js"></script>
        <script type="text/javascript" src="/ScriptLibrary/jquery.validation/localization/messages_pt_BR.js"></script>
        <script type="text/javascript" src="/ScriptLibrary/jquery.meio.mask.js"></script>
    ';
    //VALIDATION
}

if (in_array('FANCY',$diff)) {
    //FANCYBOX -->
    //<script type="text/javascript" src="/ScriptLibrary/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    echo '
        <link rel="stylesheet" type="text/css" href="/ScriptLibrary/fancybox/jquery.fancybox-1.3.4.css"/>
        <script type="text/javascript" src="/ScriptLibrary/fancybox/jquery.fancybox-1.3.4.js"></script>
        <script type="text/javascript">
        $(function(){
            //FANCY IMAGENS
            $(".fancybox").fancybox({
                padding				: 0,
                transitionIn		: "elastic",
                transitionOut		: "elastic",
                scrolling			: "no",
                centerOnScroll		: true,
                //hideOnOverlayClick	: false,
                speedIn				: 150,
                speedOut			: 150,
                width				: "auto",
                height				: "auto",
                closeClick 			: true
            });

            //FANCY VIDEOS
            $(".iframe").click(function() {
                $.fancybox({
                    padding				: 0,
                    autoScale			: false,
                    transitionIn		: "none",
                    transitionOut		: "none",
                    scrolling			: "no",
                    centerOnScroll		: true,
                    hideOnOverlayClick	: false,
                    title				: this.title,
                    href				: this.href.replace(new RegExp("watch\\?v=", "i"),"v/"),
                    type				: "swf",
                    swf					: {
                    wmode			: "transparent",
                        allowfullscreen	: "true"
                    }
                });
                return false;
            });
        });
        </script>
    ';
    //FANCYBOX <--
}

if (in_array('BUSCA',$diff)) {
    echo '
        <script type="text/javascript">
        $(function(){
            //ATIVA BUSCA -->
            function redirectSearch() {
                window.location = $("#formSearch").attr("action") + $("#bsa").val();
            }

            //ATIVA SUBMIT EM HREF -->
            $(".buttomSearch").click(function() {
                redirectSearch();
                return false;
            });
            $("#formSearch").submit(function() {
                redirectSearch();
                return false;
            });
            //ATIVA BUSCA <--

            //ATIVA SUBMIT AO APERTAR TECLA ENTER NO CAMPO -->
            $("#bsa").focus(function(){
                 $(this).keypress(function(e){
                     var interacao = $(this).val();

                     if(e.keyCode == 13 && interacao == "")  // Se ao teclar enter o campo for vazio, não faz nada.
                     {
                        e.preventDefault();
                     }

                     if(e.keyCode == 13 && interacao != "") // Se ao teclar enter o campo não for vazio, chama uma função
                     {
                         // Aqui a função que chama o submit.
                        $("#formSearch").submit();
                        return false;
                     }
                });
            });
            //ATIVA SUBMIT AO APERTAR TECLA ENTER NO CAMPO <--
        });
        </script>
    ';
}
?>