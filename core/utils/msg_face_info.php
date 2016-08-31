<?php
class msg_face_info
{
	  function msg_face_info()
	  {
		    //nothing
	  }
	  
	  function get_face_img($msgstr)
	  {
		    $arr_face_str=array("[眨眼]","[微笑]",
		    "[大笑]","[笑脸]",
		    "[白眼]","[发怒]",
		    "[鼓掌]","[偷笑]",
		    "[流泪]","[可爱]",
		    "[晕]","[流汗]",
		    "[发呆]","[害羞]",
		    "[惊讶]","[哈哈]",
		    "[色色]","[酷]",
		    "[骷髅]","[哈欠]",
		    "[睡觉]","[调皮]",
		    "[亲亲]","[疑问]",
		    "[闭嘴]","[难过]",
		    "[冷汗]","[奋斗]",
		    "[鄙视]","[猪头]"
            );
		    $arr_face_img=array("<img src='/i/f/zayan.gif'>","<img src='/i/f/weixiao.gif'>",
		    "<img src='/i/f/daxiao.gif'>","<img src='/i/f/xiaolian.gif'>",
		    "<img src='/i/f/baiyan.gif'>","<img src='/i/f/fanu.gif'>",
		    "<img src='/i/f/guzhang.gif'>","<img src='/i/f/touxiao.gif'>",
		    "<img src='/i/f/liulei.gif'>","<img src='/i/f/keai.gif'>",
		    "<img src='/i/f/yun.gif'>","<img src='/i/f/liuhan.gif'>",
		    "<img src='/i/f/fadai.gif'>","<img src='/i/f/haixiu.gif'>",
		    "<img src='/i/f/jingya.gif'>","<img src='/i/f/haha.gif'>",
		    "<img src='/i/f/se.gif'>","<img src='/i/f/ku.gif'>",
		    "<img src='/i/f/kulou.gif'>","<img src='/i/f/haqian.gif'>",
		    "<img src='/i/f/shuijiao.gif'>","<img src='/i/f/tiaopi.gif'>",
		    "<img src='/i/f/qin.gif'>","<img src='/i/f/yiwen.gif'>",
		    "<img src='/i/f/bizui.gif'>","<img src='/i/f/nanguo.gif'>",
		    "<img src='/i/f/lenghan.gif'>","<img src='/i/f/fendou.gif'>",
		    "<img src='/i/f/bishi.gif'>","<img src='/i/f/zhu.gif'>"
		    );
		    
		    $newphrase = str_replace($arr_face_str, $arr_face_img, $msgstr);
		    return $newphrase;
	  }


	  function get_word_cont_with_img($message)
	  {
		   $arr_face_str=array("[眨眼]","[微笑]",
		    "[大笑]","[笑脸]",
		    "[白眼]","[发怒]",
		    "[鼓掌]","[偷笑]",
		    "[流泪]","[可爱]",
		    "[晕]","[流汗]",
		    "[发呆]","[害羞]",
		    "[惊讶]","[哈哈]",
		    "[色色]","[酷]",
		    "[骷髅]","[哈欠]",
		    "[睡觉]","[调皮]",
		    "[亲亲]","[疑问]",
		    "[闭嘴]","[难过]",
		    "[冷汗]","[奋斗]",
		    "[鄙视]","[猪头]"
            );
		    $arr_face_img=array("<img src='/i/f/zayan.gif'>","<img src='/i/f/weixiao.gif'>",
		    "<img src='/i/f/daxiao.gif'>","<img src='/i/f/xiaolian.gif'>",
		    "<img src='/i/f/baiyan.gif'>","<img src='/i/f/fanu.gif'>",
		    "<img src='/i/f/guzhang.gif'>","<img src='/i/f/touxiao.gif'>",
		    "<img src='/i/f/liulei.gif'>","<img src='/i/f/keai.gif'>",
		    "<img src='/i/f/yun.gif'>","<img src='/i/f/liuhan.gif'>",
		    "<img src='/i/f/fadai.gif'>","<img src='/i/f/haixiu.gif'>",
		    "<img src='/i/f/jingya.gif'>","<img src='/i/f/haha.gif'>",
		    "<img src='/i/f/se.gif'>","<img src='/i/f/ku.gif'>",
		    "<img src='/i/f/kulou.gif'>","<img src='/i/f/haqian.gif'>",
		    "<img src='/i/f/shuijiao.gif'>","<img src='/i/f/tiaopi.gif'>",
		    "<img src='/i/f/qin.gif'>","<img src='/i/f/yiwen.gif'>",
		    "<img src='/i/f/bizui.gif'>","<img src='/i/f/nanguo.gif'>",
		    "<img src='/i/f/lenghan.gif'>","<img src='/i/f/fendou.gif'>",
		    "<img src='/i/f/bishi.gif'>","<img src='/i/f/zhu.gif'>"
		    );

			$newphrase = str_replace($arr_face_img, $arr_face_str, $message);
		    return $newphrase;
		    
	  }
}
?>
