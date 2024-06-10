-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 10:32 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textsummarizer_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `c_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `msg` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`c_id`, `name`, `mail`, `subject`, `msg`) VALUES
('641cb20b5421f', 'nishi', 'nishi@gmail.com', 'try', 'hii'),
('641dfadfb7de5', 'Nishi Singhal', 'nishi@gmail.com', 'try', 'hii'),
('641dfb1617a47', 'Nishi Singhal', 'nishi@gmail.com', 'try', 'hii'),
('641dfe0c56c96', 'Nishi Singhal', 'nishi@gmail.com', 'try', 'hii');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `message`, `date`, `time`, `rating`) VALUES
('641aae9811d2d', 'u02', '', '2023-03-22', '01:00:32', 4),
('641aaed2f10d6', 'u02', 'jbgytrdxfcghvyju', '2023-03-22', '01:01:30', 4),
('641af4d011dd6', 'u02', '', '2023-03-22', '06:00:08', 4),
('641e97d034954', 'u02', 'gyftdresdfcgvhb', '2023-03-25', '12:12:24', 5),
('6437aaf1056f6', '6437a9a85bf0b', 'good', '2023-04-13', '12:40:41', 5);

-- --------------------------------------------------------

--
-- Table structure for table `functionality`
--

CREATE TABLE `functionality` (
  `func_id` varchar(50) NOT NULL,
  `func_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `functionality`
--

