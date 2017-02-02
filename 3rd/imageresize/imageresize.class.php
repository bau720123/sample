<?php
/**
 * Created by PhpStorm.
 * User: Rahman
 * Date: 12/19/2015
 * Time: 3:39 PM
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
function debug($content = "", $exit = false, $raw = true){
    if($raw){
        header('Content-Type: application/json; charset=utf-8');
    } else {
        header("content-type: text/html; charset=UTF-8");
    }
    $whereCalled = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    $whereCalled = array_shift($whereCalled);
    echo $whereCalled['file'] . "\nLine :: " . $whereCalled['line'] . "\n\n";
    print_r($content);
    echo "\r\n\r\n";
    if($exit){
        exit;
    }
}

class ImageResize
{
    public $inputData = array();
    public $params;
    public $tmpFolder;

    public function __construct($input = [])
    {
        $this->params = ltrim($_SERVER['PATH_INFO'], '/');
        $this->inputData = isset($input['request']) ? $input['request'] : $_REQUEST;
        $this->tmpFolder = getcwd() . '/tmp';
        $this->watermarkPath = getcwd() . '/watermark.png';
    }

    protected function _getPage($url, $type = 'get', $cookiePath = null, $postData = null, $returnHeader = false)
    {
        if ($cookiePath == null){
            $cookiePath = $this->tmpFolder;
            //windows servers
            if (strstr($cookiePath,'\\') != '') {
                $cookiePath = str_replace('/','\\',$cookiePath);
            }
        }
        $ch = curl_init();
        $header[] = "Connection: keep-alive;";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiePath);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiePath);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($type == 'put' || $type == 'delete') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($type));
        }
        if ($returnHeader){
            curl_setopt($ch, CURLOPT_HEADER, true);
        }
        curl_setopt($ch, CURLOPT_ENCODING , "");
        if ($type == 'post' || $type == 'put'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
            $header[] = "Expect:  ";
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $response = curl_exec($ch);
        if ($returnHeader){
            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);
            return compact('header', 'body');
        }
        return $response;
    }


    /**
     * @uses resize
     * @uses This function is used to resize/crop an image from a url on the web
    Examples: http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg original image size
    Examples: http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=200 image resized to 200x(calculated height)
    Examples: http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&height=300 image resized to (calculated_width)x300
    Examples: http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=180&height=150 image resized and cropped to 180x150
    Examples: http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=400&height=300&grey=1 image resized and cropped to 400x300 and converted to grayscale
    Examples: http://loclhost/imageresize/sample.php?url=http://newfm.ir/sample.jpg&width=300&height=200&offsetX=40&offsetY=80 image cropped and resized to 300x200. The crop starts from x=40 and y=80
     * @return	an image with image headers
     */
    function resize()
    {
        $imageUrl = $this->inputData['url'];
        $userWidth = $this->inputData['width'];
        $userHeight = $this->inputData['height'];
        $offsetX = $this->inputData['offsetX'];
        $offsetY = $this->inputData['offsetY'];
        $grey = $this->inputData['grey'];
        $watermark = $this->inputData['watermark'];
        $watermarkPosition = $this->inputData['watermark_position'];
        $watermarkPosition = !empty($watermarkPosition) ? $watermarkPosition : 'center';
        $fileName = basename($imageUrl);
        $domainArray = parse_url($imageUrl);
        $domain = $domainArray['host'];
        $filePath = $domainArray['path'];
        $tmp = explode('/', $filePath);
        array_pop($tmp);
        $filePath = implode('/', $tmp);
        $path = $this->tmpFolder . '/' . $domain . '/' . $filePath . '/';
        $path = str_replace('//','/',$path);
        if (!is_dir($path)) {
            mkdir($path, '0755', true);
        }
        $url = $path;
        $path .= $fileName;
        $path = str_replace('//','/',$path);
        if (!file_exists($path)){
            $result = $this->_getPage($imageUrl,'get');
            file_put_contents($path, $result);
        }
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        list($width, $height) = getimagesize($path);
        //no width or height is set from the user
        if (empty($userWidth) && empty($userHeight))
        {
            // Getting headers sent by the client.
            $headers = apache_request_headers();
            // Checking if the client is validating his cache and if it is current.
            if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($path))) {
                // Client's cache IS current, so we just respond '304 Not Modified'.
                header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($path)).' GMT', true, 304);
            } else {
                // Image not cached or cache outdated, we respond '200 OK' and output the image.
                header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($path)).' GMT', true, 200);
                header('Content-Length: '.filesize($path));
                header('Content-Type: image/'.$extension);
            }
            $fp = fopen($path,'r');
            $data = fread($fp, filesize($path));
            echo $data;
            fclose($fp);
            exit;
        }
        $new_width = $userWidth;
        if ($userWidth > 0)
        {
            $new_height = ($userHeight > 0 ? $userHeight : round($height * $new_width/$width));
        }
        elseif ($userHeight > 0)
        {
            $new_height = $userHeight;
            $new_width = round($width * $new_height/$height);
        }
        else
        {
            // Getting headers sent by the client.
            $headers = apache_request_headers();
            // Checking if the client is validating his cache and if it is current.
            if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($path))) {
                // Client's cache IS current, so we just respond '304 Not Modified'.
                header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($path)).' GMT', true, 304);
            } else {
                // Image not cached or cache outdated, we respond '200 OK' and output the image.
                header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($path)).' GMT', true, 200);
                header('Content-Length: '.filesize($path));
                header('Content-Type: image/'.$extension);
            }
            $fp = fopen($path,'r');
            $data = fread($fp, filesize($path));
            echo $data;
            fclose($fp);
            exit;
        }
        if (!is_numeric($new_height))
            $new_height = '';
        if ($grey && $watermark)
            $thumb = $url . 'thumb/grey_watermark_' . $watermarkPosition  . '_' . $new_width . 'x' . $new_height . '_' . $fileName;
        elseif ($watermark)
            $thumb = $url . 'thumb/watermark_' . $watermarkPosition . ' _' . $new_width . 'x' . $new_height . '_' . $fileName;
        elseif ($grey)
            $thumb = $url . 'thumb/grey_' . $new_width . 'x' . $new_height . '_' . $fileName;
        elseif (isset($offsetX))
        {
            $x = $offsetX;
            $y = isset($offsetY) ? $offsetY : 0;
            $thumb = $url . 'thumb/' . $new_width . 'x' . $new_height . '_' . $x . 'x' . $y . '_' . $fileName;
        }
        else
            $thumb = $url . 'thumb/' . $new_width . 'x' . $new_height . '_' . $fileName;
        if (file_exists($thumb))
        {
            // Getting headers sent by the client.
            $headers = apache_request_headers();
            // Checking if the client is validating his cache and if it is current.
            if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($thumb))) {
                // Client's cache IS current, so we just respond '304 Not Modified'.
                header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($thumb)).' GMT', true, 304);
                header('Cache-Control: cache');
                header('Pragma: cache');
                header('Expires: '.date("D, d M Y H:i:s GMT",strtotime('next week GMT')));
            } else {
                // Image not cached or cache outdated, we respond '200 OK' and output the image.
                header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($thumb)).' GMT', true, 200);
                header('Content-Length: '.filesize($thumb));
                header('Content-Type: image/'.$extension);
                header('Cache-Control: cache');
                header('Pragma: cache');
                header('Expires: '.date("D, d M Y H:i:s GMT",strtotime('next week GMT')));
            }
            $fp = fopen($thumb,'r');
            $data = fread($fp, filesize($thumb));
            echo $data;
            fclose($fp);
            exit;
        }
        if (!is_dir($url . 'thumb'))
            mkdir($url . 'thumb');
        header('Content-Type: image/'.$extension);
        $image_p = $this->crop_resize($path, $thumb, $new_width, $new_height,$offsetX, $offsetY);
        if (isset($grey))
        {
            $image_p = $this->convert_grey($thumb,$thumb);
        }
        if (isset($watermark))
        {
            $image_p = $this->add_watermark($thumb, $this->watermarkPath, $watermarkPosition);
        }
        imagejpeg($image_p);
        imagedestroy($image_p);
        exit;
    }

    function crop_resize($original_path, $thumb_path, $thumb_width, $thumb_height,$offsetX, $offsetY)
    {
        $extension = pathinfo($original_path, PATHINFO_EXTENSION);
        $tmp = explode('/',$original_path);
        $type = exif_imagetype($original_path);
        if ($type == 3) //png
            $image = imagecreatefrompng($original_path);
        elseif ($type == 1) //gif
            $image = imagecreatefromgif($original_path);
        elseif ($type == 2) //jpg
            $image = imagecreatefromjpeg($original_path);
        else
            return -1;
        list($width, $height) = getimagesize($original_path);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect )
        {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        }
        else
        {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
        // Resize and crop
        if (!$offsetX)
        {
            imagecopyresampled($thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                0, 0,
                $new_width, $new_height,
                $width, $height);
        }
        elseif ($offsetX)
        {
            $x = $offsetX;
            $y = $offsetY ? $offsetY : 0;
            if ($thumb_width + $x > $width)
                $thumb_width = $width - $x;
            if ($thumb_height + $y > $height)
                $thumb_height = $height - $y;
            $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
            imagecopyresampled ($thumb, $image,0,0,$x,$y,$thumb_width,$thumb_height,$thumb_width,$thumb_height);
        }
        else
        {
            imagecopyresampled($thumb,
                $image,
                0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                0, 0,
                $new_width, $new_height,
                $width, $height);
        }
        imageinterlace($thumb, 1);
        if ($type == 3) //png
            imagepng($thumb, $thumb_path);
        elseif ($type == 1) //gif
            imagegif($thumb, $thumb_path);
        elseif ($type == 2) //jpg
            imagejpeg($thumb, $thumb_path, 80);
        return $thumb;
    }

    function add_watermark($original_path, $watermark_path, $position='center')
    {
        $stamp = imagecreatefrompng($watermark_path);
        $type = exif_imagetype($original_path);
        if ($type == 3) //png
            $image = imagecreatefrompng($original_path);
        elseif ($type == 1) //gif
            $image = imagecreatefromgif($original_path);
        elseif ($type == 2) //jpg
            $image = imagecreatefromjpeg($original_path);
        else
            return -1;
        $original_width = imagesx($image);
        $original_height = imagesy($image);
        $watermark_width = imagesx($stamp);
        $watermark_height = imagesy($stamp);
        if ($position == 'center')
            imagecopy($image, $stamp, ($original_width - $watermark_width)/2,($original_height - $watermark_height)/2, 0, 0, $watermark_width, $watermark_height);
        elseif ($position == 'bottom-right')
            imagecopy($image, $stamp, ($original_width - $watermark_width),($original_height - $watermark_height), 0, 0, $watermark_width, $watermark_height);
        elseif ($position == 'top-right')
            imagecopy($image, $stamp, ($original_width - $watermark_width), 0, 0, 0, $watermark_width, $watermark_height);
        elseif ($position == 'bottom-left')
            imagecopy($image, $stamp, 0,($original_height - $watermark_height), 0, 0, $watermark_width, $watermark_height);
        elseif ($position == 'top-left')
            imagecopy($image, $stamp, 0, 0, 0, 0, $watermark_width, $watermark_height);
        imageinterlace($image, 1);
        if ($type == 3) //png
            imagepng($image, $original_path);
        elseif ($type == 1) //gif
            imagegif($image, $original_path);
        elseif ($type == 2) //jpg
            imagejpeg($image, $original_path, 80);
        return $image;

        imagejpeg($im, $original_path, 95);
        imagejpeg($im);
        imagedestroy($im);
    }

    function convert_grey($original_path, $thumb)
    {
        $type = exif_imagetype($original_path);
        if ($type == 3) //png
            $image = imagecreatefrompng($original_path);
        elseif ($type == 1) //gif
            $image = imagecreatefromgif($original_path);
        elseif ($type == 2) //jpg
            $image = imagecreatefromjpeg($original_path);
        else
            return -1;
        imagefilter($image,IMG_FILTER_GRAYSCALE);
        imageinterlace($image, 1);
        if ($type == 3) //png
            imagepng($image, $thumb);
        elseif ($type == 1) //gif
            imagegif($image, $thumb);
        elseif ($type == 2) //jpg
            imagejpeg($image, $thumb, 80);
        return $image;
    }
}
