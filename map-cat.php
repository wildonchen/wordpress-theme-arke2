<?php
/*
 * @Author: chenqiwei.net 
 * @Date: 2021-05-24 22:50:49 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-30 20:39:05
 */
//https://lbsyun.baidu.com/jsdemo.htm
?>

<style type="text/css">
    .cat-banner {
        display: none;
    }

    .map .entry-title {
        float: unset;
    }

    .anchorBL {
        display: none;
    }

    .BMapLabel {
        border-radius: 4px;
        border: 1px solid #7d7d7d !important;
        padding: 2px 4px !important;
    }

    .map-info {
        font-size: 14px;
    }

    .content-area {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
    }
    .BMap_noprint{
        border-radius: 50%;
        border: 2px solid #4682b4 !important;
        margin: -1.8px !important;
    }
</style>


<div class="entry-content  fadeIn animated">
    <div id="my-map">
    </div>
</div>
<div class="map-info">

</div>
<?php
$mapList = '';
query_posts('cat=12');
while (have_posts()) : the_post();
    $key = get_post_meta(get_the_ID(), 'city', true);
    if ($key) {
        if (has_post_thumbnail()) {
            $img=',"'.wp_get_attachment_url(get_post_thumbnail_id(@$post->ID)).'?x-oss-process=image/resize,m_fill,h_24,w_24/circle,r_100/format,webp"';
        }
        else if (catch_that_image()){
            $img=',"'.catch_that_image().'?x-oss-process=image/resize,m_fill,h_24,w_24/circle,r_100/format,webp"';
        }
        else{
            $img=',"'.blog_theme_url('/assets/img/avatar.png?image/resize,m_fill,h_24,w_24/circle,r_100/format,webp').'"';
        }
        $getCon=mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 160, ' ...');
        $getCon=str_replace(array("\r\n", "\r", "\n", "\""), "", $getCon);
        //url 标题，内容，时间
        $con = ',"'.esc_url(get_permalink()).'||'.get_the_title().'||'.$getCon.'||'.get_the_date('Y-m-d').'"';
        $mapList .= 'setPoint("' . $key . '"'.$img.$con.');';
    }
endwhile;
wp_reset_query();
?>
<script type="text/javascript">
    var where = window.location.hash.split('=');
    where=where[1]?decodeURIComponent(where[1]):null;
    loadScript("/assets/css/map.min.css", "css", "map-css", "head");
    function mapCon(){
        <?php echo $mapList; ?>
    }
    try {
        bdmap(where);
        
    } catch (err) {
        loadScript("//api.map.baidu.com/getscript?type=webgl&v=1.0&ak=k9I4KFTuj5t73H9C7tc2MVqBpcVA9g39&services=&t=20210408201030", "js", "baidu-map-js", "body");
        document.getElementById("baidu-map-js").onload = function() {
            loadScript("/assets/js/map.min.js", "js", "map-js", "body");
            document.getElementById("map-js").onload = function() {
                bdmap(where);
            }
        }
    }
</script>

