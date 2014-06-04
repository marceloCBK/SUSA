<?php

//*** DMXzone Paginator PHP ----------------------------------------------------

// Copyright 2010 (c) DMXzone.com

//

// Version: 1.0.2.1

//------------------------------------------------------------------------------



class dmxPaginator

{

    var $numPages;

    var $showNextPrev;

    var $showFirstLast;

    var $numPagelinks;

    var $recordsetName;

    var $feedGenieName;

    var $rowsPerPage;

    var $rowsTotal;

    var $prevLabel;

    var $nextLabel;

    var $firstLabel;

    var $lastLabel;

    var $adjacentLinks;

    var $outerLinks;

    var $pageNumSeparator;
	
	var $pageLinkClass;

    

    function dmxPaginator()

    {

        $this->numPages = 200;

        $this->showNextPrev = true;

        $this->showFirstLast = false;

        $this->numPagelinks = 5;

        $this->recordsetName = "";

        $this->feedGenieName = "";

        $this->rowsPerPage = 2;

        $this->rowsTotal = 10;

        $this->prevLabel = "&lsaquo;";

        $this->nextLabel = "&rsaquo;";

        $this->firstLabel = "&lsaquo;&lsaquo;";

        $this->lastLabel = "&rsaquo;&rsaquo;";

        $this->adjacentLinks = 2;

        $this->outerLinks = 1;

        $this->pageNumSeparator = "...";
		
		$this->pageLinkClass = "";

        

    }

    

    function addPagination()