INSERT INTO `functionality` (`func_id`, `func_name`, `status`) VALUES
('f01', 'Text Summary', 'active'),
('f02', 'Summarize WebPage', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `usage_record`
--

CREATE TABLE `usage_record` (
  `record_id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `record_date` date NOT NULL,
  `func_used` varchar(50) NOT NULL,
  `usage_info` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usage_record`
--

INSERT INTO `usage_record` (`record_id`, `user_id`, `record_date`, `func_used`, `usage_info`) VALUES
('6430675f0a2e4', 'u02', '2023-04-08', 'f01', 'Modern humans arrived on the Indian subcontinent from Africa no later than 55,000 years ago. The region is second only to Africa in human genetic diversity. By 1200 BCE, an archaic form of Sanskrit had diffused into India from the northwest. Early political consolidations gave rise to the loose-knit Maurya and Gupta Empires.'),
('6430677e07b5c', 'u02', '2023-04-08', 'f01', 'In the early medieval era, Christianity, Islam, Judaism, and Zoroastrianism became established on India\'s southern and western coasts. Muslim armies from Central Asia intermittently overran India\'s northern plains. The Vijayanagara Empire created a long-lasting composite Hindu culture in south India. In the Punjab, Sikhism emerged, rejecting institutionalised religion.'),
('643067a0d9a4d', 'u02', '2023-04-08', 'f01', 'India has been a federal republic since 1950, governed through a democratic parliamentary system. It is a pluralistic, multilingual and multi-ethnic society. India\'s population grew from 361 million in 1951 to almost 1.4 billion in 2022. It has a space programme which includes several planned or completed extraterrestrial missions.'),
('643067e8d8cec', 'u02', '2023-04-08', 'f01', 'The name &quot;India&quot; is derived from the Classical Latin India, a reference to South Asia and an uncertain region to its east. The ancient Greeks referred to the Indians as Indoi, which translates as &quot;The people of the Indus&quot; The term Bharat (Bhārat) is mentioned in both Indian epic poetry and the Constitution of India.'),
('643068104ced3', 'u02', '2023-04-08', 'f01', 'The economy of India has transitioned from a mixed planned economy to a mixed middle-income developing social market economy. It is the world\'s fifth-largest economy by nominal GDP and the third-largest by purchasing power parity (PPP) Since the start of the 21st century, annual average GDP growth has been 6% to 7%. India accounted for 7.2% of global economy in 2022 in PPP terms, and around 3.4% in nominal terms.'),
('643068289d65c', 'u02', '2023-04-08', 'f01', 'Economic growth slowed down in 2017 due to the shocks of &quot;demonetisation&quot; in 2016 and the introduction of the Goods and Services Tax in 2017. India still has informal domestic economies; COVID-19 reversed both economic growth and poverty reduction. India ranks 63rd on the Ease of doing business index and 68th on the Global Competitiveness Report.'),
('64306853418d7', 'u02', '2023-04-08', 'f01', 'In 2022, India\'s ten largest trading partners were United States, China, United Arab Emirates (UAE), Saudi Arabia, Russia, Germany, Hong Kong, Indonesia, South Korea, and Malaysia. In 2021–22, the foreign direct investment (FDI) in India was $82 billion. The leading sectors for FDI inflows were the service sector, the computer industry, and the telecom industry.'),
('64306873292b7', 'u02', '2023-04-08', 'f01', 'The service sector makes up 50% of GDP and remains the fastest growing sector. The industrial sector and the agricultural sector employs a majority of the labor force. India is the world\'s sixth-largest manufacturer, representing 2.6% of global manufacturing output. Nearly 65% of India\'s population is rural, and contributes about 50% to its GDP.'),
('643068e4031c8', 'u02', '2023-04-08', 'f01', 'The film stars N. T. Rama Rao Jr., Ram Charan, Ajay Devgn, Alia Bhatt, Shriya Saran, Samuthirakani, Ray Stevenson, Alison Doody, and Olivia Morris. It centers around fictional versions of two Indian revolutionaries, Alluri Sitarama Raju (Charan) and Komaram Bheem (Rama Rao) Principal photography began in November 2018 in Hyderabad and continued until August 2021.'),
('6430691c14e97', 'u02', '2023-04-08', 'f01', 'The film was initially scheduled for theatrical release on 30 July 2020, which was postponed multiple times due to production delays and the COVID pandemic. RRR was released theatrically on 25 March 2022. Made on a budget of ₹550 crore (US$72 million), RRR is the most expensive Indian film to date.'),
('64306970d952a', 'u02', '2023-04-08', 'f01', 'RRR received universal praise for Rajamouli\'s direction, writing, performances (particularly Rama Rao and Charan), soundtrack, action sequences, cinematography and visual effects. The film was considered one of the ten best films of the year by the National Board of Review, making it only the second non-English language film ever to make it to the list. The song &quot;Naatu Naatu&quot; won the Best Original Song award at the 95th Academy Awards.'),
('643069db1f4d3', 'u02', '2023-04-08', 'f01', 'In 1920, during the British Raj, Governor Scott Buxton and his wife Catherine visit a forest in Adilabad and there abduct Malli, a young girl with a talent for artistry, from the Gond tribe. Enraged by this, the tribe\'s guardian Komaram Bheem embarks for Delhi to rescue her, disguising himself as a Muslim man named Akhtar. The Nizamate of Hyderabad, sympathetic to the Raj, warns Scott\'s office of the impending danger. Catherine enlists A. Rama Raju, an ambitious officer in the Indian Imperial Police, to quell the threat.'),
('64306a5c2f8f4', 'u02', '2023-04-08', 'f01', 'Bheem\'s men barge into Scott\'s residence with a lorry filled with wild animals, which creates havoc among the assembled guests. Raju arrives and tells him Scott intends to kill Malli; he surrenders out of obligation. In the aftermath of the incident, Raju is promoted for thwarting Bheem, yet he is absorbed with guilt.'),
('64306a8fe420e', 'u02', '2023-04-08', 'f01', 'Bheem infiltrates the barracks where Raju is detained and frees him. Unaware of Bheem\'s identity, she reveals Raju\'s actual, anti-colonial objectives. The pair retreat to a nearby forest, where they decimate more soldiers with a longbow taken from a Rama shrine.'),
('64368ab236ad1', 'u02', '2023-04-12', 'f01', 'Modern humans arrived on the Indian subcontinent from Africa no later than 55,000 years ago. By 1200 BCE, an archaic form of Sanskrit, an Indo-European language, had diffused into India from the northwest. Early political consolidations gave rise to the loose-knit Maurya and Gupta Empires.'),
('6437ab4be9ced', '6437a9a85bf0b', '2023-04-13', 'f01', 'Amitabh Bachchan is an Indian actor, film producer, television host, occasional playback singer and former politician. Referred to as the Shahenshah of Bollywood, Sadi Ke Mahanayak (Hindi for, &quot;Greatest actor of the century&quot;), Star of the Millennium, or Big B. Bachchan was born in 1942 in Allahabad to the Hindi poet Harivansh Rai Bachchan and his wife, the social activist Teji Bachchan. He has appeared in over 200 Indian films in a career spanning more than five decades.'),
('6437b311642ae', '641fffd104e82', '2023-04-13', 'f02', 'Amitabh Bachchan - Wikipedia Jump to content Main menu Main menu move to sidebar hide Navigation Main page ContentsCurrent eventsRandom articleAbout WikipediaContact usDonate Contribute HelpLearn to editCommunity portalRecent changesUpload file Languages Language links are at the top of the page across from the title. Search Create accountLog in Personal tools Create account Log in Pages for logged out editors learn more ContributionsTalk Contents move tosidebar hide (Top) 1Early life and family 2Acting career Toggle Acting career subsection 2.1Television appearances 3.2Voice-acting 3.3Business investments 4Political career 5Humanitarian and social causes 6Personal life 7Filmography 8Legacy Toggle Legacy subsection 8.1Autobiography 8.2Biographies 9Awards and honours 10See also 11References 12Further reading 13External links Toggle the table of contents Toggle thetable of contents AmitabH Bachchan. 108 languages  ቛርኛ   “العرب’s” “I’m a big fan of this actor.”'),
('6437b33bd72aa', '641fffd104e82', '2023-04-13', 'f02', 'Amitabh Bachchan - Wikipedia Jump to content Main menu Main menu move to sidebar hide Navigation Main page ContentsCurrent eventsRandom articleAbout WikipediaContact usDonate Contribute HelpLearn to editCommunity portalRecent changesUpload file Languages Language links are at the top of the page across from the title. Search Create accountLog in Personal tools Create account Log in Pages for logged out editors learn more ContributionsTalk Contents move tosidebar hide (Top) 1Early life and family 2Acting career Toggle Acting career subsection 2.1Television appearances 3.2Voice-acting 3.3Business investments 4Political career 5Humanitarian and social causes 6Personal life 7Filmography 8Legacy Toggle Legacy subsection 8.1Autobiography 8.2Biographies 9Awards and honours 10See also 11References 12Further reading 13External links Toggle the table of contents Toggle thetable of contents AmitabH Bachchan. 108 languages  ቛርኛ   “العرب’s” “I’m a big fan of this actor.”'),
('6437b348069c2', '641fffd104e82', '2023-04-13', 'f01', 'Amitabh Bachchan - Wikipedia Jump to content Main menu Main menu move to sidebar hide Navigation Main page ContentsCurrent eventsRandom articleAbout WikipediaContact usDonate Contribute HelpLearn to editCommunity portalRecent changesUpload file Languages Language links are at the top of the page across from the title. Search Create accountLog in Personal tools Create account Log in Pages for logged out editors learn more ContributionsTalk Contents move tosidebar hide (Top) 1Early life and family 2Acting career Toggle Acting career subsection 2.1Television appearances 3.2Voice-acting 3.3Business investments 4Political career 5Humanitarian and social causes 6Personal life 7Filmography 8Legacy Toggle Legacy subsection 8.1Autobiography 8.2Biographies 9Awards and honours 10See also 11References 12Further reading 13External links Toggle the table of contents Toggle thetable of contents AmitabH Bachchan. 108 languages  ቛርኛ   “العرب’s” “I’m a big fan of this actor.”'),
('6437b8bd8d36a', '6437a9a85bf0b', '2023-04-13', 'f02', 'Amitabh Bachchan is an Indian actor, film producer, television host, occasional playback singer and former politician. Referred to as the Shahenshah of Bollywood, Sadi Ke Mahanayak (Hindi for, &quot;Greatest actor of the century&quot;), Star of the Millennium, or Big B. Bachchan first gained popularity in the early 1970s for films such as Zanjeer, Deewaar and Sholay. He has won numerous accolades in his career, including four National Film Awards as Best Actor, Dadasaheb Phalke Award as lifetime achievement award and many awards at international film festivals and award ceremonies.'),
('6437ba8f22579', '6437a9a85bf0b', '2023-04-13', 'f01', 'Amitabh Bachchan is an Indian actor, film producer, television host, occasional playback singer and former politician. Referred to as the Shahenshah of Bollywood, Sadi Ke Mahanayak (Hindi for, &quot;Greatest actor of the century&quot;), Star of the Millennium, or Big B. Bachchan first gained popularity in the early 1970s for films such as Zanjeer, Deewaar and Sholay. He has won numerous accolades in his career, including four National Film Awards as Best Actor, Dadasaheb Phalke Award as lifetime achievement award and many awards at international film festivals and award ceremonies.'),
('6437bada90855', '6437a9a85bf0b', '2023-04-13', 'f01', 'Amitabh Bachchan is an Indian actor, film producer, television host, occasional playback singer and former politician. Referred to as the Shahenshah of Bollywood, Sadi Ke Mahanayak (Hindi for, &quot;Greatest actor of the century&quot;), Star of the Millennium, or Big B. Bachchan first gained popularity in the early 1970s for films such as Zanjeer, Deewaar and Sholay. He has won numerous accolades in his career, including four National Film Awards as Best Actor, Dadasaheb Phalke Award as lifetime achievement award and many awards at international film festivals and award ceremonies.');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_email`, `username`, `password`, `role`) VALUES
('641dee1e128e7', 'nishisinghal@gmail.com', 'NishiSinghal', 'f87dab8d027236545a2257c668603a4d', 'user'),
('641df95bd41b4', 'nishisinghal2001@gmail.com', 'NishiSinghal', 'f87dab8d027236545a2257c668603a4d', 'user'),
('641fffd104e82', 'nishi123@gmail.com', 'NishiSinghal', 'fc6d8e46ccb1105565f0356b4868f720', 'user'),
('6420302a1cc2b', 'CC@abc.com', 'AABB', '900150983cd24fb0d6963f7d28e17f72', 'user'),
('6437a9a85bf0b', 'shreya12@gmail.com', 'shreyaAwasthi', '0085a15e3bf57ab54d6a895f15b6b102', 'user'),
('u01', 'admin@gmail.com', 'admin', '6b1049159fb98132913a5e5b8bde49bd', 'admin'),
('u02', 'nishi@gmail.com', 'nishi', 'eac873e7039579fa26570afb651d5685', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `functionality`
--
ALTER TABLE `functionality`
  ADD PRIMARY KEY (`func_id`);

--
-- Indexes for table `usage_record`
--
ALTER TABLE `usage_record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
