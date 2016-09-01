/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : dalcms

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2016-08-26 17:33:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `uid` int(8) NOT NULL COMMENT 'ç”¨æˆ·id',
  `group_id` int(8) NOT NULL COMMENT 'è§’è‰²id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ç”¨æˆ·-è§’è‰²å…³è”è¡¨';

-- ----------------------------
-- Records of auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for `auth_node`
-- ----------------------------
DROP TABLE IF EXISTS `auth_node`;
CREATE TABLE `auth_node` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '0' COMMENT 'è§„åˆ™å”¯ä¸€æ ‡è¯†',
  `title` varchar(20) NOT NULL DEFAULT '0' COMMENT 'è§„åˆ™ä¸­æ–‡åç§°',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'çŠ¶æ€ï¼šä¸º1æ­£å¸¸ï¼Œä¸º0ç¦ç”¨',
  `type` varchar(80) NOT NULL DEFAULT '0',
  `pid` int(2) NOT NULL DEFAULT '0' COMMENT 'çˆ¶èŠ‚ç‚¹',
  `sort` int(2) NOT NULL DEFAULT '0' COMMENT 'æŽ’åº',
  `conditions` varchar(100) DEFAULT NULL COMMENT 'è§„åˆ™è¡¨è¾¾å¼,ä¸ºç©ºè¡¨ç¤ºå­˜åœ¨å°±éªŒè¯ï¼Œä¸ä¸ºç©ºè¡¨ç¤ºæŒ‰ç…§æ¡ä»¶éªŒè¯',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='åŠŸèƒ½è§„åˆ™è¡¨';

-- ----------------------------
-- Records of auth_node
-- ----------------------------
INSERT INTO `auth_node` VALUES ('1', 'Admin', '管理员管理', '1', '0', '0', '1', null);
INSERT INTO `auth_node` VALUES ('3', 'node', '权限管理', '1', '0', '1', '1', null);
INSERT INTO `auth_node` VALUES ('4', 'Admin/node_add', '添加权限', '1', '0', '3', '2', null);
INSERT INTO `auth_node` VALUES ('5', 'Admin/node_edit', '权限修改', '1', '0', '3', '3', null);
INSERT INTO `auth_node` VALUES ('6', 'Admin/node_del', '权限删除', '1', '0', '3', '4', null);
INSERT INTO `auth_node` VALUES ('7', 'Admin/node', '权限管理', '1', '0', '3', '1', null);
INSERT INTO `auth_node` VALUES ('8', 'Home', '首页设置', '1', '0', '0', '1', null);
INSERT INTO `auth_node` VALUES ('9', 'category', '栏目设置', '1', '0', '8', '1', null);
INSERT INTO `auth_node` VALUES ('10', 'category', '栏目管理', '1', '0', '9', '1', null);
INSERT INTO `auth_node` VALUES ('11', 'Home/category_add', '添加栏目', '1', '0', '9', '2', null);
INSERT INTO `auth_node` VALUES ('12', 'Home/category_edit', '编辑栏目', '1', '0', '9', '3', null);
INSERT INTO `auth_node` VALUES ('13', 'Home/category_del', '删除栏目', '1', '0', '9', '4', null);

-- ----------------------------
-- Table structure for `hometitle`
-- ----------------------------
DROP TABLE IF EXISTS `hometitle`;
CREATE TABLE `hometitle` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '0' COMMENT 'æ ç›®åç§°',
  `link` varchar(100) NOT NULL DEFAULT '0' COMMENT 'æ ç›®è¿žæŽ¥',
  `sort` int(4) NOT NULL DEFAULT '0' COMMENT 'æŽ’åº',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'çŠ¶æ€ï¼šä¸º1æ­£å¸¸ï¼Œä¸º0ç¦ç”¨',
  `pid` int(8) NOT NULL DEFAULT '0' COMMENT 'çˆ¶èŠ‚ç‚¹',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='é¦–é¡µæ ç›®èœå•';

