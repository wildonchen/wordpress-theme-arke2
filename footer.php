<?php
/*
 * @Author: Danny Cooper
 * @Date: 2021-04-02 20:49:43
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-10-12 23:18:43
 * @copyright Copyright (c) 2018, Danny Cooper
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
*/
?>
<?php wp_footer_pjax(); ?>

<?php
if (isset($_GET["pjax"])) //判断所需要的参数是否存在，isset用来检测变量是否设置，返回true 
{
    die();
}
?>


</div>
</div>

<?php wp_footer(); ?>

</div>
</body>

</html>