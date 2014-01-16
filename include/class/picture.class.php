<?php
/**
 * 调整图像大小
 *
 * @author <judasnow@gmail.com>
 */
class picture{

		//图片的信息
		private $picture_prop;
		//相应格式应该使用的函数
		private $picture_type;
		//图片读入函数
		private $image_create_from;
		//图片输出函数
		private $inage_output;

		function __construct( $picture_prop ){
			
			 $this->picture_prop = $picture_prop;
				
		}

		/**
		 * 按照用户提供新的高度调整图片的大小,新的长宽可只设置一个。
		 * 另一个参数会按比例生成。
		 *  
		 * @param string $file_name 调整大小后的图片存放的位置及文件名
		 * @param int $new_height 调整后图片的高
		 * @param int $new_width 调整后图片的宽   
		 *
		 * @return bool 
		 */
		function resize_picture( $file_name , $max_width = 0 , $max_height = 0 ){
					
			//判断图片格式，初始化不同的函数
			$this->picture_type = $this->picture_prop['type'];
			switch( $this->picture_type ){

				case 'image/jpeg' : 
					$image_create_from = 'imagecreatefromjpeg';
					$image_output = 'imagejpeg';
					break;
				case 'image/png' :
					$image_create_from = 'imagecreatefrompng';
					$image_output='imagepng';
					break;
				case 'image/gif' :
					$image_create_from = 'imagecreatefromgif';
					$image_output='imagegif';
					break;
				default :
					//@todo 此处处理不妥当
					throw new Exception( '对不起，暂时不支持您上传的文件类型' );
					break;
			}

			//得到图片的原始尺寸
			list ( $original_width , $original_height ) =  getimagesize( $this->picture_prop['tmp_name'] );

			//得到图像的原始比例
			$ratio = $original_width / $original_height ;
			
			$max_width = min( $original_width , $max_width );
			if( $max_width == 0 ){
	 	 	 	 $max_width = $original_width;
			}
	 	 	$max_height = min( $original_height , $max_height );	
			if( $max_height == 0 ){	 
	 	 	 	 $max_height = $original_height;
			}

			$new_width = $max_width;
			$new_height = $new_width / $ratio;

			if( $new_height > $max_height ){
				 
				$new_height = $max_height;
				$new_width = $max_height * $ratio;
			}

			//打开原始图片
			//@todo 错误处理 
			$image_original = @$image_create_from( $this->picture_prop['tmp_name'] );

			//新建一个图片
			$image_tmp = imagecreatetruecolor( $new_width , $new_height );
			imagecopyresampled( $image_tmp, $image_original , 0 , 0 , 0 , 0 , 
					   $new_width , $new_height , $original_width, $original_height );

			// 输出图片到指定文件夹中
			$image_output( $image_tmp , $file_name , 100 );
		}
}
