-- ----------------------------
-- Records of hometitle
-- ----------------------------
INSERT INTO `hometitle` VALUES ('1', '关于我们', 'about', '2', '1', '0');
INSERT INTO `hometitle` VALUES ('2', '经销加盟', 'wenhua ', '5', '1', '0');
INSERT INTO `hometitle` VALUES ('3', '下属公司', 'jianshan', '4', '1', '0');
INSERT INTO `hometitle` VALUES ('5', '产品展示', 'Product/index', '6', '1', '0');
INSERT INTO `hometitle` VALUES ('7', '联系方式', '456456', '8', '1', '0');
INSERT INTO `hometitle` VALUES ('8', '新闻中心', 'News/index', '3', '1', '0');
INSERT INTO `hometitle` VALUES ('9', '组织机构', 'zuzhi', '1', '1', '1');
INSERT INTO `hometitle` VALUES ('10', '新闻咨询', 'News/index', '1', '1', '8');
INSERT INTO `hometitle` VALUES ('11', '网站首页', 'Index/index', '1', '1', '0');
INSERT INTO `hometitle` VALUES ('12', '行业动态', 'News/industry', '2', '1', '8');
INSERT INTO `hometitle` VALUES ('13', '老窖酿坊', 'Product/index', '1', '1', '5');
INSERT INTO `hometitle` VALUES ('14', '礼宾级', 'Product/index', '2', '1', '5');
INSERT INTO `hometitle` VALUES ('15', '泸州陈曲', 'Product/index', '3', '1', '5');
INSERT INTO `hometitle` VALUES ('16', '公司简介', 'About/index/article/6', '1', '1', '1');

