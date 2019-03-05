-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 03:17 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `aname` varchar(100) NOT NULL,
  `apass` varchar(32) NOT NULL,
  `anicheng` char(100) NOT NULL,
  `aphoto` char(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `aname`, `apass`, `anicheng`, `aphoto`) VALUES
(1, 'tt', 'e10adc3949ba59abbe56e057f20f883e', 'tt', 'root/17-10-02/15069446171822tx.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(10) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cenglish` varchar(100) NOT NULL,
  `cintro` varchar(200) NOT NULL,
  `cimg` char(255) NOT NULL,
  `pid` int(10) NOT NULL,
  `state` int(2) NOT NULL,
  `isshow` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `cname`, `cenglish`, `cintro`, `cimg`, `pid`, `state`, `isshow`) VALUES
(1, '宠物品种', 'PET TYPE', '宠物和人类是一家人', '', 0, 1, 0),
(2, '宠物用品', 'PET SUPPLIES', '任何需求都是您对宠物的爱', '', 0, 0, 0),
(4, '留言博客', 'MESSAGE BLOG', '更多呵护、更多互动、更多爱', '', 0, 1, 0),
(5, '加入我们', '', '', '', 0, 0, 0),
(6, 'Dog pets', '', '', '', 1, 0, 0),
(7, 'Cat pets', '', '', '', 1, 0, 0),
(8, 'Other pets', '', '', '', 1, 0, 0),
(11, '图片', 'img', '', '', 0, 0, 1),
(12, '犬类文章', 'Dog Aritcle', '', '', 4, 0, -1),
(13, '猫类文章', 'Cat Article', '', '', 4, 0, -1),
(14, '其他类文章', 'Other Article', '', '', 4, 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `jid` int(10) NOT NULL,
  `jname` varchar(100) NOT NULL,
  `jnum` tinyint(10) NOT NULL,
  `jplace` varchar(200) NOT NULL,
  `jprice` varchar(100) NOT NULL,
  `jintro` varchar(500) NOT NULL,
  `jrequired` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jid`, `jname`, `jnum`, `jplace`, `jprice`, `jintro`, `jrequired`) VALUES
(1, '宠物医生', 2, '太原市小店区', '4-5k', '1、负责宠物病情的检测、医治等工作。\r\n2、负责教导其他人员对宠物的日常护理。', '1、有此行业的从事经验，3年以上医治经验。\r\n2、对宠物有爱心。');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int(10) NOT NULL,
  `uid1` int(10) NOT NULL,
  `uid2` int(10) NOT NULL,
  `mtitle` varchar(200) NOT NULL,
  `mcon` varchar(3000) NOT NULL,
  `mtime` varchar(100) NOT NULL,
  `sid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `uid1`, `uid2`, `mtitle`, `mcon`, `mtime`, `sid`) VALUES
(1, 2, 0, '沙发', '第一个留言', '17-10-17', 23),
(13, 6, 2, 'wwqe', 'qwe', '2017-10-18 09:31:07', 32),
(14, 2, 2, 'as', 'asd', '2017-10-18 09:31:39', 32);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `posid` int(10) NOT NULL,
  `posname` char(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`posid`, `posname`) VALUES
(1, '主页面热门宠物'),
(2, '轮播图'),
(3, '分页面主图'),
(4, '主页面用品'),
(6, '主页面模块图片');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `sid` int(10) NOT NULL,
  `stitle` varchar(200) NOT NULL,
  `sintro` varchar(200) NOT NULL,
  `scon` varchar(5000) NOT NULL,
  `simg` varchar(2000) NOT NULL,
  `sprice` varchar(20) NOT NULL,
  `snum` varchar(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `posid` int(10) NOT NULL,
  `uid` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`sid`, `stitle`, `sintro`, `scon`, `simg`, `sprice`, `snum`, `cid`, `posid`, `uid`) VALUES
