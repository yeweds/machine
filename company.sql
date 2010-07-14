-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 07 月 14 日 07:39
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `company`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_announce`
--

DROP TABLE IF EXISTS `cms_announce`;
CREATE TABLE `cms_announce` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) character set utf8 NOT NULL,
  `content` text character set utf8 NOT NULL,
  `username` varchar(50) character set utf8 NOT NULL,
  `comefrom` varchar(50) character set utf8 NOT NULL,
  `link` varchar(100) character set utf8 NOT NULL COMMENT '链接地址',
  `hits` int(11) NOT NULL,
  `postdate` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `cms_announce`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_article`
--

DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL default '0',
  `subject` varchar(255) character set utf8 NOT NULL,
  `color` varchar(7) character set utf8 NOT NULL,
  `username` varchar(50) character set utf8 NOT NULL,
  `comefrom` varchar(50) character set utf8 NOT NULL,
  `postdate` int(11) NOT NULL default '0',
  `yeard` char(4) character set utf8 NOT NULL default '0',
  `monthd` char(2) character set utf8 NOT NULL default '0',
  `hits` int(11) NOT NULL default '0',
  `cid` int(11) NOT NULL default '0',
  `ischecked` tinyint(4) NOT NULL default '1',
  `istop` tinyint(4) NOT NULL default '0',
  `ispic` tinyint(1) NOT NULL default '0',
  `isgood` tinyint(1) NOT NULL default '0',
  `link` varchar(100) character set utf8 NOT NULL,
  `message` text character set utf8 NOT NULL,
  `content` mediumtext character set utf8 NOT NULL,
  `attachment` varchar(50) character set utf8 NOT NULL,
  `attachpath` varchar(50) character set utf8 NOT NULL,
  `attachthumb` varchar(50) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `cms_article`
--