-- ----------------------------
-- Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL DEFAULT '0' COMMENT 'æ ‡é¢˜',
  `content` varchar(15000) NOT NULL DEFAULT '0' COMMENT 'å†…å®¹',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT 'ç±»åž‹',
  `view` int(4) NOT NULL DEFAULT '0' COMMENT 'æµè§ˆæ•°ç›®',
  `fileid` int(10) NOT NULL DEFAULT '0' COMMENT 'å›¾ç‰‡æ–‡ä»¶id',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'çŠ¶æ€ï¼šä¸º1æ­£å¸¸ï¼Œä¸º0ç¦ç”¨',
  `istop` int(1) NOT NULL DEFAULT '0' COMMENT 'çŠ¶æ€ï¼šä¸º1ç½®é¡¶ï¼Œä¸º0æ­£å¸¸',
  `times` int(10) NOT NULL DEFAULT '0' COMMENT 'æ—¶é—´',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='æ–°é—»';

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('4', 'ceshi ', '<img src=\"http://127.0.0.1/mprotect/cms/Public/kindeditor/plugins/emoticons/images/11.gif\" alt=\"\" border=\"0\" /><img src=\"/mprotect/cms/Public/Uploads/image/2016-08-25/1472111295_42.png\" alt=\"\" />', '1', '0', '1472111284', '1', '0', '1472111297');
INSERT INTO `news` VALUES ('5', '测试', '<img src=\"/mprotect/cms/Public/Uploads/image/2016-08-25/1472111337_16.jpg\" alt=\"\" />1', '2', '0', '1472111325', '1', '0', '1472111339');
INSERT INTO `news` VALUES ('6', '公司简介', '<p style=\"text-indent:2em;\">\r\n	<img title=\"\" src=\"/mprotect/cms/Public/Uploads/image/2016-08-25/1472115446_63.png\" alt=\"\" align=\"left\" height=\"260\" width=\"400\" />\r\n</p>\r\n<p>\r\n	四川是中国酒的故乡。位于川南的泸州市自古就有“酒城”的美誉，酿酒历史自秦汉以来已有千年。泸州\r\n</p>\r\n<p>\r\n	老窖是在明清36家古老酿酒作坊群的基础上发展起来的国有大型骨干酿酒企业。\r\n</p>\r\n<p>\r\n	&nbsp;泸州润泽天下酒类销售有限责任公司是一家专业生产与销售浓香型、酱香型、清香型及各种定制酒（喜酒\r\n</p>\r\n<p>\r\n	寿酒、公司内供定制酒等）封藏酒的大型企业。\r\n</p>\r\n<p>\r\n	&nbsp;公司坐落于中国名酒金三角腹地泸州大渡口镇—中国酒镇，是一家专业生产和销售浓香型、酱香型原酒、\r\n</p>\r\n<p>\r\n	品牌酒的大型企业。\r\n</p>\r\n<p>\r\n	&nbsp;公司厂区分布在泸州、宜宾、贵州三地，总占地面积2200余亩，拥有老窖窖池4000多口，泸州市市级文物\r\n</p>\r\n<p>\r\n	保护窖池700多口，集团拥有新老窖池近万口，年生产优质原酒2万余千升，总储量达5万余千升。\r\n</p>\r\n<p>\r\n	&nbsp;公司拥有员工1500多人，其中国家级白酒评委 2人，国家一级品酒师6名，国家质量工程师4名，国家酒类\r\n</p>\r\n<p>\r\n	高级营销师1名、省级白酒评委6名，酿造师、工程师等专业技术人员80多名。过硬的技术保证和质量管理，让\r\n</p>\r\n<p>\r\n	“巴蜀液”在近5年来迅速发展，原酒畅销全国各地，可提供OEM贴牌包装业务。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp;<img src=\"/mprotect/cms/Public/Uploads/image/2016-08-25/1472115455_83.png\" alt=\"\" align=\"left\" />公司历年来获得“中国食品安全示范单位”称号、四川省诚信先进单位；四川省白酒制造业“十佳成长型\r\n</p>\r\n<p>\r\n	”企业；四川省“守合同重信用企业”；四川省“酿酒协会常务理事单位”；江西省食品工业协会指定的浓香\r\n</p>\r\n<p>\r\n	型基础酒、调味酒研发基地；泸州市酒产业重点扶持的“小巨人企业”；泸州市“守合同重信用企业”；“泸\r\n</p>\r\n<p>\r\n	州白酒十强”企业；泸州农业产业化经营重点龙头企业；泸州市酒业协会副会长单位；纳溪区区委、区政府指\r\n</p>\r\n<p>\r\n	定的“绿卡”重点企业。\r\n</p>\r\n<p>\r\n	&nbsp;在未来五年，巴蜀液酒业集团全力打造酒之道品牌事业部，计划形成“立足泸州，深入四川，拓展全国”\r\n</p>\r\n<p>\r\n	的战略发展格局，多元化经营为辅助，管理规范，力争成为以白酒连锁销售、经营稳健的国际化O2O商业平台。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	为公司走向国际化，奠定了坚实的基础。从而真正意义上实现了让全国消费者喝上优质的泸州美酒。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', '3', '0', '1472115226', '1', '0', '1472115861');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '0' COMMENT 'äº§å“åç§°',
  `pname` varchar(200) NOT NULL DEFAULT '0' COMMENT 'äº§å“çˆ¶æ ‡é¢˜',
  `product` varchar(1000) NOT NULL DEFAULT '0' COMMENT 'äº§å“ä»‹ç»',
  `link` varchar(400) NOT NULL DEFAULT '0' COMMENT 'å›¾ç‰‡è·¯å¾„',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'çŠ¶æ€',
  `pid` int(3) NOT NULL DEFAULT '0' COMMENT 'çˆ¶ç±»',
  `sort` int(2) NOT NULL DEFAULT '0' COMMENT 'æŽ’åº',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='äº§å“ä¿¡æ¯';

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for `uploadfile`
-- ----------------------------
DROP TABLE IF EXISTS `uploadfile`;
CREATE TABLE `uploadfile` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '0' COMMENT 'åŽŸåç§°',
  `savename` varchar(200) NOT NULL DEFAULT '0' COMMENT 'ä¿å­˜åç§°',
  `link` varchar(400) NOT NULL DEFAULT '0' COMMENT 'æ–‡ä»¶è·¯å¾„',
  `savepath` varchar(200) NOT NULL DEFAULT '0' COMMENT 'ä¿å­˜è·¯å¾„',
  `fileid` int(10) NOT NULL DEFAULT '0' COMMENT 'å¯¹åº”id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COMMENT='ä¸Šä¼ æ–‡ä»¶è·¯å¾„';

