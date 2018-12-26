<?php
/**
 * Created by PhpStorm.
 * User: Yian.Tung
 * Date: 2018/12/6
 * Time: 下午 09:08
 */

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "tcigene";
$dbname = "tci_gene_dashboard";
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');

$file = fopen("../private_data/完整會員疾病風險總表_20181226.txt", "r");
while (!feof($file)) {
    $items = preg_split('/\t/', fgets($file));

    $sql = "INSERT INTO wishing_pond " .
        "(會員編號, 姓名, 性別, 生日, 年齡, 電話, 地址, 備註, 肥胖症, 第二型糖尿病, 高血壓, 高血脂, 高尿酸血症, 冠狀動脈疾病, 心房顫動, 腦中風, 靜脈曲張, 晚發型阿茲海默症, 帕金森氏症, 退化性關節炎, 骨質疏鬆, 肌少症, 子宮內膜異位症, 子宮肌瘤, 多囊性卵巢症候群, 女性尿道感染, 類風濕性關節炎, 紅斑性狼瘡, 自體免疫甲狀腺疾病, 僵直性脊椎炎, 肝硬化, 脂肪肝, 膽石症, 消化性潰瘍, 大腸息肉症, 胰臟炎, 白內障, 青光眼, 黃斑部病變, 高度近視, 憂鬱症, 躁鬱症, 思覺失調症, 慢性阻塞性肺病, 攝護腺肥大, 腎結石, 腎衰竭, 氣喘, 過敏性鼻炎, 異位性皮膚炎, 乾癬, 牙周病, 口腔癌, 鼻咽癌, 食道癌, 肺癌, 胃癌, 肝癌, 大腸癌, 胰臟癌, 乳癌, 卵巢癌, 子宮頸癌, 攝護腺癌, 膀胱癌, 淋巴癌) " .
        "VALUES ('$items[0]', '$items[1]', '$items[2]', '$items[3]', '$items[4]', '$items[5]', '$items[6]', '$items[7]', '$items[8]', '$items[9]',
        '$items[10]', '$items[11]', '$items[12]', '$items[13]', '$items[14]', '$items[15]', '$items[16]', '$items[17]', '$items[18]', '$items[19]',
        '$items[20]', '$items[21]', '$items[22]', '$items[23]', '$items[24]', '$items[25]', '$items[26]', '$items[27]', '$items[28]', '$items[29]',
        '$items[30]', '$items[31]', '$items[32]', '$items[33]', '$items[34]', '$items[35]', '$items[36]', '$items[37]', '$items[38]', '$items[39]',
        '$items[40]', '$items[41]', '$items[42]', '$items[43]', '$items[44]', '$items[45]', '$items[46]', '$items[47]', '$items[48]', '$items[49]',
        '$items[50]', '$items[51]', '$items[52]', '$items[53]', '$items[54]', '$items[55]', '$items[56]', '$items[57]', '$items[58]', '$items[59]',
        '$items[60]', '$items[61]', '$items[62]', '$items[63]', '$items[64]', '$items[65]'
        )";

    mysql_query("SET NAMES 'utf8'");
    mysql_select_db($dbname);

    $result = mysql_query($sql) or die('MySQL query error');
}

?>
