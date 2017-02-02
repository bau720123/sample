The purpose of this class is to resize images on the fly using some parameters set in the query string.

Installation:
You just need to include imageresize.class.php in your codes, create a new instance of the class and call the resize() method of the class. You can check the sample.php file to see it in action.

How to use:
In order to download, crop and resize images you should include url, width, height and some other parameters in the query string.

The parameters you can use are as follows:
width=(int) pixels
height=(int) pixels
grey=1
watermark=1
watermark_position=either of [bottom-left,bottom-right,top-left,top-right,center]

Note: You can use all the options together

Examples: 
To download the image with its original size:
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg

To resize the image to the width of 200 pixels and keep the aspect ratio
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=200

To resize the image to the height of 300 pixels and keep the aspect ratio
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&height=300

To resize the image to the width of 180 and height of 150 pixels and crop it intellegently
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=180&height=150

To resize the image to the width of 400 and height of 300 pixels and crop it intellegently and convert it to grey
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=400&height=300&grey=1

To resize the image to the width of 300 and height of 200 pixels and crop it from the original position of 40,80 (x,y)
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=300&height=200&offsetX=40&offsetY=80

To add watermark to the cropped image at its bottom left.
http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=180&height=150&watermark=1&watermark_position=bottom-left


License:
This program is free for non-commercial use.

Please send any comments and questions to my email address:
haghparast@gmail.com