-- ----------------------------
-- Records of uploadfile
-- ----------------------------
INSERT INTO `uploadfile` VALUES ('35', 'QQ.png', '1472111295_42.png', '/Public/Uploads/image/2016-08-25/1472111295_42.png', '2016-08-25/', '1472111284');
INSERT INTO `uploadfile` VALUES ('36', '1468459774531849.jpg', '1472111337_16.jpg', '/Public/Uploads/image/2016-08-25/1472111337_16.jpg', '2016-08-25/', '1472111325');
INSERT INTO `uploadfile` VALUES ('37', 'about1.png', '1472115446_63.png', '/Public/Uploads/image/2016-08-25/1472115446_63.png', '2016-08-25/', '1472115226');
INSERT INTO `uploadfile` VALUES ('38', 'about2.png', '1472115455_83.png', '/Public/Uploads/image/2016-08-25/1472115455_83.png', '2016-08-25/', '1472115226');

-- ----------------------------
-- Table structure for `web_role`
-- ----------------------------
DROP TABLE IF EXISTS `web_role`;
CREATE TABLE `web_role` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(80) NOT NULL DEFAULT '0',
  `pid` int(80) NOT NULL DEFAULT '0' COMMENT 'çˆ¶èŠ‚ç‚¹',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='è§’è‰²ç»„è¡¨';

-- ----------------------------
-- Records of web_role
-- ----------------------------
INSERT INTO `web_role` VALUES ('1', '管理员', '1', '0', '0');
INSERT INTO `web_role` VALUES ('2', '编辑员', '1', '0', '0');

-- ----------------------------
-- Table structure for `web_user`
-- ----------------------------
DROP TABLE IF EXISTS `web_user`;
CREATE TABLE `web_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL COMMENT 'è´¦æˆ·',
  `password` varchar(50) DEFAULT NULL COMMENT 'å¯†ç ',
  `nickname` varchar(500) DEFAULT NULL COMMENT 'æ˜µç§°',
  `phone` varchar(20) DEFAULT NULL COMMENT 'ç”µè¯',
  `qq` int(18) DEFAULT NULL COMMENT 'QQ',
  `sex` int(1) DEFAULT NULL COMMENT 'æ€§åˆ«',
  `pic` varchar(300) DEFAULT NULL COMMENT 'å¤´åƒ',
  `role` varchar(50) DEFAULT NULL COMMENT 'è§’è‰²',
  `rid` int(6) DEFAULT NULL COMMENT 'è§’è‰²id',
  `ctime` int(6) DEFAULT NULL COMMENT 'åˆ›å»ºæ—¶é—´',
  `login` int(6) DEFAULT NULL COMMENT 'ç™»å½•æ¬¡æ•°',
  `lasttime` int(6) DEFAULT NULL COMMENT 'æœ€åŽç™»å½•æ—¶é—´',
  `lastip` varchar(50) DEFAULT NULL COMMENT 'æœ€åŽç™»å½•ip',
  `islock` int(1) DEFAULT '0' COMMENT 'é”å®š',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='ç³»ç»Ÿç”¨æˆ·è¡¨';

-- ----------------------------
-- Records of web_user
-- ----------------------------
INSERT INTO `web_user` VALUES ('1', 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'admin', '123456', null, null, null, '管理员', '1', '1471922981', null, null, null, '0');
INSERT INTO `web_user` VALUES ('2', 'root', 'd41d8cd98f00b204e9800998ecf8427e', 'root', '12345678', null, null, null, '编辑员', '2', '1471923788', null, null, null, '0');
