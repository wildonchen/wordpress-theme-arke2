/*!
 * @Author: chenqiwei.net 
 * @Date: 2021-08-15 23:59:19 
 * @Last Modified by: chenqiwei.net
 * @Last Modified time: 2021-09-25 17:40:04
 */

var fixWeek = [7, 1, 2, 3, 4, 5, 6];
var date = new Date();
var year = date.getFullYear();
var month = date.getMonth() + 1;
var week = fixWeek[date.getDay()];
var day = date.getDate();
var hour = date.getHours();
if (year % 4 == 0 && year % 100 != 0 || year % 400 == 0) {
    var yearType = "闰年";
} else {
    var yearType = "平年";
}
var lunarTime = [];


//今日
document.getElementById('hours').innerHTML = '今天已过去' + hour + '小时';
document.getElementById('hours-jdt').style.width = hour / 24 * 100 + '%';
//本周
document.getElementById('weeks').innerHTML = '本周已过去' + week + '天';
document.getElementById('weeks-jdt').style.width = week / 7 * 100 + '%';
//本月
function getMonthDay(year, month) {
    let days = new Date(year, month, 0).getDate()
    return days
}
document.getElementById('day').innerHTML = '本月已过去' + day + '日';
document.getElementById('day-jdt').style.width = day / getMonthDay(year, month) * 100 + '%';
//本年
document.getElementById('month').innerHTML = '今年已过去' + month + '月';
document.getElementById('month-jdt').style.width = month / 12 * 100 + '%';



//父亲节、母亲节
var gd = {
    "1": [
        ['01/01', '元旦节'],
    ],
    "2": [
        ["02/14", "情人节"],
    ],
    "3": [
        ["03/08", "妇女节"],
        ["03/12", "植树节"],
        ["03/14", "白色情人节"],
    ],
    "4": [
        ["04/01", "愚人节"],
    ],
    "5": [
        ["05/01", "劳动节"],
        ["05/04", "青年节"],
        ["0", "0"],
        ["05/20", "网络情人节"],
    ],
    "6": [
        ["06/01", "儿童节"],
        ["0", "0"],
    ],
    "7": [
        ["07/01", "建党节"],
    ],
    "8": [
        ["08/01", "建军节"],
    ],
    "9": [
        ["09/10", "教师节"],
        ["09/18", "国耻日"],
    ],
    "10": [
        ["10/01", "国庆节"],
        ["10/24", "网络程序员节"],
    ],
    "11": [
        ["11/01", "万圣节"],
        ["11/11", "网络光棍节"],
        ["11/22", "感恩节"],
    ],
    "12": [
        ["12/24", "平安夜"],
        ["12/25", "圣诞节"],
    ]
};