(1, '卷毛比雄犬', '111', '<p>比雄犬性格友善、活泼，聪明伶俐，有优良的记忆力，会作各种各样的动作引人发笑。但对生人凶猛。由于它们长期与人们相伴，对人的依附性很大，非常友善，是很好的家庭伴侣犬。\r\n外形有如绵塘一般，头部覆盖着丰富的冠毛，眼睛下部如刀削似的成弧状，身体肌肉发达，尾巴上翘。全身密生着丝一样的细毛，分为上被毛和下被毛，毛色以米色、杏黄色、白色等较好。通常将其修剪成粉扑状。 比雄犬性格友善、活泼，聪明伶俐，有优良的记忆力，会作各种各样的动作引人发笑，但对生人凶猛。由于它们长期与人们相伴，对人的依附性很大，非常友善，是很好的家庭伴侣犬。唯一不足的是要经常为其梳洗打扮，日常养护占用时间较多。温和而守规矩，敏感、顽皮、且挚爱。快乐、友好、活泼，而且很容易因为小事情而满足。是一种令人爱不释手的小宠物。对大多数主人能提供的运动量，都能适应。\r\n以双层毛皮形成的蓬松外形而著名，毛质纤细卷曲如丝般柔软，通常都绕过眼睛而向后修剪，圆脸的形象突出。受上流人士所喜爱，据说贵妇人皆与此犬一起洗澡，外形有如绵塘一般。此犬种约在二十年前就深受美国爱犬者喜爱，而流传全世界。</p><p><img src="../../../php/pet/index/upload/image/20171016/1508123888135007.jpg" title="1508123888135007.jpg" alt="jmbxq2.jpg"/></p>', 'root/17-10-03/15070006978323b1.jpg', '0', '0', 6, 2, 0),
(2, '布偶猫', '', '布偶猫，又称“布拉多尔（Ragdoll）”，发源于美国，是一种杂交品种宠物猫。是现存体型最大、体重最重的猫之一。头呈楔形，眼大而圆，被毛丰厚，四肢较长且富有肉感，尾长，身体柔软，毛色有重点色、手套色或双色等等。布偶猫较为温顺好静，对人友善。其美丽优雅又非常类似于狗的性格（Puppy cat）而又被称为"仙女猫"，"小狗猫"。特殊的外貌和温和的性格是布偶猫最大的特点之一。\r\n布偶猫异常温柔，较适宜室内饲养。一般应为它们做绝育并提供适当的生活环境，例如配备猫抓板来适应它们的抓挠习惯等：这些是维持它们健康长寿和快乐的基本条件。\r\n布偶猫会舔洗和梳理一身中等长度的丝状毛发。如果要给它们梳理毛发的话可以抱着用钢针排梳梳理，使它们举止优雅。\r\n布偶猫善于讨好主人，总是形影不离地围着主人转，这种猫喜静，但也爱玩玩具，并喜欢参与家中的日常生活。', 'root/17-10-03/15070247446116500376444.jpg', '0', '0', 7, 2, 0),
(4, '挪威森林猫', '', '挪威森林猫（Norwegian Forest Cat），以白话直译的说法，就是在挪威森林里面栖息的，生存的猫，这是斯堪地半岛特有的品种，其起源不明，常常以像妖精的猫出现在北欧的神话之中。挪威森林猫外观与缅因猫相似，与西伯利亚森林猫同列。森林猫生长的环境非常寒冷和恶劣，因此它长有比其它猫更厚密的被毛和强壮的体格。挪威森林猫体大肢壮，奔跑速度极快，不怕日晒雨淋，行走时颈毛和尾毛飘逸，非常美丽。但是，生长在挪威森林内地的猫，数目已逐年减少，一时有绝迹的危机。因而，在进入一九七零年代初期，努力保存、繁殖，就显得格外重要。\r\n挪威森林猫性格内向，独立性强，聪颖敏捷，机灵警觉，行动谨慎，喜欢冒险和活动，且能抓善捕，善爬树攀岩，有“能干的狩猎者”之美誉 。因而不适宜长期饲养在室内，最好饲养在有庭院和环境比较宽敞的家庭。', 'root/17-10-08/15074439447407cbdbfc9b8bce6332a544e6d575bec542.jpg', '0', '0', 7, 2, 0),
(5, '金丝熊', '', '金丝熊，英文名Syrian Hamster、Golden Hamster，是仓鼠的一种。产于亚洲西部的叙利亚、黎巴嫩、以色列等地，1938年引入美国后才正式成为宠物分类，属鼠类。其形态像熊，成年体重0.2公斤，二十世纪九十年代在中国浙江建德等地引种饲养。性情较温顺，是仓鼠当中最早成为人类宠物的。毛色棕黄，有的带褐色斑点或白色毛，适应性强，各地均可饲养。主食各种植物种子。\r\n主食以各种杂草种子和粮食为主，偶尔猎食昆虫,有储存食物的习性，家养仓鼠不冬眠，\r\n金丝熊\r\n金丝熊(9张)\r\n但防止伪冬眠，它们会储存食物过冬。人工饲养情况下可喂鼠粮、水果干、适量的蔬菜。喂养时一般喂食金丝熊专用的鼠粮，在以鼠粮为主的时候，也要注意喂一些面包虫和小鱼干。金丝熊有把食物贮存在颊囊里的习性。', 'root/17-10-08/15074439723756b1.jpg', '0', '0', 8, 2, 0),
(6, '哈士奇', '', '哈士奇，正名西伯利亚雪橇犬，俗名为二哈。西伯利亚雪橇犬体重介于雄犬20-27公斤，雌犬16-23公斤，身高大约雄犬肩高53-58厘米，雌犬51-56厘米，是一种中型犬。\r\n西伯利亚雪橇犬是原始的古老犬种，在西伯利亚东北部、格陵兰南部生活。哈士奇名字的由来，是源自其独特的嘶哑声。哈士奇性格多变，有的极端胆小，也有的极端暴力，进入大陆和家庭的哈士奇，都已经没有了这种极端的性格，比较温顺，是一种流行于全球的宠物犬。与金毛犬、拉布拉多并列为三大无攻击型犬类。被世界各地广泛饲养，并在全球范围内，有大量该犬种的赛事。\r\n哈士奇生性好群居，但在群体中有着明显的等级制度。在狗饲养场、农村、城郊的狗群中，总由一条头狗（通常是老狗）支配、管辖着全群。级别高或资格老的头狗怎样表明它的等级上风呢？通常采用以下几种特定动作来表示：如答应它而不答应对方检查它狗的生殖器官；不准对方向另一只狗排过尿的地方排尿；对方可在头狗眼前摇头、摆尾、耍顽皮、退走、坐下、躺下，当头狗离开时，方可站住；等级上风明确后，敌对状态消除，开始成为朋友。狗对其主人也会表现同样的姿势。', 'root/17-10-03/150702535283403a4ea02a41b4b34851f8f9089d743bc0.jpg', '0', '0', 6, 2, 0),
(7, '挪威森林猫', '', '', 'root/17-10-08/15074438913144500376444.jpg', '0', '0', 7, 2, 0),
(8, '宠物护理', '', '', 'root/17-10-09/15075098529755pettype.jpg;root/17-10-09/15075098523003hl.jpg', '0', '0', 11, 3, 0),
(9, '泰迪犬', '', '泰迪狗是非常受欢迎的体型较小的宠物伴侣。欢快，好动，聪明的特点让很多女士们选择泰迪狗做宠物。', 'root/17-10-09/15075139514244td.jpg', '0', '0', 6, 1, 0),
(10, '萨摩犬', '', '摩耶德犬有着非常引人注目的外表：雪白的被毛，微笑的脸和黑色而聪明的眼睛，是现在的犬中最漂亮的一种。萨摩耶德犬天生聪明，对主人绝对忠诚。', 'root/17-10-09/15075140186582smq.jpg', '0', '0', 6, 1, 0),
(11, '宠物毛刷', '狗狗清洁毛刷 清洁脚部防伤皮肤', '<ul class="p-parameter-list list-paddingleft-2" style="list-style-type: none;"><li><p>品牌：&nbsp;<a href="https://list.jd.com/list.html?cat=6994,7001,7037&ev=exbrand_13850" target="_blank" style="margin: 0px; padding: 0px; color: rgb(94, 105, 173); text-decoration-line: none;">派克瑞（Petlot）</a></p></li><li><p>商品名称：狗狗清洁毛刷 清洁脚部防伤皮肤 大小型犬宠物猫咪通用 普蓝 S-小号</p></li><li><p>商品编号：14654983314</p></li><li><p>店铺：&nbsp;<a href="https://mall.jd.com/index-695203.html" target="_blank" style="margin: 0px; padding: 0px; color: rgb(94, 105, 173); text-decoration-line: none;">小萌主宠物用品专营店</a></p></li><li><p>商品毛重：1.0kg</p></li><li><p>货号：pkrdmms</p></li><li><p>适用对象：通用</p></li><li><p>分类：梳子/刷子</p></li><li><p>梳/刷分类：排梳</p></li></ul><p><br/></p>', 'root/17-10-15/15080814423554ms1.jpg;root/17-10-15/15080814421789ms2.jpg;root/17-10-15/15080814423059ms3.jpg', '20', '49', 2, 4, 0),
(12, '宠物饭盒', '', '', 'root/17-10-15/15080814681974fh1.jpg;root/17-10-15/15080814682164fh2.jpg;root/17-10-15/15080814681029fh3.jpg', '25', '50', 2, 4, 0),
(13, '宠物之家', '温暖小窝', '<p>&nbsp;宠物之家宠物之家宠物之家宠物之家宠物之家宠物之家宠物之家</p>', 'root/17-10-15/15080815188861cww1.jpg;root/17-10-15/15080815181235cww2.jpg;root/17-10-15/15080815182762cww3.jpg', '59', '66', 2, 4, 0),
(14, '橡胶保龄球', '', '<p>&nbsp;橡胶保龄球橡胶保龄球橡胶保龄球橡胶保龄球橡胶保龄球</p>', 'root/17-10-09/15075147603164yp5.jpg', '0', '0', 2, 4, 0),
(15, '如何让猫在指固定地点睡觉', '在猫买回来之前就要给它准备好一个 宠物窝或箱子，在里面棉垫或草，如果是冬天，还要在里面放上一个热水袋或装窝放置在一个温暖的地方', '<p>&nbsp;猫调教训练，首先在猫买回来之前就要给它准备好一个 宠物窝或箱子，在里面棉垫或草，如果是冬天，还要在里面放上一个热水袋或装窝放置在一个温暖的地方，让猫每天固定在里面睡觉。\r\n如果发现猫不愿意回到窝里睡觉，而跑到人的被窝进而睡时，养猫的主人就要发出“不可以”的口令，同时把猫再放回到它自己的窝里，并用铁丝网做的罩子把箱子盖好，强迫猫在里面睡觉。这样反复训练几回，就能使猫逐渐养成在固定地方睡觉的良好习惯。</p>', 'root/17-10-12/1507796948376msj.jpg', '0', '0', 13, 5, 0),
(17, '布偶猫', '', '布偶猫是全身特别松弛柔软，像软绵绵的布偶一样。该猫体型大，身体长、肌肉发达、胸部宽、颈粗而短，发育期长，幼猫要4年左右才能完全发育成熟。其特征是头大而呈楔形，头顶扁平，眼睛为深蓝色，吻部呈圆形，短鼻子上略有凹陷，有的脸上有“V”形斑纹，颈部被毛较长，属毛长猫类。布偶猫手套色前脚掌上好像戴着手套，两只手套呈白色，大小相似，且不超出腿和脚掌形成的角度。后腿上白色靴子向上延伸至后脚踝关节，整个身体下方由下巴至尾部也都是白色。布偶猫有三种颜色图案：双色、手套和重点色。这些图案各分6种颜色：海豹色、蓝色、巧克力色、淡紫色、红色和乳色。所有颜色均可附加山猫纹、玳瑁或同时附加山猫及玳瑁。', 'root/17-10-11/1507709874134bom.jpg', '0', '0', 7, 1, 0),
(18, '毛丝鼠', '', '毛丝鼠性情温顺，不咬人，喜欢群居，善于跳跃，胆小怕惊扰，习惯于白天安睡，夜间觅食，喜欢在笼中仰卧于柔和的阳光下。平时雌雄个体相处和睦，极少吵架，只有在繁殖配偶季节偶尔发生争斗现象。雌、雄毛丝鼠交配时，发出柔和的像鸽子一样的“咕咕”声。\r\n毛丝鼠喜欢干燥阴凉的环境，适宜的温度是2～30℃，气温为零度以下，或30℃以上均不适宜其生长。雨水太多，潮湿和寒风对毛丝鼠的生长发育都不利。因此，一般毛丝鼠都在室内较暗的环境中饲养。\r\n毛丝鼠喜欢吃鲜嫩多汁的植物，也喜欢吃树皮、干草和种子。在人工饲养条件下，通常饲喂干草、谷物和青饲料，或配合饲料。成年毛丝鼠的采食量约为体重的5%～6%。毛丝鼠吃食时的姿势很像松鼠，后肢坐立，用前肢抓取食物，一点一点地送进嘴里。毛丝鼠的寿命一般为15～20年，其中有8～10年具有繁殖力。\r\n沙浴是毛丝鼠最重要的习性。喜在沙盘中打滚、嬉戏，清洁身体，并有啮齿动物咬嘴的习惯。', 'root/17-10-11/15077104711301mss.jpg', '0', '0', 8, 1, 0),
(19, '边境牧羊犬', '', '边境牧羊犬是世界上智商最高的犬，教他学习一个新知识不需要超过5次他就能完成，在主人的教导下也能学会很多东西，不过它会尽可能地与你斗智斗勇。', 'root/17-10-11/15077132237996myq.jpg', '0', '0', 6, 1, 0),
(20, '阿拉斯加犬', '阿拉斯加雪橇犬对环境的要求很高，由于其源于寒带，因此不甚耐热，需要长期保持一个比较凉爽的环境。', '<p>阿拉斯加雪橇犬对环境的要求很高，由于其源于寒带，因此不甚耐热，需要长期保持一个比较凉爽的环境。此犬的活动能力极强，因此其居住环境需要比较宽敞，更重要的是保证它充足的运动量。</p><p>阿拉斯加雪橇犬天生肠胃功能就较差，特别是幼犬，更加容易患肠胃方面的疾病，轻者无食欲，重者上吐下泻。</p><p><br/></p>', 'root/17-10-12/15077890054507alsj.png', '0', '0', 6, 1, 0),
(21, '宠物皮球', '', '', 'root/17-10-13/15078569856199cwpq.jpg', '0', '0', 2, 4, 0),
(22, '七彩玲', '', '', 'root/17-10-13/15078573318738qcl.jpg', '0', '0', 2, 4, 0),
(23, '养两只狗能否改善分离焦虑', '患有分离焦虑的狗狗通常比较黏人，当然也可能是这种狗比较有责任心，因为在它们看来你是它的保护对象。有的狗狗会焦虑则是因为它们的责任心过强，或者说它们把自己当成了这个家的头领。', '<p style="text-indent: 2em;"><span style="font-size: 14px;">患有分离焦虑的狗狗通常比较黏人，当然也可能是这种狗比较有责任心，因为在它们看来你是它的保护对象。有的狗狗会焦虑则是因为它们的责任心过强，或者说它们把自己当成了这个家的头领。</span></p><p style="text-indent: 2em;"><span style="font-size: 14px;">患有分离焦虑的狗狗通常比较黏人，当然也可能是这种狗比较有责任心，因为在它们看来你是它的保护对象。所以当它们看不到你的身影时就会惊慌焦虑，要改善这种情况需要慢慢训练。而有人提出通过饲养两条狗狗来缓解这一情况。</span></p><p style="text-indent: 2em;"><span style="font-size: 14px;">那么养两只狗狗有助于减缓分离焦虑症呢?其实这样的做法并不能很好地改善这一问题，如果狗狗本身就有分离焦虑，第二只小狗到家里后，在错误中学习另一只狗狗的习性，那么很可能两条狗狗都有可能出现分离焦虑的问题。</span></p><p style="text-indent: 2em;"><span style="font-size: 14px;">一次养两只狗狗跟分离焦虑症没有正相关，它们很可能都会在主人离开后感到焦虑;而且如果它们过于依赖彼此，那主人在将其中一只带离时，另一只也会躁郁不安，反而不是好事情。</span></p><p style="text-indent: 2em;"><span style="font-size: 14px;">所以说，当狗狗有分离焦虑症时，最重要的就是利用训练弱化狗狗对于主人要出门的敏锐度，只要让它们知道“主人并不不是一去不回”以及“自己在家其实没什么大不了的”，狗狗习惯后就能稳定许多。</span></p><p style="text-indent: 2em;"><span style="font-size: 14px;">所以这就需要给狗狗一个习惯的过程，主人起身穿外套拿钥匙(假装要出门)后，又坐回去看电视，多练习几次，让狗狗对于准备出门的这些举动越来越无感。在出门前才给平时都不会吃的美味零食，这样狗狗就会把主人出门与获得奖励所联系起来。</span></p><p style="text-indent: 2em;"><span style="font-size: 14px;">有的狗狗会焦虑则是因为它们的责任心过强，或者说它们把自己当成了这个家的头领。而保护我们就是它们的职责，当我们不在它们的保护范围内时，它们就会出现焦躁不安的情况。对于这种情况的狗狗就需要让它们正确对待自己在家中的地位，如果它们卸下了身上的责任就会放松很多。这需要一段时间去让它们适应只要它们知道，我们的外出是没有危险的，外出之后我们还会回来，那么焦虑的情况就会逐渐改善。</span></p>', 'root/17-10-13/15078584129668blog.png', '0', '0', 12, 5, 0),
(32, '狗狗的卫生', '卫生很重要。', '<p>卫生很重要。卫生很重要。卫生很重要。卫生很重要。卫生很重要。卫生很重要。</p>', 'root/17-10-15/15080770285535ggws.jpg', '0.00', '99', 12, 0, 2),
(33, '褴褛猫', '褴褛猫属于长毛猫，但打理起来并不费劲，虽然这身被毛又厚又长，但并不容易打结，梳理起来很方便。', '<p style="text-indent: 0em;"><span style="font-size: 16px;"><span style="font-size: 18px;"><strong>基本介绍</strong></span><br/></span></p><p style="text-indent: 2em;"><span style="font-size: 16px;">褴褛猫是一种大体型猫，成年母猫体重在10到15磅之间，而公猫体重在15到20磅之间。褴褛猫是个小胖子，这得益于他们结实而厚重的骨骼和丰富皮下脂肪。褴褛猫要大约四岁才能完全成熟，并拥有有很长的寿命。他们强壮和健康体魄，到目前为止还没有发现遗传疾病和基因缺陷。当你第一次从远处看到褴褛猫，你会发现自己会生出一种敬畏的情感。但当你走近它时，你会发现一双大而美丽的眼睛乞求你的爱抚。褴褛猫拥有美丽的颜色，柔软的被毛和完美的身躯。</span></p><p style="text-indent: 0em;"><span style="font-size: 18px;"><strong>性格特点</strong></span></p><p style="text-indent: 2em;">褴褛猫个性是一个极端甜，以那些的特征相似与一只可爱的哈叭狗。 每一个这些猫在注意上兴旺，并且它为任何它们中的一个不是异常的招呼您在门，跟随您从室对室和适合您忠实的伴侣。 它们非常做美妙的家庭宠物，充满喜爱对授予大家在家庭，包括您的其他宠物。</p><p style="text-indent: 2em;">褴褛猫是美妙的与孩子。 它们的镇静和耐心气质借自己对聒噪，健壮戏剧年轻人和它们可能容易地被发现出席茶会或采取在婴儿车乘坐。 只要它们有人的注意并且感兴趣，它们脾气随和的个性使它们能适应到几乎所有环境或情况。</p><p style="text-indent: 2em;">当您读一本书或看电视，褴褛猫可能倾向于是在您的膝部和意志将被发现卷曲的安静。 然而，这些不是懒惰猫。 请拿出它们的玩具，并且您将发现他们准备好行动。</p><p><br/></p>', 'root/17-10-15/15080798533889llm1.jpg;root/17-10-15/15080798536817llm2.jpg;root/17-10-15/15080798535210llm3.jpg', '8000-10000', '3', 7, 1, 0),
(34, '狗狗珍珠波点蝴蝶结拉颈套装', '适用对象：猫咪狗狗通用 配套：项圈、牵引绳', '<p>产品名称：韵声狗狗珍珠波点蝴蝶结拉颈套装</p><p>品牌：韵声Wincent&nbsp;<br/></p><p>适用对象：猫咪狗狗通用<br/></p><p>配套：项圈、牵引绳<br/></p><p>规格：S-小型 全长约120cm<br/></p><p>是否可伸缩：不可伸缩</p><p>材质：优质移膜皮，高档丝质蝴蝶结<br/></p><p><br/></p>', 'root/17-10-15/1508080726155hdj2.jpg;root/17-10-15/15080807268302hdj3.jpg;root/17-10-15/15080807263389hdj4.jpg;root/17-10-15/1508080726417hdj1.jpg', '29.8', '29', 2, 0, 0),
(35, '星记消防栓FP造型玩具组合', '星记消防栓FP造型玩具组合，由美国顶尖的宠物训练专业机构Triple Crown研发生产', '<p>星记消防栓FP造型玩具组合，由美国顶尖的宠物训练专业机构Triple Crown研发生产，通过他们对各型犬只的观察及特殊的专利设计，发展出最适合陪伴狗狗的智能型玩具，使您的爱犬可以从游乐中获得乐趣与零食享受，犹如您的爱心陪伴一般。搭配星记磨牙饼的独特的专利造型，添加三钙磷酸盐及碳酸钙，清除牙垢和牙结石。延长玩耍时间，打发无聊时光。</p><p>所属品牌:星记&nbsp;<br/></p><p>产品规格:460g&nbsp;<br/></p><p>适用类型:犬</p><p>适用年龄:3月以上宠物<br/></p><p>主要成分：特殊软胶材质，磨牙饼成分：小麦蛋白，明胶，水，甘油，天然香料，玉米蛋白，大蒜粉，啤酒酵母，卵磷脂等。<br/></p><p>【商品品牌】：星记&nbsp;<br/></p><p>【产地】：中国<br/></p><p><br/></p>', 'root/17-10-15/15080811431046xfs2.png;root/17-10-15/15080811436886xfs1.jpg;root/17-10-15/15080811431304xfs3.jpg', '16.8', '99', 2, 0, 0),
(36, 'qwe', 'qwe', '<p><img src="/ueditor/php/upload/image/20171016/1508120087808136.jpg" title="1508120087808136.jpg" alt="tx.jpg"/></p>', 'root/17-10-16/15081201097310tx.jpg', '', '', 2, 0, 0),
(37, 'qqq', 'qqq', '<p><img src="/ueditor/php/upload/image/20171016/1508120169740576.jpg" title="1508120169740576.jpg" alt="tx.jpg"/></p>', 'root/17-10-16/15081201746707tx.jpg', '', '', 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(10) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `upass` varchar(32) NOT NULL,
  `uimg` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `upass`, `uimg`) VALUES
(2, 'ttt', 'e10adc3949ba59abbe56e057f20f883e', ''),
(6, 'lmr', 'e10adc3949ba59abbe56e057f20f883e', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`jid`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`posid`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `posid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