<?php
/*
//http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/2020/index.html
$mapAry = array(
    "北京",
    "天津",
    "石家庄",
    "唐山",
    "秦皇岛",
    "邯郸",
    "邢台",
    "保定",
    "张家口",
    "承德",
    "沧州",
    "廊坊",
    "衡水",
    "太原",
    "大同",
    "阳泉",
    "长治",
    "晋城",
    "朔州",
    "晋中",
    "运城",
    "忻州",
    "临汾",
    "吕梁",
    "太原",
    "大同",
    "阳泉",
    "长治",
    "晋城",
    "朔州",
    "晋中",
    "运城",
    "忻州",
    "临汾",
    "吕梁",
    "呼和浩特",
    "包头",
    "乌海",
    "赤峰",
    "通辽",
    "鄂尔多斯",
    "呼伦贝尔",
    "巴彦淖尔",
    "乌兰察布",
    "兴安",
    "锡林郭勒",
    "阿拉善",
    "沈阳",
    "大连",
    "鞍山",
    "抚顺",
    "本溪",
    "丹东",
    "锦州",
    "营口",
    "阜新",
    "辽阳",
    "盘锦",
    "铁岭",
    "朝阳",
    "葫芦岛",
    "长春",
    "吉林",
    "四平",
    "辽源",
    "通化",
    "白山",
    "松原",
    "白城",
    "延边",
    "哈尔滨",
    "齐齐哈尔",
    "鸡西",
    "鹤岗",
    "双鸭山",
    "大庆",
    "伊春",
    "佳木斯",
    "七台河",
    "牡丹江",
    "黑河",
    "绥化",
    "大兴安岭",
    "上海",
    "南京",
    "无锡",
    "徐州",
    "常州",
    "苏州",
    "南通",
    "连云港",
    "淮安",
    "盐城",
    "扬州",
    "镇江",
    "泰州",
    "宿迁",
    "杭州",
    "宁波",
    "温州",
    "嘉兴",
    "湖州",
    "绍兴",
    "金华",
    "衢州",
    "舟山",
    "台州",
    "丽水",
    "合肥",
    "芜湖",
    "蚌埠",
    "淮南",
    "马鞍山",
    "淮北",
    "铜陵",
    "安庆",
    "黄山",
    "滁州",
    "阜阳",
    "宿州",
    "六安",
    "亳州",
    "池州",
    "宣城",
    "福州",
    "厦门",
    "莆田",
    "三明",
    "泉州",
    "漳州",
    "南平",
    "龙岩",
    "宁德",
    "南昌",
    "景德镇",
    "萍乡",
    "九江",
    "新余",
    "鹰潭",
    "赣州",
    "吉安",
    "宜春",
    "抚州",
    "上饶",
    "济南",
    "青岛",
    "淄博",
    "枣庄",
    "东营",
    "烟台",
    "潍坊",
    "济宁",
    "泰安",
    "威海",
    "日照",
    "临沂",
    "德州",
    "聊城",
    "滨州",
    "菏泽",
    "郑州",
    "开封",
    "洛阳",
    "平顶山",
    "安阳",
    "鹤壁",
    "新乡",
    "焦作",
    "濮阳",
    "许昌",
    "漯河",
    "三门峡",
    "南阳",
    "商丘",
    "信阳",
    "周口",
    "驻马店",
    "武汉",
    "黄石",
    "十堰",
    "宜昌",
    "襄阳",
    "鄂州",
    "荆门",
    "孝感",
    "荆州",
    "黄冈",
    "咸宁",
    "随州",
    "恩施",
    "长沙",
    "株洲",
    "湘潭",
    "衡阳",
    "邵阳",
    "岳阳",
    "常德",
    "张家界",
    "益阳",
    "郴州",
    "永州",
    "怀化",
    "娄底",
    "湘西",
    "广州",
    "韶关",
    "深圳",
    "珠海",
    "汕头",
    "佛山",
    "江门",
    "湛江",
    "茂名",
    "肇庆",
    "惠州",
    "梅州",
    "汕尾",
    "河源",
    "阳江",
    "清远",
    "东莞",
    "中山",
    "潮州",
    "揭阳",
    "云浮",
    "南宁",
    "柳州",
    "桂林",
    "梧州",
    "北海",
    "防城港",
    "钦州",
    "贵港",
    "玉林",
    "百色",
    "贺州",
    "河池",
    "来宾",
    "崇左",
    "海口",
    "三亚",
    "三沙",
    "儋州",
    "重庆",
    "成都",
    "自贡",
    "攀枝花",
    "泸州",
    "德阳",
    "绵阳",
    "广元",
    "遂宁",
    "内江",
    "乐山",
    "南充",
    "眉山",
    "宜宾",
    "广安",
    "达州",
    "雅安",
    "巴中",
    "资阳",
    "阿坝",
    "甘孜",
    "凉山",
    "贵阳",
    "六盘水",
    "遵义",
    "安顺",
    "毕节",
    "铜仁",
    "黔西南",
    "黔东南",
    "黔南",
    "昆明",
    "曲靖",
    "玉溪",
    "保山",
    "昭通",
    "丽江",
    "普洱",
    "临沧",
    "楚雄",
    "红河",
    "文山",
    "西双版纳",
    "大理",
    "德宏",
    "怒江",
    "迪庆",
    "拉萨",
    "日喀则",
    "昌都",
    "林芝",
    "山南",
    "那曲",
    "阿里",
    "西安",
    "铜川",
    "宝鸡",
    "咸阳",
    "渭南",
    "延安",
    "汉中",
    "榆林",
    "安康",
    "商洛",
    "兰州",
    "嘉峪关",
    "金昌",
    "白银",
    "天水",
    "武威",
    "张掖",
    "平凉",
    "酒泉",
    "庆阳",
    "定西",
    "陇南",
    "临夏",
    "甘南",
    "西宁",
    "海东",
    "海北",
    "黄南",
    "海南",
    "果洛",
    "玉树",
    "海西",
    "银川",
    "石嘴山",
    "吴忠",
    "固原",
    "中卫",
    "乌鲁木齐",
    "克拉玛依",
    "吐鲁番",
    "哈密",
    "昌吉",
    "博尔塔拉",
    "巴音郭楞",
    "阿克苏",
    "克孜勒苏柯尔克孜",
    "喀什",
    "和田",
    "伊犁哈萨克",
    "塔城",
    "阿勒泰",
);
*/
?>