    {

        $pageNo = 1;

        $recPerPage = 1;

        if ($this->recordsetName != "") {

        	$dsName = $this->recordsetName;

        	$offsetName = "pageNum_";

        	$useOffset = 0;

        } else {

        	$dsName = $this->feedGenieName;

        	$offsetName = "offset_";

        	$useOffset = 1;

        	$recPerPage = $this->rowsPerPage;

        }

        

        $this->numPages = ceil($this->rowsTotal / $this->rowsPerPage);

        if ($this->numPages < 2)

        {

            return;

        }

       // $curPageUrl = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], "/") +1);
		$curPageUrl = "/";

        if (isset($_GET[$offsetName.$dsName]))

        {
			$pageNumCorrent = intval($_GET[$offsetName.$dsName])-1;

        	if ($useOffset == 0) {

            	//$pageNo = intval($_GET[$offsetName.$dsName]) + 1;
				$pageNo = $pageNumCorrent + 1;

            } else {

            	//$pageNo = (intval($_GET[$offsetName.$dsName]) / $this->rowsPerPage) + 1;
				$pageNo = (intval($pageNumCorrent) / $this->rowsPerPage) + 1;

            }

        }

        $pageNumParam = $offsetName.$dsName."=";

       // $curPageUrl .= "?";

        

        $queryString = "";

        if (!empty($_SERVER['QUERY_STRING'])) 

        {

              //$params = explode("&", $_SERVER['QUERY_STRING']);
			  $params = explode("=", $_SERVER['QUERY_STRING']);
			  
			  $queryString = "/";
			  $newParams = explode("/", $params[1]);
			  $newParams = array_filter($newParams);
			  $newParamsCount = count($newParams);	  
			  $aux=1;
			  
			  foreach($newParams as $param)
			  {
				  if($aux == $newParamsCount)
				  {
					  if (!preg_match('/^([0-9]+)$/', $param))
					  {
						  $queryString.= $param."/";
					  }
				  }
				   
				  else
				  
				  {
					  $queryString.= $param."/";
				  }
				  
				  $aux++;
			  }
			  
        }        

        echo "<div class=\"dmxpagination\">";

        if ($this->showFirstLast)

        {

            if ($pageNo == 1)

            {

                echo "<span class=\"disabled\">".$this->firstLabel."</span>";

            }

            else

            {

                $prev = $pageNo - 1;

                echo "<a href=\"".$queryString."1\" class=\"previous ".$this->pageLinkClass."\">".$this->firstLabel."</a>";

            }    

        }

        if ($this->showNextPrev)

        {

            if ($pageNo == 1)

            {

                echo "<span class=\"disabled\">".$this->prevLabel."</span>";

            }

            else

            {

                $prev = $pageNo - 1;

                echo "<a href=\"".$queryString.((($prev-1)*$recPerPage)+1)."\" class=\"previous ".$this->pageLinkClass."\">".$this->prevLabel."</a>";

                

            }    

        }

        if($this->numPages < (($this->outerLinks + $this->adjacentLinks)*2 + 1))

        {

            for ($i = 1; $i < $this->numPages + 1; $i++)

            {

                if ($pageNo == $i)

                {

                    echo "<span class=\"current\">".$i."</span>";

                }

                else

                {

                    echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                }

            }

        }

        else

        {

            if($pageNo < $this->outerLinks + $this->adjacentLinks + 2)

            {

                for ($i = 1; $i < ($this->outerLinks + $this->adjacentLinks*2 + 2); $i++)

                {

                    if ($pageNo == $i)

                    {

                        echo "<span class=\"current\">".$i."</span>";

                    }

                    else

                    {

                        echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                    }

                }

                if ($this->outerLinks > 0)

                {

                    echo $this->pageNumSeparator;

                }    

                for ($i = $this->numPages - $this->outerLinks + 1; $i < $this->numPages + 1; $i++)

                {

                    echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                }

            }

            else 

            {

                if ($pageNo < $this->numPages - $this->outerLinks - $this->adjacentLinks)

                {

                    for ($i = 1; $i < $this->outerLinks + 1; $i++)

                    {

                                echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                    }

                    if ($this->outerLinks > 0)

                    {

                        echo $this->pageNumSeparator;

                    }

                    for ($i = $pageNo - $this->adjacentLinks; $i < $pageNo + $this->adjacentLinks + 1; $i++)

                    {

                        if ($pageNo == $i)

                        {

                            echo "<span class=\"current\">".$i."</span>";

                        }

                        else

                        {

                            echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                        }

                    }

                    if ($this->outerLinks > 0)

                    {

                        echo $this->pageNumSeparator;

                    }

                    for ($i = $this->numPages - $this->outerLinks + 1; $i < $this->numPages + 1; $i++)

                    {

                        echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                    }

                }

                else

                {

                    for ($i = 1; $i < $this->outerLinks + 1; $i++)

                    {

                        echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                    }

                    if ($this->outerLinks > 0)

                    {

                        echo $this->pageNumSeparator;

                    }

                    for($i = $this->numPages - ($this->outerLinks + ($this->adjacentLinks*2)); $i < $this->numPages + 1; $i++)

                    {

                        if ($pageNo == $i)

                        {

                            echo "<span class=\"current\">".$i."</span>";

                        }

                        else

                        {

                            echo "<a href=\"".$queryString.((($i - 1)*$recPerPage)+1)."\" class=\"".$this->pageLinkClass."\">".$i."</a>";

                        }

                    }

                }

            }

        }

        if ($this->showNextPrev)

        {

            if ($pageNo == $this->numPages)

            {

                echo "<span class=\"disabled\">".$this->nextLabel."</span>";

            }

            else

            {

                $next = $pageNo + 1;

                echo "<a href=\"".$queryString.((($next - 1)*$recPerPage)+1)."\" class=\"next ".$this->pageLinkClass."\">".$this->nextLabel."</a>";

            }

        }

        if ($this->showFirstLast)

        {

            if ($pageNo == $this->numPages)

            {

                echo "<span class=\"disabled\">".$this->lastLabel."</span>";

            }

            else

            {

                $next = $pageNo + 1;

                echo "<a href=\"".$queryString.((($this->numPages - 1)*$recPerPage)+1)."\" class=\"next ".$this->pageLinkClass."\">".$this->lastLabel."</a>";

            }

        }

        echo "</div>";

    }

}

?>