var nd = {
    "1": [
        ['01/01', '春节', '23232'],
        ['01/15', '元宵节'],
    ],
    "2": [
        ['02/02', '龙抬头'],
        ['02/23', '清明节'],
        ['02/27', '春分'],
    ],
    "3": [
        ['03/24', '立夏'],
        ['02/23', '清明节'],
        ['02/27', '春分'],
    ],
    "4": [],
    "5": [
        ['05/05', '端午节'],
    ],
    "6": [
        ['06/29', '立秋'],
    ],
    "7": [
        ['07/07', '七夕节'],
        ['07/15', '中元节'],
    ],
    "8": [
        ['08/15', '中秋节'],
    ],
    "9": [
        ['09/09', '重阳节'],
    ],
    "10": [
        ['10/03', '立冬'],
        ['10/15', '下元节'],
    ],
    "10": [],
    "12": [
        ['12/08', '腊八节'],
        ['12/23', '小年'],
        ['12/30', '除夕'],
    ]
};
var nMonth = {
    "01": "正月",
    "02": "二月",
    "03": "三月",
    "04": "四月",
    "05": "五月",
    "06": "六月",
    "07": "七月",
    "08": "八月",
    "09": "九月",
    "10": "十月",
    "11": "十一月",
    "12": "腊月",
}
var nDay = {
    "01": "初一",
    "02": "初二",
    "03": "初三",
    "04": "初四",
    "05": "初五",
    "06": "初六",
    "07": "初七",
    "08": "初八",
    "09": "初九",
    "10": "初十",
    "11": "十一",
    "12": "十二",
    "13": "十三",
    "14": "十四",
    "15": "十五",
    "16": "十六",
    "17": "十七",
    "18": "十八",
    "19": "十九",
    "20": "二十",
    "21": "廿一",
    "22": "廿二",
    "23": "廿三",
    "24": "廿四",
    "25": "廿五",
    "26": "廿六",
    "27": "廿七",
    "28": "廿八",
    "29": "廿九",
    "30": "三十",
}
for (let i in nd) {
    for (let ii in nd[i]) {
        var toArr = nd[i][ii][0].split('/');
        nd[i][ii][2] = Lunar.toSolar(year, toArr[0], toArr[1]);

    }
}
function montherDay() {
    var d = new Date();
    var dd = new Date("May 01 " + d.getFullYear());
    var montherDay = (new Date("May " + (1 + (7 - dd.getDay()) + 7) + " " + d.getFullYear()));
    return montherDay;
}
function fatherDay() {
    var d = new Date();
    var dd = new Date("Jun 01 " + d.getFullYear());
    var fatherDay = (new Date("Jun " + (1 + (7 - dd.getDay()) + 7 + 7) + " " + d.getFullYear()));
    return fatherDay;
}
gd[5][2][0] = montherDay();
gd[5][2][1] = '母亲节';
gd[6][1][0] = fatherDay();
gd[6][1][1] = '父亲节';
var date30 = new Date();
date30.setDate(day + 30 + 30);
var date30 = Date.parse(date30.getMonth() + 1 + '/' + date30.getDate());
var date0 = Date.parse(month + '/' + day);
var list = '';
for (let i in gd) {

    for (let ii in gd[i]) {
        if (Date.parse(gd[i][ii][0]) < date30 && Date.parse(gd[i][ii][0]) >= date0) {
            var gdFormat = gd[i][ii][0].replace("/", "月");
            list += '<li>' + gdFormat + '日 ' + gd[i][ii][1] + ' (' + getRTime(month + '/' + day, gd[i][ii][0], 3) + ')</li>';
        }

    }
}
document.getElementById('gl').innerHTML = list;
var list = '';
for (let i in nd) {
    for (let ii in nd[i]) {
        if (Date.parse(nd[i][ii][2][1] + '/' + nd[i][ii][2][2]) < date30 && Date.parse(nd[i][ii][2][1] + '/' + nd[i][ii][2][2]) >= date0) {
            var gdFormat = nd[i][ii][0].split("/");
            list += '<li>' + nMonth[gdFormat[0]] + nDay[gdFormat[1]] + ' ' + nd[i][ii][1] + ' (' + getRTime(month + '/' + day, nd[i][ii][2][1] + '/' + nd[i][ii][2][2], 3) + ')</li>';
        }

    }
}
document.getElementById('nl').innerHTML = list;
/* 倒计时 */
function getRTime(now, to, type = 1) { //1为公历,2为农历,3为公历+返回中文倒计时,4为农历+返回中文倒计时
    if (type == 2 || type == 4) {
        var toArr = to.split('-');
        lunarTime = Lunar.toSolar(toArr[0], toArr[1], toArr[2]);
        var EndTime = new Date(lunarTime[0] + '-' + lunarTime[1] + '-' + lunarTime[2]);
    }
    else {
        var EndTime = new Date(to);
    }
    var NowTime = new Date(now);
    var t = EndTime.getTime() - NowTime.getTime();
    var c = Math.floor(t / 1000 / 60 / 60 / 24);
    if (type == 3 || type == 4) {
        if (c == 0) {
            return '今天';
        }
        else if (c < 0) {
            return '还有 ' + c + ' 天';
        } else {
            return '还有 ' + c + ' 天';
        }
    }
    return c;
}
function daoJiShi(year, month, day) {
    /* 倒计时 */
    function djsA(toM, toD, div, type = 1) {
        var djs = getRTime(year + '-' + month + '-' + day, year + '-' + toM + '-' + toD, type);
        if (djs == 0) {
            var djsDay = '就是今天哦';
        }
        else if (djs < 0) {
            var djs = getRTime(year + '-' + month + '-' + day, year + 1 + '-' + toM + '-' + toD, type);
            var djsDay = '还有 ' + djs + ' 天';
        } else {
            var djsDay = '还有 ' + djs + ' 天';
        }
        document.getElementById(div).innerHTML = djsDay;
    }
    djsA('07', '07', 'love-day', '2');
    djsA('09', '29', 'he-day', '2');
    djsA('01', '01', 'she-day');
    djsA('02', '14', 'qrj-day');
    djsA('07', '07', 'cn-qrj-day', '2');
    djsA('05', '20', 'wl-qrj-day');
    lunarTime = Lunar.toLunar(year, month, day);
    document.getElementById('date').innerHTML = '今天是 ' + year + '年' + month + '月' + day + '日' + '，农历 ' + lunarTime[3] + lunarTime[4] + '年 ' + lunarTime[5] + lunarTime[6] + '，' + yearType;
}


function ssl(domain) {
    var domainArr = domain.split(',')
    var ajax = new XMLHttpRequest();
    ajax.open('post', '/api/ssl?domain=' + domain);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var con = eval('(' + ajax.responseText + ')');
            var tr = '';
            for (j = 0; j < domainArr.length; j++) {
                if (j % 2 == 0) {
                    tr = tr + '<tr>';
                }
                tr += '<td>' + domainArr[j] + ' ( ' + con[domainArr[j]] + ' )</td>';
                if (j % 2 != 0 || (j + 1) == domainArr.length) {
                    tr = tr + '</tr>';
                }

            }
            document.getElementById('ssl').innerHTML = '<table>' + tr + '</table>';
        }
    }
}
//ssl('guduriji.com,chenqiwei.net,weilulu.chenqiwei.net');

    /*
cur();
setInterval(cur, 1000);
function cur() {
    var now = new Date();
    var h = now.getHours();
    var m = now.getMinutes();
    var s = now.getSeconds();
    spans[2].style.transform="rotate("+h*30+"deg)";
    spans[1].style.transform="rotate("+m*6+"deg)";
    spans[0].style.transform="rotate("+s*6+"deg)";
}
*/
