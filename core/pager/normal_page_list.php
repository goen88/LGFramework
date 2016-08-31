<?php
//by hd
class normal_page_list
{
var $disp;
function normal_page_list($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE,$other)
{
	$base_url = str_replace("?&","?",rtrim($base_url,"&"));
	$base_url = str_replace("&&","&",rtrim($base_url,"&"));
	if(strstr($base_url,"=")){
		$base_url = $base_url."&";
	}
	$total_pages = ceil($num_items/$per_page);              //共多少页
	if ($total_pages <= 1)                                  //如只有一页 
	{
		return '';
	}

	$on_page = floor($start_item / $per_page) + 1;          //当前页
	//echo "当前页：$on_page<br>";
	$page_string = '';                                      //初始化返回字符串
	if (($total_pages > 12) && ($on_page>8)) //如多于15页
	{     
		    $startp=$on_page-5;
		    $endp=$startp+12;
		    for($i = $startp; $i < $endp ; $i++)
		    {
		    	$page_string .= ($i == $on_page) ? ('<a class="checked">'.$i.'</a>') 
		    	                                 : ('<a href="' . $base_url . "offset=" . (($i - 1) * $per_page) .$other. '">' . $i . '</a>');
		    	if ($i <  $total_pages)
		    	{
		    		$page_string .= ' ';
		    	}
		    }    
	}
	elseif ($total_pages <=12)                                    //如果页数小于15,则把这些页数全都显示出来
	{
		    for($i = 1; $i < $total_pages + 1; $i++)
		    {
		    	$page_string .= ($i == $on_page) ? ('<a class="checked">'.$i.'</a>') 
		    	                                 : ('<a href="' . $base_url . "offset=" . (($i - 1) * $per_page) .$other. '">' . $i . '</a>');
		    	if ($i <  $total_pages)
		    	{
		    		$page_string .= ' ';
		    	}
		    }
	}
	else
	{
		    for($i = 1; $i < 12 + 1; $i++)
		    {
		    	$page_string .= ($i == $on_page) ? ('<a class="checked">'.$i.'</a>') 
		    	                                 : ('<a href="' . $base_url . "offset=" . (($i - 1) * $per_page) .$other. '">' . $i . '</a>');
		    	if ($i <  $total_pages)
		    	{
		    		$page_string .= ' ';
		    	}
		    }		
	}
	
	if ($on_page>($total_pages-12) && ($total_pages>12))
	{     $page_string='';
		    $startp=$total_pages-12;
		    $endp=$startp+12;
		    for($i = $startp; $i < $endp + 1; $i++)
		    {
		    	$page_string .= ($i == $on_page) ? ('<a class="checked">'.$i.'</a>') 
		    	                                 : ('<a href="' . $base_url . "offset=" . (($i - 1) * $per_page) .$other. '">' . $i . '</a>');
		    	if ($i <  $total_pages)
		    	{
		    		$page_string .= ' ';
		    	}
		    }  		
	}

	if ($add_prevnext_text)                           //如添加prev next选项为真
	{
		if ($on_page > 1)                         //如当前页不在第1页,显示prev用来回到前一页
		{
			$page_string = "<input type='button'  class='pre' onclick='location.href=\"" . $base_url . "offset=" .(($on_page - 2 ) * $per_page) .$other. "\"'/>" . $page_string;//.'<input type="button"  class="next"/>';
		}

		if ($on_page < $total_pages)             //如当前页不在最后1页,显示next用来前进到下一页  
		{
			//$page_string = '<input type="button"  class="pre"/>'.$page_string;
			$page_string .=   "<input type='button'  class='next' onclick='location.href=\"".$base_url . "offset=" . ($on_page * $per_page) .$other."\"'/>";
		}
	}
	

	$page_string = "$page_string".'&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
        	跳转到&nbsp;&nbsp; <input type="text"  class="goPage" onkeyup="goPageListener(event,this);" value="'.$on_page.'" />&nbsp;&nbsp; 页 
        	<input type="button"  class="confirmBtn" onclick="gotoPage(event,this,'.$total_pages.','.$per_page.',\''.$base_url.'\',\''.$other.'\')"/>';
	$this->disp=$page_string;
}

}
?>
