<?php

/**
 * Yii2 PHP Free chat
 *
 * @author Marc Oliveras <admin@oligalma.com> 
 * @link http://www.oligalma.com
 * @copyright 2015 Oligalma
 * @license GPLv3 License
 */

namespace ho96\phpfreechat;

use Yii;
use yii\web\View;
use yii\base\Widget;

class PHPFreeChat extends Widget
{
	private $_assetsUrl;
	
	public function run()
	{
		if($this->_assetsUrl === null)
		{
			$assets = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
			$this -> _assetsUrl = Yii::$app->getAssetManager()->publish($assets, array('beforeCopy' => 
			    function($from, $to)
			    {
				if(strpos($from, '.directory') < 1)
				  return $from;
			    }
			 ));
		}

		$this->getView()->registerJs("
			resizeIframe();
			
			$(window).resize(function(){
				resizeIframe();
			});
			
			function resizeIframe()
			{
				$('iframe').attr('width',$('#iframe-div').width());
				$('iframe').attr('height','770');			
			}
		      ", View::POS_END, 'iframe');
				
		echo '<div id="iframe-div">';
		echo	'<iframe src="' . $this->_assetsUrl[1] . '/phpfreechat"></iframe>';
		echo '</div>';
	}
}