INSERT INTO `cms_article` (`id`, `uid`, `subject`, `color`, `username`, `comefrom`, `postdate`, `yeard`, `monthd`, `hits`, `cid`, `ischecked`, `istop`, `ispic`, `isgood`, `link`, `message`, `content`, `attachment`, `attachpath`, `attachthumb`) VALUES
(1, 1, '森诺特软件有限公司加入IBM', '', 'admin', '森诺特软件有限公司', 1276763463, '0', '0', 16, 2, 1, 0, 0, 0, '', '2121111111111111111', '<p>森诺特软件有限公司加入IBM</p>', '', '', ''),
(2, 1, '巴菲特午餐价落槌 263万美元创纪录', '', 'admin', '', 1276763572, '0', '0', 18, 3, 1, 0, 0, 0, '', '巴菲特午餐价落槌 263万美元创纪录', '<p>　　6月12日上午10:30消息，亿万富翁沃伦&middot;巴菲特2010年度的eBay午餐拍卖刚刚截止，一位名为&ldquo;t***l&rdquo;的神秘买家出价2,626,311美元拍得与股神巴菲特共进午餐，本次拍卖总计吸引到9位竞拍者，总计竞拍77次，最终竞拍价创出了历年来的新纪录。</p>\r\n<p>　　为期5天的拍卖于6月11日美东时间晚10点半(北京时间6月12日上午10:30)结束。拍卖的最终赢家最多可携七位朋友与世界第三富豪巴菲特在纽约曼哈顿Smith &amp; Wollensky牛排馆一同吃午饭。</p>\r\n<p>　　拍卖所得将捐给设在旧金山的非盈利机构&ldquo;Glide基金会&rdquo;。该基金会专门向穷人和无家可归者提供食品、健康和儿童护理、住所和就业培训等服务。Smith &amp; Wollensky牛排馆将捐给Glide基金会1万美元。</p>\r\n<p>　　最终的出价已经高于了历史最高纪录：2008年香港投资人赵丹阳报出的211万100美元。去年，总部位于多伦多的财富管理商Salida资本公司以168万300美元的报价胜出。</p>\r\n<p>　　据《福布斯》杂志提供的信息，现年79岁的巴菲特拥有约470亿美元身家，他主要通过保险及投资公司：伯克希尔-哈撒韦为自己积累了巨额财富。目前伯克希尔经营着约80家企业，还拥有数百亿美元的投资。</p>\r\n<p>　　此前进行的10次年度慈善拍卖总计拍得了590多万美元。2006年巴菲特做出承诺，将把自己的大部分财富捐给比尔及梅琳达-盖茨基金会及其他四个家族式慈善团体。</p>', '', '', ''),
(3, 1, '传戴尔电脑分销商冲击夜总会劫持人质', '', 'admin', '', 1276763642, '0', '0', 14, 3, 1, 0, 0, 0, '', '传戴尔电脑分销商冲击夜总会劫持人质', '<p>　　戴尔杭州最大的分销商老板因挟持人质被警方刑拘，正面临法律严惩。</p>\r\n<p>　　出于保护前提，就不提是什么公司，以及具体人名。关键问题在于，挟持的是某夜总会的妈咪，有些不值，须知婊子无情戏子无义，做IT做到如此份上，恨不能化蝶双双飞。</p>\r\n<p>　　事情发生在2010年5月22日凌晨2点半，位于杭州闹市区凤起路上的&ldquo;新锦绣娱乐会所&rdquo;已近打烊时分，服务员们三三两两下班回家。</p>\r\n<p>　　一辆奥迪A6由远至近，停在了&ldquo;新锦绣&rdquo;门口。司机A某穿一件棕色T恤衫，走下了车。</p>\r\n<p>　　A某等邓姑娘，邓姑娘25岁，江西人，是这家娱乐场所的妈咪。</p>\r\n<p>　　A某，33岁，杭州人，家住西湖区杭新路，从事戴尔电脑分销生意，因为业务关系，他曾来过锦绣消费多次。</p>\r\n<p>　　很快，邓姑娘和同伴出来了。她刚要走出大门，A某就快步上前，一下捏住了邓姑娘的胳膊。</p>\r\n<p>　　两人吵了起来，高生很激动，他拿出一把水果刀，抵住了邓姑娘。&ldquo;别过来！退后！退后！&rdquo;A某要周围所有人全部退后，挟持着邓姑娘退到了一楼大厅的角落里。</p>\r\n<p>　　保安赶紧出门报警，警察随后赶到。</p>\r\n<p>　　从凌晨2点半到清晨5点，杭州市公安局常务副局长郑贤胜亲任谈判专家，经过2个多小时的谈判，A某终于愿意放下手中的刀。就在这个时候，埋伏在里面的特警冲上前去控制住了A某。</p>\r\n<p>　　没有造成重大人员伤亡，仅仅邓姑娘背部被捅了一刀，</p>\r\n<p>　　A某在整个过程中，一直说&ldquo;你不要和我分手，你不要和我分手&rdquo;。</p>\r\n<p>　　由于挚爱，由于坚持，A某不愿意接受被妈咪甩掉的事实，进而做出如此过激举动。</p>', '', '', ''),
(4, 1, '水货iPhone4最快月底开卖:价格最低8000元', '', 'admin', '', 1276763698, '0', '0', 37, 3, 1, 0, 0, 0, '', '水货iPhone4最快月底开卖:价格最低8000元', '<p>　　手机倒爷欲再发iphone4财</p>\r\n<p>　　一石激起千层浪。在大洋对岸发布的iPhone4引起国内消费者无限遐想。尤其是当苹果正式表示今年7月iPhone4将登陆中国香港市场后，坊间迅疾传言其今年9月将登陆中国内地市场。第四代iPhone是否会如愿9月登场？将由何家运营商牵线？内地市场是否再次成为iPhone4最大的水货集散地？记者采访发现，与粉丝不同的是，手机倒爷们已经准备借此大好契机，再发一笔iphone财。</p>\r\n<p><strong>　　内地iPhone4将于9月上市？</strong></p>\r\n<p>　　苹果回应：进入内地市场无时间表。</p>\r\n<p>　　&ldquo;9月登陆中国内地的消息谁说的？除了在发布会上正式公布的iPhone4三批国家和地区上市时间表外，没有进入中国内地市场的时间表。&rdquo;北京时间6月11日下午，身在美国加州参加苹果全球开发者大会(WWDC)的苹果公司中国公关部相关负责人在电话中如是告诉记者。</p>\r\n<p>　　事实上，在苹果8日发布iPhone4后，国内即有消息称&ldquo;或9月登陆中国内地&rdquo;。该负责人向记者明确透露，iPhone4会在7月份登陆中国香港市场，并不意味着马上就可以进入中国内地市场。&ldquo;（传言中）9月份登陆的消息肯定是不准确的，因为公司根本就没有任何关于进入内地市场的信息对外公布。&rdquo;该负责人直接排除了苹果公司其他人透露该消息的可能。</p>\r\n<p>　　按照苹果的计划，6月24日iPhone4将在美国、法国、德国、英国和日本同步上市；7月将登陆澳大利亚、奥地利、比利时、芬兰、中国香港、意大利、荷兰、挪威、新加坡、韩国等地；9月，将在全球其他88个国家和地区上市。因此，中国内地消费者可能还需要耐心等待iPhone4入市。</p>\r\n<p><strong>　　行货难进水货价格高处不胜寒？</strong></p>\r\n<p>　　水货商回应：大概8000元以上，最快月底有货。</p>\r\n<p>　　玩家回应：价格贵但肯定没有翻新机。</p>\r\n<p>　　既然苹果公司对于iPhone4行货进入中国内地市场没有时间表，那水货大行其道自是必然。苹果中国公司相关人士表示，苹果不会对水货渠道和产品发表任何意见。因此，水货iPhone4数量之最是否会再次出现在内地市场也并不重要。</p>\r\n<p>　　其实，在iPhone4发布之后，水货商已在行动。淘宝网上已出现了不少预订销售iPhone4的卖家。报价极为吓人，大多在8000元以上，甚至有些卖家的报价超过1万元。</p>\r\n<p>　　在广州中华广场、岗顶电脑城等地的水货商也开始接受iPhone4的预订。尽管具体报价不一，但也基本在8000元以上。据水货商家表示，iPhone4的水货最快将在月底到货。对此，有iPhone玩家表示，这个价格确实很贵，但起码保证首批产品不会是翻新机、二手机，能率先同步体验iPhone4也不错。</p>\r\n<p><strong>　　中国联通引入iPhone4？</strong></p>\r\n<p>　　中国联通回应：会与苹果磋商，但目前尚无具体计划及时间表。</p>\r\n<p>　　苹果回应：只要不到发布的那一分钟，什么都不会讲。</p>\r\n<p>　　近日，在一次活动上，中国联通负责终端业务的副总经理李刚向记者透露，中国联通将与苹果磋商，并制定引入iPhone4的商业计划，但目前还没有具体计划及时间表。</p>\r\n<p>　　他表示，iPhone4进入中国还需要按照国内的规定，进行终端测试并取得工信部入网许可证等。同时，iPhone在全球的销售有一个整体进度，全球与iPhone合作的运营商也非常多，中国联通会根据iPhone4的销售情况做具体的引入计划。另外，此次iPhone4使用的是微型的MicroSIM卡，与国内使用的SIM卡规格并不相同。</p>\r\n<p>　　与中国联通的态度一样，前述苹果中国公司人士也向记者表示，暂时无可奉告。</p>\r\n<p><strong>　　苹果对iPhone4期望多高？</strong></p>\r\n<p>　　iPhone4将于9月前在88个国家和地区上市，比以往三代产品上市速度快得多。</p>\r\n<p>　　苹果公司表示，对于iPhone4的市场表现&ldquo;不感兴趣&rdquo;。苹果中国公司相关人士告诉记者，&ldquo;苹果从不评论市场，只做消费者的好朋友。&rdquo;当然不会对iPhone4的销售公开做出预期。确实，在iPhone的销量上，苹果几乎从不置评，不说&ldquo;希望进入前几&rdquo;这类的评价。</p>\r\n<p>　　在消费者看事情可并非如此。&ldquo;如果苹果能够将在中国销售的iPhone4价格降低，估计会更好卖。&rdquo;玩家毛先生认为，中国联通iPhone降价千元引起&ldquo;断货&rdquo;即是明证。为什么在国外199/299美元的价格一进国内就要8000元以上？放低身段的iPhone4预计可以更好地对抗Android的竞争。</p>', '', '', ''),
(5, 1, '诺森特软件有限公司顺利通过CMMI-5认证', '', 'admin', '', 1277098371, '0', '0', 22, 2, 1, 0, 0, 0, '', '诺森特软件有限公司已通过CMMI5级认证.我公司一直把为全球客户提供高品质低成本的软件服务,作为自己的使命而不懈努力着.', '<p>诺森特软件有限公司继2005年5月获得美国SEI研究院认证的CMMI-3证书之后，经过两年多的不懈努力，于2007年10月25日顺利通过了 CMMI-5认证！能够成为全球100家以内通过CMMI-5认证的公司，不仅标志着诺森特集团在软件开发管理模式、质量监控方面达到了国际一流的水平,  同时，也为集团今后的软件开发水平与综合能力的进一步发展奠定下了坚实的基石。下一步诺森特软件将会把CMMI-5的开发过程推广到集团的其他公司与研 发中心, 希望通过国际最优的标准来进一步提高易宝的能力和竞争力。</p>', '', '', ''),
(6, 1, '公司研发出新型视频服务器软件', '#8B0000', 'admin', '', 1277366841, '0', '0', 8, 2, 1, 0, 0, 0, '', '公司研发出新型视频服务器软件获国家开发奖', '<p>公司研发出新型视频服务器软件获国家开发奖<br />\r\n功能特点：<br />\r\n1.比快播要快速。<br />\r\n2.有手机客户端软件。<br />\r\n3.基于多种平台， windows, linux, mac, unix<br />\r\n4.适用网吧电影服务器</p>', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `cms_category`
--

DROP TABLE IF EXISTS `cms_category`;
CREATE TABLE `cms_category` (
  `id` smallint(6) unsigned NOT NULL auto_increment,
  `module` tinyint(1) NOT NULL default '0',
  `parentid` smallint(6) unsigned NOT NULL default '0',
  `title` varchar(50) character set utf8 NOT NULL,
  `keywords` varchar(255) character set utf8 NOT NULL default '',
  `description` varchar(255) character set utf8 NOT NULL default '',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `allowadd` varchar(50) character set utf8 NOT NULL default '0',
  `allowedit` varchar(50) character set utf8 NOT NULL default '0',
  `allowdel` varchar(50) character set utf8 NOT NULL default '0',
  `tnum` mediumint(8) unsigned NOT NULL default '0',
  `cnum` int(10) unsigned NOT NULL default '0',
  `displayorder` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `cms_category`
--

INSERT INTO `cms_category` (`id`, `module`, `parentid`, `title`, `keywords`, `description`, `status`, `allowadd`, `allowedit`, `allowdel`, `tnum`, `cnum`, `displayorder`) VALUES
(1, 1, 0, '产品', '', '', 1, '', '', '', 0, 0, 0),
(2, 2, 0, '公司动态', '', '公司动态', 1, '3', '3', '3', 0, 0, 1),
(3, 2, 0, '行业新闻', '', '行业新闻', 1, '3', '3', '3', 0, 0, 2);

-- --------------------------------------------------------

--
-- 表的结构 `cms_comment`
--

DROP TABLE IF EXISTS `cms_comment`;
CREATE TABLE `cms_comment` (
  `id` int(11) NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `username` varchar(20) character set utf8 NOT NULL,
  `ip` char(15) character set utf8 NOT NULL,
  `content` text character set utf8 NOT NULL,
  `ischecked` tinyint(1) NOT NULL default '1',
  `postdate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `cms_comment`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_feedback`
--

DROP TABLE IF EXISTS `cms_feedback`;
CREATE TABLE `cms_feedback` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(50) character set utf8 NOT NULL COMMENT '反馈类型：建议，投诉，表扬，问题，留言。。',
  `username` varchar(50) character set utf8 NOT NULL COMMENT '留言者',
  `sex` tinyint(4) NOT NULL COMMENT '是为男，否为女',
  `tel` varchar(50) character set utf8 NOT NULL COMMENT '电话',
  `fax` varchar(50) character set utf8 NOT NULL COMMENT '传真',
  `qq` varchar(50) character set utf8 NOT NULL COMMENT 'QQ',
  `email` varchar(50) character set utf8 NOT NULL COMMENT 'email',
  `web` varchar(50) character set utf8 NOT NULL COMMENT '个人主页',
  `address` varchar(50) character set utf8 NOT NULL,
  `content` text character set utf8 NOT NULL COMMENT '回复内容',
  `reply` text character set utf8 NOT NULL,
  `ischecked` smallint(1) NOT NULL default '0',
  `replydate` int(11) NOT NULL default '0',
  `postdate` int(11) NOT NULL COMMENT '留言时间',
  `ip` varchar(50) character set utf8 NOT NULL COMMENT '留言IP',
  `intro` text character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `cms_feedback`
--

INSERT INTO `cms_feedback` (`id`, `type`, `username`, `sex`, `tel`, `fax`, `qq`, `email`, `web`, `address`, `content`, `reply`, `ischecked`, `replydate`, `postdate`, `ip`, `intro`) VALUES
(1, 'gbook', '猪先生', 1, '15889361393', '23432423', '119677109', 'xxrs90@126.com', 'http://michaeljoney.gicp.net', '', '我有一个业务想跟你谈下。', '有事情请联系15889361393', 1, 1279085321, 1279085078, '127.0.0.1', '');

-- --------------------------------------------------------

--
-- 表的结构 `cms_job`
--

DROP TABLE IF EXISTS `cms_job`;
CREATE TABLE `cms_job` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) character set utf8 NOT NULL COMMENT '工作名称或招聘对象',
  `nums` int(11) NOT NULL COMMENT '招聘人数',
  `address` varchar(150) character set utf8 NOT NULL COMMENT '工作地点',
  `tel` varchar(50) character set utf8 NOT NULL COMMENT '联系电话',
  `money` text character set utf8 NOT NULL COMMENT '工资待遇',
  `intro` text character set utf8 NOT NULL COMMENT '招聘要求',
  `ischecked` tinyint(1) NOT NULL default '1',
  `exdate` int(11) NOT NULL COMMENT '有效天数',
  `postdate` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `cms_job`
--

INSERT INTO `cms_job` (`id`, `title`, `nums`, `address`, `tel`, `money`, `intro`, `ischecked`, `exdate`, `postdate`) VALUES
(1, 'WEB程序员', 0, '深圳市科技园数字技术园A3栋', '2343242', '10000', '<div class="entry">This is my very first entry in my brand new blog. The blogging software that I am using uses the fantastic Blogtastic tool that I read about in a great O''Reilly book!</div>\r\n<p>&nbsp;</p>', 1, 20, 1276332212),
(2, 'java工程师', 1, '深圳市', '23342', '12000', '<p>工作制</p>\r\n<p>奖励制度</p>\r\n<p>要求</p>', 1, 4, 1276332351);

-- --------------------------------------------------------

--
-- 表的结构 `cms_link`
--

DROP TABLE IF EXISTS `cms_link`;
CREATE TABLE `cms_link` (
  `id` int(11) NOT NULL auto_increment,
  `types` varchar(50) character set utf8 NOT NULL COMMENT '链接类型：首页，内页，论坛,文字',
  `title` varchar(50) character set utf8 NOT NULL COMMENT '网站名称',
  `url` varchar(100) character set utf8 NOT NULL COMMENT '地址',
  `logo` varchar(50) character set utf8 NOT NULL,
  `intro` text character set utf8 NOT NULL COMMENT '简介',
  `postdate` int(11) NOT NULL COMMENT '添加时间',
  `ischecked` tinyint(1) NOT NULL default '1' COMMENT '首页显示、内页显示等显示方式',
  `orders` smallint(6) NOT NULL COMMENT '排序数值，越小排得越前',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `cms_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_member`
--

DROP TABLE IF EXISTS `cms_member`;
CREATE TABLE `cms_member` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) character set utf8 NOT NULL COMMENT '用户名',
  `password` varchar(50) character set utf8 NOT NULL COMMENT '密码',
  `question` varchar(50) character set utf8 NOT NULL COMMENT '问题',
  `answer` varchar(50) character set utf8 NOT NULL COMMENT '答案',
  `groupid` tinyint(2) NOT NULL default '0',
  `regtime` int(11) NOT NULL COMMENT '注册时间',
  `lastlogintime` int(11) NOT NULL COMMENT '最后登录时间',
  `logintimes` int(11) NOT NULL default '0' COMMENT '登录次数',
  `ischecked` tinyint(1) NOT NULL default '1' COMMENT '是否锁定',
  `realname` varchar(50) character set utf8 NOT NULL COMMENT '真实姓名',
  `sex` tinyint(4) NOT NULL COMMENT '性别真为男',
  `telphone` varchar(50) character set utf8 NOT NULL COMMENT '电话',
  `fax` varchar(50) character set utf8 NOT NULL COMMENT 'FAX',
  `email` varchar(50) character set utf8 NOT NULL COMMENT '电子邮件',
  `address` varchar(100) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `cms_member`
--

INSERT INTO `cms_member` (`id`, `username`, `password`, `question`, `answer`, `groupid`, `regtime`, `lastlogintime`, `logintimes`, `ischecked`, `realname`, `sex`, `telphone`, `fax`, `email`, `address`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', 1, 1230768000, 1230768000, 0, 1, '', 1, '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `cms_order`
--

DROP TABLE IF EXISTS `cms_order`;
CREATE TABLE `cms_order` (
  `id` int(11) NOT NULL auto_increment,
  `pid` tinyint(50) NOT NULL default '0' COMMENT '订单号',
  `company` varchar(50) character set utf8 NOT NULL COMMENT '公司名称',
  `username` varchar(50) character set utf8 NOT NULL COMMENT '收货人',
  `address` varchar(50) character set utf8 NOT NULL COMMENT '地址',
  `zip` varchar(50) character set utf8 NOT NULL COMMENT '邮编',
  `tel` varchar(50) character set utf8 NOT NULL COMMENT '电话',
  `fax` varchar(50) character set utf8 NOT NULL COMMENT '传真',
  `email` varchar(50) character set utf8 NOT NULL COMMENT '电子邮件',
  `intro` text character set utf8 NOT NULL COMMENT '备注',
  `ischecked` tinyint(1) NOT NULL default '0',
  `postdate` int(11) NOT NULL COMMENT '订货日期',
  `pcode` varchar(50) character set utf8 NOT NULL COMMENT '产品编号',
  `subject` varchar(50) character set utf8 NOT NULL COMMENT '产品名称',
  `spec` varchar(50) character set utf8 NOT NULL COMMENT '产品型号',
  `numb` int(11) NOT NULL default '0' COMMENT '订购数量',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `cms_order`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_pages`
--

DROP TABLE IF EXISTS `cms_pages`;
CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(100) character set utf8 NOT NULL,
  `seotitle` varchar(250) character set utf8 NOT NULL,
  `seokeywords` varchar(250) character set utf8 NOT NULL,
  `seodescription` varchar(250) character set utf8 NOT NULL,
  `message` text character set utf8 NOT NULL,
  `content` text character set utf8 NOT NULL,
  `postdate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- 导出表中的数据 `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `subject`, `seotitle`, `seokeywords`, `seodescription`, `message`, `content`, `postdate`) VALUES
(1, '公司简介', '', '公司简介，森诺特软件介绍', '森诺特软件有限公司简介', '森诺特软件公司成立于XXXX年XXX月，专门从事实用的企业网站建设、企业应用软件开发、网页设计、UI设计等服务项目。拥有专业的web程序设计人员，均从事华为项目工作多年，具有独到的设计意识和丰富的工作经验，能为您提供完善的服务、一流的设计和全面的解决方案。  \r\n', '<p><span style="font-size: 12px; line-height: 200%;"><font face="Verdana"><font face="Verdana" color="#3d2d29">　 　森诺特软件公司成立于XXXX年XXX月，专门从事实用的企业网站建设、企业应用软件开发、网页设计、UI设计等服务项目。拥有专业的web程序设计人员，均从事华为项目工作多年，具有独到的设计意识和丰富的工作经验，能为您提供完善的服务、一流的设计和全面的解决方案。&nbsp; <br />\r\n</font></font></span></p>\r\n<p><span style="font-size: 12px; line-height: 200%;"><font face="Verdana"><font face="Verdana" color="#3d2d29">　　森诺特软件公司</font></font></span>在高科技行业、电信业、金融服务业、制造业、零售与分销业等领域积累了丰富的行业经验，具备全 面的IT专业服务能力，为客户提供研究及开发、 企业解决方案、 应用软件开发和维护、  质量保证和测试、本地化和全球化、基础设施外包以及业务流程外包等服务，帮助客户实现投资收益最大化，并使之更专注于自身核心业务。目前，文思已成为众多 财富500强企业的重要合作伙伴，主要客户包括 Microsoft, IBM, TIBCO, HP, EMC, NEC, Mitsubishi,  Huawei, Lenovo, ABB, 3M等著名公司。</p>\r\n<p>　　为了满足客户对全球交付和IT支持日益增长的需求，文思将总部设在北京，在中国深圳、南京、上海、 杭州、大连、广州、成都、西安、武汉、天津、香港、台湾、日本东京、马来西亚、美国圣地亚哥、西雅图、旧金山和英国伦敦设有分支机构，为客户提供一站式的 实时服务。文思凭借多年的行业经验和全方位的专业技能，有效地满足了客户的需求，并得到了国际市场的认可。</p>\r\n<p><span style="font-size: 12px; line-height: 200%;"><font face="Verdana"><font face="Verdana" color="#3d2d29"><br />\r\n</font></font></span></p>', 1231751203),
(2, '企业文化', '企业文化', '企业文化，共同的目的，共同的使命，公司的口号', '企业文化，公司口号优质品质，完美服务，激情团队，不断创新', '共同的目的：\r\n为客户创造价值！\r\n以市场为导向，以客户需求为导向，以不断的创新、不断的发现客户为导向。\r\n\r\n共同的使命（亦即共同的最高目标）：\r\n为社会创造价值\r\n\r\n公司的口号：\r\n优质品质，完美服务，激情团队，不断创新\r\n', '<p><strong style="font-size: 14px;">共同的目的：</strong></p>\r\n<p style="margin-left: 47px; text-indent: 0pt;">为客户创造价值！<br />\r\n以市场为导向，以客户需求为导向，以不断的创新、不断的发现客户为导向。</p>\r\n<p><strong style="font-size: 14px;">共同的使命（亦即共同的最高目标）：</strong></p>\r\n<p style="margin-left: 20px;">为社会创造价值</p>\r\n<p><strong style="font-size: 14px;">公司的口号：</strong></p>\r\n<div style="margin-left: 20px;">\r\n<p style="margin-left: 27px; text-indent: 0pt;">中文：优质品质，完美服务，激情团队，不断创新<br />\r\n英文：High Quality, Perfect Service, Amazing Team,Always Improving!</p>\r\n<p>口号释义：</p>\r\n<p style="margin-left: 27px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 优质品质（High  Quality）：我们要以专业的品质为客户提供最优化的解决方案，帮助客户实现综合成本最优。</p>\r\n<p style="margin-left: 27px;"><font style="font-size: 14px; margin-left: 27px;">完美服务（Perfect  Service）：是联系公司和客户的纽带；&ldquo;完美&rdquo;一词表示通过良好沟通与交流、用心专注地服务，让客户实现价值最优化。</font><br />\r\n<font style="font-size: 14px; margin-left: 27px;">激情团队（Amazing  Team）：是要我们树立一个信念，打造一支长期、稳定、出色的团队；我们对自己取得的成就感到自豪并通过互助来实现公司与个人的更大目标。</font><br />\r\n<font style="font-size: 14px; margin-left: 27px;">不断创新（Always  Improving）：是表明我们从不懈怠，在&ldquo;优质品质、完美服务、激情团队&rdquo;目标实现基础上，我们还要高瞻远瞩，以积极创新的精神对待工作，把公司的 各个方面做到尽善尽美。</font></p>\r\n</div>\r\n<p><strong style="font-size: 14px;">公司价值观：<br />\r\n</strong></p>\r\n<div style="margin-left: 20px;">\r\n<p>客户第一。客户是衣食父母，无论何种状况，始终微笑面对客户，体现尊重和诚意。在坚持原则的基础上，用客户喜欢的方式对待客户。为客户提供高附加值 的服务，使客户资源的利用最优化。平衡好客户需求和公司利益，寻求并取得双赢。关注客户的关注点，为客户提供建议和资讯，帮助客户成长。</p>\r\n<p>团队精神，共享共担，以小我完成大我。乐于分享经验和知识，与团队共同成长。有团队主人翁意识，为团队建设添砖加瓦。在工作中主动相互配合，拾遗补 缺。决策前充分发表意见，决策后坚决执行。正面影响团队，使大家积极地朝着一个方向前进。</p>\r\n<p>拥抱变化，突破自我，迎接变化。对于本行业的特点有深刻的认识，坚信变化是正常现象。对于公司的变化，认真思考，充分理解，积极接受并影响和带动同 事。对于变化对个人产生的影响，理性对待，充分沟通，诚意配合。在工作中善于自我调整，具备前瞻意识，建立新方法、新思路。面对变化后产生的挫折和失败， 能够重新调整，以更积极的心态投入到改进中。</p>\r\n<p>激情，永不言弃，乐观向上。对公司、工作和同事要充满热情。以积极的心态面对变化、困难、挫折和失败。在日常工作中，不断自我激励，自我完善。  任何时候保持自信，拥有必胜的决心。在困难的时候，以乐观主义的精神影响同事和团队。</p>\r\n<p>诚信，诚实正直，信守承诺。以坦荡的胸怀，坦诚的态度，与人交往合作。言行一致，不屈服于利益或压力。勇于承认错误，敢于承担责任。不传播未经证实 的消息，不在背后不负责地议论事和人。坚持原则，不随意承诺或妥协，维护公司的利益和声誉。</p>\r\n<p>敬业，以专业的态度和平常的心态做不平凡的事情。今日事今日毕，自己的事情不推给别人。持续学习，不断提升专业能力和解决问题的能力。不计较个人得 失，以团队和公司利益为重。在工作上能以较小的投入获得高效的产出。遵循工作流程，安排好优先顺序，做正确的事情。</p>\r\n</div>\r\n<p><strong style="font-size: 14px;"><br />\r\n</strong></p>', 1231751240),
(3, '服务项目', '', '', '', '电信、联通、华为项目。', '<p>服务项目</p>', 1231751249),
(4, '成功案例', '', '', '', '1.电话费计算管理系统。\r\n2.货物配送系统。\r\n3. 通信制高校学习支援系统。', '<p>成功案例</p>', 1231751258),
(5, '技术支持', '', '', '', '', '<p>技术支持</p>', 1231751268),
(6, '增值服务', '', '', '', '增值服务', '<p>增值服务</p>', 1276331674),
(7, '支撑软件', '', '', '', '支撑软件', '<p>支撑软件&nbsp; 斯蒂芬斯多夫。</p>', 1277196876),
(8, '商业智能', '', '', '', '介绍ERP系统', '<p>商业智能</p>', 1277371462),
(9, '软件外包', '', '', '', '外包服务内容', '<p>华为外包</p>', 1277371500),
(11, '联系我们', '联系我们', '联系我们，公司地址', '联系我们，广东省深圳市南山区科技园数字技术园A3栋3A', '公司名称： 森诺特软件\r\n联  系 人： 刘振\r\n电      话： 0000-0000000\r\n传　　真： 0000-0000000\r\n邮　　箱：\r\n地　　址： 广东省深圳市南山区科技园数字技术园A3栋3A', '<p>公司名称： 森诺特软件<br />\r\n联系人： 刘振<br />\r\n电&nbsp; 话： 0000-0000000<br />\r\n传&nbsp; 真： 0000-0000000<br />\r\n邮&nbsp; 箱：</p>\r\n<div style="background-color: lightblue; height: 20px; width: 100%;"><span style="font-size: small; vertical-align: middle; display: table-cell;"><span style="font-family: Tahoma;"><big><small>如何找到我们</small></big></span></span></div>\r\n<p>地&nbsp; 址： 广东省深圳市南山区科技园数字技术园A3栋3A<br />\r\n邮&nbsp; 编：518054<br />\r\n坐以下公交车到&ldquo;科技园&rdquo;站，然后往虚拟大学方向走， 惠红集团的楼对面就是数字技术园A3栋。<br />\r\n<br />\r\n70路&nbsp;&nbsp; 220路&nbsp; &nbsp;  210路&nbsp;&nbsp; 329路&nbsp; &nbsp; 390路&nbsp;&nbsp; 81路&nbsp; &nbsp; 36路&nbsp; &nbsp; 101路</p>', 1277390281),
(12, '数据库营销', '', '', '', '数据库营销', '<p>数据库营销</p>', 1277608238),
(13, '咨询服务', '', '', '', '咨询服务', '<p>咨询服务</p>', 1277608254),
(14, '服务承诺', '', '', '', '服务承诺', '<p>服务承诺</p>', 1277608388),
(15, '常见问题', '', '', '', '常见问题', '<p>常见问题</p>', 1277608399);

-- --------------------------------------------------------

--
-- 表的结构 `cms_product`
--

DROP TABLE IF EXISTS `cms_product`;
CREATE TABLE `cms_product` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL default '1' COMMENT '用户ID',
  `cid` int(11) NOT NULL COMMENT '分类ID',
  `subject` varchar(50) character set utf8 NOT NULL COMMENT '产品名称',
  `color` varchar(7) character set utf8 NOT NULL,
  `spec` varchar(50) character set utf8 NOT NULL COMMENT '产品型号|规格',
  `size` varchar(50) character set utf8 NOT NULL COMMENT '产品尺寸',
  `keywords` varchar(50) character set utf8 NOT NULL COMMENT '关键字',
  `content` text character set utf8 NOT NULL COMMENT '产品说明',
  `meno` text character set utf8 NOT NULL,
  `attachpath` varchar(6) character set utf8 NOT NULL,
  `attachment` varchar(50) character set utf8 NOT NULL COMMENT '产品图片',
  `attachthumb` varchar(50) character set utf8 NOT NULL,
  `ischecked` tinyint(1) NOT NULL default '1' COMMENT '是否审核',
  `istop` tinyint(1) NOT NULL default '0' COMMENT '是否推荐',
  `isgood` tinyint(1) NOT NULL default '0',
  `hits` int(11) NOT NULL COMMENT '点击次数',
  `postdate` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `cms_product`
--

INSERT INTO `cms_product` (`id`, `userid`, `cid`, `subject`, `color`, `spec`, `size`, `keywords`, `content`, `meno`, `attachpath`, `attachment`, `attachthumb`, `ischecked`, `istop`, `isgood`, `hits`, `postdate`) VALUES
(1, 1, 1, '中国网管联盟', '', 'DedeCMS VDedeCMS V5.3', '', '', '<p>中国网管联盟是一个自1999年起已有7年历史专注于网管特定群体的技术机构，联盟英文名称：Webmaster　Union of China(缩写WUC，简称网盟)。 主要由网络技术的爱好者组成，力求打造国内网管第一门户网站！</p>\r\n<p>　　网管是一种特殊的职业，掌握着最先进的IT应用技术，是企业的信息化改革及管理的先锋和骨干。但新技术层出不穷，网管随着年岁的增长永远面临着被淘汰的危险。&nbsp;</p>\r\n<p>　　网管是企业信息系统危机处理的消防队员，永远处于高度紧张之中。高付出、高强度、高风险的职业。却没有相应的回报。随着职业竞争的加剧，形势越来越不容乐观。&nbsp;</p>\r\n<p>　　网管们大多不甘平庸。但捆绑在快速变化的网络列车上，既无法象管理人员及营销人员长期受企业重 用，也不可能象软件开发人员专注单纯的技术，要么高新回报，要么拥有自己的软件产品去创业。而网管，只有不知疲倦的学习、努力地工作。才能维持一份中等收 入。也许成为CIO是许多网管的梦想，但只有很少的大型企业的个别网管才有机会获此殊荣。对大部分网管来说。前途仍然充满着彷徨。为了依靠技术优势寻求创 业机会。有些网管建立了个人网站，但缺乏长远规划及足够的维护力量，很难成气候，许多都是自生自灭。</p>\r\n<p>　　在现代信息社会，个人英雄主义已经不适合网络创业了，只有团结协作、资源共享，才有可能创造后网络时代的创业神话。 其实机会就是我们身边，只是我们视而不见。我们欢迎一切愿意融入到 中国网管大联盟 中来的所有朋友,共同交流、共同创业。</p>', '', '201006', '4c286a36bcc8c.gif', '4c286a36bcc8c_thumb.gif', 1, 0, 0, 10, 1277717046),
(2, 1, 1, '盐城市国土资源局', '', 'DedeCMS VDedecmsV55 ', '', '', '<p>　盐城市国土资源局是主管全市土地、矿产等自然资源的规划、管理、保护与合理利用以及测绘行政管理的工作部门，其职能如下： <br />\r\n&nbsp;&nbsp;&nbsp; 1、贯彻执行国家、省有关国土资源、矿产资源、测绘管理方面的法律、法规和方针、政策，研究草拟并组织实施管理、保护和合理利用土地资源、矿产资源以及测绘管理方面的有关政策、措施；组织制订全市土地资源、矿产资源、测绘管理方面的技术标准、规程和规范。 <br />\r\n&nbsp;&nbsp;&nbsp; 2、组织编制和实施全市国土规划、土地利用总体规划和其他专项规划，参与审核城市总体规划；指导、审核县(市、区)、乡(镇)土地利用总体规划；负责土地利用年度计划的编制、管理和建设项目的用地预审；组织编制和实施全市矿产资源总体规划、地质环境 <br />\r\n规划及其他专项规划；指导、审核县(市、区)矿产资源规划、地质环境规划及专项规划。 <br />\r\n&nbsp;&nbsp;&nbsp; 3、拟定并实施耕地特殊保护和鼓励耕地开发政策；实施农地用途管制，组织基本农田保护，组织指导未利用土地开发、土地整理、土地复垦，监督耕地开垦，负责耕地占补平衡工作。 <br />\r\n&nbsp;&nbsp;&nbsp; 4、依法管理国有土地使用权划拨、出让、租赁、作价出资、转让和实施国有土地储备工作，管理土地市场，承担土地资源资产化管理的有关工作；依法管理农村集体非农用地，承担报省政府、国务院审批的农地转用、征(使)用的材料审查报批工作。 <br />\r\n&nbsp;&nbsp;&nbsp; 5、组织土地资源调查、地籍调查、土地统计和土地动态监测；组织指导土地确权、土地登记发证等工作；承办并组织调处土地权属纠纷；指导、组织土地定级和基准地价、标定地价评估，负责评估机构从事土地评估资格的初审、土地使用权价格的会审工作。 <br />\r\n&nbsp;&nbsp;&nbsp; 6、监督检查全市国土资源部门行政执法、土地、矿产资源规划执行情况；依法保护土地、矿产资源所有者和使用者的合法权益，承办并组织查处违法案件。 <br />\r\n&nbsp;&nbsp;&nbsp; 7、负责矿产资源开采登记管理和采矿权转让审批；培育矿业权市场；依法征收管理矿产资源补偿费和采矿权使用费及价款统一管理矿产资源储量，管理地质资料汇 交，负责矿产储量登记统计管理参与矿产建设项目可行性论证审查制定地方性地质勘查计划；管理地勘成果；对矿产资源勘查、开发、保护和合理利用进行监督管 理。 <br />\r\n&nbsp;&nbsp;&nbsp; 8、负责矿产资源勘查、开采过程中矿产开发生态环境保护监督管理；组织矿产开发生态环境治理；组织实施地质灾害勘查、监测和防治，保护地质环境；审查 重点工程建设用地的地质环境条件评估结论；指导水文地质、工程地质、环境地质勘查和评价。 <br />\r\n&nbsp;&nbsp;&nbsp; 9、制订全市测绘事业发展规划和中长期计划；组织管理全市基础测绘、地籍测绘、行政区域界线测绘及其他重大测绘项目；依法管理全市测绘市场，负责全市测绘 资质、技术、成果、测量标志、地图编制出版管理，组织指导基础地理信息社会化服务，审核全市有关地理信息数据。 <br />\r\n&nbsp;&nbsp;&nbsp; 10、安排并监督检查市财政拨给的国土资源工作经费、专项资伞及其他资金；完成省和市政府规定的国土资源税费征收、协收任务。 <br />\r\n&nbsp;&nbsp;&nbsp; 11、制订全市国土资源利用制度改革方案，不断完善各项改革措施。 <br />\r\n&nbsp;&nbsp;&nbsp; 12、组织开展土地、矿产、测绘资源的科技工作和对外交流与合作。 <br />\r\n&nbsp;&nbsp;&nbsp; 13、承办市政府交办的其他事项。</p>', '', '201006', '4c286a9c89601.gif', '4c286a9c89601_thumb.gif', 1, 0, 0, 20, 1277717148),
(3, 1, 1, '天网安全阵线', '', 'DedeCMS VDedecmsV5６ ', '', '', '<p>广州众达天网技术有限公司是一家集科研、生产、经营于一体的高科技产业公司，成立于1998年，是开创国内网络安全事业的先行者。主要从事互联网应 用技术及网络安全产品的研究、开发和生产，为全国的行业用户和广大的上网用户提供网络安全应用的软、硬件产品、安全解决方案以及全方位的专业技术服务。</p>\r\n<p><span class="style1">主要产品：<br />\r\n</span>　　中国第一套软硬件集成防火墙――天网防火墙 <br />\r\n享誉国内外的&quot;天网防火墙个人版&quot; <br />\r\n中国第一套计算机安全在线检测系统――天网在线检测系统</p>\r\n<p><span class="style1">技术展示：<br />\r\n</span>　 　&ldquo;天网防火墙&rdquo;是我国首个达到国际一流水平、首批获得国家信息安全认证中心、国家公安部、国家安全部认证的软硬件一体化网络安全产品，性能指标及技术指 标达到世界同类产品先进水平。&ldquo;天网防火墙&rdquo;发展到现在，已经在多项网络安全关键技术上取得重大突破，特别是强大的DoS防御功能足以傲视同行。公司还在 此基础上独立开发出天网VPN安全网关、内容过滤系统等网络应用软硬件系统模块。</p>\r\n<p><span class="style1">用户情况：<br />\r\n</span>　 　2000年天网率先在国内推出首个国产个人防火墙&ldquo;天网防火墙个人版&rdquo;，以先进的技术与理念得到广大用户的支持，问世以来，拥有超过300万的忠实用 户。为中国个人防火墙之翘楚。 本公司在网上的代表网站就是著名的&ldquo;天网安全阵线&rdquo;。&ldquo;天网在线检测系统&rdquo;提供在线全面的网络计算机安全检测，问世以来，已经为互联网用户提供超过 3000万次网络在线检测，大大推动中国网络安全建设的步伐。</p>\r\n<p><span class="style1">成功案例：</span><br />\r\n作为一家网络安全的专业公司，为中央电视台、人民日报社、广州视窗、网易、21CN、南方航空公司、南京大学、中山大学等大型单位的网络安全建设提供了有力的支持，并获得了普遍好评。</p>\r\n<p><span class="style1">远大目标：</span></p>\r\n<p>　　 &ldquo;不断创新，共同发展&rdquo; 。凝聚大批优秀技术人才的广州众达天网技术有限公司将以发展中华民族的网络安全事业为己任，努力为中国的网络发展及信息安全建设作出贡献。</p>', '网站简介： 广州众达天网技术有限公司是一家集科研、生产、经营于一体的高科技产业公司，成立于1998年，是开创国内网络安全事业的先行者。主要从事互联网应 用技术及网络安全产品的研... ', '201006', '4c286b415ff6e.gif', '4c286b415ff6e_thumb.gif', 1, 0, 0, 18, 1277717290);

-- --------------------------------------------------------

--
-- 表的结构 `cms_resume`
--

DROP TABLE IF EXISTS `cms_resume`;
CREATE TABLE `cms_resume` (
  `id` int(11) NOT NULL auto_increment,
  `jid` int(11) NOT NULL COMMENT '招聘信息ID',
  `username` varchar(50) character set utf8 NOT NULL COMMENT '姓名',
  `sex` varchar(50) character set utf8 NOT NULL COMMENT '性别',
  `age` varchar(50) character set utf8 NOT NULL COMMENT '出生日期',
  `marry` varchar(50) character set utf8 NOT NULL COMMENT '婚否',
  `school` varchar(50) character set utf8 NOT NULL COMMENT '学校',
  `degree` varchar(50) character set utf8 NOT NULL COMMENT '学历',
  `zhuanye` varchar(50) character set utf8 NOT NULL COMMENT '专业',
  `gradyear` varchar(50) character set utf8 NOT NULL COMMENT '毕业时间',
  `tel` varchar(50) character set utf8 NOT NULL COMMENT '电话',
  `email` varchar(50) character set utf8 NOT NULL COMMENT 'EMAIL',
  `address` varchar(50) character set utf8 NOT NULL COMMENT '联系地址',
  `rusumes` text character set utf8 NOT NULL,
  `postdate` int(11) NOT NULL COMMENT '应聘时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `cms_resume`
--


-- --------------------------------------------------------

--
-- 表的结构 `cms_scroll`
--

DROP TABLE IF EXISTS `cms_scroll`;
CREATE TABLE `cms_scroll` (
  `id` int(11) NOT NULL auto_increment,
  `subject` varchar(50) character set utf8 NOT NULL COMMENT '网站名称',
  `url` varchar(100) character set utf8 NOT NULL COMMENT '地址',
  `attachment` varchar(50) character set utf8 NOT NULL,
  `content` text character set utf8 NOT NULL COMMENT '简介',
  `postdate` int(11) NOT NULL COMMENT '添加时间',
  `orders` smallint(6) NOT NULL COMMENT '排序数值，越小排得越前',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `cms_scroll`
--

INSERT INTO `cms_scroll` (`id`, `subject`, `url`, `attachment`, `content`, `postdate`, `orders`) VALUES
(1, '1', 'http://www.osphp.com.cn', '1.jpg', '', 1231923826, 0),
(2, '2', 'http://www.osphp.com.cn', '2.jpg', 'eeeeeee', 1231923863, 0),
(3, '3', 'http://www.osphp.com.cn', '3.jpg', 'sdaf', 1231932490, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_settings`
--

DROP TABLE IF EXISTS `cms_settings`;
CREATE TABLE `cms_settings` (
  `title` varchar(20) character set utf8 NOT NULL default '',
  `values` text character set utf8 NOT NULL,
  PRIMARY KEY  (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 导出表中的数据 `cms_settings`
--

INSERT INTO `cms_settings` (`title`, `values`) VALUES
('sitename', '森诺特软件'),
('siteurl', 'http://michaeljoney.gicp.net'),
('stopd', '系统维护中.....'),
('status', '1'),
('db_fields_cache', 'false'),
('email', 'xxrs90@126.com'),
('address', '广东省深圳市南山区科技园数字技术园A3栋3A'),
('telephone', '0000-0000000'),
('fax', '0000-0000000'),
('default_module', 'Index'),
('debug_mode', 'false'),
('attachdir', 'Attachments'),
('attachsize', '2097192'),
('attachext', 'jpg,gif,png'),
('thumbmaxwidth', '300'),
('thumbmaxheight', '200'),
('thumbsuffix', '_thumb'),
('tmpl_cache_time', '2'),
('sql_debug_log', 'false'),
('web_log_record', 'false'),
('seotitle', '森诺特软件'),
('seokeywords', '森诺特软件'),
('seodescription', '森诺特软件'),
('sysversion', '1.1'),
('attach', 'true'),
('company', '森诺特软件'),
('think_html_token', ''),
('linkman', '肖潇'),
('router_on', 'true'),
('html_url_suffix', '.html'),
('data_cache_type', 'File'),
('data_cache_subdir', 'false'),
('sdata_time', '60'),
('postcode', '123');

-- --------------------------------------------------------

--
-- 表的结构 `cms_top_menu`
--

DROP TABLE IF EXISTS `cms_top_menu`;
CREATE TABLE `cms_top_menu` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `module` tinyint(1) default '3' COMMENT '类型',
  `pid` varchar(300) default NULL COMMENT '文章数组',
  `link` varchar(20) default NULL COMMENT '链接',
  `sortrank` tinyint(40) default '0' COMMENT '排列',
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `cms_top_menu`
--

INSERT INTO `cms_top_menu` (`id`, `name`, `module`, `pid`, `link`, `sortrank`) VALUES
(1, '关于我们', 3, '1,2', '', 1),
(2, '新闻动态', 2, NULL, 'Article.html', 2),
(3, '服务项目', 3, '5,6,7,8,9,12,13', '', 3),
(4, '产品展示', 1, '', 'Product.html', 4),
(5, '技术支持', 3, '14,15', '', 5),
(6, '求贤纳才', 4, '', 'Job.html', 6);

-- --------------------------------------------------------

--
-- 表的结构 `cms_usergroup`
--

DROP TABLE IF EXISTS `cms_usergroup`;
CREATE TABLE `cms_usergroup` (
  `id` tinyint(1) NOT NULL auto_increment,
  `grouptitle` varchar(20) character set utf8 NOT NULL,
  `allowsystem` tinyint(1) NOT NULL default '0',
  `allowlink` tinyint(1) NOT NULL default '0',
  `allowdatabase` tinyint(1) NOT NULL default '0',
  `allowpages` tinyint(1) NOT NULL default '0',
  `allowarticle` tinyint(1) NOT NULL default '0',
  `allowproduct` tinyint(1) NOT NULL default '0',
  `allowcategory` tinyint(1) NOT NULL default '0',
  `allowjob` tinyint(1) NOT NULL default '0',
  `allowmenumanage` tinyint(1) NOT NULL default '0',
  `allowfeedback` tinyint(1) NOT NULL default '0',
  `allowannounce` tinyint(1) NOT NULL default '0',
  `allowmember` tinyint(1) NOT NULL default '0',
  `allowgroup` tinyint(1) NOT NULL default '0',
  `allowscroll` tinyint(1) NOT NULL default '0',
  `allowbat` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `cms_usergroup`
--

INSERT INTO `cms_usergroup` (`id`, `grouptitle`, `allowsystem`, `allowlink`, `allowdatabase`, `allowpages`, `allowarticle`, `allowproduct`, `allowcategory`, `allowjob`, `allowmenumanage`, `allowfeedback`, `allowannounce`, `allowmember`, `allowgroup`, `allowscroll`, `allowbat`) VALUES
(1, '超级管理', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, '禁止访问', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '普通管理', 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0);
