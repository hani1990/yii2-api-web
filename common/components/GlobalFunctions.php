<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/12/25
 * Time: 下午5:05
 */

    function cache()
    {
        return Yii::$app->cache;
    }



/**
 * 发送HTTP POST请求
 * @param $url
 * @param $data
 * @param string $referer
 * @return mixed
 */
if (function_exists("curl_init")) {
    function http_post_data($url, $data, $referer = '')
    {
        $ch = curl_init();
        $timeout = 300;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $referer);   //构造来路
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $handles = curl_exec($ch);
        curl_close($ch);
        return $handles;
    }
} else {
    function http_post_data($url, $data, $referer = '')
    {
        if (!is_array($data)) {
            return;
        }
        $data = http_build_query($data);
        $url = parse_url($url);
        if (!isset($url['scheme']) || $url['scheme'] != 'http') {
            die('Error: Only HTTP request are supported !');
        }
        $host = $url['host'];
        $path = isset($url['path']) ? $url['path'] : '/';
        // open a socket connection on port 80 - timeout: 30 sec
        $fp = fsockopen($host, 80, $errno, $errstr, 30);
        if ($fp) {
            // send the request headers:
            $length = strlen($data);
            $POST = <<<HEADER
POST {$path} HTTP/1.1
Accept: text/plain, text/html
Referer: {$referer}
Accept-Language: zh-CN,zh;q=0.8
Content-Type: application/x-www-form-urlencodem
Cookie: var=value; var2=value2
User-Agent: Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.56 Safari/537.17
Host: {$host}
Content-Length: {$length}
Pragma: no-cache
Cache-Control: no-cache
Connection: close\r\n
{$data}
HEADER;
            fwrite($fp, $POST);
            $result = '';
            while (!feof($fp)) {
                // receive the results of the request
                $result .= fread($fp, 512);
            }
        } else {
            return "";
        }
        // close the socket connection:
        fclose($fp);
        // split the result header from the content
        $result = explode("\r\n\r\n", $result, 2);
        // return as structured array:
        return isset($result[1]) ? $result[1] : '';
    }
}
/*
 * get redis
 * */
    function redis()
    {
        return Yii::$app->redis;
    }


    /**
     * 文件下载
     * @param string 文件本地路径
     */
     function outputFile($fullPath) {
        $file_name = $fullPath;//图片链接
        $path_parts = pathinfo($fullPath);
        $mime = 'application/force-download';

        header('Pragma: public'); // required

        header('Expires: 0'); // no cache

        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

        header('Cache-Control: private',false);

        header('Content-Type: '.$mime);

        header('Content-Disposition: attachment; filename='.$path_parts['basename']);

        header('Content-Transfer-Encoding: binary');

        header('Connection: close');

        readfile($file_name); // push it out

        exit();
    }


    /**
     * 把返回的数据集转换成Tree
     *
     * @param array $list
     *        	要转换的数据集
     * @param string $pid
     *        	parent标记字段
     * @param string $level
     *        	level标记字段
     * @return array
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */

    function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = array ();
        if (is_array ( $list )) {
            // 创建基于主键的数组引用
            $refer = array ();
            foreach ( $list as $key => $data ) {
                $refer [$data [$pk]] = & $list [$key];
            }
            foreach ( $list as $key => $data ) {
                // 判断是否存在parent
                $parentId = $data [$pid];
                if ($root == $parentId) {
                    $tree [] = & $list [$key];
                } else {
                    if (isset ( $refer [$parentId] )) {
                        $parent = & $refer [$parentId];
                        $parent [$child] [] = & $list [$key];
                    }
                }
            }
        }
        return $tree;
    }


    /**
     * 将list_to_tree的树还原成列表
     *
     * @param array $tree
     *        	原来的树
     * @param string $child
     *        	孩子节点的键
     * @param string $order
     *        	排序显示的键，一般是主键 升序排列
     * @param array $list
     *        	过渡用的中间数组，
     * @return array 返回排过序的列表数组
     * @author 凡星
     */
    function tree_to_list($tree, $child = '_child', $order = 'id', &$list = array()) {
        if (is_array ( $tree )) {
            $refer = array ();
            foreach ( $tree as $key => $value ) {
                $reffer = $value;
                if (isset ( $reffer [$child] )) {
                    unset ( $reffer [$child] );
                    tree_to_list ( $value [$child], $child, $order, $list );
                }
                $list [] = $reffer;
            }
            $list = list_sort_by ( $list, $order, $sortby = 'asc' );
        }
        return $list;
    }
    /**
     * 树形列表
     *
     * @param array $list
     *        	数据库原始数据
     * @param array $res_list
     *        	返回的结果数组
     * @param int $pid
     *        	上级ID
     * @param int $level
     *        	当前处理的层级
     */
    function list_tree($list, &$res_list, $pid = 0, $level = 0) {
        foreach ( $list as $k => $v ) {
            if (intval ( $v ['pid'] ) != $pid)
                continue;

            if ($level > 0) {
                $space = '';
                for($i = 1; $i < $level; $i ++) {
                    $space .= '──';
                }
                $v ['title'] = '├──' . $space . $v ['title'];
            }

            $v ['level'] = $level;
            $res_list [] = $v;
            unset ( $list [$k] );

            list_tree ( $list, $res_list, $v ['id'], $level + 1 );
        }
    }
    
    
    
    /**
     * 对查询结果集进行排序
     *
     * @access public
     * @param array $list
     *        	查询结果
     * @param string $field
     *        	排序的字段名
     * @param array $sortby
     *        	排序类型
     *        	asc正向排序 desc逆向排序 nat自然排序
     * @return array
     *
     */
    function list_sort_by($list, $field, $sortby = 'asc') {
        if (is_array ( $list )) {
            $refer = $resultSet = array ();
            foreach ( $list as $i => $data )
                $refer [$i] = &$data [$field];
            switch ($sortby) {
                case 'asc' : // 正向排序
                    asort ( $refer );
                    break;
                case 'desc' : // 逆向排序
                    arsort ( $refer );
                    break;
                case 'nat' : // 自然排序
                    natcasesort ( $refer );
                    break;
            }
            foreach ( $refer as $key => $val )
                $resultSet [] = &$list [$key];
            return $resultSet;
        }
        return false;
    }

/*
 *  阿拉伯数字转中文表述，如101转成一百零一
 * */
function num2cn($number) {
    $number = intval ( $number );
    $capnum = array (
        "零",
        "一",
        "二",
        "三",
        "四",
        "五",
        "六",
        "七",
        "八",
        "九"
    );
    $capdigit = array (
        "",
        "十",
        "百",
        "千",
        "万"
    );

    $data_arr = str_split ( $number );
    $count = count ( $data_arr );
    for($i = 0; $i < $count; $i ++) {
        $d = $capnum [$data_arr [$i]];
        $arr [] = $d != '零' ? $d . $capdigit [$count - $i - 1] : $d;
    }
    $cncap = implode ( "", $arr );

    $cncap = preg_replace ( "/(零)+/", "0", $cncap ); // 合并连续“零”
    $cncap = trim ( $cncap, '0' );
    $cncap = str_replace ( "0", "零", $cncap ); // 合并连续“零”
    $cncap == '一十' && $cncap = '十';
    $cncap == '' && $cncap = '零';
    // echo ( $data.' : '.$cncap.' <br/>' );
    return $cncap;
}