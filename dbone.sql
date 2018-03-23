-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-23 08:12:10
-- 服务器版本： 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbone`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs_category`
--

DROP TABLE IF EXISTS `bbs_category`;
CREATE TABLE IF NOT EXISTS `bbs_category` (
  `cid` int(10) NOT NULL AUTO_INCREMENT,
  `classname` varchar(60) NOT NULL COMMENT '版块名称',
  `parentid` int(10) NOT NULL COMMENT '父级ID',
  `classpath` char(20) DEFAULT NULL COMMENT '关系',
  `replycount` int(10) DEFAULT '0' COMMENT '回帖数量',
  `motifcount` int(10) NOT NULL DEFAULT '0' COMMENT '帖子数量',
  `compere` char(10) DEFAULT NULL COMMENT '版主',
  `classpic` varchar(255) NOT NULL DEFAULT 'public/img/classLogo.gif' COMMENT '板块ICON',
  `description` varchar(200) DEFAULT NULL COMMENT '板块描述',
  `orderby` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `lastpost` varchar(255) DEFAULT NULL COMMENT '最后发表',
  `namestyle` char(10) DEFAULT NULL,
  `ispass` tinyint(2) NOT NULL DEFAULT '1' COMMENT '审核状态',
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='论坛版块表';

--
-- 转存表中的数据 `bbs_category`
--

INSERT INTO `bbs_category` (`cid`, `classname`, `parentid`, `classpath`, `replycount`, `motifcount`, `compere`, `classpic`, `description`, `orderby`, `lastpost`, `namestyle`, `ispass`) VALUES
(1, 'PHP技术交流', 0, NULL, 0, 0, '', 'public/img/classLogo.gif', '', 1, NULL, NULL, 1),
(2, '程序人生', 0, NULL, 0, 0, '', 'public/img/classLogo.gif', '', 2, NULL, NULL, 1),
(3, '内核源码', 1, NULL, 0, 0, 'admin', 'public/img/classLogo.gif', '本论坛超管的账号为admin，密码为admin', 1, NULL, NULL, 1),
(4, 'PHP框架', 1, NULL, 0, 0, 'admin', 'public/img/classLogo.gif', '', 2, NULL, NULL, 1),
(5, '开源产品', 1, NULL, 0, 0, 'admin', 'public/img/classLogo.gif', '', 3, NULL, NULL, 1),
(6, '进阶讨论', 1, NULL, 0, 0, 'admin', 'public/img/classLogo.gif', '', 4, NULL, NULL, 1),
(7, '求职招聘', 2, NULL, 0, 0, 'admin', 'public/img/classLogo.gif', '', 5, NULL, NULL, 1),
(8, '经验分享', 2, NULL, 0, 0, 'admin', 'public/img/classLogo.gif', '', 6, NULL, NULL, 1),
(9, '名人故事', 2, NULL, 0, 0, 'admin', 'public/img/notice.gif', '', 7, NULL, NULL, 1),
(22, '赞助商家', 2, NULL, 0, 0, 'admin', 'public/img/payDetail.gif', '福利区，广告区', 8, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_closeip`
--

DROP TABLE IF EXISTS `bbs_closeip`;
CREATE TABLE IF NOT EXISTS `bbs_closeip` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` int(12) NOT NULL COMMENT 'IP地址（用到的函数：ip2long）',
  `addtime` int(12) NOT NULL COMMENT '记录添加时间',
  `overtime` int(12) DEFAULT NULL COMMENT 'ip限制的结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='IP黑名单表';

--
-- 转存表中的数据 `bbs_closeip`
--

INSERT INTO `bbs_closeip` (`id`, `ip`, `addtime`, `overtime`) VALUES
(6, 252679690, 1512814834, 2143534834),
(9, 201362974, 1512815859, 1513247859);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_details`
--

DROP TABLE IF EXISTS `bbs_details`;
CREATE TABLE IF NOT EXISTS `bbs_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first` tinyint(1) NOT NULL DEFAULT '0' COMMENT '帖子回复（1=帖子，0=回复）',
  `tid` int(10) NOT NULL COMMENT '帖子id',
  `sid` int(10) NOT NULL DEFAULT '0',
  `authorid` int(10) NOT NULL COMMENT '发贴人id',
  `title` varchar(600) NOT NULL COMMENT '帖子标题',
  `content` mediumtext NOT NULL COMMENT '帖子/回帖内容',
  `addtime` int(12) NOT NULL COMMENT '发布时间',
  `addip` int(12) NOT NULL COMMENT '发帖人IP',
  `classid` int(10) NOT NULL COMMENT '板块id',
  `replycount` int(12) NOT NULL DEFAULT '0' COMMENT '帖子的回复数量',
  `hits` int(12) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `istop` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为置顶帖（1=是，0=否）',
  `elite` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为精华帖（1=是，0=否）',
  `ishot` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否为热门贴（1=是，0=否）',
  `rate` smallint(3) NOT NULL DEFAULT '0' COMMENT '帖子售价（积分）',
  `attachment` smallint(3) DEFAULT NULL COMMENT '帖子附件',
  `isdel` int(2) DEFAULT '0' COMMENT '是否放入回收站（1=是，0=否）',
  `style` char(10) DEFAULT NULL COMMENT '帖子标题颜色（css样式）',
  `isdisplay` int(2) NOT NULL DEFAULT '0' COMMENT '是否屏蔽回复内容（1=是，0=否）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='帖子信息表';

--
-- 转存表中的数据 `bbs_details`
--

INSERT INTO `bbs_details` (`id`, `first`, `tid`, `sid`, `authorid`, `title`, `content`, `addtime`, `addip`, `classid`, `replycount`, `hits`, `istop`, `elite`, `ishot`, `rate`, `attachment`, `isdel`, `style`, `isdisplay`) VALUES
(1, 1, 0, 0, 1, '第一个帖子', '第一个帖子的内容', 1512929000, 1234567, 3, 28, 784, 1, 1, 1, 20, NULL, 0, NULL, 0),
(2, 1, 0, 0, 1, '第二个帖子', '第二个帖子的内容', 1512929010, 2, 3, 0, 14, 0, 0, 1, 15, NULL, 0, NULL, 0),
(5, 1, 0, 0, 9, '第三个帖子', '第三个帖子的内容', 1512929200, 3, 3, 0, 5, 0, 0, 1, 0, NULL, 0, NULL, 0),
(6, 1, 0, 0, 10, '第四个帖子', '第四个帖子的内容', 1512929220, 4, 3, 0, 21, 1, 0, 0, 0, NULL, 0, NULL, 0),
(7, 1, 0, 0, 9, '第五个帖子', '第五个帖子的内容', 1512929240, 5, 3, 0, 1, 0, 0, 0, 0, NULL, 0, NULL, 0),
(8, 1, 0, 0, 12, '第六个帖子', '第六个帖子的内容', 1512929260, 6, 3, 0, 1, 0, 0, 1, 0, NULL, 0, NULL, 0),
(9, 1, 0, 0, 10, '第七个帖子', '第七个帖子的内容', 1512929270, 7, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(10, 1, 0, 0, 12, '第八个帖子', '第八个帖子的内容', 1512929280, 8, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(11, 1, 0, 0, 10, '第九个帖子', '第九个帖子的内容', 1512929290, 9, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(12, 1, 0, 0, 9, '第十个帖子', '第十个帖子的内容', 1512929300, 10, 3, 0, 4, 0, 0, 0, 0, NULL, 0, NULL, 0),
(13, 1, 0, 0, 12, '第十一个帖子', '第十一个帖子的内容', 1512929310, 11, 3, 0, 15, 1, 0, 1, 0, NULL, 0, NULL, 0),
(14, 0, 1, -1, 10, '', '回复1', 1512929562, 8, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 1),
(16, 0, 1, -1, 10, '', '回复3', 1512929600, 215335, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(17, 0, 1, -1, 12, '', '回复4', 186546435, 33, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(19, 0, 1, -1, 10, '', '回复6', 365247669, 6, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(22, 1, 0, 0, 12, '11111', '<p>\r\n	22222222</p>\r\n', 1512967788, 2130706433, 3, 1, 74, 0, 1, 1, 5, NULL, 0, NULL, 0),
(23, 0, 1, -1, 1, '', '<p>\r\n	说得好</p>\r\n', 1513040609, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(24, 0, 1, 0, 1, '', '<p>\r\n	说得好</p>\r\n', 1513040631, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(25, 0, 1, 0, 1, '', '<p>\r\n	说得好</p>\r\n', 1513040691, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(26, 0, 1, 0, 1, '', '<p>\r\n	说得好</p>\r\n', 1513040698, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(28, 0, 1, 0, 1, '', '<p>\r\n	连我自己都感动了</p>\r\n', 1513041034, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(29, 0, 1, 0, 1, '', '<p>\r\n	甚至留下了感动的泪水</p>\r\n', 1513041711, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(30, 0, 1, 0, 12, '', '<p>\r\n	当时我就念了一句诗</p>\r\n<p>\r\n	叫苟利国家生死以</p>\r\n<p>\r\n	岂因祸福避趋之</p>\r\n', 1513042071, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(31, 0, 1, 0, 12, '', '<p>\r\n	一个人的命运啊，当然要靠自我奋斗，但也要考虑到历史的行程</p>\r\n', 1513042176, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(32, 0, 1, -1, 12, '', '<p>\r\n	闷声发大财，这是坠吼滴</p>\r\n', 1513042206, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(33, 0, 1, 0, 12, '', '<p>\r\n	你们有一个好的，全世界我到哪里，你们比西方记者跑的还快</p>\r\n<p>\r\n	但是问来问去的问题啊，too simple</p>\r\n', 1513042544, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(34, 0, 1, 0, 12, '', '<p>\r\n	美国的华莱士，不知比你们高到哪里去了，我与他谈笑风生</p>\r\n', 1513042629, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(35, 0, 1, 0, 10, '', '<p>\r\n	the deep dark fantasy</p>\r\n', 1513042724, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(36, 0, 1, 0, 10, '', '<p>\r\n	<span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">我也是个</span><span style="color: rgb(204, 0, 0); font-family: arial; font-size: 13px;">广东人</span><span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">,所以我们可能是</span><span style="color: rgb(204, 0, 0); font-family: arial; font-size: 13px;">老乡</span></p>\r\n', 1513042840, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(37, 0, 1, 0, 1, '', '<p>\r\n	天若有情天亦老，人间正道是沧桑</p>\r\n', 1513046549, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(38, 0, 1, 0, 1, '', '<p>\r\n	可怜身上衣正单，心忧炭贱愿天寒</p>\r\n', 1513046583, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(39, 0, 1, 0, 1, '', '<p>\r\n	替我向老师问好</p>\r\n', 1513046608, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(40, 0, 1, 0, 1, '', '<p>\r\n	人生在世不如意，不如自挂东南枝</p>\r\n', 1513046670, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(41, 0, 1, 0, 12, '', '<p>\r\n	两情若是久长时，必是在朝朝暮暮</p>\r\n', 1513046716, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(42, 0, 1, 0, 12, '', '<p>\r\n	少年不识愁滋味，为赋新词强说愁</p>\r\n', 1513046821, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(43, 0, 1, 0, 12, '', '<p>\r\n	而今识尽愁滋味，却道天凉好个秋</p>\r\n', 1513046891, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(44, 0, 1, 0, 9, '', '<p>\r\n	hahahahah</p>\r\n', 1513061064, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(45, 0, 1, 0, 10, '', '<p>\r\n	楼主说得好啊</p>\r\n', 1513087871, 2130706433, 3, 0, 1, 0, 0, 0, 0, NULL, 0, NULL, 0),
(46, 0, 1, 0, 1, '', '<p>\r\n	steam打折了</p>\r\n', 1513136402, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(47, 0, 1, 0, 10, '', '<p>\r\n	我走过最远的道路</p>\r\n', 1513144758, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(48, 0, 22, 0, 12, '', '<p>\r\n	顶一个</p>\r\n', 1513146111, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(49, 1, 0, 0, 1, '促销活动上线！！！', '<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	1、百万感恩，新享事成。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 2、周年庆，别等了，错过要等X年。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 3、感恩促，惠无限。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 4、感恩XX年路，百万钜惠等你拿。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 5、感恩回馈，放价一天。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 6、感恩嘉年华，全系惠不停。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 7、一价到底，感恩惠给你。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 8、感恩，&ldquo;价&rdquo;给你。</p>\r\n<p style="margin: 1px 0px 0px; padding: 0px 0px 8px; color: rgb(51, 51, 51); font-family: 宋体; font-size: 15px;">\r\n	&nbsp; &nbsp; 9、感恩，来点实际的，最高降价XX元。</p>\r\n', 1513155015, 2130706433, 22, 0, 11, 0, 0, 0, 0, NULL, 0, NULL, 0),
(50, 1, 0, 0, 1, '最新视频教程，你懂得，想要的戳进来', '<p>\r\n	<span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">国产在线深夜福利</span><span style="color: rgb(204, 0, 0); font-family: arial; font-size: 13px;">视频</span><span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">来了!还有国产</span><span style="color: rgb(204, 0, 0); font-family: arial; font-size: 13px;">你懂得</span><span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">在线</span><span style="color: rgb(204, 0, 0); font-family: arial; font-size: 13px;">视频</span><span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">等你来看!精彩享不停!还有在线国产</span><span style="color: rgb(204, 0, 0); font-family: arial; font-size: 13px;">视频</span><span style="color: rgb(51, 51, 51); font-family: arial; font-size: 13px;">高清无码免费下载。感兴趣的小伙伴千万不要错过哟~</span></p>\r\n', 1513155192, 2130706433, 22, 0, 33, 0, 0, 0, 0, NULL, 0, NULL, 0),
(51, 1, 0, 0, 1, '全球最大的轻交友婚恋社区上线啦', '<p>\r\n	全球最大的线上轻交友婚恋社区上线啦，真人红娘，在线牵线，各类美女帅哥云集的高端婚恋社区，无论你是想419，谈纯情，无论你期待火热恋情还是露水情缘，更无论是敲定长期发展喜结连理，统统都可以满足你！</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	社区新上线，好礼送不停，前100名注册的用户还有好礼相送，详情咨询管理员</p>\r\n', 1513155678, 2130706433, 22, 0, 7, 0, 0, 0, 0, NULL, 0, NULL, 0),
(52, 1, 0, 0, 1, '123123123', '<p>\r\n	123123123</p>\r\n', 1513155811, 2130706433, 22, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(53, 1, 0, 0, 1, 'werwerwer', '<p>\r\n	werwerwer</p>\r\n', 1513155880, 2130706433, 3, 0, 2, 0, 0, 0, 0, NULL, 1, NULL, 0),
(55, 1, 0, 0, 1, 'asdfaxfea', '<p>\r\n	wafdaxcfe</p>\r\n', 1513156022, 2130706433, 3, 0, 1, 0, 0, 0, 0, NULL, 1, NULL, 0),
(59, 0, 1, 14, 1, '', '<p>\r\n	螳臂当车，愚蠢</p>\r\n', 1513169637, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(62, 0, 1, 14, 10, '', '<p>\r\n	这张头像下的不是肉体，是思想，权限大人。而思想，是不怕封禁的</p>\r\n', 1513172130, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(64, 0, 1, 14, 9, '', '<p>\r\n	层主牛逼啊</p>\r\n', 1513175453, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(65, 0, 1, 16, 1, '', '<p>\r\n	呵呵</p>\r\n', 1513212975, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(66, 1, 0, 0, 14, '九阴真经', '<p>\r\n	天之道，损有余而补不足。是故虚胜实，不足胜有余</p>\r\n', 1513214119, 2130706433, 3, 0, 17, 0, 0, 0, 5, NULL, 1, NULL, 0),
(72, 1, 0, 0, 16, '莫生气', '<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	人生就像一场戏，今世有缘才相聚。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	相处一处不容易，人人应该去珍惜。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	世上万物般般有，哪能件件如我意。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	为了小事发脾气，回想起来又何必。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	他人气我我不气，气出病来无人替。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	生气伤肝又伤脾，促人衰老又生疾。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	看病花钱又受罪，还说气病治非易。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	小人量小不让人，常常气人气自己。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	君子量大同天地，好事坏事包在里。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	他人骂我我装聋，高声上天低入地。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	我若错了真该骂，诚心改正受教育。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	要是根本没那事，全当他是骂自己。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	左亲右邻团结好，家庭和睦乐无比。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	夫妻互助又亲爱，朝夕相伴笑嘻嘻。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	政通人和想天伦，晚年幸福甜如蜜。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	邻里亲友不要比，儿孙锁事随他去。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	淡泊名利促健康，文明礼貌争第一。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	三国有个周公瑾，因气丧命中人计。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	清朝有个闫敬铭，领悟危害不生气。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	弥勒就是布袋僧，袒胸大肚能忍气。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	笑口常开无忧虑，一切疾病皆消去。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	不气不气真不气，不气歌儿记心里。</div>\r\n<div class="para" label-module="para" style="font-size: 14px; word-wrap: break-word; color: rgb(51, 51, 51); margin-bottom: 15px; text-indent: 2em; line-height: 24px; zoom: 1; font-family: arial, 宋体, sans-serif;">\r\n	只要你能做得到，活到百岁不足奇。</div>\r\n', 1513222518, 2130706433, 3, 0, 9, 0, 0, 0, 5, NULL, 1, NULL, 0),
(73, 0, 1, 0, 1, '', '<p>\r\n	huifu</p>\r\n', 1513230531, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(74, 0, 1, 0, 1, '', '<p>\r\n	顶贴</p>\r\n', 1513231764, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(75, 0, 1, 19, 1, '', '<p>\r\n	悲伤逆流成河</p>\r\n', 1513232088, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(76, 1, 0, 0, 17, '第十一个贴', '<p>\r\n	内容为空</p>\r\n', 1513235222, 2130706433, 3, 1, 10, 0, 0, 0, 5, NULL, 0, NULL, 0),
(77, 0, 76, 0, 17, '', '<p>\r\n	呵呵哒</p>\r\n', 1513235249, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(78, 0, 1, 0, 1, '', '<p>\r\n	是我的雨伞的</p>\r\n', 1513236074, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(80, 0, 1, 14, 15, '', '<p>\r\n	pangpang</p>\r\n', 1513244595, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(81, 0, 1, 0, 15, '', '<p>\r\n	pangpang</p>\r\n', 1513244610, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(86, 0, 50, -1, 1, '', '<p>\r\n	牛</p>\r\n', 1513249222, 2130706433, 22, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(87, 0, 50, 0, 1, '', '<p>\r\n	人人</p>\r\n', 1513249252, 2130706433, 22, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(88, 0, 50, 86, 1, '', '<p>\r\n	真是世风日下，道德沦丧</p>\r\n', 1513251214, 2130706433, 22, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(89, 1, 0, 0, 1, '常来常新', '<p>\r\n	常来常新</p>\r\n', 1513256477, 2130706433, 3, 0, 2, 0, 0, 0, 50, NULL, 1, NULL, 0),
(90, 1, 0, 0, 1, '常来常新', '<p>\r\n	常来常新</p>\r\n', 1513256477, 2130706433, 3, 0, 7, 0, 0, 0, 50, NULL, 1, NULL, 0),
(91, 0, 1, 19, 1, '', '<p>\r\n	这个头像换的好</p>\r\n', 1513256522, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(92, 0, 90, 0, 1, '', '<p>\r\n	杭来长信</p>\r\n', 1513257713, 2130706433, 3, 0, 0, 0, 0, 0, 0, NULL, 1, NULL, 0),
(93, 1, 0, 0, 1, '再来一次', '<p>\r\n	再来一次</p>\r\n', 1513257810, 2130706433, 3, 0, 1, 0, 0, 0, 50, NULL, 0, NULL, 0),
(94, 1, 0, 0, 1, '法制频道', '<p>\r\n	<span style="color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px;">&nbsp;这一切的背后， 是人性的扭曲还是道德的沦丧？</span></p>\r\n', 1513298017, 2130706433, 22, 0, 2, 0, 0, 0, 50, NULL, 1, NULL, 0),
(95, 1, 0, 0, 1, '法治在线', '<p>\r\n	<span style="color:#ff0000;">这背后到底是人性的扭曲还是道德的沦丧？</span></p>\r\n<p>\r\n	这背后到底是人性的扭曲还是道德的沦丧？</p>\r\n<p>\r\n	<span style="color:#ffd700;">这背后到底是人性的扭曲还是道德的沦丧？</span></p>\r\n<p>\r\n	这背后到底是人性的扭曲还是道德的沦丧？</p>\r\n<p>\r\n	<span style="color:#0000cd;">这背后到底是人性的扭曲还是道德的沦丧？</span></p>\r\n<p>\r\n	这背后到底是人性的扭曲还是道德的沦丧？</p>\r\n<p>\r\n	<span style="color:#00ff00;">这背后到底是人性的扭曲还是道德的沦丧</span>？</p>\r\n<p>\r\n	这背后到底是人性的扭曲还是道德的沦丧？</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 1513298125, 2130706433, 22, 1, 9, 1, 1, 0, 50, NULL, 0, NULL, 0),
(96, 0, 95, 0, 1, '', '<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n<p>\r\n	欢迎关注今晚8点整播出的法治在线</p>\r\n', 1513298314, 2130706433, 22, 0, 0, 0, 0, 0, 0, NULL, 0, NULL, 0),
(97, 1, 0, 0, 18, '精华帖，高亮贴', '<p>\r\n	精华帖，高亮贴</p>\r\n', 1513300979, 2130706433, 3, 0, 1, 0, 1, 1, 0, NULL, 0, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_link`
--

DROP TABLE IF EXISTS `bbs_link`;
CREATE TABLE IF NOT EXISTS `bbs_link` (
  `lid` smallint(6) NOT NULL AUTO_INCREMENT,
  `displayorder` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` mediumtext,
  `logo` varchar(255) DEFAULT NULL,
  `addtime` int(12) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_link`
--

INSERT INTO `bbs_link` (`lid`, `displayorder`, `name`, `url`, `description`, `logo`, `addtime`) VALUES
(1, 0, '官方论坛', 'http://www.discuz.net', '提供最新 Discuz! 产品新闻、软件下载与技术交流', 'public/img/friendUp1.gif', 2147483647),
(2, 3, '漫游平台', 'http://www.manyou.com/', '', '', 2147483647),
(3, 2, 'Yeswan', 'http://www.yeswan.com/', '', '', 2147483647),
(4, 1, '我的领地', 'http://www.5d6d.com/', '', '', 0),
(5, 4, '百度一下', 'http://www.baidu.com', '百度一下你就知道', '', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_msg`
--

DROP TABLE IF EXISTS `bbs_msg`;
CREATE TABLE IF NOT EXISTS `bbs_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '序号',
  `name` varchar(200) NOT NULL COMMENT '名称',
  `content` varchar(200) NOT NULL COMMENT '内容',
  `isset` tinyint(2) DEFAULT NULL COMMENT '判断（1=是。0=否）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_msg`
--

INSERT INTO `bbs_msg` (`id`, `name`, `content`, `isset`) VALUES
(1, 'WebTitle', '10分钟学院', 0),
(2, 'webName', 'phpxy', NULL),
(3, 'webUrl', 'http://www.phpxy.com/', NULL),
(4, 'webCode', '京ICP备 89273号', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_pay`
--

DROP TABLE IF EXISTS `bbs_pay`;
CREATE TABLE IF NOT EXISTS `bbs_pay` (
  `oid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `id` int(11) NOT NULL COMMENT '帖子id',
  `rate` int(11) NOT NULL COMMENT '价格',
  `addtime` int(11) NOT NULL COMMENT '创建时间',
  `ispay` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否已支付（1=是，0=否）',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='帖子订单表';

--
-- 转存表中的数据 `bbs_pay`
--

INSERT INTO `bbs_pay` (`oid`, `uid`, `id`, `rate`, `addtime`, `ispay`) VALUES
(1, 12, 1, 20, 1513058765, 1),
(7, 9, 1, 20, 1513060671, 1),
(17, 10, 1, 20, 1513145067, 1),
(18, 16, 1, 20, 1513222386, 1),
(19, 17, 22, 5, 1513235437, 1),
(20, 16, 2, 15, 1513238873, 1);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_user`
--

DROP TABLE IF EXISTS `bbs_user`;
CREATE TABLE IF NOT EXISTS `bbs_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(16) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码（md5加密）',
  `email` char(30) NOT NULL COMMENT '邮箱',
  `undertype` tinyint(2) NOT NULL COMMENT '账号类型（1=管理员，0=普通用户）',
  `regtime` int(12) NOT NULL COMMENT '注册时间',
  `lasttime` int(12) NOT NULL COMMENT '最后登录时间',
  `regip` int(12) NOT NULL COMMENT '注册IP',
  `picture` varchar(255) NOT NULL DEFAULT 'public/img/avatarBlank.gif' COMMENT '头像',
  `grade` int(10) DEFAULT '0' COMMENT '积分',
  `problem` varchar(200) DEFAULT '0' COMMENT '查找密码问题',
  `result` varchar(200) DEFAULT NULL COMMENT '答案',
  `realname` char(50) DEFAULT NULL COMMENT '真实姓名',
  `sex` tinyint(4) DEFAULT '2' COMMENT '性别（1=男。2=女）',
  `birthday` varchar(20) DEFAULT NULL COMMENT '生日',
  `place` varchar(50) DEFAULT NULL COMMENT '所在地',
  `qq` char(13) DEFAULT NULL COMMENT 'QQ号码',
  `autograph` varchar(500) DEFAULT NULL COMMENT '个人签名',
  `errortimes` int(11) NOT NULL DEFAULT '0' COMMENT '登录时密码错误的次数',
  `allowlogin` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否允许登录（0=允许，1=不允许）',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='用户基本资料表';

--
-- 转存表中的数据 `bbs_user`
--

INSERT INTO `bbs_user` (`uid`, `username`, `password`, `email`, `undertype`, `regtime`, `lasttime`, `regip`, `picture`, `grade`, `problem`, `result`, `realname`, `sex`, `birthday`, `place`, `qq`, `autograph`, `errortimes`, `allowlogin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '574@qq.com', 1, 1234567, 1513297719, 1234567, 'upload/face/5a3282fa83e88.jpg', 1495, '0', NULL, 'ADMIN', 2, '1999/7/12', '广西壮族自治区', '123123', '<p>\r\n	我就是admin</p>\r\n', 0, 0),
(9, 'xiaohua', 'ee755bdd4adb8ac6270ef476fefab245', 'xiaohua@xx.com', 0, 1512207072, 1513175428, 2130706433, 'upload/face/5a2f75bf38444.gif', 489, '0', NULL, '', 2, '//', '', NULL, NULL, 0, 0),
(10, 'xiaohong', '435a605868a16e60edb277742291913a', 'honghong@xx.com', 0, 1512207626, 1513254779, 2130706433, 'upload/face/5a3271a56dc17.jpg', 23, '保持原有的问题和答案', '', '红', 1, '2005/6/11', '黑龙江省', '55555555', '<p>\r\n	你们啊，不要听风就是雨</p>\r\n', 0, 0),
(12, 'xiaofen', '02f510c04985a3f37b1b25c51cc0a079', 'fenfen@xx.com', 0, 1512359581, 1513145389, 2130706433, 'upload/face/5a2f9c8101131.jpg', 194, '1', 'xiaofen', '粉', 2, '1985/9/10', '江西省', '123', '<p>\r\n	一个人的奋斗</p>\r\n', 0, 0),
(13, 'congcong', 'ffe0170dbd161802c1a0f89e54bf1739', 'congcong@xx.com', 0, 1513213388, 1513213583, 2130706433, 'public/img/avatarBlank.gif', 54, '0', NULL, '匆匆', 1, '1999/5/10', '江西省', '234992349', NULL, 1, 0),
(15, 'pangpang', 'd86d4aed81d08fb4d182172b34365120', 'pangpang@xx.com', 0, 1513222097, 1513256917, 2130706433, 'public/img/avatarBlank.gif', 36, '0', NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 0),
(17, 'xdf123', 'e120ea280aa50693d5568d0071456460', '123@qq.com', 0, 1513235155, 1513235155, 2130706433, 'upload/face/5a322369db577.jpg', 48, '0', NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 0),
(18, 'kaikai', '676818ff58423dbcc47d6696094a8971', 'kaikai@xx.com', 0, 1513300937, 1513304863, 2130706433, 'public/img/avatarBlank.gif', 54, '0', NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
